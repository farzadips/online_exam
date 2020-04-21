<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>صفحه مدیریت فروشگاه اینترنتی روکسو</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/fonts-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- jQuery 2.2.0 -->
    <script src="/admin/plugins/jQuery/jQuery-2.2.0.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div style="direction: rtl">
    <div class="d-flex justify-content-start">
        <div class="col-sm-2" id="admin-menu">
            <ul class="nav flex-column mt-5">
                <li class="nav-item " style="margin-top: 15mm">
                    <span>آزمون ها</span>
                    <a href="/exams"><i class="fa fa-circle-o"></i>لیست سوالات </a>
                    <a href="/adminpanel/add_exam"><i class="fa fa-circle-o"></i>افزودن آزمون </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link border-bot" href="/news">ارسال اطلاعیه</a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.index')}}">دسته بندی ها</a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">خروج</a>
                </li>


            </ul>


        </div>

    </div>
    <div class="col-sm-9 ">
        <div class="d-flex justify-content-end mt-5">
            @yield('content')
        </div>
    </div>
</div>
@yield('ajax')

<!-- jQuery UI 1.11.4 -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="/admin/bootstrap/js/bootstrap.min.js"></script>
@yield('script-vuejs')

<!-- Morris.js charts -->
<script src="/admin/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="/admin/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
@yield('scripts')

<script src="/admin/dist/js/demo.js"></script>

</body>
</html>
