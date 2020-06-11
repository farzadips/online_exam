@extends('adminpanel.plain')
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('cart') && sizeof(\Illuminate\Support\Facades\Session::get('cart')->questions) > 0))
        <li>
            <table class="table">
                <form action="/adminpanel/save_cart" method='post'
                      style="direction: rtl; text-align: right;"
                      enctype="multipart/form-data">

                    @foreach(\Illuminate\Support\Facades\Session::get('cart')->questions as $session_item)
                        <div style="text-align: right;margin-right: 1.5rem;">

                            @csrf
                            <p style="font-size: 1.2rem"><span>سوال {{++$i}}- </span><input class="w-400" type="text"
                                                                                            name="question[]"
                                                                                            value="{{$session_item['question']->question}}"
                                                                                            readonly><span>؟</span></p>
                            <br>

                            @if( $session_item['question']->level == 1 )
                                <span>بسیار اسان</span>
                            @endif
                            @if( $session_item['question']->level == 2 )
                                <span> اسان</span>
                            @endif
                            @if( $session_item['question']->level == 3 )
                                <span>متوسط</span>
                            @endif
                            @if( $session_item['question']->level == 4 )
                                <span>کمی دشوار</span>
                            @endif
                            @if( $session_item['question']->level == 5 )
                                <span>دشوار</span>
                            @endif

                            <br><br>
                            <br>
                            @foreach($session_item['question']->option as $option)

                                <span>- </span><input readonly class="w-200" type="text" value="{{$option->option}}"
                                                      name="option[]"><input readonly
                                                                             type="file"
                                                                             name="select_file[]">
                                <br>

                                <br><br>
                                <br>
                            @endforeach
                            <a class="btn btn-primary" data-toggle="tooltip" title="حذف"  href="{{route('cart.remove', ['id' =>$session_item['question']->id])}}"><i class="fa fa-minus"></i></a>


                            <br>
                            <br>
                        </div>
                    @endforeach
                    <br>
                    <input name="exam_name" placeholder="نام ازمون را وارد کنید">

                    <br>
                    <div class="form-group w-200">
                        <label for="startdate">تاریخ شروع آزمون :</label>
                        <input type="date" name="start_date" class="form-control" placeholder="1398-04-03" required>
                    </div>
                    <div class="form-group w-200">
                        <label for="enddate">تاریخ اتمام آزمون:</label>
                        <input type="date" name="end_date" class="form-control" placeholder="1398-04-04" required>
                    </div>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-success"> ذخیره به عنوان سوال جدید</button>
                        <br>

                </form>

            </table>
        </li>

    @else
        <p style="text-align: center; font-size: large;color: red">سبد سوال شما خالی است.</p>
    @endif
@endsection
