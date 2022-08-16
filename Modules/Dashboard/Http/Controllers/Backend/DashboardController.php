<?php

namespace Modules\Dashboard\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\InventoryManagement\Entities\Category;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $cus_count=User::whereHas('roles', function($q){
                $q->where('name','user');
            })->count('id');
            $cate_count=Category::count('id');;
            return view('dashboard::backend.dashboard',compact('cate_count', 'cus_count'));
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
