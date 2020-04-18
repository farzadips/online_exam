@extends('master')
@section('link','login')
@section('title','ورود')
@section('content')
<div class="container">
	
	<div class="d-flex flex-wrap">
	<div class="col-sm-6" style="text-align: center">
		<img style="position: relative;top: 30%"src="{{ asset('images/logo.png') }}">
	</div>
	<div class="col-sm-6">
		<div id="login-panel">
			<div  style="border-bottom:2px solid rgba(216, 86,86, .53);text-align: center;">
				<h3 style="color: #c93e3e">راه های ارتباط با ما</h3>
			</div>
			<div style="text-align: center; direction: rtl;position: relative;top: 10%; color: #c93e3e;">
			 <b>شماره تماس:</b><br><br>
			 <p style="font-size: 1.5rem;"> 041-33299962</p>
			 <a href="https://t.me/Erdosh"><i style="font-size: 4.5rem; margin-top: 2rem;" class="fab fa-telegram"></i></a> <br><br>
			 <a href="https://www.instagram.com/erdos_math/"><i  style="font-size: 4.5rem; margin-top: 2rem;" class="fab fa-instagram"></i></a>
				
			</div>
			</div>
		</div>

   
</div>
</div>

@endsection