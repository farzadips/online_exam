@extends('adminpanel.plain')
@section('content')
    <div style="border:1px solid black;width: 100%;border-radius: 1rem;direction: rtl">
        <div style="text-align: center;">
            <h3>بسم الله الرحمن الرحیم</h3>
        </div>
        <div style="text-align: right;margin-right: 1rem;">
            <br><br>
            @if($exam->type_question=="0")
                <span style="font-size:1.3rem;">  نوع آزمون: <span>{{$exam->option_count}} گزینه ای</span></span><br>
                <br>
            @else
                <span style="font-size:1.3rem;">نوع آزمون: <span>جای خالی</span></span><br><br>
            @endif

            <span style="font-size:1.3rem;">نام آزمون:<span>&nbsp;{{$exam->exam_name}}</span></span><br><br>
            <span style="font-size:1.3rem;">تعداد سوالات:<span>&nbsp;{{$exam->question_count}}</span></span><br><br>
            <span style="font-size:1.3rem;">زمان:<span>&nbsp;{{$exam->exam_time}}&nbsp;دقیقه</span></span><br>
        </div>
        <br><br>
        <hr>

        @for ($i =0; $i <= $exam->question_count-1; $i++)
            <div style="text-align: right;margin-right: 1.5rem;">
                <form action="/adminpanel/submit_question_edit/{{$questions[$i]->id}}" method='post' style="direction: rtl; text-align: right;"
                      enctype="multipart/form-data">
                    @csrf
                    <p style="font-size: 1.2rem"><span>{{$i+1}}-</span><input class="w-400" type="text"
                                                                            name="question"
                                                                            value="{{$questions[$i]->question}}"><span>؟</span>
                        <span><input style="margin-right: 2rem;" type="file" name="select_file_0"></span></p><br>
                    <span>جواب صحیح :</span><input type="text" name="valid" value="{{$questions[$i]->valid - $questions[$i]->option[0]->id +1 }}"
                                                   placeholder="برای مثال  3" required><br><br>
                    <span>سطح سوال :</span>
                    <select name="level">
                        <option value="1">بسیار آسان</option>
                        <option value="2">آسان</option>
                        <option value="3">متوسط</option>
                        <option value="4">کمی دشوار</option>
                        <option value="5">دشوار</option>
                    </select>
                    <br><br>

                    <br>
                    <input type="hidden" name="exam_id" value="{{$questions[$i]->exam_id}}">

                    @foreach($questions[$i]->option as $option)

                        <span>- </span><input  class="w-200" type="text" value="{{$option->option}}"
                                              name="option[]"><input
                                                                     type="file"
                                                                     name="select_file[]">
                        <br>
                        <br>
                        <br><br>
                        <br>
                    @endforeach
                    <button type="submit" class="btn btn-success">  اتمام ویرایش سوال {{ $i+1 }} و ادامه ویرایش سوالات دیگر  </button>
{{--                    <a class="button" href="\myexams" >خروج</a>--}}
                    <a  class="btn btn-primary" href='/myexams'>خروج</a>

                    <br>
                    <br><br>
                    <hr>
                    <div id="msg">

                    </div>
                </form>
                <div class="alert" style="display: none"></div>
            </div>
        @endfor
    </div>
@endsection

