{{-- {% extends 'base.html' %}

{% load static %}

{% block style %} <link rel="stylesheet" href="{% static 'css/docPatient.css' %}"> {% endblock %}

{% block content %}
{% include 'partials/_header.html' %}

<div class="docHeader">
    <h1>Dr. {{doctor.first_name}}  {{doctor.last_name}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    {% include 'partials/_aside_doctor.html' %}

    <article>
        <h2>Appointments</h2>
        <section class="cards upcoming-appointments">
            {% if docAppointments != null %}

                {% for docAppointment in docAppointments%}
                <div class="card appointment">
                    {% for patient in patients %}
                        {% if docAppointment.patient == patient.pk %}
                            <h3>Patient's Name: {{patient.first_name}}  {{patient.last_name}}</h3>
                            <div class="appointment-content">
                                <div class="appointment-text">
                                    <p>Ailment Notes: {{docAppointment.notes}}</p>
                                    <span>Patient Age: {{patient.age}}</span>
                                    <span>Time and Date: {{docAppointment.time}}</span>
                                </div>
                                <div class="actionable">
                                    <button class="btn btn-danger">Show Patient Info</button>
                                </div>
                            </div>
                        {% endif %}
                    {% endfor %}
                </div>
                {% endfor %}
            {% else %}
                
                <p>No Upcoming Appointments</p>

            {% endif %}
            <a href="#" class="btn btn-danger addAppointment">Show Previous Appointments</a>
        </section>

        
    </article>
</div>
{% endblock %} --}}
AKlsdjlaksjdklajs