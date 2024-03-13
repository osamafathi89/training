<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sub_cat;
class SubCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = DB::select('select * from sub_cats_view order by created_at DESC  ');
        return view('admin.subcats.show', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = DB::select('select id,name from cats ');
        return view('admin.subcats.add',compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cat = new Sub_cat();
        $request->validate([
            'cat_id'=>'required',
            'name' => 'required|min:5',
            'image' => 'mimes:png,jpg,jfif,jpeg,PNG,JPG,JPEG,JFIF',
        ], [
            'cat_id.required' => 'يرجى أختيار إسم القسم',
            'name.required' => 'يرجى إدخال إسم القسم',
            'name.min' => 'يجب ألا يقل إسم القسم عن 10 حروف',
            'image.mimes' => 'عذرا صيغة الملف غير مدعوم png',
            
        ]);
        if ($request->file('image')) {
            $image = time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('../uploads/subcats/'), $image);
        }
        $cat->name = $request->name;
        $cat->image = $image;
        $cat->cat_id = $request->cat_id;
        $cat->save();
        return redirect()->route('subcats.create')->with('success', 'تم الحفظ  بنجاح !!');
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
        $subcat = Sub_cat::find($id);
        $cats = DB::select('select id,name from cats ');
        return view('admin.subcats.edit', compact('subcat','cats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cat = Sub_cat::find($id);
        $request->validate([
            'cat_id'=>'required',
            'name' => 'required|min:5',
            'image' => 'mimes:png,jpg,jfif,jpeg,PNG,JPG,JPEG,JFIF',
        ], [
            'cat_id.required' => 'يرجى أختيار إسم القسم',
            'name.required' => 'يرجى إدخال إسم القسم',
            'name.min' => 'يجب ألا يقل إسم القسم عن 10 حروف',
            'image.mimes' => 'عذرا صيغة الملف غير مدعوم png',
            
        ]);
        if ($request->file('image')) {
            $image = time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('../uploads/subcats/'), $image);
            unlink(public_path('../uploads/setting/' . $cat->image));
            $cat->image = $image;
        }
        $cat->name = $request->name;
        $cat->cat_id = $request->cat_id;

        $cat->save();
        return redirect()->route('subcats.edit', $id)->with('success', 'تم التعديل  بنجاح !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
       $id = implode(',',$request->id);
       $images = DB::select("select image from sub_cats where id in ($id)");
       DB::delete("delete from sub_cats  where id in ($id)");
       foreach ($images as $key => $image) {
        unlink(public_path('../uploads/subcats/' . $image->image));
       }
            return redirect()->route('subcats.index')->with('success', 'تم الحذف  بنجاح !!');
    }
    public function deleteCat($id)
    {
        $cat = Sub_cat::find($id);
        unlink(public_path('../uploads/subcats/' . $cat->image));
        $cat->delete();
        return redirect()->route('subcats.index')->with('success', 'تم الحذف  بنجاح !!');
    }
}
