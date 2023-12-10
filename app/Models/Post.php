<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $attributes = [
        'active' => '1',
    ];

    protected $fillable = [
        'title', 'slug',
        'category_id',
        'film_id',
        'content',
        'published_at',
        'user_id',
    ];

    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function isPublished() : bool {
        return $this->active
            && $this->published_at;
    }

    public function toSearchableArray() {
        return [
            'title' => $this->title,
        ];
    }
}
