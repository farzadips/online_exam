@extends('layouts.master')
@section('link','logout')
@section('title','خروج')
@section('content')

<div class="container" style="direction: rtl; margin-top: 6rem;">
  @if (session('exam_not_finished'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('exam_not_finished') }}
    </div>
  @endif
	<div class="d-flex flex-wrap justify-content-between" style="color: #e8e7e5;margin: 1rem 2rem;">
@if(isset($result))
@for($i=0;$i< sizeof($result);$i++)
	<div class="col-sm-5 future-exam-plain" style="color: #383535">
		<img src="{{ asset('images.exampic/'.$result[$i][0]->epicaddress) }}" class="future-exam-img">
        <br><br>
       	<h4><b style="color:#1da1f2 ">{{$result[$i][0]->exam_name}}</b></h4><br>
      	<p><b style="color:#1da1f2 ">توضیحات:</b>&nbsp;{{$result[$i][0]->desc}}</p><br>
      	<p><b style="color:#1da1f2 ">مدت زمان:</b>&nbsp;<span>{{$result[$i][0]->exam_time}}</span>دقیقه</p><br>
        <p><b style="color:#1da1f2 ">تعداد سوالات:</b>&nbsp;<span>{{$result[$i][0]->question_count}}</span></p><br>
      	<div class="d-flex justify-content-center">
          <form action="/estimate" method="post">
            @csrf
          <input type="hidden" name="exam_id" value="{{$result[$i][0]->id}}">
      	  <input  class="exam-entry-btn" style="width: 9rem" type="submit" value="مشاهده نتیجه">
         </form>
        </div>
        <hr>
      	   <div class="d-flex justify-content-between  mb-3">
         <div class="p-2"><span style="color:#1da1f2 ">تاریخ شروع :&nbsp;</span><span><bdi style="opacity: .7" >{{$result[$i][0]->start_date}}<bdi></span></div>
   
         <div class="p-2"><span style="color:#1da1f2 ">تاریخ اتمام:&nbsp;</span><span><bdi style="opacity: .7">{{$result[$i][0]->end_date}}</bdi></span></div>
          </div>
        </div>

@endfor
@else
<div class="container" style="direction: rtl">
<div style="height: 25rem;margin-top: 6rem; text-align: center;border:1px solid #6bbde0;background-color: #71c4e8;border-radius: 10px;">
 <h1 style="margin-top: 5rem;">شما در هیچ آزمونی شرکت نکرده اید</h1><br>
 
 <a href="/userpanel">بازگشت به پنل کاربری</a>
</div>
</div>
@endif


	</div>
	</div>


@endsection