<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contact_info';

    protected $fillable = [
        'key',
        'label',
        'value',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Scope untuk mendapatkan kontak yang aktif saja
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengurutkan berdasarkan sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('label');
    }

    /**
     * Toggle status aktif/non-aktif
     */
    public static function toggleStatus($key)
    {
        $contact = self::where('key', $key)->first();
        if ($contact) {
            $contact->is_active = !$contact->is_active;
            $contact->save();
            return $contact;
        }
        return null;
    }
}
