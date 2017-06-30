<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Freelancer - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= $this->url->path() ?>vendor/css/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?= $this->url->path() ?>static/css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= $this->url->path() ?>vendor/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body<?php if ($this->view->bodyClass) { ?> class="<?= $this->view->bodyClass ?>"<?php } ?>>
    <div id="wrapper">
      <?= $this->getContent() ?>
    </div>
    <!-- jQuery -->
    <script src="<?= $this->url->path() ?>vendor/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $this->url->path() ?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <!-- Contact Form JavaScript -->
    <script src="<?= $this->url->path() ?>static/js/jqBootstrapValidation.js"></script>
    <script src="<?= $this->url->path() ?>static/js/contact_me.js"></script>
    <!-- Theme JavaScript -->
    <script src="<?= $this->url->path() ?>static/js/freelancer.min.js"></script>
  </body>

</html>
