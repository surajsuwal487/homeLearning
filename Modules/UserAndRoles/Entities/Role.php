<?php

namespace Modules\UserAndRoles\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    
    protected static function newFactory()
    {
        return \Modules\UserAndRoles\Database\factories\RoleFactory::new();
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
