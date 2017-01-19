<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ helper.title().get()|escape }}</title>

    {{ helper.meta().get('description') }}
    {{ helper.meta().get('keywords') }}
    {{ helper.meta().get('seo-manager') }}
    <link href="{{ url.path() }}vendor/css/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url.path() }}vendor/css/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url.path() }}vendor/css/css/style.css" rel="stylesheet" type="text/css">

    <link href="{{ url.path() }}favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">

    <!--css <link href="{{ url.path() }}vendor/css/reset.min.css" rel="stylesheet" type="text/css"> reset -->
    <link href="{{ url.path() }}vendor/semantic-2.1/semantic.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url.path() }}vendor/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--/css libs-->
    
    <!--<link href="{{ url.path() }}static/less/style.less" rel="stylesheet/less" type="text/css">-->
    <script src="{{ url.path() }}vendor/js/jquery-3.1.1.min.js"></script>
    <script src="{{ url.path() }}vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ url.path() }}vendor/js/script.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/vendor/js/html5shiv.js"></script>
    <script src="/vendor/js/respond.min.js"></script>
    <![endif]-->

    <!--js-->
    {{ assets.outputJs('js') }}
    <!--/js-->

    {{ helper.javascript('head') }}

</head>
<body{% if view.bodyClass %} class="{{ view.bodyClass }}"{% endif %}>

<div id="wrapper">
    {{ content() }}
</div>
    
</body>
</html>