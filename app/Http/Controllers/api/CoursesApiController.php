<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = DB::select('select * from  courses_cats');
        // $courses= Course::join('courses.*,sub_cats.name as sub_name,cats.name as cat_name')
        // ->leftJoin('sub_cats','courses.sub_cat.id','=','sub_cats.id')
        // ->leftJoin('cats','cats.id','=','courses.cat_id');
  
        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->cat_id = $request->cat_id;
        $course->sub_cat_id = $request->sub_cat_id;
        $course->hours = $request->hours;
        $course->price= $request->price;
        $course->description = $request->description;
        $course->save();
        return response()->json($course->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::find($id);
        $course->name = $request->name;
        $course->cat_id = $request->cat_id;
        $course->sub_cat_id = $request->sub_cat_id;
        $course->hours = $request->hours;
        $course->price= $request->price;
        $course->description = $request->description;
        $course->save();
        return response()->json($course->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        $course->delete();
        return response()->json($course->id);
    }
}
