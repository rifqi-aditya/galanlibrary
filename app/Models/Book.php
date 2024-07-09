<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    const COVER_PATH = 'book-covers';

    protected $fillable = [
        'title',
        'description',
        'author',
        'publisher_id',
        'publication_year',
        'stock',
        'category_id',
        'cover',
    ];

    public static function booted()
    {
        static::deleted(function ($book) {
            if ($book->cover) {
                Storage::delete(self::COVER_PATH . '/' . $book->cover);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function cover()
    {
        if (is_null($this->cover)) {
            return 'https://placehold.co/400x300';
        }
        return route('book-covers', ['path' => $this->cover]);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
}
