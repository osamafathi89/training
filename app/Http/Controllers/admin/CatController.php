<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Cat::all()->sortByDesc('created_at');
        return view('admin.cats.show', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cats.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cat = new Cat();
        $request->validate([
            'name' => 'required|min:5',
            'image' => 'mimes:png,jpg,jfif,jpeg,PNG,JPG,JPEG,JFIF',
        ], [
            'name.required' => 'يرجى إدخال إسم القسم',
            'name.min' => 'يجب ألا يقل إسم القسم عن 10 حروف',
            'image.mimes' => 'عذرا صيغة الملف غير مدعوم png',
        ]);
        if ($request->file('image')) {
            $image = time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('../uploads/cats/'), $image);
        }
        $cat->name = $request->name;
        $cat->image = $image;
        $cat->save();
        return redirect()->route('cats.create')->with('success', 'تم الحفظ  بنجاح !!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sub_cats = DB::select('select id,name from sub_cats where cat_id = ?', [$id]);
        $data="<option value=''>أختر القسم </option>";
        foreach ($sub_cats as $sub) {
            $data.="<option value='$sub->id'>$sub->name</option>";
        }
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cat = Cat::find($id);
        return view('admin.cats.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cat = Cat::find($id);
        $request->validate([
            'name' => 'required|min:5',
            'image' => 'mimes:png,jpg,jfif,jpeg,PNG,JPG,JPEG,JFIF',
        ], [
            'name.required' => 'يرجى إدخال إسم القسم',
            'name.min' => 'يجب ألا يقل إسم القسم عن 10 حروف',
            'image.mimes' => 'عذرا صيغة الملف غير مدعوم ',
        ]);
        if ($request->file('image')) {
            $image = time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('../uploads/cats/'), $image);
            unlink(public_path('../uploads/setting/' . $cat->image));
            $cat->image = $image;
        }
        $cat->name = $request->name;

        $cat->save();
        return redirect()->route('cats.edit', $id)->with('success', 'تم التعديل  بنجاح !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $id = implode(',', $request->id);
        $images = DB::select("select image from cats where id in ($id)");
        DB::delete("delete from cats  where id in ($id)");
        foreach ($images as $key => $image) {
            unlink(public_path('../uploads/cats/' . $image->image));
        }
        return redirect()->route('cats.index')->with('success', 'تم الحذف  بنجاح !!');
    }
    public function deleteCat($id)
    {
        $cat = Cat::find($id);
        unlink(public_path('../uploads/cats/' . $cat->image));
        $cat->delete();
        return redirect()->route('cats.index')->with('success', 'تم الحذف  بنجاح !!');
    }
}
