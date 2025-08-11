<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInfo;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Display the contact page
     */
    public function index()
    {
        // Ambil informasi kontak yang aktif dan diurutkan
        $contacts = ContactInfo::active()->ordered()->get();
        
        // Grupkan kontak berdasarkan key untuk kemudahan penggunaan di view
        $contactData = [];
        foreach ($contacts as $contact) {
            $contactData[$contact->key] = $contact->value;
        }
        
        return view('contact.index', compact('contacts', 'contactData'));
    }

    /**
     * Store contact message
     */
    public function store(Request $request)
    {
        // Honeypot Protection
        if ($request->filled('website')) {
            // Bot detected, silently redirect
            return redirect()->route('contact.index')
                            ->with('success', 'Pesan Anda berhasil dikirim. Kami akan membalas secepat mungkin.');
        }

        // Time-based Protection (minimum 5 seconds to fill form)
        $formStartTime = $request->input('form_start_time');
        if ($formStartTime && (time() - $formStartTime) < 5) {
            return redirect()->back()
                            ->withErrors(['spam' => 'Form diisi terlalu cepat. Silakan isi dengan lebih teliti.'])
                            ->withInput();
        }

        // Validate input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20|min:10',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:1000|min:10'
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nama_lengkap.min' => 'Nama lengkap minimal 2 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'nomor_telepon.required' => 'Nomor telepon harus diisi',
            'nomor_telepon.min' => 'Nomor telepon minimal 10 digit',
            'subjek.required' => 'Subjek harus diisi',
            'pesan.required' => 'Pesan harus diisi',
            'pesan.min' => 'Pesan minimal 10 karakter',
            'pesan.max' => 'Pesan maksimal 1000 karakter'
        ]);

        // Content filtering for spam keywords
        $spamKeywords = [
            'viagra', 'casino', 'lottery', 'winner', 'congratulations',
            'urgent', 'click here', 'free money', 'make money fast',
            'work from home', 'crypto', 'bitcoin', 'investment opportunity'
        ];

        $content = strtolower($request->pesan . ' ' . $request->subjek);
        foreach ($spamKeywords as $keyword) {
            if (strpos($content, $keyword) !== false) {
                return redirect()->back()
                                ->withErrors(['spam' => 'Pesan mengandung konten yang tidak diperbolehkan.'])
                                ->withInput();
            }
        }

        // Check for suspicious patterns
        if ($this->isSuspiciousContent($request->pesan)) {
            return redirect()->back()
                            ->withErrors(['spam' => 'Pesan terdeteksi sebagai spam. Silakan gunakan bahasa yang lebih formal.'])
                            ->withInput();
        }

        ContactMessage::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
            'status' => 'pending'
        ]);

        return redirect()->route('contact.index')
                        ->with('success', 'Pesan Anda berhasil dikirim. Kami akan membalas secepat mungkin.');
    }

    /**
     * Check for suspicious content patterns
     */
    private function isSuspiciousContent($content)
    {
        // Check for excessive URLs
        if (preg_match_all('/https?:\/\/[^\s]+/', $content) > 2) {
            return true;
        }

        // Check for excessive special characters
        $specialCharCount = preg_match_all('/[!@#$%^&*()_+=\[\]{}|;:,.<>?]/', $content);
        if ($specialCharCount > strlen($content) * 0.2) {
            return true;
        }

        // Check for repeated characters (more than 4 times)
        if (preg_match('/(.)\1{4,}/', $content)) {
            return true;
        }

        // Check for excessive uppercase (more than 50% of text)
        $uppercaseCount = preg_match_all('/[A-Z]/', $content);
        $totalLetters = preg_match_all('/[a-zA-Z]/', $content);
        if ($totalLetters > 0 && ($uppercaseCount / $totalLetters) > 0.5) {
            return true;
        }

        return false;
    }
}
