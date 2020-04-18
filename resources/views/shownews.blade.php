@extends('layouts.master')
@section('link','logout')
@section('title','خروج')
@section('content')
<div class="container" style="direction: rtl;margin-top: 10rem;height: 100%">
	
	<div class="d-flex flex-wrap justify-content-center">
		<table>
		  <tr>
		    <th><span style="float: right;">شماره </span></th>
		    <th><span style="float: right;">اطلاعیه</span></th>
		  </tr>
		 @foreach($news as $new)
		   <tr>
		   	<th><span style="float: right;">{{$new->id}}</span></th>
		   	<th><span style="float: right">{{$new->main_news}}</span></th>
		   </tr>
         @endforeach
       </table>

   
</div>
</div>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
<br>

@endsection