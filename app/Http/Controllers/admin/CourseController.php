<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Noti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
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
  
        return view('admin.courses.show',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = DB::select('select id,name from cats ');
        return view('admin.courses.add',compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = new Course();
        $request->validate([
            'name' => 'required',
            'cat_id' => 'required',
            'image' => 'mimes:png,jpg,jfif,jpeg,PNG,JPG,JPEG,JFIF',
        ], [
            'name.required' => 'يرجى إدخال إسم الكورس',
            'cat_id.required' => 'يرجى اختيار إسم القسم',
            'image.mimes' => 'عذرا صيغة الملف غير مدعوم png',
        ]);
        if ($request->file('image')) {
            $image = time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('../uploads/courses/'), $image);
        }
        $course->name = $request->name;
        $course->cat_id = $request->cat_id;
        $course->sub_cat_id = $request->sub_cat_id;
        $course->hours = $request->hours;
        $course->price= $request->price;
        $course->description = $request->description;
        $course->image = $image;
        $course->save();
        $this->notiAdd($course->id);

        return redirect()->route('courses.create')->with('success', 'تم الحفظ  بنجاح !!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        $cats = DB::select('select id,name from cats ');
        $sub_cats = DB::select("select id,name from sub_cats WHERE cat_id = $course->cat_id");
        
        return view('admin.courses.edit',compact('cats','sub_cats','course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::find($id);
        $request->validate([
            'name' => 'required',
            'cat_id' => 'required',
            'image' => 'mimes:png,jpg,jfif,jpeg,PNG,JPG,JPEG,JFIF',
        ], [
            'name.required' => 'يرجى إدخال إسم الكورس',
            'cat_id.required' => 'يرجى اختيار إسم القسم',
            'image.mimes' => 'عذرا صيغة الملف غير مدعوم png',
        ]);
        if ($request->file('image')) {
            $image = time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('../uploads/courses/'), $image);
            unlink(public_path('../uploads/courses/'.$course->image));
            $course->image = $image;
        }
        $course->name = $request->name;
        $course->cat_id = $request->cat_id;
        $course->sub_cat_id = $request->sub_cat_id;
        $course->hours = $request->hours;
        $course->price= $request->price;
        $course->description = $request->description;
       
        $course->save();
        return redirect()->route('courses.edit',$id)->with('success', 'تم الحفظ  بنجاح !!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id, Request $request)
    {
        $id = implode(',', $request->id);
        $images = DB::select("select image from courses where id in ($id)");
        DB::delete("delete from courses  where id in ($id)");
        foreach ($images as $key => $image) {
            unlink(public_path('../uploads/courses/' . $image->image));
        }
        return redirect()->route('courses.index')->with('success', 'تم الحذف  بنجاح !!');
    }
    public function deleteCourse($id)
    {
        $cat = Course::find($id);
        unlink(public_path('../uploads/courses/' . $cat->image));
        $cat->delete();
        return redirect()->route('courses.index')->with('success', 'تم الحذف  بنجاح !!');
    }
    public function notiAdd($id){
        $users = DB::select('select id from users ');
        // dd($users);
        
        foreach ($users as $key => $value) {
        DB::insert('insert into notis ( `user_id`, `course_id`) values (?, ?)', [$value->id, $id]);

        }

    }
}
