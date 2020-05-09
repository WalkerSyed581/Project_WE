{% extends 'base.html' %}

{% block content %}

{% include 'partials/_mid-cover.html' %}

<article class="content helping-staff-content">
    <section class="duties">
        <!-- Insert all the duties along with a small check box to submit whether it has been fulfilled-->
        <div class="duty card">
            <h3>Duty at Room 32</h3>
            <p>Doctor's Name (if any): John Doe</p>
            <p>Patient's Name : John Smith</p>
            <p>Patient's Prescription: Midazolam</p>
            <p>Patient's Ailment: Dunno</p>
            <form method="POST" action="">
                <div class="form-group form-check">
                    <!-- Enable this when the time has passed for this duty -->
                    <input type="checkbox" class="form-check-input disabled" id="medicalHistoryBool">
                    <label class="form-check-label" for="medicalHistoryBool">Duty Fulfilled</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="duty card">
            <h3>Duty at Room 32</h3>
            <p>Doctor's Name (if any): John Doe</p>
            <p>Patient's Name : John Smith</p>
            <p>Patient's Prescription: Midazolam</p>
            <p>Patient's Ailment: Dunno</p>
            <form method="POST" action="">
                <div class="form-group form-check">
                    <!-- Enable this when the time has passed for this duty -->
                    <input type="checkbox" class="form-check-input disabled" id="medicalHistoryBool">
                    <label class="form-check-label" for="medicalHistoryBool">Duty Fulfilled</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="duty card">
            <h3>Duty at Room 32</h3>
            <p>Doctor's Name (if any): John Doe</p>
            <p>Patient's Name : John Smith</p>
            <p>Patient's Prescription: Midazolam</p>
            <p>Patient's Ailment: Dunno</p>
            <form method="POST" action="">
                <div class="form-group form-check">
                    <!-- Enable this when the time has passed for this duty -->
                    <input type="checkbox" class="form-check-input disabled" id="medicalHistoryBool">
                    <label class="form-check-label" for="medicalHistoryBool">Duty Fulfilled</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
</article>

{% endblock %}