<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>LaravelVue - </title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://laravel54.dev/vendor/tcg/voyager/assets/css/login.css">
    <style>
        body {
            background-image:url('http://laravel54.dev/vendor/tcg/voyager/assets/images/bg.jpg');
        }
        .login-sidebar:after, .gradient-button {
            background: linear-gradient(-135deg, #bc1339, #e9721e);
            background: -webkit-linear-gradient(-135deg, #4cb5ff, #e9721e);
        }
    </style>

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
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
                        <h1>Voyager</h1>
                        <p>Welcome to Voyager. The Missing Admin for Laravel</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-3 login-sidebar">

            <div class="logo-container">    
                <img class="img-responsive logo" src="http://laravel54.dev/vendor/tcg/voyager/assets/images/logo-icon-light.png" alt="Logo Icon">
            </div>

            <form action="/admin/login" method="POST">
            {{ csrf_field() }}
            <div class="group">      
              <input type="text" name="username" value="" required>
              <span class="highlight"></span>
              <span class="bar"></span>
              <label><i class="glyphicon glyphicon-user"></i><span class="span-input"> E-mail</span></label>
            </div>

            <div class="group">      
              <input type="password" name="password" required>
              <span class="highlight"></span>
              <span class="bar"></span>
              <label><i class="glyphicon glyphicon-lock"></i><span class="span-input"> Password</span></label>
            </div>

            <button type="submit" class="btn btn-block gradient-button">
                <span class="signingin hidden"><span class="glyphicon glyphicon-refresh"></span> Loggin in...</span>
                <span class="signin">Login</span>
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
