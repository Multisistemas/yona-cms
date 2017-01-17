<div class="container">
    <div class="col-md-12"></div>
    <section>
        {% if auths['auth']['raw']['gender'] == "female" %}
           <h2>Bienvenida 
        {% else %}
           <h2>Bienvenido 
        {% endif  %}
        {{ auths['auth']['raw']['given_name'] }}</h2>

        
        
    </section>
</div>
</div>