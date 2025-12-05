<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'image',
        'is_accepted',
        'user_id',
    ];

    protected $casts = [
        'is_accepted' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
