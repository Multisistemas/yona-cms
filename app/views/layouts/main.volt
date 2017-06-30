{{ partial('main/nav') }}
<header>
    {{ partial('main/header') }}
</header>
<div class="wrapper-in">

    <div id="main">

        {{ content() }}

        {% if seo_text is defined and seo_text_inner is not defined %}
            <div class="seo-text">
                {{ seo_text }}
            </div>
        {% endif %}

    </div>
</div>
<!--footer class="footer"-->
    {{ partial('main/footer') }}
<!--/footer-->

<!--{% if registry.cms['PROFILER'] %}
    {{ helper.dbProfiler() }}
{% endif %}-->

{{ helper.javascript('body') }}
