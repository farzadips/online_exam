@extends('adminpanel.plain')
@section('content')



    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد دسته بندی جدید</h3>

                {{--            <div class=" text-left">--}}
                {{--                <a class="btn btn-app" href="{{route('categories.create')}}">--}}
                {{--                    <i class="fa fa-plus"></i> جدید--}}
                {{--                </a>--}}
                {{--            </div>--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-8 col-md-offset-3">
                    <form method="post" action="/adminpanel/categories">
                        @csrf
                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="عنوان دسته بندی را وارد کنید">
                        </div>

                        <div class="form-group">
                            <label for="category_parent">دسته والد</label>
                            <select name="parent_id"
                                    class="form-control" id="">
                                <option value="">بدون والد</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @if(count($category->childrenRecursive) > 0)
                                        @include('adminpanel.partial.category',['categories'=>$category->childrenRecursive
                                        , 'level'=>1])
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
