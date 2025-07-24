<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterSubscription extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'email',
        'type',
        'is_active',
        'last_sent_at'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'last_sent_at' => 'datetime'
    ];
    
    /**
     * Scope a query to only include active subscriptions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope a query to filter by subscription type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where(function($q) use ($type) {
            $q->where('type', $type)
              ->orWhere('type', 'all');
        });
    }
}
