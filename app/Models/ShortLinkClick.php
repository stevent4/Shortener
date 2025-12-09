<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLinkClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_link_id',
        'ip_address',
        'user_agent',
        'referrer'
    ];

    public function shortLink()
    {
        return $this->belongsTo(ShortLink::class);
    }
}