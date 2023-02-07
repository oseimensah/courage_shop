<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'discount',
        'description',
        'featured',
    ];

    protected $appends = ['date_time_str', 'date_human_readable', 'thumb_image_url'];


    public function getDateTimeStrAttribute()
    {
        return date("Y-m-dTH:i", strtotime($this->created_at->toDateTimeString()));
    }

    public function getDateHumanReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getThumbImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('product_image', 'thumb');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_image')->singleFile();
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
        return $this->getFirstMediaUrl('product_image');
    }

    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('landscape')->singleFile();
    //     $this->addMediaCollection('square')->singleFile();
    //     $this->addMediaCollection('product_image');
    // }

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('landscape_thumb')
    //         ->format(Manipulations::FORMAT_PNG)
    //         ->width(612)
    //         ->height(200)
    //         ->performOnCollections('landscape')
    //         ->queued();

    //     $this->addMediaConversion('square_thumb')
    //         ->format(Manipulations::FORMAT_PNG)
    //         ->width(600)
    //         ->height(600)
    //         ->performOnCollections('square')
    //         ->queued();

    //     $this->addMediaConversion('square')
    //         ->format(Manipulations::FORMAT_PNG)
    //         ->width(1224)
    //         ->height(1224)
    //         ->performOnCollections('square')
    //         ->queued();


    //     $this->addMediaConversion('landscape')
    //         ->format(Manipulations::FORMAT_PNG)
    //         ->width(1224)
    //         ->height(400)
    //         ->performOnCollections('landscape')
    //         ->queued();

    //     $this->addMediaConversion('pictures_thumb')
    //         ->width(100)
    //         ->height(100)->performOnCollections('product_image')
    //         ->queued();
    // }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function order_product()
    {
        return $this->belongsToMany(Order::class, 'order_products')->withPivot('price', 'quantity');
    }

    public function getPriceWithCurrencyAttribute()
    {
        return "GHS " . $this->price;
    }
}
