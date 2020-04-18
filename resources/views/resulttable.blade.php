@extends('layouts.master')
@section('link','logout')
@section('title','خروج')
@section('content')
<div class="container" style="direction: rtl;margin-top: 10rem;height: 100%">
	
	<div class="d-flex flex-wrap justify-content-center">
		<table>
		  <tr>
		    <th><span style="float: right;">نام</span></th>
		    <th><span style="float: right;">نام خانوادگی</span></th>
		    <th><span style="float: right;">درصد کل</span></th>
		    <th><span style="float: right;">هوش تجسم</span></th>
		    <th><span style="float: right;">هوش تصویری و استعداد </span></th>
		    <th><span style="float: right;">هوش استدل</span></th>
		    <th><span style="float: right;">هوش کلام</span></th>

		  </tr>
		 @foreach($userss as $user)
		 
		 @if($percent[$user->id]  != 0)
			  <tr>
		    <th><span style="float: right;">{{ $user->name}}</span></th>
		    <th><span style="float: right;">{{$user->lastname}}</span></th>
		    <th><span style="float: right;">{{$percent[$user->id]}}</span></th>
		        <th><span>{{$imaginpercent[$user->id]}}</span></th>
		    <th><span style="float: right;">{{$describepercent[$user->id]}}</span></th>
		    <th><span style="float: right;">{{$whypercent[$user->id]}}</span></th>
		    <th><span style="float: right;">{{$wordspercent[$user->id]}}</span></th>

		      </tr>
		      @endif
         @endforeach
       </table>

   
</div>
</div>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
<br>

@endsection