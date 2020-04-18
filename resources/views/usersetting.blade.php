@extends('layouts.master')
@section('link','logout')
@section('title','خروج')
@section('content')
<div class="container">
	
 <div class="d-flex justify-content-center">
	<div class="col-sm-6">
		<div id="login-panel" style="text-align: center;direction: rtl;height:56rem;">
			<div  style="border-bottom:2px solid rgba(29, 161, 242, .5);;text-align: center;">
				<h3 style="color: black;font-size: 1.2rem;padding: 1REM;">مشخصات حساب کاربری شما</h3>
			</div>
      <form action="/changeuserinfo" method="post">
        @csrf
      <p style="margin-top: 2rem;">نام:</p>
      <input type="text" name="name" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" value="{{$user->name}}"><br><br>
      <p>نام خانوادگی:</p>
      <input type="text" name="lastname"style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" value="{{$user->lastname}}"><br><br>
      <p>ایمیل:</p>
      <input class="user" type="text" name="email" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" value="{{$user->email}}"><br><br>
      <p>کدملی:</p>
      <input class="user" type="text" name="identity_code" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" value="{{$user->identity_code}}"><br><br>
       <p>تلفن همراه:</p>
      <input class="user" type="text" name="phone" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" value="{{$user->phone}}"><br><br>
      <p>تغییر رمز عبور:</p>
      <input class="user" type="password" name="password" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;"><br><br>
      <p>تکرار رمز عبور:</p>
      <input class="user" type="password" name="repeat_password" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;"><br><br>
      <input type="submit" id="login-btn" style="font-size: 1.2rem;" value="به روز رسانی">
      </form>
       @if ($errors->any())
        <div class="alert alert-danger" style="margin-top: 1rem;">
         <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

      @endif
@if (session('password_not_match'))
    <div class="alert alert-danger" style="text-align: center;margin-top: 1rem;">
        {{ session('password_not_match') }}
    </div>
  @endif
			</div>
		</div>
  </div>

   

</div>
<br><br>

@endsection