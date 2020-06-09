@extends('adminpanel.plain')
@section('content')


    <section class="content" >
        <div class="text-center" style="margin: 40px">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img style="width: 100px;height:100px" src="{{asset('images/user.png')}}" class="user-image"
                     alt="User Image">
                <span class="hidden-xs">{{$user->name}} {{$user->lastname}}</span>
            </a>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$examcount}}</h3>

                        <p>بانک سوالات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/exams" class="small-box-footer">برو به بانک سوالات <i class="fa fa-arrow-circle-right"></i></a>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$myexamcount}}</h3>

                        <p>سوالات من</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/myexams" class="small-box-footer">برو به سوالات من <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$categorycount}}</h3>

                        <p>دسته بندی ها</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('categories.index')}}" class="small-box-footer">برو به دسته بندی <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$newscount}}</h3>

                        <p>اطلاعیه ها</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/news" class="small-box-footer">برو به اطلاعیه ها <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="text-center" style="margin: 40px">
        <a href="/adminpanel/add_exam" class="dropdown-toggle" data-toggle="dropdown">
            <img style="width: 100px;height:100px" src="{{asset('images/plus.png')}}" class="user-image"
                 alt="User Image">
            <br>
            <span class="hidden-xs">افزودن سوال</span>
        </a>
        </div>
    </section>
@endsection
