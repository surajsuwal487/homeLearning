<?php

namespace Modules\InventoryManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InventoryManagementController extends Controller
{

    public function index()
    {
        return view('inventorymanagement::backend.product.view-product');
    }


    public function create()
    {
        return view('inventorymanagement::create');
    }


    public function store(Request $request)
    {
        
    }


    public function show($id)
    {
        return view('inventorymanagement::show');
    }


    public function edit($id)
    {
        return view('inventorymanagement::edit');
    }

    public function update(Request $request, $id)
    {
        
    }


    public function destroy($id)
    {
        
    }
}
