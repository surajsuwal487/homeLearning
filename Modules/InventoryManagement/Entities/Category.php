<?php

namespace Modules\InventoryManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\InventoryManagement\Entities\CategoryImages;
use Modules\InventoryManagement\Entities\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Category extends Model implements HasMedia
{
    use HasFactory, Sluggable, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name', 'slug', 'image', 'feature', 'status'
    ];
    
    protected static function newFactory()
    {
        return \Modules\InventoryManagement\Database\factories\CategoryFactory::new();
    }

    //Mutators(changeBehaviour) in Laravel
    // public function setNameAttribute($name){
    //     $this->attributes['name'] = Str::upper($name);
    // }

    //Accessors in Laravel
    // public function setNameAttribute($name){
    //     return 'category' . ucfirst($name);
    // }

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
