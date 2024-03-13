@extends('admin.layouts.layout')
@section('content')
    <div class="row">


        <div class="col-md-12">

            <div class="card card-warning ">
                <div class="card-header ">
                    <h3 class="card-title">الإعدادات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                        {{Session::get('success')}}    
                        </div> 
                    @endif
                    <form role="form" method="post" enctype="multipart/form-data" action="{{ route('settings.update', 1) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label" for="inputError"> الإسم</label>
                            <input type="text" class="form-control @error('name')is-invalid @enderror" id="inputError" name='name' value="{{$setting->name}}" placeholder="أدخل الإسم">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputError"> الوصف</label>
                            <textarea  class="form-control @error('description')is-invalid @enderror" id="inputError" name='description'placeholder="أدخل الوصف ....">{{$setting->name}}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputError"> الكلمات المفتاحية</label>
                            <input type="text" class="form-control @error('keywords')is-invalid @enderror" id="inputError" name='keywords'value="{{$setting->keywords}}" placeholder="أدخل الكلمات المفتاحية مفصول ب ,">
                            @error('keywords')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputError"> اللينك اند</label>
                            <input type="text" class="form-control " id="inputError" placeholder="أدخل رابط اللينكد ان "name='linked' value="{{$setting->linked}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputError"> الفيس بوك</label>
                            <input type="text" class="form-control " id="inputError" placeholder="أدخل رابط الفيس بوك" name='facebook' value="{{$setting->facebook}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputError"> التويتر</label>
                            <input type="text" class="form-control " id="inputError" placeholder="أدخل رابط التويتر" name='twitter' value="{{$setting->twitter}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputError"> الإنستجرام</label>
                            <input type="text" class="form-control " id="inputError" placeholder="أدخل رابط الإنستجرام" name='instagram' value="{{$setting->instagram}}">
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="inputError"> صورة الموقع</label>
                            <img src="{{asset('uploads/setting/')}}/{{$setting->logo}}" alt="" width="150" height="150"/>
                            <input type="file" name='logo' class="form-control  @error('keywords')is-invalid @enderror" id="inputError" placeholder="أدخل الإسم">
                            @error('logo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


<input type="submit" value="حفظ" class="btn btn-primary">

                    </form>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!--/.col (right) -->
    </div>
@endsection
