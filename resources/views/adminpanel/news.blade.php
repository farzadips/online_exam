@extends('adminpanel.plain')
@section('content')
		
			 	<form action="/news" method='post' style="direction: rtl; text-align: right;" enctype="multipart/form-data">
			 		@csrf
                        <input type="text" name="news" style="width: 600px;height: 3rem;" required><br><br><br>
                        <button type="submit" class="btn btn-success">ثبت اطلاعیه</button><br><br>
                        
               </form>
			
		 
@endsection
	