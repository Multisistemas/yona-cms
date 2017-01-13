<div class="container">
        <div class="row">
                {% if success == true %}
                 <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>Mensaje enviado</h1>
                        <p>Revisa tu bandeja de entrada y haz click en el enlace que te hemos enviado para validar
                        tu cuenta de correo.
                        </p>
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
                {% endif %}    
        </div>
</div>