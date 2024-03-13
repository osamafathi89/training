<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
public function dash(){
    $categories= DB::select('select count(id)as num from cats' );
    $sub_categories= DB::select('select count(id)as num from sub_cats ' );
    $courses= DB::select('select count(id)as num from courses ' );
    return view("admin.index",compact('categories','sub_categories','courses'));
}
}
