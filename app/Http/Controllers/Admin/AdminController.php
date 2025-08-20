<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan statistik.
     *
     * @return \Illuminate\View\View
     */
    public function showDashboard()
    {
        $user = Auth::user();
        
        // Statistik umum
        $stats = [
            'total_users' => User::count(),
            'total_berita' => Berita::count(),
            'total_pengumuman' => Pengumuman::count(),
            'unread_messages' => ContactMessage::unread()->count(),
        ];
        
        // Statistik aktivitas
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        
        $activityStats = [
            'today' => ActivityLog::whereDate('created_at', $today)->count(),
            'this_week' => ActivityLog::where('created_at', '>=', $thisWeek)->count(),
            'this_month' => ActivityLog::where('created_at', '>=', $thisMonth)->count(),
            'total' => ActivityLog::count(),
        ];
        
        // Aktivitas terbaru
        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Top aktivitas berdasarkan kategori
        $topCategories = ActivityLog::selectRaw('log_name, count(*) as count')
            ->groupBy('log_name')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
        
        // Pengguna paling aktif hari ini
        $activeUsers = ActivityLog::with('user')
            ->whereDate('created_at', $today)
            ->whereNotNull('causer_id')
            ->selectRaw('causer_id, count(*) as activity_count')
            ->groupBy('causer_id')
            ->orderBy('activity_count', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'user', 
            'stats', 
            'activityStats', 
            'recentActivities', 
            'topCategories', 
            'activeUsers'
        ));
    }

    /**
     * Tampilkan halaman dashboard admin dengan data pengguna yang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data pengguna yang login
        $user = Auth::user(); // Mengambil data pengguna yang sedang login

        // Kirim data ke view admin
        return view('admin.dashboard', compact('user'));
    }

    /**
     * Tampilkan halaman profil admin.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        // Ambil data pengguna yang login
        $user = Auth::user();

        // Kirim data pengguna ke view profile
        return view('admin.profile', compact('user'));
    }

    /**
     * Tampilkan halaman edit profil admin.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        // Ambil data pengguna yang login
        $user = Auth::user();

        // Kirim data pengguna ke view edit profile
        return view('admin.edit-profile', compact('user'));
    }

    /**
     * Update profil admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
        public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil data pengguna yang login
        $user = Auth::user();

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            // Simpan gambar profil baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('admin.profile')
            ->with('toast_success', 'Profile updated successfully!');
    }

public function updatePassword(Request $request)
    {
        // Validasi input password
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // Password minimal 8 karakter dan konfirmasi password
        ]);

        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah current_password yang dimasukkan benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('toast_error', 'Current password is incorrect!');
        }

        // Update password dengan password baru
        $user->password = Hash::make($request->new_password); // Meng-enkripsi password baru
        $user->save(); // Simpan perubahan

        return back()->with('toast_success', 'Password updated successfully!');
    }

    /**
     * Tambah pengguna baru (Admin).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

public function createUser(Request $request)
{
    // Pastikan hanya superadmin yang bisa menambah pengguna
    if (Auth::user()->role !== 'superadmin') {
        return redirect()->route('admin.users')->with('error', 'You do not have permission to add users.');
    }

    // Validasi input pengguna baru
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Membuat pengguna baru
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;

    // Menambahkan role 'admin' secara default
    $user->role = 'admin'; // Menetapkan role sebagai admin

    // Generate password acak yang akan di-reset
    $tempPassword = Str::random(10); // Membuat password acak sementara
    $user->password = bcrypt($tempPassword); // Enkripsi password

    // Menyimpan gambar profil jika ada
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }

    // Menyimpan data pengguna
    $user->save();

    // Kirimkan email untuk reset password
    Password::sendResetLink(['email' => $user->email]);

    return redirect()->route('admin.users')->with('success', 'User created successfully. A password reset email has been sent.');
}



    /**
     * Menonaktifkan (soft delete) pengguna.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateUser($id)
{
    $user = User::findOrFail($id);

    // Pastikan hanya superadmin yang dapat menonaktifkan pengguna
    if (Auth::user()->role !== 'superadmin') {
        return redirect()->route('admin.users')->with('error', 'You do not have permission to deactivate users.');
    }

    // Pastikan pengguna tidak bisa menghapus akun yang menambahkannya
    if ($user->id === Auth::id()) {
        return redirect()->route('admin.users')->with('error', 'You cannot deactivate your own account.');
    }

    // Soft delete pengguna
    $user->delete();

    return redirect()->route('admin.users')->with('success', 'User deactivated successfully.');
}
    public function reactivateUser($id)
{
    $user = User::withTrashed()->findOrFail($id);

    // Pastikan hanya superadmin yang dapat mengaktifkan kembali pengguna
    if (Auth::user()->role !== 'superadmin') {
        return redirect()->route('admin.users')->with('error', 'You do not have permission to reactivate users.');
    }

    // Pastikan pengguna tidak bisa menghapus akun yang menambahkannya
    if ($user->id === Auth::id()) {
        return redirect()->route('admin.users')->with('error', 'You cannot reactivate your own account.');
    }

    // Mengembalikan pengguna yang di soft delete
    $user->restore();

    return redirect()->route('admin.users')->with('success', 'User reactivated successfully.');
}


    /**
     * Menampilkan semua pengguna untuk admin.
     *
     * @return \Illuminate\View\View
     */
    public function showUsers()
{
    // Mengambil semua pengguna, termasuk yang di-soft delete
    $users = User::withTrashed()->get();
    return view('admin.users', compact('users'));
}

}
