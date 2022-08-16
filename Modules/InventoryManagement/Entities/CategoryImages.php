<?php

namespace Modules\InventoryManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'image'
    ];
    
    protected static function newFactory()
    {
        return \Modules\InventoryManagement\Database\factories\CategoryImagesFactory::new();
    }
}
