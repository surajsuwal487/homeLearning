<?php

namespace Modules\InventoryManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\InventoryManagement\Entities\CategoryImages;
use Modules\InventoryManagement\Entities\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;



class Category extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'image', 'feature', 'status'
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
