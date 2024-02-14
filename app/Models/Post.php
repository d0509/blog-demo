<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasSlug, Mediable;

    protected $fillable = [
        'status',
        'author',
        'category_id',
        'title',
        'description',
    ];

    public function getCreatedAtAttribute($value)
    {
        // Change the date format as per your requirement
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // The field to generate the slug from
            ->saveSlugsTo('slug');       // The field to store the generated slug
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title', // The field to generate the slug from
                'onUpdate' => true, // Regenerate the slug when the source field is updated
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeInCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($subquery) use ($categorySlug) {
            $subquery->where('slug', $categorySlug);
        });
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('title', 'like', '%' . $keyword . '%');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}