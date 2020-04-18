@extends('adminpanel.plain')
@section('content')

    <form action="/submitexam" method='post' style="direction: rtl; text-align: right;" enctype="multipart/form-data">
        @csrf
        <label>نوع سوال را انتخاب کنید:</label>

        <select id="type_question" name="type_question">
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
        {{-- 				    <div class="form-group w-200">--}}
        {{-- 				   	<label for="pic">آیا آزمون هوش و خلاقیت است؟</label>--}}
        {{-- 				    <input type="checkbox" name="is_creative"class="form-control" value="1">--}}
        {{-- 				   </div>--}}
        {{-- 				   <div class="form-group w-200">--}}
        {{--					    <label for="imagin_start">هوش محاسباتی و خلاقیت:</label>--}}
        {{--					    <input type="text" class="form-control" name="imagin_start">--}}
        {{--					    <p>تا</p>--}}
        {{--					    <input type="text" class="form-control" name="imagin_end">--}}
        {{-- 				   </div>--}}
        {{-- 				     <div class="form-group w-200">--}}
        {{--					    <label for="describe_start">هوش تصویری و استعداد تحلیلی:</label>--}}
        {{--					    <input type="text" class="form-control" name="describe_start">--}}
        {{--					    <p>تا</p>--}}
        {{--					    <input type="text" class="form-control" name="describe_end">--}}
        {{-- 				   </div>--}}
        {{-- 				       <div class="form-group w-200">--}}
        {{--					    <label for="why_start">هوش استدلالی و منطقی:</label>--}}
        {{--					    <input type="text" class="form-control" name="why_start">--}}
        {{--					    <p>تا</p>--}}
        {{--					    <input type="text" class="form-control" name="why_end">--}}
        {{-- 				   </div>--}}
        {{-- 				   <div class="form-group w-200">--}}
        {{--					    <label for="words_start">شماره سوالات هوش کلامی از :</label>--}}
        {{--					    <input type="text" class="form-control" name="words_start">--}}
        {{--					    <p>تا</p>--}}
        {{--					    <input type="text" class="form-control" name="words_end">--}}
        {{-- 				   </div>--}}
        {{-- 				 --}}
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
    </form>


@endsection
