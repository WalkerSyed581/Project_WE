{% extends 'base.html' %}

{% load static %}


{% block content %}
<main class="loginPage">
    {% include 'partials/_header.html' %}
    {% if supportGroups %}
        {% for supportGroup in supportGroups %}
        <div class="card appointment">
            <h3>Support Group Title: {{supportGroup.name}}</h3>
            {% for conductor in supportGroupConductors %}
                {% if supportGroup.conducted_by.id == conductor.id %}
                    <h4>Conductor: {{conductor.first_name}}  {{conductor.last_name}}</h4>
                {% endif %}
            {% endfor %}
            <div class="appointment-content">
                <div class="appointment-text">
                    <span>Time: {{supportGroup.timing}}</span>
                    <span>Day: {{supportGroup.day}}</span>
                    <span>Fee: {{supportGroup.fee}}</span>
                   
                    <p>Description: {{supportGroup.description}}</p>
                </div>
                <div class="actionable">
                    <a href="{% url 'patient:joinGroup' patient.id supportGroup.id %}" class="btn btn-danger">Join Support Group</a>
                </div>
            </div>
            
        </div>
        {% endfor %}
    {% else %}
        <p>No Support Groups are currently on going</p>
    {% endif %}

</main>

{% endblock %}