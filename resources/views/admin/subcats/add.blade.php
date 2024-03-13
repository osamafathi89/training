@extends('admin.layouts.layout')
@section('content')
    <div class="row">


        <div class="col-md-12">

            <div class="card card-warning ">
                <div class="card-header ">
                    <h3 class="card-title">أضافة قسم</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form role="form" method="post" enctype="multipart/form-data" action="{{ route('subcats.store') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label class="control-label" for="inputError"> القسم الرئيسى</label>
                            <select class="form-control @error('cat_id')is-invalid @enderror" id="inputError" name='cat_id'>
                                <option value="">أختر القسم الرئيسى</option>
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('cat_id') == $cat->id)>{{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cat_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="inputError"> الإسم</label>
                            <input type="text" class="form-control @error('name')is-invalid @enderror" id="inputError"
                                name='name' value="{{ old('name') }}" placeholder="أدخل الإسم">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label class="control-label" for="inputError"> صورة الموقع</label>

                            <input type="file" name='image'
                                class="form-control  @error('keywords')is-invalid @enderror" id="inputError"
                                placeholder="أدخل الإسم">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
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
