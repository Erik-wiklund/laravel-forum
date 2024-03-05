<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    use HasFactory;

    protected $table = 'resources';

    protected $fillable = [
        'created_by',
        'category',
        'title',
        'description',
        'version',
        'tag_line',
        'format',
        'url',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
