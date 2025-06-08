<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class HomepageBannerController extends Controller
{
    // Menampilkan daftar homepage banner dengan data lengkap untuk modal
    public function index()
    {
        try {
            $banners = HomepageBanner::orderBy('created_at', 'desc')->get()->map(function ($banner) {
                $banner->image_url = $banner->image_path ? Storage::url($banner->image_path) : null;
                return $banner;
            });
            
            return view('admin.homepage_banners.index', compact('banners'));
        } catch (Exception $e) {
            Log::error('Failed to load banners: ' . $e->getMessage());
            return redirect()->back()->with('toast_error', 'Failed to load banners: ' . $e->getMessage());
        }
    }

    // Menyimpan banner baru ke database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'image' => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048', // Max 2MB
            ], [
                'title.required' => 'Title is required.',
                'title.max' => 'Title must not exceed 255 characters.',
                'description.required' => 'Description is required.',
                'description.max' => 'Description must not exceed 1000 characters.',
                'image.required' => 'Image is required.',
                'image.image' => 'File must be an image.',
                'image.mimes' => 'Image must be a file of type: jpg, jpeg, png, bmp, gif, svg.',
                'image.max' => 'Image size must not exceed 2MB.',
            ]);

            DB::beginTransaction();

            // Check if image upload is successful
            if (!$request->hasFile('image')) {
                throw new Exception('No image file uploaded');
            }

            $image = $request->file('image');
            
            // Additional validation for image
            if (!$image->isValid()) {
                throw new Exception('Uploaded image is corrupted or invalid');
            }

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Menyimpan gambar dan mendapatkan path-nya
            $imagePath = $image->storeAs('images/homepage_banners', $filename, 'public');

            if (!$imagePath) {
                throw new Exception('Failed to save image to storage');
            }

            // Validate image dimensions (optional - add if you need specific dimensions)
            $imageInfo = getimagesize($image->getPathname());
            if ($imageInfo === false) {
                Storage::disk('public')->delete($imagePath);
                throw new Exception('Invalid image file format');
            }

            // Membuat entry baru di database
            $banner = HomepageBanner::create([
                'title' => trim($request->title),
                'description' => trim($request->description),
                'image_path' => $imagePath,
            ]);

            if (!$banner) {
                // Clean up uploaded image if database insert fails
                Storage::disk('public')->delete($imagePath);
                throw new Exception('Failed to save banner to database');
            }

            DB::commit();

            Log::info('Banner created successfully', [
                'banner_id' => $banner->id,
                'title' => $banner->title,
                'user_id' => auth()->id() ?? 'unknown'
            ]);

            return redirect()->route('admin.homepage_banners.index')
                           ->with('toast_success', 'Banner "' . $banner->title . '" created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            
            Log::warning('Banner creation validation failed', [
                'errors' => $e->errors(),
                'input' => $request->except(['image'])
            ]);
            
            return redirect()->back()
                           ->withErrors($e->validator)
                           ->withInput()
                           ->with('toast_error', 'Please check your input and try again.');
        } catch (Exception $e) {
            DB::rollBack();
            
            // Clean up any uploaded files if they exist
            if (isset($imagePath) && $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            Log::error('Banner creation failed', [
                'error' => $e->getMessage(),
                'input' => $request->except(['image'])
            ]);

            return redirect()->back()
                           ->withInput()
                           ->with('toast_error', 'Failed to create banner: ' . $e->getMessage());
        }
    }

    // Menyimpan perubahan ke database
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048', // Max 2MB
            ], [
                'title.required' => 'Title is required.',
                'title.max' => 'Title must not exceed 255 characters.',
                'description.required' => 'Description is required.',
                'description.max' => 'Description must not exceed 1000 characters.',
                'image.image' => 'File must be an image.',
                'image.mimes' => 'Image must be a file of type: jpg, jpeg, png, bmp, gif, svg.',
                'image.max' => 'Image size must not exceed 2MB.',
            ]);

            $banner = HomepageBanner::findOrFail($id);
            $oldImagePath = $banner->image_path;
            $oldTitle = $banner->title;

            DB::beginTransaction();

            // Handle image upload if new image provided
            $imagePath = $banner->image_path; // Keep current image by default
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                
                // Validate uploaded image
                if (!$image->isValid()) {
                    throw new Exception('Uploaded image is corrupted or invalid');
                }

                // Validate image format
                $imageInfo = getimagesize($image->getPathname());
                if ($imageInfo === false) {
                    throw new Exception('Invalid image file format');
                }

                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Save new image
                $imagePath = $image->storeAs('images/homepage_banners', $filename, 'public');
                
                if (!$imagePath) {
                    throw new Exception('Failed to save new image to storage');
                }
            }

            // Update banner data
            $updated = $banner->update([
                'title' => trim($request->title),
                'description' => trim($request->description),
                'image_path' => $imagePath,
            ]);

            if (!$updated) {
                // Clean up new image if database update fails
                if (isset($imagePath) && $imagePath !== $oldImagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                throw new Exception('Failed to update banner in database');
            }

            // Delete old image only after successful update and if new image was uploaded
            if ($request->hasFile('image') && $oldImagePath && $oldImagePath !== $imagePath) {
                if (!Storage::disk('public')->delete($oldImagePath)) {
                    // Log warning but don't fail the operation
                    Log::warning("Failed to delete old banner image: {$oldImagePath}");
                }
            }

            DB::commit();

            Log::info('Banner updated successfully', [
                'banner_id' => $banner->id,
                'old_title' => $oldTitle,
                'new_title' => $banner->title,
                'image_changed' => $request->hasFile('image'),
                'user_id' => auth()->id() ?? 'unknown'
            ]);

            return redirect()->route('admin.homepage_banners.index')
                           ->with('toast_success', 'Banner "' . $banner->title . '" updated successfully!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            
            Log::warning('Banner not found for update', ['banner_id' => $id]);
            
            return redirect()->route('admin.homepage_banners.index')
                           ->with('toast_error', 'Banner not found. It may have been deleted.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            
            Log::warning('Banner update validation failed', [
                'banner_id' => $id,
                'errors' => $e->errors(),
                'input' => $request->except(['image'])
            ]);
            
            return redirect()->back()
                           ->withErrors($e->validator)
                           ->withInput()
                           ->with('toast_error', 'Please check your input and try again.');
        } catch (Exception $e) {
            DB::rollBack();
            
            // Clean up new image if upload succeeded but update failed
            if (isset($imagePath) && $imagePath && $imagePath !== $oldImagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            Log::error('Banner update failed', [
                'banner_id' => $id,
                'error' => $e->getMessage(),
                'input' => $request->except(['image'])
            ]);

            return redirect()->back()
                           ->withInput()
                           ->with('toast_error', 'Failed to update banner: ' . $e->getMessage());
        }
    }

    // Menghapus banner
    public function destroy($id)
    {
        try {
            $banner = HomepageBanner::findOrFail($id);
            $imagePath = $banner->image_path;
            $bannerTitle = $banner->title;

            DB::beginTransaction();

            // Delete banner from database first
            $deleted = $banner->delete();
            
            if (!$deleted) {
                throw new Exception('Failed to delete banner from database');
            }

            // Delete image file
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                if (!Storage::disk('public')->delete($imagePath)) {
                    // Log warning but don't fail the operation since banner is already deleted
                    Log::warning("Failed to delete banner image file: {$imagePath}");
                }
            }

            DB::commit();

            Log::info('Banner deleted successfully', [
                'banner_id' => $id,
                'title' => $bannerTitle,
                'user_id' => auth()->id() ?? 'unknown'
            ]);

            return redirect()->route('admin.homepage_banners.index')
                           ->with('toast_success', 'Banner "' . $bannerTitle . '" deleted successfully!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            
            Log::warning('Banner not found for deletion', ['banner_id' => $id]);
            
            return redirect()->route('admin.homepage_banners.index')
                           ->with('toast_error', 'Banner not found. It may have already been deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error('Banner deletion failed', [
                'banner_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('admin.homepage_banners.index')
                           ->with('toast_error', 'Failed to delete banner: ' . $e->getMessage());
        }
    }
}