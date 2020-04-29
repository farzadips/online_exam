@extends('adminpanel.plain')
@section('content')


    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">دانشجویان شرکت کرده در سوال {{$exam->name}} </h3>


            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr style="direction: rtl">
                            <th class="text-center">نام  دانشجو</th>
                            <th class="text-center">نام خانوادگی دانشجو</th>
                            <th class="text-center">نمره</th>
                        </tr>
                        @foreach($user_exams as $user_exam)
                            <tr style="direction: rtl">

                                <td style="text-align: center">{{$user_exam->user->name}}</td>
                                <td style="text-align: center">{{$user_exam->user->lastname}}</td>
                                <td style="text-align: center">
                                    @if(isset($user_exam->percent))
                                    {{$user_exam->percent}}
                                    @else
                                    نمره محاسبه نشده است
                                        @endif
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                      @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

        </div>
    </section>
@endsection
