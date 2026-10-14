<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Request a dental appointment at Cerillo Dental Clinic." />
  <title>Request an appointment · Cerillo Dental Clinic</title>
  <link rel="icon" href="/assets/images/cerillo-logo.png" />
  <link rel="stylesheet" href="/assets/css/app.css" /><link rel="stylesheet" href="/assets/css/clinic-fixes.css" />
<meta name="csrf-token" content="{{ csrf_token() }}"><link rel="stylesheet" href="/assets/css/cerillo-responsive.css">
<script src="/assets/js/cerillo-format.js"></script>
</head>
<body class="appointment-request-page">
  <main class="request-page-shell">
    <header class="request-page-header">
      <a class="brand" href="/" aria-label="Cerillo Dental Clinic home">
        <img src="/assets/images/cerillo-logo.png" alt="Cerillo tooth logo" />
        <span>Cerillo<small>Dental Clinic</small></span>
      </a>
      <a class="btn secondary" href="/">Back to clinic</a>
    </header>

    <section class="request-hero">
      <div>
        <p class="eyebrow">Appointment request</p>
        <h1>Tell us what you need. Our Front Desk will confirm the schedule.</h1>
        <p>Complete the patient and medical information below, choose a preferred date and time, and submit your request. The appointment is not final until Front Desk accepts it and assigns a dentist.</p>
      </div>
      <aside class="request-process-card">
        <strong>How it works</strong>
        <ol>
          <li>Send your patient and medical information.</li>
          <li>Select a preferred service, date and available time.</li>
          <li>Front Desk reviews the request and assigns the appropriate dentist.</li>
          <li>You receive final appointment confirmation from the clinic.</li>
        </ol>
      </aside>
    </section>

    <form id="publicAppointmentRequestForm" class="public-request-form">
      <section class="request-form-section">
        <div class="request-section-heading"><span>01</span><div><h2>Patient information</h2><p>Contact information used by Front Desk to confirm your request.</p></div></div>
        <div class="form-grid">
          <label>First name<input id="reqFirstName" required maxlength="60" autocomplete="given-name" /></label>
          <label>Last name<input id="reqLastName" required maxlength="60" autocomplete="family-name" /></label>
          <label>Date of birth<input id="reqDob" required type="date" /></label>
          <label>Sex<select id="reqSex" required><option>Female</option><option>Male</option><option>Prefer not to say</option></select></label>
          <label>Email (optional)<input id="reqEmail" type="email" autocomplete="email" /></label>
          <label>Mobile number<div class="phone-input"><span>+63</span><input id="reqPhone" required pattern="9[0-9]{9}" placeholder="9171234567" /></div></label>
          <label class="span-2">Home address<input id="reqAddress" required autocomplete="street-address" /></label>
        </div>
      </section>

      <section class="request-form-section">
        <div class="request-section-heading"><span>02</span><div><h2>Medical and dental information</h2><p>These details help the clinic prepare safely before your visit.</p></div></div>
        <div class="form-grid">
          <label>Allergies (optional)<textarea id="reqAllergies" rows="3" placeholder="Type None if none"></textarea></label>
          <label>Current medications (optional)<textarea id="reqMedications" rows="3" placeholder="Type None if none"></textarea></label>
          <label class="span-2">Medical history (optional)<textarea id="reqMedicalHistory" rows="4" placeholder="Conditions, previous surgeries, heart disease, hypertension, diabetes, bleeding disorders, pregnancy, or other information the dentist should know"></textarea></label>
          <label>Previous dental visit (optional)<input id="reqLastVisit" type="date" /></label>
          <label>Dental anxiety<select id="reqAnxiety"><option>Low</option><option>Moderate</option><option>High</option></select></label>
          <label>Bleeding tendency<select id="reqBleeding"><option>No known issue</option><option>Yes / under medical care</option><option>Unsure</option></select></label>
          <label>Pregnancy status<select id="reqPregnancy"><option>Not applicable / No</option><option>Pregnant</option><option>Possibly pregnant</option><option>Prefer not to say</option></select></label>
          <label class="span-2">Chief concern / reason for visit<textarea id="reqConcern" required rows="4" placeholder="Describe pain, sensitivity, broken tooth, cleaning request, orthodontic concern, or other reason"></textarea></label>
        </div>
      </section>

      <section class="request-form-section">
        <div class="request-section-heading"><span>03</span><div><h2>Service and availability</h2><p>Select the service you are interested in and a preferred schedule. Front Desk will confirm the final time.</p></div></div>
        <div class="form-grid request-service-grid request-service-single">
          <label>Requested service<select id="reqService" required></select></label>
          
        </div>
        <div class="request-date-picker"><label for="reqDateSelector">Preferred date</label><input type="date" id="reqDateSelector" aria-label="Choose preferred appointment date" /></div><p class="small muted">Past days and elapsed time slots cannot be selected. Clinic availability is checked for the selected date.</p><div class="public-availability-calendar" id="publicAvailabilityCalendar" aria-label="Appointment availability calendar"></div>
        <input type="hidden" id="reqPreferredDate" required />
        <input type="hidden" id="reqPreferredTime" required />
        <div class="selected-request-slot" id="selectedRequestSlot">Choose a service, date, and an available time.</div>
      </section>

      <section class="request-form-section">
        <div class="request-section-heading"><span>04</span><div><h2>Consent and contact preference</h2><p>Choose how Front Desk should contact you about this request.</p></div></div>
        <div class="form-grid">
          <label>Preferred contact<select id="reqContactPreference"><option>SMS</option><option>Email</option><option>Phone call</option></select></label>
          <label>Best time to contact<select id="reqContactTime"><option>Morning</option><option>Afternoon</option><option>Any clinic hour</option></select></label>
          <label class="span-2 check request-consent"><input id="reqConsent" type="checkbox" required /><span>I confirm that the information above is accurate and understand that this is an appointment request, not a confirmed booking.</span></label>
        </div>
      </section>

      <div class="request-form-actions">
        <a class="btn secondary" href="/">Cancel</a>
        <button class="btn" type="submit">Submit appointment request</button>
      </div>
      <div class="request-success" id="requestSuccess" hidden aria-live="polite"></div>
    </form>
  </main>

  <script src="/assets/js/public-booking-live.js" defer></script>


<script src="/assets/js/cerillo-ui-hotfix.js"></script>

<script src="/assets/js/cerillo-responsive.js"></script>
<script src="/assets/js/cerillo-table-pagination.js"></script>
</body>
</html>