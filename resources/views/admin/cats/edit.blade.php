@extends('admin.layouts.layout')
@section('content')
    <div class="row">


        <div class="col-md-12">

            <div class="card card-warning ">
                <div class="card-header ">
                    <h3 class="card-title">تعديل قسم</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form role="form" method="post" enctype="multipart/form-data"
                        action="{{ route('cats.update', $cat->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label" for="inputError"> الإسم</label>
                            <input type="text" class="form-control @error('name')is-invalid @enderror" id="inputError"
                                name='name' value="{{ $cat->name }}" placeholder="أدخل الإسم">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label class="control-label" for="inputError"> صورة
                                الموقع</label>
                            <img src="{{ asset('uploads/cats/') }}/{{ $cat->image }}" alt="" width="150"
                                height="150" />
                            <input type="file" name='image'
                                class="form-control  @error('keywords')is-invalid @enderror" id="inputError"
                                placeholder="أدخل الإسم">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <input type="submit" value="تعديل" class="btn btn-primary">

                    </form>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!--/.col (right) -->
    </div>
@endsection
