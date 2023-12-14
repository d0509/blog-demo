<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory,SoftDeletes,HasSlug;

    protected $fillable = [
        'name',
        'is_active'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name') // The field to generate the slug from
            ->saveSlugsTo('slug');       // The field to store the generated slug
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name', // The field to generate the slug from
                'onUpdate' => true, // Regenerate the slug when the source field is updated
            ],
        ];
    }
}
