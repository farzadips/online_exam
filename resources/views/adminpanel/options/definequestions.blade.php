@extends('adminpanel.plain')
@section('content')
    <div style="border:1px solid black;width: 100%;border-radius: 1rem;direction: rtl">
        <div style="text-align: center;">
            <h3>بسم الله الرحمن الرحیم</h3>
        </div>

        <div style="text-align: right;margin-right: 1rem;">
            <br><br>

            @if($type_question=="0")
                <span style="font-size:1.3rem;">  نوع آزمون: <span>{{$option_count}} گزینه ای</span></span><br><br>
            @else
                <span style="font-size:1.3rem;">نوع آزمون: <span>جای خالی</span></span><br><br>
            @endif

            <span style="font-size:1.3rem;">نام آزمون:<span>&nbsp;{{$exam_name}}</span></span><br><br>
            <span style="font-size:1.3rem;">تعداد سوالات:<span>&nbsp;{{$question_count}}</span></span><br><br>
            <span style="font-size:1.3rem;">زمان:<span>&nbsp;{{$exam_time}}&nbsp;دقیقه</span></span><br>
        </div>
        <br><br>
        <hr>

        @for ($i =1; $i <= $question_count; $i++)
            <div style="text-align: right;margin-right: 1.5rem;">
                <form class="upload_form" enctype="multipart/form-data">
                    @csrf
                    <p style="font-size: 1.2rem"><span>{{$i}}-</span><input class="w-400" type="text"
                                                                            name="question"><span>؟</span>
                        <span><input style="margin-right: 2rem;" type="file" name="select_file_0"></span></p><br>
                    <span>جواب صحیح :</span><input type="text" name="valid" placeholder="برای مثال  3" required><br><br>
                    <span>سطح سوال :</span>
                    <select name="level">
                        <option value="1">بسیار آسان</option>
                        <option value="2">آسان</option>
                        <option value="3">متوسط</option>
                        <option value="4">کمی دشوار</option>
                        <option value="5">دشوار</option>
                    </select>
                    <br><br>

                    <br>
                    <input type="hidden" name="exam_id" value="{{$exam_id}}">

                    @for($j=1; $j<=$option_count; $j++)
                    <span>گزینه {{$j}}- </span><input class="w-200" type="text" name="option[]"><input type="file"
                                                                                           name="select_file[]"><br><br>
                    <br><br>
                    <br>
                    @endfor
                    <br>
                    <input type="submit">
                    <br><br>
                    <hr>
                    <div id="msg">
                    </div>
                </form>
                <div class="alert" style="display: none"></div>
            </div>
        @endfor
    </div>
@endsection
@section('ajax')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            $('.upload_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "/ajax_upload/action",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (msg) {
                        alert("با موفقیت ثبت شد");
                    }
                })
            });

        });
    </script>
@endsection
