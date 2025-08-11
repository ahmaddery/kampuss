<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages
     */
    public function index(Request $request)
    {
        $query = ContactMessage::with('repliedBy')->latest();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->byStatus($request->status);
        }

        // Filter berdasarkan status baca
        if ($request->has('read_status')) {
            if ($request->read_status === 'unread') {
                $query->unread();
            } elseif ($request->read_status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(10);

        // Statistik
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::unread()->count(),
            'pending' => ContactMessage::byStatus('pending')->count(),
            'replied' => ContactMessage::byStatus('replied')->count(),
            'closed' => ContactMessage::byStatus('closed')->count(),
        ];

        return view('admin.contact-messages.index', compact('messages', 'stats'));
    }

    /**
     * Display the specified contact message
     */
    public function show(ContactMessage $contactMessage)
    {
        // Tandai sebagai sudah dibaca jika belum
        if (!$contactMessage->is_read) {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Reply to a contact message
     */
    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:1000'
        ]);

        // Simpan balasan ke database
        $contactMessage->reply($request->admin_reply, Auth::id());

        // Kirim email balasan ke pengirim pesan
        try {
            Mail::to($contactMessage->email)->send(new ContactReplyMail($contactMessage, $request->admin_reply));
            
            return redirect()->route('admin.contact-messages.show', $contactMessage)
                            ->with('success', 'Balasan berhasil dikirim dan email telah dikirim ke ' . $contactMessage->email);
        } catch (\Exception $e) {
            // Jika gagal kirim email, tetap simpan balasan tapi beri notifikasi
            return redirect()->route('admin.contact-messages.show', $contactMessage)
                            ->with('warning', 'Balasan berhasil disimpan, tetapi gagal mengirim email. Error: ' . $e->getMessage());
        }
    }

    /**
     * Mark message as read/unread
     */
    public function toggleRead(ContactMessage $contactMessage)
    {
        if ($contactMessage->is_read) {
            $contactMessage->update([
                'is_read' => false,
                'read_at' => null
            ]);
        } else {
            $contactMessage->markAsRead();
        }

        return redirect()->back()->with('success', 'Status baca berhasil diubah');
    }

    /**
     * Update message status
     */
    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:pending,replied,closed'
        ]);

        $contactMessage->update(['status' => $request->status]);

        if ($request->status === 'closed') {
            $contactMessage->close();
        }

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }

    /**
     * Delete a contact message
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
                        ->with('success', 'Pesan berhasil dihapus');
    }

    /**
     * Bulk actions for multiple messages
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:mark_read,mark_unread,delete,close',
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:contact_messages,id'
        ]);

        $messages = ContactMessage::whereIn('id', $request->message_ids);

        switch ($request->action) {
            case 'mark_read':
                $messages->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);
                break;
            case 'mark_unread':
                $messages->update([
                    'is_read' => false,
                    'read_at' => null
                ]);
                break;
            case 'close':
                $messages->update([
                    'status' => 'closed',
                    'is_read' => true,
                    'read_at' => now()
                ]);
                break;
            case 'delete':
                $messages->delete();
                break;
        }

        return redirect()->back()->with('success', 'Aksi berhasil dilakukan');
    }
}
