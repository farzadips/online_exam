@extends('layouts.master')
@section('link','logout')
@section('title','خروج')
@section('content')
    <div class="container-fluid">


        <div
            style="border:1px solid #1da1f2;border-radius: 2rem;background-color: white;width: 100%;text-align:center;margin-top: 5rem;direction: rtl">
            <div style="direction: rtl width:100%">
                <h4 style="color: #1da1f2;margin-top: 2rem;">تعداد کل سوالات:</h4>
                <p style="font-size: 1.3rem;">{{$count}}</p>
                <h4 style="color: #1da1f2">جواب درست:</h4>
                <p style="font-size: 1.3rem">{{$trueanswer}}</p>
                <h4 style="color: #1da1f2">جواب غلط:</h4>
                <p style="font-size: 1.3rem">{{$falseanswer}}</p>
                <h4 style="color: #1da1f2">درصد:</h4>
                <p style="font-size: 1.3rem">{{$percent}}</p>
                @if(isset($imagin_percent))
                    <h4 style="color: #1da1f2">هوش تجسمی:</h4>
                    <p style="font-size: 1.3rem">{{$imagin_percent}}</p>
                    <h4 style="color: #1da1f2">هوش تصویری و استعداد تحلیلی :</h4>
                    <p style="font-size: 1.3rem">{{$describe_percent}}</p>
                    <h4 style="color: #1da1f2">هوش استدلالی:</h4>
                    <p style="font-size: 1.3rem">{{$why_percent}}</p>
                    <h4 style="color: #1da1f2">هوش کلامی: </h4>
                    <p style="font-size: 1.3rem">{{$words_percent}}</p>
                @endif
                <hr>
                @php
                    $i=0;
                @endphp
                @foreach($questions as $question)

                    <p style="color:#1da1f2;font-size: 1.5rem;"><span>{{$i+1}}-</span>{{$question->question}}؟</p>
                    @php
                        $valid=$question->valid;
                    @endphp

                    @if($exam->type_question==0)
                        @for($k=0;$k<$exam->question_count;$k++)
                            @if(isset($options[$i][$k]))
                                @if($options[$i][$k]->id==$valid)
                                    <p style="margin-top: 1rem;">
                                        <span
                                            style="color:#1da1f2 ">جواب درست:</span><span>{{$options[$i][$k]->option}}</span>
                                        @if($options[$i][$k]->ohaspic==1)
                                            <img style="margin-right:2rem;max-height: 80px;max-width: 200px;"
                                                 src="{{ asset('images.optionpic/'.$options[$i][$k]->opicaddress) }}">
                                        @endif
                                        @endif
                                    </p>
                                    @if(in_array($options[$i][$k]->id, $answers))
                                        <p style="margin-top: 1rem;"><span
                                                style="color:#1da1f2">جواب شما:</span><span>{{$options[$i][$k]->option}}</span>
                                            @if($options[$i][$k]->ohaspic==1)
                                                <img style="margin-right:2rem;max-height: 80px;max-width: 200px;"
                                                     src="{{ asset('images.optionpic/'.$options[$i][$k]->opicaddress) }}">
                                            @endif
                                            @endif
                                        </p>
                                    @endif
                                    @endfor
                                @endif
                                @if($exam->type_question==1)
                                        <p>جواب شما: {{$answers[$i]}}</p>
                                        <p>جواب درست: {{$valids[$i]}}</p>

                                @endif


                                @php
                                    $i=$i+1;
                                @endphp
                                <br><br>
                                @endforeach

            </div>
        </div>


@endsection
