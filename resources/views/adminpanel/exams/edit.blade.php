@extends('adminpanel.plain')
@section('content')

    <form action="/adminpanel/submit_edit/{{$exam->id}}" method='post' style="direction: rtl; text-align: right;"
          enctype="multipart/form-data">
        @csrf
        <label>نوع سوال را انتخاب کنید:</label>

        <select id="type_question" name="type_question" id="mySelect">

            @if($exam->type_question == 0)
                <option value="0" selected="selected">گزینه ای</option>
                <option value="1">جای خالی</option>
            @elseif($exam->type_question == 1)
                <option value="0">گزینه ای</option>
                <option value="1" selected="selected">جای خالی</option>
            @endif
        </select>

        <span>
            <input type="text" name="option_count" value="{{$exam->option_count}}">
        </span>

        <div class="form-group w-200">
            <label for="examname">نام آزمون :</label>
            <input type="text" class="form-control" id="exam_name" name="exam_name" value="{{$exam->exam_name}}"
                   placeholder="آزمون مثال"
                   required>
        </div>
        <div class="form-group">
            <label for="desc">توضیحات:</label>
            <textarea class="form-control" rows="5" id="desc" name="desc" required>{{$exam->desc}}</textarea>
        </div>
        <div class="form-group w-200"><label for="time">قیمت به تومان:</label> <input type="text"
                                                                                      class="form-control"
                                                                                      name="cost"
                                                                                      value="{{$exam->cost}}" required>
        </div>

        <div class="form-group">
            <label for="category_parent">دسته والد</label>
            <select name="category_id"
                    class="form-control" id="">
                <option value="">بدون والد</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($exam->category_id == $category->id)selected="selected"@endif>{{$category->name}}</option>
                    @if(count($category->childrenRecursive) > 0)
                        @include('adminpanel.partial.category',['categories'=>$category->childrenRecursive
                        , 'level'=>1])
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group w-200">
            <label for="time">مدت زمان:</label>
            <input type="text" class="form-control" id="time" name="exam_time" value="{{$exam->exam_time}}"
                   placeholder="60" required>
        </div>
        <div class="form-group w-200">
            <label for="count">تعداد سوالات:</label>
            <input type="text" class="form-control" id="count" name="question_count" value="{{$exam->question_count}}"
                   placeholder="100" required>
        </div>
        <div class="form-group w-200">
            <label for="pic" value="{{$exam->epicaddress}}">تصویر آزمون:</label>
            <input type="file" name="image" value="{{$exam->epicaddress}}" class="form-control">
        </div>
        <div class="form-group w-200">
            <label for="startdate">تاریخ شروع آزمون :</label>
            <input type="date" name="start_date" class="form-control" value="{{$exam->start_date}}"
                   placeholder="1398-04-03" required>
        </div>
        <div class="form-group w-200">
            <label for="enddate">تاریخ اتمام آزمون:</label>
            <input type="date" name="end_date" class="form-control" value="{{$exam->end_date}}" placeholder="1398-04-04"
                   required>
        </div>
        <button type="submit" class="btn btn-success">ادامه و تغیر سوالات</button>
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
    </form>


@endsection
