<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name'
    ];
    // protected $fillable = [
    //     'name', 'updated_at', 'created_at'
    // ];

    protected $appends = ['date_time_str', 'date_human_readable', 'thumb_image_url'];

    public function getThumbImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('category_image', 'thumb');
    }

    public function getDateTimeStrAttribute()
    {
        return date("Y-m-dTH:i", strtotime($this->created_at->toDateTimeString()));
    }

    public function getDateHumanReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category_image')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function getPhotoAttribute()
    {
        return $this->getFirstMediaUrl('category_image');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
