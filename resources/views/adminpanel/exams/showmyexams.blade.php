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

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            @if($exam->author_id == $user->id)
                                <tr style="direction: rtl">
                                    <td style="text-align: center">{{$exam->id}}</td>
                                    <td style="text-align: center">{{$exam->exam_name}}</td>
                                    <td style="text-align: center">{{$exam->category->name}}</td>

                                    <td class="text-center">
                                        <a class="btn btn-warning"
                                           href="/adminpanel/edit_exam/{{$exam->id}}">ویرایش</a>
                                        <div class="display-inline-block">
                                            <form method="post" action="/adminpanel/delete_exam/{{$exam->id}}">
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                >حذف
                                                </button>
                                            </form>
                                        </div>
                                        <a class="btn btn-success"
                                           href="/adminpanel/show_students/{{$exam->id}}">دانشجویان</a>
                                    </td>
                                @endif
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