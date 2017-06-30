<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--         <meta name="viewport" content="width=device-width, initial-scale=1"> -->

        <title>Admin login</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="{{ url.path() }}themes/{{ config.admin_theme }}/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ url.path() }}themes/{{ config.admin_theme }}/dist/css/AdminLTE.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="{{ url.path() }}themes/{{ config.admin_theme }}/plugins/iCheck/square/blue.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

        <link href="{{ url.path() }}vendor/semantic-2.1/semantic.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="{{ url.path() }}vendor/js/html5shiv.js"></script>
            <script src="{{ url.path() }}vendor/js/respond.min.js"></script>
        <![endif]-->
<!--
        <style>
        .container {
            width: 400px;
            margin: 100px auto 0;
        }
        </style>
-->
    </head>
    <body class="hold-transition login-page">
	<div class="login-box">
	  <div class="login-logo">
	    <a href="../../index2.html"><b>Admin</b>Login</a>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
	    <p class="login-box-msg">Sign in to start your session</p>

	    <form class="ui form" method="post" action="{{ url.get() }}admin/index/login">
	      <div class="form-group has-feedback required field">
            {{ form.render('login') }}
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        {{ form.render('password') }}
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	        <div class="ui error message">
	            <div class="header">Errors</div>
	        </div>
	      <div class="row">
	        <div class="col-xs-8">
	          <div class="form checkbox icheck">
	            <label>
	              <input type="checkbox"> Remember Me
	            </label>
	          </div>
	        </div>
	        <!-- /.col -->
	        <div class="col-xs-4">
                <input type="hidden" name="{{ security.getTokenKey() }}"
                       value="{{ security.getToken() }}"/>
                <input type="submit" id="submit" class="ui blue submit button" value="Log in">

	        </div>
	        <!-- /.col -->
	      </div>
	    </form>
<!--
	    <div class="social-auth-links text-center">
	      <p>- OR -</p>
	      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
	        Facebook</a>
	      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
	        Google+</a>
	    </div>
       -->
	    <!-- /.social-auth-links -->

	    <a href="#">I forgot my password</a><br>
	    <a href="register.html" class="text-center">Register a new membership</a>

	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="{{ url.path() }}themes/{{ config.admin_theme }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ url.path() }}themes/{{ config.admin_theme }}/bootstrap/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="{{ url.path() }}themes/{{ config.admin_theme }}/plugins/iCheck/icheck.min.js"></script>
	<script>
	  $(function () {
	    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' // optional
	    });
	  });
	</script>
    </body>
</html>
