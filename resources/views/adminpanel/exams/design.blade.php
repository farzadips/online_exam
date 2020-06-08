@extends('adminpanel.plain')
@section('content')

    <form action="/submitexam" method='post' style="direction: rtl; text-align: right;" enctype="multipart/form-data">
        @csrf
        <div style="margin: 40px">
            <br>
            <br>
            <br>
        <label>نوع سوال را انتخاب کنید:</label>

        <select class="select2-container--classic" id="type_question" name="type_question">
            <option value="0">گزینه ای</option>
            <option value="1">جای خالی</option>
        </select>

        <span>
            <input type="text" name="option_count" placeholder="تعداد گزینه هارا وارد کنید">
        </span>

        <div class="form-group w-200">
            <label for="examname">نام آزمون :</label>
            <input type="text" class="form-control" id="exam_name" name="exam_name" placeholder="آزمون مثال"
                   required>
        </div>
        <div class="form-group">
            <label for="desc">توضیحات:</label>
            <textarea class="form-control" rows="5" id="desc" name="desc" required></textarea>
        </div>
        <div class="form-group w-200"><label for="time">قیمت به تومان:</label> <input type="text"
                                                                                      class="form-control"
                                                                                      name="cost" required></div>

        <div class="form-group">
            <label for="category_parent">دسته والد</label>
            <select name="category_id"
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
            <label>آیا بقیه اساتید این سوال رو میتوانند ببینند؟</label>

            <select class="select2-container--classic" id="show_to_others" name="show_to_others">
                <option value="0">خیر</option>
                <option value="1">بله</option>
            </select>

        <div class="form-group w-200">
            <label for="time">مدت زمان:</label>
            <input type="text" class="form-control" id="time" name="exam_time" placeholder="60" required>
        </div>
        <div class="form-group w-200">
            <label for="count">تعداد سوالات:</label>
            <input type="text" class="form-control" id="count" name="question_count" placeholder="100" required>
        </div>
        <div class="form-group w-200">
            <label for="pic">تصویر آزمون:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group w-200">
            <label for="startdate">تاریخ شروع آزمون :</label>
            <input type="date" name="start_date" class="form-control" placeholder="1398-04-03" required>
        </div>
        <div class="form-group w-200">
            <label for="enddate">تاریخ اتمام آزمون:</label>
            <input type="date" name="end_date" class="form-control" placeholder="1398-04-04" required>
        </div>
        <button type="submit" class="btn btn-success">ادامه و تعریف سوالات</button>
        <br><br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>

    </form>

@endsection
