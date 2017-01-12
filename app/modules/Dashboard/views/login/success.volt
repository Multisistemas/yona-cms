<div class="container">
    <div class="col-md-12"></div>
    <section>
        {% if auths['auth']['raw']['gender'] == "female" %}
           <h2>Bienvenida 
        {% else %}
           <h2>Bienvenido 
        {% endif  %}
        {{ auths['auth']['raw']['given_name'] }}</h2>
        <pre>
        <?php //print_r($auths); ?>
        </pre>

        <p>A continuación encontrarás los enlaces a nuestros sistemas de información:</p>
		<h4>Enlaces</h4>
        <div> 
        <ul>
        {% for id,link in auths['modules'] %}
        	{% if id is scalar %}
        	<a href='{{link}}'>
        	<li>
        		 <span>{{id}}</span>
        	</li>
        	</a>
        	{% endif %}
        {% endfor %}
        </ul>
        </div>
		
		<h4>Manuales</h4>
        <div class="bs-glyphicons"> 
        <ul class="bs-glyphicons-list">
        {% for id,link in auths['manuals'] %}
        	{% if id is scalar %}
        	<a href='{{link}}'>
        	<li>
        		 <span>{{id}}</span>
        	</li>
        	</a>
        	{% endif %}
        {% endfor %}
        </ul>
        </div>
    </section>
</div>
</div>