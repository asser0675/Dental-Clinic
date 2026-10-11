(function(){
  function readJson(key, fallback){
    try { return JSON.parse(localStorage.getItem(key) || 'null') || fallback; }
    catch (_) { return fallback; }
  }

  function stripLeakedCodeNodes(){
    var root = document.body;
    if (!root || !document.createTreeWalker) return;
    var suspicious = [
      /cerilloPatientPrintFrame/i,
      /buildPatientPrint\(/i,
      /frame\.srcdoc\s*=\s*html/i,
      /consultation-invoice/i,
      /data-export-patient-pdf/i,
      /window\\?\.addEventListener/i,
      /contentWindow\\?\.focus/i,
      /document\.addEventListener\('click'/i,
      /addLedgerRow\(dialog,item\)/i
    ];
    var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, {
      acceptNode: function(node){
        var parent = node.parentElement;
        if (!parent) return NodeFilter.FILTER_REJECT;
        var tag = parent.tagName;
        if (tag === 'SCRIPT' || tag === 'STYLE' || tag === 'NOSCRIPT' || tag === 'TEXTAREA') return NodeFilter.FILTER_REJECT;
        var text = (node.nodeValue || '').replace(/\s+/g, ' ').trim();
        if (text.length < 120) return NodeFilter.FILTER_SKIP;
        for (var i = 0; i < suspicious.length; i++) {
          if (suspicious[i].test(text)) return NodeFilter.FILTER_ACCEPT;
        }
        return NodeFilter.FILTER_SKIP;
      }
    });
    var doomed = [];
    while (walker.nextNode()) doomed.push(walker.currentNode);
    doomed.forEach(function(node){ node.parentNode && node.parentNode.removeChild(node); });

    Array.from(root.querySelectorAll('p,div,section,article,pre')).forEach(function(el){
      if (el.querySelector('script,style')) return;
      var text = (el.textContent || '').replace(/\s+/g, ' ').trim();
      if (text.length < 140) return;
      var matched = suspicious.some(function(rx){ return rx.test(text); });
      if (matched && el.children.length === 0) {
        el.remove();
      }
    });
  }

  function syncToothLabels(){
    document.querySelectorAll('.premium-dental-chart .tooth-unit').forEach(function(tooth){
      var code = String(tooth.dataset.tooth || '').toUpperCase();
      var isPrimary = /^[A-T]$/.test(code);
      var name = String(tooth.dataset.toothName || '').toLowerCase();
      tooth.classList.toggle('chart-label-primary', isPrimary);
      tooth.classList.toggle('chart-label-permanent', !isPrimary);
      tooth.classList.toggle('tooth-upper', name.indexOf('maxillary') !== -1);
      tooth.classList.toggle('tooth-lower', name.indexOf('mandibular') !== -1);
      var target = tooth.querySelector('.tooth-number');
      if (target && target.textContent !== code) target.textContent = code;
    });
  }

  function latestMatchingRequest(patientName){
    var name = (patientName || '').trim().toLowerCase();
    if (!name) return null;
    var requests = readJson('cerilloPublicAppointmentRequests', []);
    for (var i = requests.length - 1; i >= 0; i--) {
      var req = requests[i] || {};
      var reqName = (req.name || (((req.firstName || '') + ' ' + (req.lastName || '')).trim())).trim().toLowerCase();
      if (reqName === name) return req;
    }
    return null;
  }

  function yesNo(value){
    if (value === true) return 'Yes';
    if (value === false) return 'No';
    return value || 'Not provided';
  }

  function joinConditions(value){
    if (Array.isArray(value) && value.length) return value.join(', ');
    return 'None reported';
  }

  function makeDetail(label, value){
    return '<div><dt>' + label + '</dt><dd>' + (value || 'Not provided') + '</dd></div>';
  }

  function populateMedicalIntakeCard(){
    document.querySelectorAll('dialog.clinical-record-modal').forEach(function(dialog){
      var grid = dialog.querySelector('.medical-record-grid');
      if (!grid) return;
      var old = grid.querySelector('.medical-request-card');
      if (old) old.remove();
      var patientName = dialog.dataset.patientName || '';
      if (!patientName) {
        var header = dialog.querySelector('.patient-file-header h3');
        patientName = header ? header.textContent.trim() : '';
      }
      var req = latestMatchingRequest(patientName);
      if (!req) return;
      var article = document.createElement('article');
      article.className = 'info-card medical-record-card medical-request-card';
      article.innerHTML = '' +
        '<div class="medical-card-title"><span>04</span><div><h4>Appointment Request Intake</h4><p>Information submitted from the online request form.</p></div></div>' +
        '<dl class="detail-list">' +
          makeDetail('Immediate concern', req.concern || req.concernImmediate || 'Not provided') +
          makeDetail('Mouth condition rating', req.mouthCondition || 'Not provided') +
          makeDetail('Routine dental visit', req.dentalRoutine || 'Not provided') +
          makeDetail('Fear level', req.fearScale ? (req.fearScale + ' / 10') : 'Not provided') +
          makeDetail('Unfavorable dental experience', yesNo(req.unfavorableExperience)) +
          makeDetail('Complications from past dental treatment', yesNo(req.pastTreatmentComplications)) +
          makeDetail('Reaction to local anesthetic', yesNo(req.localAnestheticReaction)) +
          makeDetail('Braces / orthodontic treatment / bite adjusted', yesNo(req.bracesHistory)) +
          makeDetail('Teeth removed', yesNo(req.teethRemoved)) +
          makeDetail('Under medical care in past 2 years', yesNo(req.underMedicalCare)) +
          makeDetail('Allergy to penicillin / aspirin / food / drugs / medication', yesNo(req.medicationAllergy)) +
          makeDetail('Excessive bleeding requiring special treatment', yesNo(req.specialBleeding)) +
          makeDetail('Reported conditions', joinConditions(req.healthConditions)) +
          makeDetail('Patient comments', req.requestComments || 'None provided') +
        '</dl>';
      grid.appendChild(article);
    });
  }

  function enhanceRequestForm(){
    var form = document.getElementById('publicAppointmentRequestForm');
    if (!form) return;
    if (document.getElementById('reqFearScale')) return;

    var medicalSection = form.querySelectorAll('.request-form-section')[1];
    if (!medicalSection) return;
    var extra = document.createElement('div');
    extra.className = 'form-grid';
    extra.style.marginTop = '16px';
    extra.innerHTML = '' +
      '<label>How would you rate the condition of your mouth?<select id="reqMouthCondition"><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></label>' +
      '<label>I routinely see my dentist every<select id="reqDentalRoutine"><option>Every 3 months</option><option>Every 1.5 months</option><option>Every 6 months</option><option>Not routinely</option></select></label>' +
      '<label>How fearful are you of dental treatment? (1 least, 10 most)<select id="reqFearScale"><option value="">Select rating</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></label>' +
      '<label>Unfavorable dental experience<select id="reqUnfavorableExperience"><option>No</option><option>Yes</option></select></label>' +
      '<label>Complications from past dental treatment<select id="reqPastTreatmentComplications"><option>No</option><option>Yes</option></select></label>' +
      '<label>Reaction to local anesthetic or difficulty getting numb<select id="reqLocalAnestheticReaction"><option>No</option><option>Yes</option></select></label>' +
      '<label>Braces / orthodontic treatment / bite adjusted<select id="reqBracesHistory"><option>No</option><option>Yes</option></select></label>' +
      '<label>Any teeth removed<select id="reqTeethRemoved"><option>No</option><option>Yes</option></select></label>' +
      '<label>Under the care of a medical doctor during the past 2 years<select id="reqUnderMedicalCare"><option>No</option><option>Yes</option></select></label>' +
      '<label>Allergic to penicillin, aspirin, food, drugs or medication<select id="reqMedicationAllergy"><option>No</option><option>Yes</option></select></label>' +
      '<label>Excessive bleeding requiring special treatment<select id="reqSpecialBleeding"><option>No</option><option>Yes</option></select></label>' +
      '<label class="span-2">Reported health conditions<div class="request-condition-checklist" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:10px;padding:12px 14px;border:1px solid var(--line);border-radius:16px;background:var(--surface-alt)">'
        + '<label class="check"><input type="checkbox" value="Asthma" data-request-condition /> Asthma</label>'
        + '<label class="check"><input type="checkbox" value="Anemia" data-request-condition /> Anemia</label>'
        + '<label class="check"><input type="checkbox" value="Blood Disease" data-request-condition /> Blood Disease</label>'
        + '<label class="check"><input type="checkbox" value="Diabetes" data-request-condition /> Diabetes</label>'
        + '<label class="check"><input type="checkbox" value="Epilepsy" data-request-condition /> Epilepsy</label>'
        + '<label class="check"><input type="checkbox" value="Endocrine Problem" data-request-condition /> Endocrine Problem</label>'
        + '<label class="check"><input type="checkbox" value="Heart Disease" data-request-condition /> Heart Disease</label>'
        + '<label class="check"><input type="checkbox" value="Hearing Disorder" data-request-condition /> Hearing Disorder</label>'
        + '<label class="check"><input type="checkbox" value="Head or Face Injury" data-request-condition /> Head or Face Injury</label>'
        + '<label class="check"><input type="checkbox" value="Hepatitis" data-request-condition /> Hepatitis</label>'
        + '<label class="check"><input type="checkbox" value="Rheumatic Fever" data-request-condition /> Rheumatic Fever</label>'
        + '<label class="check"><input type="checkbox" value="Other" data-request-condition /> Other</label>'
      + '</div></label>' +
      '<label class="span-2">Comments<textarea id="reqRequestComments" rows="3" placeholder="Additional comments relevant to your dental and medical history"></textarea></label>';
    medicalSection.appendChild(extra);

    form.addEventListener('submit', function(){
      var extras = {
        mouthCondition: (document.getElementById('reqMouthCondition') || {}).value || '',
        dentalRoutine: (document.getElementById('reqDentalRoutine') || {}).value || '',
        fearScale: (document.getElementById('reqFearScale') || {}).value || '',
        unfavorableExperience: (document.getElementById('reqUnfavorableExperience') || {}).value || '',
        pastTreatmentComplications: (document.getElementById('reqPastTreatmentComplications') || {}).value || '',
        localAnestheticReaction: (document.getElementById('reqLocalAnestheticReaction') || {}).value || '',
        bracesHistory: (document.getElementById('reqBracesHistory') || {}).value || '',
        teethRemoved: (document.getElementById('reqTeethRemoved') || {}).value || '',
        underMedicalCare: (document.getElementById('reqUnderMedicalCare') || {}).value || '',
        medicationAllergy: (document.getElementById('reqMedicationAllergy') || {}).value || '',
        specialBleeding: (document.getElementById('reqSpecialBleeding') || {}).value || '',
        healthConditions: Array.from(document.querySelectorAll('[data-request-condition]:checked')).map(function(el){ return el.value; }),
        requestComments: (document.getElementById('reqRequestComments') || {}).value || ''
      };
      form.dataset.extraRequestPayload = JSON.stringify(extras);
    }, true);

    form.addEventListener('submit', function(){
      setTimeout(function(){
        var list = readJson('cerilloPublicAppointmentRequests', []);
        if (!list.length) return;
        var last = list[list.length - 1];
        var extras = {};
        try { extras = JSON.parse(form.dataset.extraRequestPayload || '{}'); } catch (_) {}
        Object.assign(last, extras);
        localStorage.setItem('cerilloPublicAppointmentRequests', JSON.stringify(list));
      }, 0);
    });
  }

  function bootstrap(){
    stripLeakedCodeNodes();
    syncToothLabels();
    populateMedicalIntakeCard();
    enhanceRequestForm();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootstrap);
  } else {
    bootstrap();
  }

  document.addEventListener('click', function(event){
    if (event.target.closest('[data-dentition], .tooth-unit, [data-record-target]')) {
      setTimeout(function(){
        syncToothLabels();
        populateMedicalIntakeCard();
      }, 0);
    }
  }, true);

  window.addEventListener('storage', function(event){
    if (event.key === 'cerilloPublicAppointmentRequests') {
      populateMedicalIntakeCard();
    }
  });

  setTimeout(function(){
    stripLeakedCodeNodes();
    syncToothLabels();
    populateMedicalIntakeCard();
  }, 250);
})();
