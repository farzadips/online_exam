@extends('layouts.master')
@section('link','signup')
@section('title','ثبت نام')
@section('content')
<div class="container-fuild">
	
	<div class="d-flex flex-wrap justify-content-center">
	<div class="col-sm-4">
		<div id="login-panel">
			<div  style="border-bottom:2px solid rgba(29, 161, 242, .5);text-align: center;">
				<h4>فراموشی رمز عبور</h4>
			</div>
			<form action="/resetpassword" method="post" style="text-align: center; direction: rtl;margin-top: 4rem; ">
				@csrf
           <label class="label" style="color:rgba(29, 161, 242)">ایمیل:</label><br>
          <input class="user" style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;" type="text" name="email" placeholder="لطفا ایمیل خود را وارد کنید">
        <br><br><br><br>
       <input id="login-btn" type="submit" value="دریافت مجدد رمز عبور">
       <br><br><br>
       @if(isset($emailerror)&&$emailerror!=null )
          <div class="alert alert-danger">
        <p>{{$emailerror}}</p>
           @endif
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