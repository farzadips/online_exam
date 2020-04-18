<!DOCTYPE html>
<html>
<head>
	<title>{{$exam->exam_name}}</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
         <link href="{{ asset('css/holdexam.css') }}" rel="stylesheet">
      
</head>
<body>
  <div class="row center">
    <div class="col-sm-2">
	<div class="clock">
	<p id="demo"></p>
   </div>
 </div>
<div class="col-sm-9">
<div class="border mt-5">
<div class="row center">
  <h3>بسم تعالی</h3>
</div>
<div class="row center">
  <img  style="width:12rem;height: 12rem;margin-top: 1rem;"src="{{ asset('images/logo.png') }}">
</div>
<div class="row center mt-4">
<h2>موسسه نوآور اردوش</h2>
</div>
<div class="row center mt-4">
    <h3>{{$exam->exam_name}}</h3>
</div>

  <div class="container">
  	<div class="d-flex flex-wrap flex-sm-row justify-content-around mt-5">
		<div class="col-sm-5 w-100 center mt-4"><span class="f-1-3">توضیح آزمون:<span>{{$exam->desc}}</span></span></div>
		<div class="col-sm-3 100 center mt-4"><span class="f-1-3">تعداد سوالات:<span>{{$exam->question_count}}</span></span></div>
		<div class="col-sm-3 w-100 center mt-4"><span class="f-1-3">زمان:<span>{{$exam->exam_time}}قیقه</span></span></div>
  </div>
  </div>
   <div class=" mt-5 d-flex justify-content-start">
      <ul class="rtl right">
       <li class="mt-4">آزمون دارای نمره منفی میباشد.</li>
       <li class="mt-4">در صورت به پایان رسیدن زمان آزمون پاسخ ها به طور خودکار ذخیره میشوند.</li>
       <li class="mt-4">در صورت ترک کردن این صفحه بدون ذخیره پاسخ ها و بازگشت دوباره آزمون از اول شروع میشود.</li>
     </ul>
   </div>
    
	<br><br>
	<hr>

	<div class="right mr-1">
		<form  name="myform" action="/answersubmit" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="exam_id" value="{{$exam->id}}">
	@php
     $i=0;
	@endphp
	@foreach ($questions as $question)
     <hr>
		<p class="mainquestion"><span>{{$i+1}}-</span><span>{{$question->question}}</span><span>؟</span></p><br>
		@if($question->qhaspic==1)
    <br>
    <div  class="row justify-content-center">

		<img class="question-image mt-2" src="{{ asset('images.questionpic/'.$question->qpicaddress) }}">
    </div>
    <br>
		@endif
  <div class="d-flex flex-wrap">
		@for($j=0;$j<5;$j++)
    @if(isset($options[$i][$j]))
		<div style="margin-left:3rem">
       <span style="direction:ltr;margin:0 5px" class="f-1-5">{{$j+1}}-</span><span class="f-1-3" style="margin:0 5px">{{$options[$i][$j]->option}}<span>&nbsp;
        @if($options[$i][$j]->ohaspic==1)
        <img class="option-image" src="{{ asset('images.optionpic/'.$options[$i][$j]->opicaddress) }}">
        @endif
        <input class="option-image" type="radio"  name="question{{$i}}"
        value="{{$options[$i][$j]->id}}" style="width:3rem;height:3rem;">
        </div>
        @endif
        
     @endfor
 </div>
     @php
     $i=$i+1;
     @endphp
	@endforeach
	<div class="center border-top">
         <input class='btn btn-primary submit-answer mt-5' type="submit" value="ثبت نهایی">
         <br><br>
     </div>
        </form>
       
	</div>
</div>
<br><br>
</div>
</div>
</div>

<script>
// Set the date we're counting down to
var d1 = new Date (),
    d2 = new Date ( d1 );
d2.setMinutes ( d1.getMinutes() + <?php echo $exam->exam_time ?> );

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = d2 - now;
    
  // Time calculations for days, hours, minutes and seconds

  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
   document.myform.submit();
  }
}, 1000);

</script>
</body>
</html>