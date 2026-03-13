<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'image_path', 'parent_id', 'is_top'];

    protected $casts = [
        'is_top' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug(Str::limit($service->title, 30, ''));
            }
        });

        static::updating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug(Str::limit($service->title, 30, ''));
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }
}
