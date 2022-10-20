<?php

namespace App\Http\Controllers;

use App\Http\Resources\RolesResource;
use App\Models\Category;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function index()
    {
        //
        $roles = Roles::all()->pluck('name')->toArray();
        $category = Category::all()->pluck('category')->toArray();
        $data = [
            "Roles"=>$roles,
            "Category"=>$category];
        // return response()->json($data); 
        return response()->json($data); 
    }
}
