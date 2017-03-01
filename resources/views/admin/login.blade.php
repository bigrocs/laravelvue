<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>LaravelVue - </title>
    <link rel="stylesheet" href="{{ mix('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/login.css') }}">
    <style>
        body {
            background-image:url('{{ asset('/assets/apps/img/bg.jpg') }}');
        }
        .login-sidebar:after, .gradient-button {
            background: linear-gradient(-135deg, #bc1339, #e9721e);
            background: -webkit-linear-gradient(-135deg, #4cb5ff, #e9721e);
        }
    </style>
</head>
<body>
<!-- Designed with ♥ by Frondor -->
<div class="container-fluid">
    <div class="row">
        <div class="faded-bg"></div>
        <div class="hidden-xs col-sm-8 col-md-9">
            <div class="clearfix">
                <div class="hidden-xs" style="margin-top:200px"></div>
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <img class="img-responsive pull-left logo hidden-xs" src="http://laravel54.dev/vendor/tcg/voyager/assets/images/logo-icon-light.png" alt="Logo Icon">
                    <div class="copy">
                        <h1>LaravelVue</h1>
                        <p>欢迎使用LaravelVue. 这个后台管理系统使用Laravel和Vue构建.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3 login-sidebar">

            <div class="logo-container">    
                <img class="img-responsive logo" src="http://laravel54.dev/vendor/tcg/voyager/assets/images/logo-icon-light.png" alt="Logo Icon">
            </div>

            <form action="{{ route('admin.auth.login') }}" method="POST">
            {{ csrf_field() }}
            <div class="group">      
              <input type="text" name="username" value="" required>
              <span class="highlight"></span>
              <span class="bar"></span>
              <label><i class="glyphicon glyphicon-user"></i><span class="span-input"> 用户名/手机/邮箱</span></label>
            </div>

            <div class="group">      
              <input type="password" name="password" required>
              <span class="highlight"></span>
              <span class="bar"></span>
              <label><i class="glyphicon glyphicon-lock"></i><span class="span-input"> 登录密码</span></label>
            </div>

            <button type="submit" class="btn btn-block gradient-button">
                <span class="signingin hidden"><span class="glyphicon glyphicon-refresh"></span> 登录中...</span>
                <span class="signin">登 录</span>
            </button>
           
          </form>
            
        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    btn.addEventListener('click', function(ev){
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
</script>
</body>
</html>
