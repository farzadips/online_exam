@extends('layouts.master')
@section('link','logout')
@section('title','خروج')
@section('content')
<div class="container" style="direction: rtl; margin-top: 6rem;">
  @if (session('time_error'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('time_error') }}
    </div>
  @endif
   @if (session('signup_error'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('signup_error') }}
    </div>
  @endif
   @if (session('once_error'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('once_error') }}
    </div>
  @endif
	<div class="d-flex flex-wrap justify-content-between" style="color: #e8e7e5;margin: 1rem 2rem;">
@foreach($exams as $exam)
	<div class="col-sm-5 future-exam-plain" style="color: #4c4949">
		<img src="{{ asset('images.exampic/'.$exam->epicaddress) }}" class="future-exam-img">
        <br><br>
       	<h4><b style="color:#1da1f2 ">{{$exam->exam_name}}</b></h4><br>
        <p><b style="color: #1da1f2">مولف:</b>&nbsp;{{$exam->author->name}} {{$exam->author->lastname}}</p><br>
        <p><b style="color: #1da1f2">توضیحات:</b>&nbsp;{{$exam->desc}}</p><br>
      	<p><b style="color: #1da1f2">مدت زمان:</b>&nbsp;<span>{{$exam->exam_time}}</span>دقیقه</p><br>
        <p><b style="color: #1da1f2">تعداد سوالات:</b>&nbsp;<span>{{$exam->question_count}}</span></p><br>
      	<div class="d-flex justify-content-center">
          <form action="/examentry" method="post">
            @csrf
          <input type="hidden" name="exam_id" value="{{$exam->id}}">
          <input type="hidden" name="user_id" value="{{$user->id}}">
      	  <input class="exam-entry-btn" type="submit" value="ورود">
         </form>
        </div>
        <hr>
      	   <div class="d-flex justify-content-between  mb-3">
         <div class="p-2" style="opacity: .8"><span style="color: #0f92e2">تاریخ شروع :&nbsp;</span><span><bdi>{{$exam->start_date}}<bdi></span></div>

         <div class="p-2" style="opacity: .8"><span style="color: #0f92e2">تاریخ اتمام:&nbsp;</span><span><bdi>{{$exam->end_date}}</bdi></span></div>
          </div>
        </div>
@endforeach

	</div>
	</div>

@endsection
