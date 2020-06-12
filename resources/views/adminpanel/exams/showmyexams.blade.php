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
                            <th class="text-center"> نام سوال</th>
                            <th class="text-center"> نوع سوال</th>
                            <th class="text-center"> دسته بندی سوال</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            @if($exam->author_id == $user->id)
                                <tr style="direction: rtl">
                                    <td style="text-align: center">{{$exam->exam_name}}</td>
                                    <td style="text-align: center">{{$exam->type_question == 0 ? $exam->question_count.' گزینه ای' : 'جای خالی'}}</td>

                                    <td style="text-align: center">{{isset($exam->category->name) ? $exam->category->name : 'دسته بندی ندارد' }}</td>

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
