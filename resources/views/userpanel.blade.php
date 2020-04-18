@extends('layouts.master')
@section('link','logout')
@section('title','خروج')
@section('content')
<div class="container" style="direction: rtl;">
	
	<div class="d-flex flex-wrap justify-content-between">
		<div class="col-sm-3 userpaneloption"style="cursor: pointer;" onclick="window.location='/exams';">
			
			
			<i class="fas fa-hourglass-start " style="font-size: 9.5rem; margin-top: 1rem;color:#3fc413"></i>
			<h5 class="desc"><b>آزمون های در حال برگذاری</b></h5>
		   
		</div>
		
		<div class="col-sm-3 userpaneloption" style="cursor: pointer;" onclick="window.location='/results';">
			<i class="fa fa-medal " style="font-size: 9.5rem; margin-top: 1rem;color: #e8d829"></i>
			<h5 class="desc"><b>نتایج آزمون ها</b></h5>
			
		</div>
		<div class="col-sm-3 userpaneloption" style="cursor: pointer;" onclick="window.location='/setting';">
			
			<i class="fas fa-user-cog " style="font-size: 9.5rem; margin-top: 1rem;color: #474638"></i>
			<h5 class="desc"><b>تنظیمات حساب کاربری</b></h5>
			
		</div>
		<div class="col-sm-3 userpaneloption" style="cursor: pointer;" onclick="window.location='/shownews';">
			
			<i class="fa fa-flag " style="font-size: 9.5rem; margin-top: 1rem; color: #218eb2;"></i>
			<h5 class="desc"><b>اطلاعیه</b></h5>
			
		</div>
	</div>

   
</div>
</div>

@endsection