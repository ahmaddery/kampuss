<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Subscribe to newsletter
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'type' => 'required|in:berita,pengumuman,all',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if email already exists
        $exists = NewsletterSubscription::where('email', $request->email)
            ->where('type', $request->type)
            ->first();

        if ($exists) {
            // If subscription exists but was soft deleted, restore it
            if ($exists->trashed()) {
                $exists->restore();
                $exists->is_active = true;
                $exists->save();
                return redirect()->back()->with('success', 'Anda telah berhasil berlangganan newsletter.');
            }
            
            // If subscription exists and is inactive, activate it
            if (!$exists->is_active) {
                $exists->is_active = true;
                $exists->save();
                return redirect()->back()->with('success', 'Anda telah berhasil berlangganan newsletter.');
            }
            
            return redirect()->back()->with('info', 'Email Anda sudah terdaftar pada newsletter kami.');
        }

        // Create new subscription
        NewsletterSubscription::create([
            'email' => $request->email,
            'type' => $request->type,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Terima kasih telah berlangganan newsletter kami!');
    }

    /**
     * Unsubscribe from newsletter
     *
     * @param  string  $email
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe($email, $token)
    {
        // Verify token (you should implement a proper token verification)
        $validToken = hash('sha256', $email . env('APP_KEY'));
        
        if ($token !== $validToken) {
            return abort(403, 'Token tidak valid');
        }
        
        $subscription = NewsletterSubscription::where('email', $email)->first();
        
        if (!$subscription) {
            return view('newsletter.unsubscribe', ['status' => 'not_found']);
        }
        
        $subscription->is_active = false;
        $subscription->save();
        
        return view('newsletter.unsubscribe', ['status' => 'success']);
    }
}
