@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('subcats.destroy','1') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width:200px">صورة القسم </th>
                                    <th>أسم القسم</th>
                                    <th>أسم القسم الرئيسي</th>
                                    <th>تعديل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $cat)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $cat->id }}"
                                                id=""></td>
                                        <td><img src="{{ asset('uploads/subcats/') }}/{{ $cat->image }}" alt=""
                                                width="75" height="75"></td>
                                        <td>{{ $cat->name }} </td>
                                        <td>{{ $cat->cat_name }} </td>
                                        <td>
                                            <a href="{{ route('subcats.edit', $cat->id) }}"
                                                class="btn btn-warning ms-5">تعديل</a>

                                            <a href="{{ route('subcats.delete', $cat->id) }}" 
                                                class="btn btn-danger">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <input type="submit" value="حذف" class="btn btn-danger">
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card -->

            <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
    </div>
@endsection
