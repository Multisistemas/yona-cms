<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="{{ url.path() }}vendor/js/html5shiv.js"></script>
            <script src="{{ url.path() }}vendor/js/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                {% if session.has('opauth') or session.has('manual') %}
                 <div class="col-md-12">
                    <div class="jumbotron">
                        <h2>{{ auth.name }}</h2>
                        {% if system != null %}
                        <p>Estos son los sistemas que ha elegido:</p>
                            {% if system == "ERP" %}
                                <a href="#"><button type="button" class="btn btn-primary">Ir a ERP</button></a>
                            {% elseif system == "DMS" %}
                                <a href="#"><button type="button" class="btn btn-warning">Ir a DMS</button></a>
                            {% elseif system == "LMS" %}
                                <a href="#"><button type="button" class="btn btn-info">Ir a LMS</button></a>
                            {% endif %}
                        {% endif %}
                    </div>
                </div>   
                {% else %}
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>Bienvenido a Multisistemas</h1>
                        <p>Antes que nada debe identificarse</p>
                        <a href="/dashboard/index/login"><button type="button" class="btn btn-lg btn-primary">Iniciar sesión / Registrarse</button></a>
                    </div>
                </div>
                {% endif  %}  
            </div>
        </div>
    </body>
</html>
