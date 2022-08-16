<?php

namespace Modules\InventoryManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\InventoryManagement\Entities\Category;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['tag'];
    
    protected static function newFactory()
    {
        return \Modules\InventoryManagement\Database\factories\TagFactory::new();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
