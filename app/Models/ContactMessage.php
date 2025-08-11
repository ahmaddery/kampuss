<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'subjek',
        'pesan',
        'is_read',
        'read_at',
        'status',
        'admin_reply',
        'replied_by',
        'replied_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'replied_at' => 'datetime'
    ];

    /**
     * Scope untuk pesan yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope untuk pesan berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk pesan terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Relasi ke user yang membalas
     */
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /**
     * Tandai pesan sebagai sudah dibaca
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    /**
     * Balas pesan
     */
    public function reply($message, $userId)
    {
        $this->update([
            'admin_reply' => $message,
            'replied_by' => $userId,
            'replied_at' => now(),
            'status' => 'replied',
            'is_read' => true,
            'read_at' => $this->read_at ?? now()
        ]);
    }

    /**
     * Tutup pesan
     */
    public function close()
    {
        $this->update([
            'status' => 'closed',
            'is_read' => true,
            'read_at' => $this->read_at ?? now()
        ]);
    }

    /**
     * Accessor untuk status badge
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">Pending</span>',
            'replied' => '<span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Replied</span>',
            'closed' => '<span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">Closed</span>'
        ];

        return $badges[$this->status] ?? $badges['pending'];
    }

    /**
     * Accessor untuk format tanggal
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }
}
