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


                <span style="font-size:1.3rem;">نام آزمون:<span>&nbsp;{{$exam->exam_name}}</span></span><br><br>
                <span style="font-size:1.3rem;">تعداد سوالات:<span>&nbsp;{{$exam->question_count}}</span></span><br><br>
                <span style="font-size:1.3rem;">زمان:<span>&nbsp;{{$exam->exam_time}}&nbsp;دقیقه</span></span><br>
        </div>
        <br><br>
        <hr>

        @for ($i =0; $i <= $exam->question_count-1; $i++)
            <div style="text-align: right;margin-right: 1.5rem;">
                <form action="/adminpanel/submit_question_edit/{{$questions[$i]->id}}" method='post'
                      style="direction: rtl; text-align: right;"
                      enctype="multipart/form-data">
                    @csrf
                    <a class="btn-primary" href="{{route('cart.add',['id'=>$questions[$i]->id])}}"> <span>افزودن به سبد سوالات</span>
                    </a>
                    <p style="font-size: 1.2rem"><span>سوال {{$i+1}}-</span><input class="w-400" type="text"
                                                                                   name="question"
                                                                                   value="{{$questions[$i]->question}}"
                                                                                   readonly><span>؟</span></p>
                    <br>
                    <span>جواب صحیح :</span><input readonly type="text" name="valid"
                                                   value="{{$questions[$i]->valid - $questions[$i]->option[0]->id +1 }}"
                                                   placeholder="برای مثال  3" required><br><br>
                    @if( $questions[$i]->level == 1 )
                        <span>بسیار اسان</span>
                    @endif
                    @if( $questions[$i]->level == 2 )
                        <span> اسان</span>
                    @endif
                    @if( $questions[$i]->level == 3 )
                        <span>متوسط</span>
                    @endif
                    @if( $questions[$i]->level == 4 )
                        <span>کمی دشوار</span>
                    @endif
                    @if( $questions[$i]->level == 5 )
                        <span>دشوار</span>
                    @endif

                    <br><br>

                    <br>
                    <input readonly type="hidden" name="exam_id" value="{{$questions[$i]->exam_id}}">

                    @foreach($questions[$i]->option as $option)

                        <span>- </span><input readonly class="w-200" type="text" value="{{$option->option}}"
                                              name="option[]">
                        <br>
                        <br>
                        <br><br>
                        <br>
                    @endforeach


                    <br>
                    <br><br>
                    <hr>
                    <div id="msg">

                    </div>
                </form>
                <div class="alert" style="display: none"></div>
            </div>
        @endfor
        @endif
        @if($exam->type_question=="1")
            <span style="font-size:1.3rem;">  نوع آزمون: <span>جای خالی</span></span><br>
            <br>


            <span style="font-size:1.3rem;">نام آزمون:<span>&nbsp;{{$exam->exam_name}}</span></span><br><br>
            <span style="font-size:1.3rem;">تعداد سوالات:<span>&nbsp;{{$exam->question_count}}</span></span><br><br>
            <span style="font-size:1.3rem;">زمان:<span>&nbsp;{{$exam->exam_time}}&nbsp;دقیقه</span></span><br>
    <br><br>
    <hr>

            <div style="text-align: right;margin-right: 1.5rem;">
            @for ($i =0; $i <= $exam->question_count-1; $i++)
            <form action="/adminpanel/submit_question_edit/{{$questions[$i]->id}}" method='post'
                  style="direction: rtl; text-align: right;"
                  enctype="multipart/form-data">
                @csrf
                <a class="btn-primary" href="{{route('cart.add',['id'=>$questions[$i]->id])}}"> <span>افزودن به سبد سوالات</span>
                </a>
                <p style="font-size: 1.2rem"><span>سوال {{$i+1}}-</span><input class="w-400" type="text"
                                                                               name="question"
                                                                               value="{{$questions[$i]->question}}"
                                                                               readonly><span>؟</span></p>
                <br>
                <span>جواب صحیح :</span><input readonly type="text" name="valid"
                                               value="{{$questions[$i]->valid  }}"
                                               placeholder="برای مثال  3" required><br><br>
                @if( $questions[$i]->level == 1 )
                    <span>بسیار اسان</span>
                @endif
                @if( $questions[$i]->level == 2 )
                    <span> اسان</span>
                @endif
                @if( $questions[$i]->level == 3 )
                    <span>متوسط</span>
                @endif
                @if( $questions[$i]->level == 4 )
                    <span>کمی دشوار</span>
                @endif
                @if( $questions[$i]->level == 5 )
                    <span>دشوار</span>
                @endif

                <br><br>

                <br>
                <input readonly type="hidden" name="exam_id" value="{{$questions[$i]->exam_id}}">
            </form>
            @endfor
            @endif

        </div>
        </div>
@endsection

