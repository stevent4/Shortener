<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_url',
        'short_code',
        'clicks',
        'is_active',
        'is_private',
        'password',
        'expired_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_private' => 'boolean',
        'expired_at' => 'datetime',
    ];

    public static function generateUniqueCode($length = 6)
    {
        do {
            $code = Str::random($length);
        } while (self::where('short_code', $code)->exists());

        return $code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clicksHistory()
    {
        return $this->hasMany(ShortLinkClick::class);
    }
}
