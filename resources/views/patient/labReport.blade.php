{% extends 'base.html' %}

{% block content %}

{% include 'partials/_header.html' %}

<article class="lab-test">
    <div class="lab-report">
        {% autoescape off %}
            {{ labReports.text|safe }}
        {% endautoescape %}
    </div>
    <button class="btn btn-danger download-report">Download PDF</button>
</article>
{% endblock %}