<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PriorityLevel;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    //
    public function __invoke()
    {
        //
        $category = Category::all()->pluck('category')->toArray();
        $priority = PriorityLevel::all()->pluck('level')->toArray();
        $status = Status::all()->pluck('status')->toArray();
        $developer = User::query()->where('roles','developer')->get()->toArray();
        $data = [
            "Category"=>$category,
            "PriorityLevel"=>$priority,
            "Status" => $status,
            "Developer"=>$developer
        ];
        return response()->json($data); 
        // return RolesResource::collection($data);
    }
    // public function prioritytable()
    // {
    //     //
    //     $data = PriorityLevel::all();
    //     return response()->json($data); 
    //     // return RolesResource::collection($data);
    // }
    // public function statustable()
    // {
    //     //
    //     $data = Status::all();
    //     return response()->json($data); 
    //     // return RolesResource::collection($data);
    // }
}
