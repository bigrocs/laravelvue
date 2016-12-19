<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Vue.js Feed</title>
    <link rel="shortcut icon" href="{{ config('website.icon') }}">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="//cdn.bootcss.com/admin-lte/2.3.8/css/AdminLTE.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/admin-lte/2.3.8/css/skins/_all-skins.min.css">
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini fixed">
    <div id="app">
    </div>
    <script src="//cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{-- <!-- admin-lte JS--> --}}
    <script src="//cdn.bootcss.com/admin-lte/2.3.8/js/app.min.js"></script>
    {{-- <!-- 页面滚动插件 SlimScroll--> --}}
    <script src="//cdn.bootcss.com/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
    {{-- <!-- 快速点击插件 fastClick--> --}}
    <script src="//cdn.bootcss.com/fastclick/1.0.6/fastclick.js"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
