<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return view('admin.settings', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {

        $request->validate([
            'name' => 'required|min:10',
            'description' => 'required|min:10',
            'keywords' => 'required|min:10',
            'logo' => 'mimes:png',
        ], [
            'name.required' => 'يرجى إدخال إسم الموقع',
            'name.min' => 'يجب ألا يقل إسم الموقع عن 10 حروف',
            'description.required' => 'يرجى أدخال الوصف',
            'description.min' => 'يجب ألا يقل الوصف عن 10 حروف',
            'keywords.required' => 'يرجى إدخال الكلمات المفتاحية',
            'keywords.min' => 'يجب ألا يقل الكلمات المفتاحية عن 10 حروف',
            'logo.mimes' => 'عذرا صيغة الملف غير مدعوم png',
        ]);
        if ($request->file('logo')) {
            $image = time() . "." . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('../uploads/setting/'), $image);
            unlink(public_path('../uploads/setting/' . $setting->logo));
        }
        $setting->name = $request->name;
        $setting->description = $request->description;
        $setting->keywords = $request->keywords;
        $setting->linked = $request->linked;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        if (isset($image)) {
            $setting->logo = $image;
        }
        $setting->save();
        return redirect()->route('settings.show', 1)->with('success', 'تم تعديل الإعدادات بنجاح !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
