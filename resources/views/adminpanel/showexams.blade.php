@extends('adminpanel.plain')
@section('content')


    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">سوالات</h3>


            </div>
            <!-- /.box-header -->
            <div class="box-body">
                                @if(Session::has('error_category'))
                                    <div class="alert alert-danger">
                                        <div>{{session('error_category')}}</div>
                                    </div>
                                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr style="direction: rtl">
                            <th class="text-center">شناسه</th>
                            <th class="text-center"> نام سوال</th>
                            <th class="text-center"> دسته بندی سوال</th>
                            <th class="text-center"> مولف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            <tr style="direction: rtl">
                                <td style="text-align: center">{{$exam->id}}</td>
                                <td style="text-align: center">{{$exam->exam_name}}</td>
                                <td style="text-align: center">{{$exam->category->name}}</td>
                                <td style="text-align: center">{{$exam->author->name}} {{$exam->author->lastname}}</td>
                                <td class="text-center">

                                    <div class="display-inline-block">
                                        <form method="post" action="/adminpanel/delete_exam/{{$exam->id}}">
                                            @csrf
                                            <input type="hidden" name="_method" >
                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

        </div>
    </section>
@endsection
