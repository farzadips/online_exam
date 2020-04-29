@extends('layouts.master')
@section('link','login')
@section('title','ورود')
@section('content')
    <div class="container">

        <div class="d-flex justify-content-center">
            <div class="col-sm-6">
                <div id="register-panel">
                    <div style="border-bottom:2px solid rgba(29,161,242, .53);text-align: center;">
                        <h3 style="color: black; font-size: 1.2rem;padding: 1rem;"> ثبت نام</h3>
                    </div>
                    <form action="/signup" method="post" style="text-align: center; direction: rtl;margin-top: 3rem; ">
                        @csrf
                        <label class="label" style="color: #1da1f2;font-size:1.2rem;">نام:</label><br>
                        <input style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;"
                               type="text" name="name" placeholder="لطفا نام خود را وارد کنید" required>
                        <br><br>
                        <label class="label" style="color: #1da1f2;font-size:1.2rem;">نام خانوادگی:</label><br>
                        <input style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;"
                               type="text" name="lastname" placeholder="لطفا نام خانوادگی خود را وارد کنید" required>
                        <br><br>
                        <label class="label" style="color: #1da1f2;font-size:1.2rem;">کد ملی:</label><br>
                        <input class="user"
                               style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;"
                               type="text" name="identity_code" placeholder="برای مثال440025xxxx  " required>
                        <br><br>
                        <label class="label" style="color: #1da1f2;font-size:1.2rem;">ایمیل:</label><br>
                        <input style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;"
                               type="text" name="email" placeholder="لطفا ایمیل خود را وارد کنید" required>
                        <br><br>
                        <label class="label" style="color: #1da1f2;font-size:1.2rem;">نقش:</label><br>
                        <label for="نقش ها">یک نفش را انتخاب کنید:</label>

                        <select id="role" name="role">
                            <option value="0">دانشجو</option>
                            <option value="1">استاد</option>
                        </select> <br><br>
                        <label class="label" style="color: #1da1f2;font-size:1.2rem;">رمز عبور</label><br>
                        <input class="user"
                               style="width: 80%;height: 2.5rem;border:1px solid #d3d3d3;border-radius: 5px;"
                               type="text" name="password"
                               placeholder="برای مثال90294558xx بدون صفر اول شماره و کد کشور" required>
                        <br><br><br>
                        <input id="login-btn" type="submit" value="ثبت نام">
                        <br><br>
                        <a style="text-align: center;font-size:.8rem" href="/resetpassword"><b>رمز عبور خود را فراموش
                                کردید؟ </b></a>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
