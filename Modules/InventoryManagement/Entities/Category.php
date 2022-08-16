<?php

namespace Modules\InventoryManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\InventoryManagement\Entities\CategoryImages;
use Modules\InventoryManagement\Entities\Tag;



class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name', 'slug', 'image', 'feature'
    ];
    
    protected static function newFactory()
    {
        return \Modules\InventoryManagement\Database\factories\CategoryFactory::new();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categoryImages(){
        return $this->hasMany(CategoryImages::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
