@extends('layouts.master')
@section('link','signup')
@section('title','ثبت نام')
@section('content')
<div class="container">
	

 <div class="d-flex justify-content-center">
	<div class="col-sm-6">
		<div id="login-panel">
			<div  style="border-bottom:2px solid rgba(29, 161, 242, .5);;text-align: center;">
				<h3 style="color: black;font-size: 1.2rem;padding: 1REM;">ورود</h3>
			</div>
			<form action="/login" method="post" style="text-align: center; direction: rtl;margin-top: 4rem; ">
				@csrf
           <label class="label" style="color: #1da1f2">کد ملی:</label><br>
          <input class="user" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" type="text" name="identity_code"  placeholder="کد ملی خود را وارد کنید">
        <br>
       <label class="label mt-5" style="color: #1da1f2">رمز عبور:</label><br>
          <input class="user" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" type="password" name="password" placeholder="رمز پیشفرض شماره تلفن بدون صفر ابتدا">
        <br><br><br><br>
         @if(isset($error)&& $error!=null )
          <div class="alert alert-danger">
        <p>{{$error}}</p>
           </div>
           @endif

       <input id="login-btn" style="font-size: 1.2rem;" type="submit" value="ورود">
       <br><br>
       <a style="text-align: center;font-size: .8rem;" href="/resetpassword"><b>رمز عبور خود را فراموش کردید؟ </b></a>
       </form><br><br>
       @if ($errors->any())
        <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

      @endif 
       <br>
			</div>
		</div>
  </div>

   

</div>
<br><br>

@endsection