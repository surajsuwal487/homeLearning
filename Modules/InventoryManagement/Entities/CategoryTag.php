<?php

namespace Modules\InventoryManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'tag_id'
    ];
    
    
    protected static function newFactory()
    {
        return \Modules\InventoryManagement\Database\factories\CategoryTagFactory::new();
    }
}
