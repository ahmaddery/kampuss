<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'batch_uuid',
        'ip_address',
        'user_agent',
        'url',
        'method',
        'status',
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the subject model that this activity is performed on.
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the causer model that performed this activity.
     */
    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who caused this activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    /**
     * Scope untuk filter berdasarkan log name.
     */
    public function scopeInLog($query, string $logName)
    {
        return $query->where('log_name', $logName);
    }

    /**
     * Scope untuk filter berdasarkan causer.
     */
    public function scopeCausedBy($query, Model $causer)
    {
        return $query->where('causer_type', get_class($causer))
                    ->where('causer_id', $causer->getKey());
    }

    /**
     * Scope untuk filter berdasarkan subject.
     */
    public function scopeForSubject($query, Model $subject)
    {
        return $query->where('subject_type', get_class($subject))
                    ->where('subject_id', $subject->getKey());
    }

    /**
     * Get formatted time ago.
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->setTimezone('Asia/Jakarta')->diffForHumans();
    }

    /**
     * Get formatted created at time in WIB.
     */
    public function getFormattedTimeAttribute()
    {
        return $this->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') . ' WIB';
    }

    /**
     * Get formatted date only in WIB.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y');
    }

    /**
     * Get status badge color.
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'success' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'warning' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get icon for log name.
     */
    public function getIconAttribute()
    {
        return match ($this->log_name) {
            'auth' => 'fas fa-sign-in-alt',
            'user' => 'fas fa-user',
            'berita' => 'fas fa-newspaper',
            'pengumuman' => 'fas fa-bullhorn',
            'fasilitas' => 'fas fa-building',
            'jurusan' => 'fas fa-graduation-cap',
            'biro' => 'fas fa-briefcase',
            'settings' => 'fas fa-cog',
            'contact' => 'fas fa-envelope',
            'newsletter' => 'fas fa-mail-bulk',
            'homepage' => 'fas fa-home',
            'organization' => 'fas fa-sitemap',
            'social_media' => 'fas fa-share-alt',
            'vision_mission' => 'fas fa-eye',
            'sejarah' => 'fas fa-history',
            'sambutan' => 'fas fa-microphone',
            'program' => 'fas fa-clipboard-list',
            default => 'fas fa-clipboard',
        };
    }
}
