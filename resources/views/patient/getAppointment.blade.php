{% extends 'base.html' %}

{% load static %}


{% block content %}
<main class="loginPage">
  {% include 'partials/_header.html' %}
  <form action="" method="POST" id="login-form">
      {% csrf_token %}
      {% for field in form%}
        <div class="form-group">
            
          <label>{{field.label}}</label>

          {{field}}

        </div>

      {% endfor %}
        <button type="submit" class="btn btn-primary submitButton">Submit</button>
  </form>
</main>

{% endblock %}