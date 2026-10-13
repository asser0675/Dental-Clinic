(function () {
  const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
  }[char]));
  const normalizeAllergy = value => {
    const text = String(value ?? '').trim();
    return (!text || /^(none|none reported|no allergies|no known allergies|n\/?a)$/i.test(text)) ? 'None' : text;
  };
  const dateTime = value => {
    if (!value) return '—';
    const date = new Date(value);
    return Number.isNaN(date.getTime()) ? '—' : date.toLocaleDateString('en-GB', {
      day: '2-digit', month: 'short', year: 'numeric'
    });
  };
  const statusClass = status => status === 'Completed' ? 'success'
    : ['Cancelled', 'No-Show'].includes(status) ? 'danger'
      : ['Checked In', 'In Progress'].includes(status) ? 'info' : 'warning';
  const databaseTime = value => {
    if (!value) return '—';
    const match = String(value).match(/[ T](\d{2}):(\d{2})/);
    if (match) {
      const hour = Number(match[1]);
      const minute = match[2];
      if (hour <= 23) {
        return `${hour % 12 || 12}:${minute} ${hour >= 12 ? 'PM' : 'AM'}`;
      }
    }
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) return String(value);
    return date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
  };
  const timeOnly = value => {
    if (!value) return '—';
    return databaseTime(value);
  };

  const FDI_TO_UNIVERSAL = {
    18: '1', 17: '2', 16: '3', 15: '4', 14: '5', 13: '6', 12: '7', 11: '8',
    21: '9', 22: '10', 23: '11', 24: '12', 25: '13', 26: '14', 27: '15', 28: '16',
    38: '17', 37: '18', 36: '19', 35: '20', 34: '21', 33: '22', 32: '23', 31: '24',
    41: '25', 42: '26', 43: '27', 44: '28', 45: '29', 46: '30', 47: '31', 48: '32',
    55: 'A', 54: 'B', 53: 'C', 52: 'D', 51: 'E', 61: 'F', 62: 'G', 63: 'H', 64: 'I', 65: 'J',
    75: 'K', 74: 'L', 73: 'M', 72: 'N', 71: 'O', 81: 'P', 82: 'Q', 83: 'R', 84: 'S', 85: 'T'
  };

  function conditionToClass(condition) {
    const c = String(condition || '').toLowerCase();
    if (c.includes('decay') || c.includes('caries') || c === 'c') return 'tooth-decay';
    if (c.includes('missing') || c.includes('extracted') || c === 'm' || c === 'x') return 'tooth-missing';
    if (c.includes('planned') || c === 'tp') return 'tooth-planned';
    if (c.includes('restor') || c.includes('completed') || c.includes('amalgam') || c.includes('composite') || c === 'am' || c === 'co' || c === 'rct') return 'tooth-completed';
    if (c.includes('impacted') || c === 'im') return 'tooth-impacted';
    if (c.includes('sound') || c === '/' || c === 'sound / healthy') return 'tooth-sound';
    return 'tooth-finding';
  }

  function hydrateDentalChart(modal, teeth) {
    if (!modal) return;
    const allStateClasses = ['tooth-sound', 'tooth-decay', 'tooth-finding', 'tooth-planned', 'tooth-completed', 'tooth-missing', 'tooth-impacted'];
    modal.querySelectorAll('.tooth-unit').forEach(btn => {
      btn.classList.remove(...allStateClasses);
      btn.classList.add('tooth-sound');
      delete btn._toothRecord;
    });

    if (!Array.isArray(teeth)) return;

    teeth.forEach(tooth => {
      const univ = FDI_TO_UNIVERSAL[tooth.fdi_number] || String(tooth.tooth_id);
      const toothBtns = modal.querySelectorAll(`.tooth-unit[data-tooth="${univ}"], .tooth-unit[data-tooth="${tooth.fdi_number}"]`);
      const statusCls = conditionToClass(tooth.condition);
      toothBtns.forEach(btn => {
        btn.classList.remove(...allStateClasses);
        btn.classList.add(statusCls);
        btn.dataset.condition = tooth.condition || 'Sound / Healthy';
        btn.dataset.presence = tooth.presence || 'Present';
        btn._toothRecord = tooth;
      });
    });
  }

  function renderPatientRecordPrescriptions(modal, visits) {
    if (!modal || modal.id !== 'patientViewModal') return;
    const chart = modal.querySelector('.premium-dental-chart');
    if (!chart) return;

    const chartTitle = chart.querySelector('.premium-chart-title h4');
    const chartDesc = chart.querySelector('.premium-chart-title p');
    if (chartTitle) chartTitle.textContent = 'Dental Chart Record';
    if (chartDesc) chartDesc.textContent = 'Recorded tooth conditions from completed clinical visits. This chart is read-only.';

    chart.querySelectorAll('.tooth-unit').forEach(tooth => {
      tooth.setAttribute('aria-disabled', 'true');
      tooth.setAttribute('tabindex', '-1');
      tooth.classList.remove('tooth-picked', 'selected');
      tooth.setAttribute('aria-pressed', 'false');
    });

    let panel = chart.querySelector('[data-patient-record-prescriptions]');
    if (!panel) {
      panel = document.createElement('article');
      panel.className = 'patient-record-prescriptions';
      panel.dataset.patientRecordPrescriptions = '';
      panel.hidden = true;
      panel.innerHTML = `
        <div class="patient-record-prescriptions-head">
          <div>
            <span>Extraction follow-up</span>
            <h4>Prescriptions</h4>
            <p>Shown only when a completed extraction visit has a recorded prescription.</p>
          </div>
        </div>
        <div class="patient-record-prescriptions-list" data-patient-record-prescriptions-list></div>`;
      const workspace = chart.querySelector('.odontogram-workspace');
      if (workspace) workspace.insertAdjacentElement('afterend', panel);
      else chart.appendChild(panel);
    }

    const completedVisits = Array.isArray(visits) ? visits.filter(v => v.status === 'Completed') : [];
    const extractionVisits = completedVisits.filter(v => /extract/i.test([
      v.service,
      v.diagnosis,
      v.treatment_recommendations,
      v.treatment_notes
    ].filter(Boolean).join(' ')));
    const prescribed = extractionVisits.filter(v => String(v.prescriptions || '').trim());
    const list = panel.querySelector('[data-patient-record-prescriptions-list]');

    if (!prescribed.length) {
      panel.hidden = true;
      if (list) list.innerHTML = '';
      return;
    }

    panel.hidden = false;
    if (list) {
      list.innerHTML = prescribed.map(v => `
        <div class="patient-record-prescription-item">
          <div>
            <strong>${escapeHtml(v.service || 'Tooth Extraction')}</strong>
            <small>${escapeHtml(dateTime(v.starts_at))} · ${escapeHtml(v.dentist || 'Attending Dentist')}</small>
          </div>
          <p>${escapeHtml(typeof v.prescriptions === 'string' ? v.prescriptions : JSON.stringify(v.prescriptions))}</p>
        </div>`).join('');
    }
  }

  function openVisitHistoryDetail(visit) {
    let dialog = document.getElementById('visitHistoryModal');
    if (!dialog) {
      dialog = document.createElement('dialog');
      dialog.id = 'visitHistoryModal';
      dialog.className = 'modal modal-lg visit-history-detail-modal';
      dialog.innerHTML = `
        <div class="modal-shell">
          <header class="modal-header">
            <div>
              <p class="eyebrow">Completed Visit</p>
              <h3 data-vh-title>Visit Details</h3>
            </div>
            <button class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
          </header>
          <div class="modal-body">
            <div class="clinical-grid two-col">
              <article class="info-card">
                <h4>Visit details</h4>
                <dl class="detail-list">
                  <div><dt>Dentist</dt><dd data-vh-dentist>—</dd></div>
                  <div><dt>Service</dt><dd data-vh-service>—</dd></div>
                  <div><dt>Date & Time</dt><dd data-vh-datetime>—</dd></div>
                  <div><dt>Status</dt><dd data-vh-status><span class="status success">Completed</span></dd></div>
                </dl>
              </article>
              <article class="info-card">
                <h4>Clinical findings</h4>
                <p data-vh-findings>No clinical findings recorded.</p>
                <h4>Diagnosis & Treatment Plan</h4>
                <p data-vh-diagnosis>Routine dental care and recall.</p>
                <h4>Dentist notes</h4>
                <p data-vh-notes>No notes recorded.</p>
                <div data-vh-prescriptions-wrap hidden>
                  <h4>Prescriptions</h4>
                  <p data-vh-prescriptions>None</p>
                </div>
              </article>
            </div>
          </div>
          <footer class="modal-footer">
            <button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">Close</button>
          </footer>
        </div>`;
      document.body.append(dialog);
      dialog.addEventListener('click', event => {
        if (event.target === dialog) dialog.close();
      });
    }

    if (!visit) return;
    const titleEl = dialog.querySelector('[data-vh-title], .modal-header h3');
    if (titleEl) titleEl.textContent = visit.service || 'Completed Visit';

    const dentistEl = dialog.querySelector('[data-vh-dentist]');
    if (dentistEl) dentistEl.textContent = visit.dentist || 'Attending Dentist';

    const serviceEl = dialog.querySelector('[data-vh-service]');
    if (serviceEl) serviceEl.textContent = visit.service || 'Dental Procedure';

    const dateEl = dialog.querySelector('[data-vh-datetime]');
    if (dateEl) {
      dateEl.textContent = `${dateTime(visit.starts_at)} · ${databaseTime(visit.starts_at)}`;
    }

    const statusEl = dialog.querySelector('[data-vh-status]');
    if (statusEl) {
      statusEl.innerHTML = `<span class="status ${statusClass(visit.status)}">${escapeHtml(visit.status)}</span>`;
    }

    const findingsEl = dialog.querySelector('[data-vh-findings]');
    if (findingsEl) findingsEl.textContent = visit.clinical_findings || 'No clinical findings recorded.';

    const diagnosisEl = dialog.querySelector('[data-vh-diagnosis]');
    if (diagnosisEl) {
      let diagText = visit.diagnosis || 'Routine dental care and recall.';
      if (visit.treatment_recommendations) {
        diagText += `\n\nTreatment Recommendations:\n${visit.treatment_recommendations}`;
      }
      diagnosisEl.textContent = diagText;
    }

    const notesEl = dialog.querySelector('[data-vh-notes]');
    if (notesEl) notesEl.textContent = visit.dentist_notes || visit.treatment_notes || 'No notes recorded.';

    const rxWrap = dialog.querySelector('[data-vh-prescriptions-wrap]');
    const rxEl = dialog.querySelector('[data-vh-prescriptions]');
    if (rxWrap && rxEl) {
      if (visit.prescriptions) {
        rxWrap.hidden = false;
        rxEl.textContent = typeof visit.prescriptions === 'string' ? visit.prescriptions : JSON.stringify(visit.prescriptions, null, 2);
      } else {
        rxWrap.hidden = true;
      }
    }

    dialog.showModal();
  }

  async function openPatientRecord(patientId) {
    const modal = document.querySelector('#dentistPatientModal, #patientViewModal, #frontPatientModal');
    if (!modal) return;

    try {
      const view = document.body.dataset.workspaceView;
      const params = new URLSearchParams();
      if (view) params.set('view', view);
      const url = `/api/patients/${encodeURIComponent(patientId)}${params.toString() ? `?${params.toString()}` : ''}`;
      const res = await fetch(url, { headers: { Accept: 'application/json' } });
      if (!res.ok) throw new Error('Patient record details could not be loaded.');
      const data = await res.json();
      const patient = data.patient;
      const visits = data.visits || [];
      const teeth = data.teeth || [];
      const transactions = data.transactions || [];
      const summary = data.summary || { total_charges: 0, total_payments: 0, balance: 0 };

      // Cache visits for timeline rows
      modal._patientVisits = visits;
      modal.dataset.patientId = patient.formatted_patient_code || window.CerilloFormat?.patientCode(patient.patient_code, patient.id) || patient.patient_code || '—';
      modal.dataset.patientName = patient.name;
      modal.dataset.rawPatientId = patient.id;

      // Header
      const avatarEl = modal.querySelector('[data-pr-avatar], .patient-identity-row .avatar');
      if (avatarEl) {
        const initials = (patient.name || 'PT').split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
        avatarEl.textContent = initials;
      }
      const nameEl = modal.querySelector('[data-pr-name], .patient-identity-row h3');
      if (nameEl) nameEl.textContent = patient.name;
      const codeEl = modal.querySelector('[data-pr-code], .patient-inline-data span');
      if (codeEl) codeEl.textContent = `ID: ${patient.formatted_patient_code || window.CerilloFormat?.patientCode(patient.patient_code, patient.id) || patient.patient_code || '—'}`;

      // Personal Details (Overview tab)
      const setPr = (selector, val) => {
        const el = modal.querySelector(selector);
        if (el) el.textContent = val || '—';
      };

      const rawDob = patient.date_of_birth ? String(patient.date_of_birth).slice(0, 10) : '';
      const ageVal = rawDob ? Math.floor((Date.now() - new Date(rawDob).getTime()) / 31557600000) : null;
      const dobAgeText = rawDob ? `${rawDob} || ${ageVal !== null && ageVal >= 0 ? ageVal : '—'}` : '—';

      setPr('[data-pr-dob]', dobAgeText);
      setPr('[data-pr-age]', ageVal !== null && ageVal >= 0 ? `${ageVal} years` : '—');
      setPr('[data-pr-gender]', patient.gender ? (patient.gender.charAt(0).toUpperCase() + patient.gender.slice(1)) : '—');
      setPr('[data-pr-phone]', patient.formatted_phone || window.CerilloFormat?.phone(patient.phone) || patient.phone);
      setPr('[data-pr-email]', patient.email);
      setPr('[data-pr-address]', patient.address || 'Not provided');
      setPr('[data-pr-insurance]', patient.insurance || 'None / Self-pay');
      setPr('[data-pr-contact]', patient.preferred_contact || 'SMS');
      setPr('[data-pr-meta]', `Verified ${patient.last_visit !== 'First visit' ? patient.last_visit : dateTime(new Date())}`);

      // Dental Care Snapshot
      setPr('[data-pr-concern]', patient.concern || 'General dental checkup');
      setPr('[data-pr-dentist]', patient.preferred_dentist || 'Dr. Angela Cerillo');
      setPr('[data-pr-last-visit]', patient.last_visit || 'First visit');
      setPr('[data-pr-next-appt]', patient.next_appointment || 'None scheduled');
      setPr('[data-pr-last-xray]', patient.last_visit !== 'First visit' ? patient.last_visit : 'None');
      setPr('[data-pr-recall]', '6 months');
      setPr('[data-pr-anxiety]', patient.anxiety || 'Low');

      // Clinical Alert Strip
      setPr('[data-pr-alert-allergy]', normalizeAllergy(patient.allergies));
      setPr('[data-pr-alert-medication]', patient.medications || 'None');
      setPr('[data-pr-alert-med-history]', patient.medical_history || 'No known systemic conditions');
      setPr('[data-pr-alert-review]', dateTime(new Date()));

      // Visits Timeline
      const timeline = modal.querySelector('[data-pr-visit-timeline], .visit-timeline');
      const completedVisits = visits.filter(v => v.status === 'Completed');
      modal._patientVisits = completedVisits;
      if (timeline) {
        if (completedVisits.length > 0) {
          timeline.innerHTML = completedVisits.map((v, idx) => `
            <button aria-label="Open completed visit details" class="visit-history-row" data-visit-index="${idx}" type="button">
              <span class="timeline-dot complete"></span>
              <strong>${escapeHtml(v.dentist)}</strong>
              <span>${dateTime(v.starts_at)} · ${databaseTime(v.starts_at)}</span>
              <span class="status success">${escapeHtml(v.status)}</span>
              <span aria-hidden="true" class="visit-chevron">›</span>
            </button>
          `).join('');
        } else {
          timeline.innerHTML = `<div class="muted" style="padding: 1.5rem; text-align: center;">No completed visits recorded for this patient.</div>`;
        }
      }

      // Medical Record tab
      setPr('[data-pr-med-drug]', normalizeAllergy(patient.allergies));
      setPr('[data-pr-med-current]', patient.medications || 'None');
      setPr('[data-pr-mc-hypertension]', String(patient.medical_history || '').toLowerCase().includes('hypertens') ? 'Yes · Controlled' : 'No');
      setPr('[data-pr-mc-diabetes]', String(patient.medical_history || '').toLowerCase().includes('diabet') ? 'Yes' : 'No');
      setPr('[data-pr-mc-cardio]', String(patient.medical_history || '').toLowerCase().includes('cardio') ? 'Yes' : 'No known condition');
      setPr('[data-pr-mc-bleeding]', String(patient.medical_history || '').toLowerCase().includes('bleed') ? 'Yes' : 'No');
      setPr('[data-pr-mc-respiratory]', String(patient.medical_history || '').toLowerCase().includes('asthma') ? 'Yes · Asthma' : 'No');
      setPr('[data-pr-mc-smoking]', 'Never');
      setPr('[data-pr-treatment-consideration]', `Review health history: ${patient.medical_history || 'No known conditions'}. Drug allergy: ${normalizeAllergy(patient.allergies)}.`);

      // Dental Chart Tab
      hydrateDentalChart(modal, teeth);
      renderPatientRecordPrescriptions(modal, visits);

      // X-rays Tab
      const xrayGrid = modal.querySelector('.xray-record-grid, [data-pr-xray-grid]');
      if (xrayGrid) {
        const xrays = data.xrays || [];
        if (xrays.length > 0) {
          xrayGrid.innerHTML = xrays.map(x => `
            <article class="xray-record-card">
              <img alt="${escapeHtml(x.title || 'Radiograph')}" src="${escapeHtml(x.image_url || '/assets/images/xray-panoramic.png')}" />
              <div>
                <strong>${escapeHtml(x.title || 'Radiograph')} · ${escapeHtml(x.date || '—')}</strong>
                <p>${escapeHtml(x.description || 'No radiographic findings recorded.')}</p>
                <span>${escapeHtml(x.dentist || 'Attending Dentist')}</span>
              </div>
            </article>
          `).join('');
        } else {
          xrayGrid.innerHTML = `<div class="muted" style="padding: 2.5rem 1.5rem; text-align: center; grid-column: 1 / -1; width: 100%;">No X-rays recorded for this patient.</div>`;
        }
      }

      // Billing Ledger Tab
      const formatPHP = val => new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(Number(val || 0));
      setPr('[data-pr-ledger-charges]', formatPHP(summary.total_charges));
      setPr('[data-pr-ledger-payments]', formatPHP(summary.total_payments));
      setPr('[data-pr-ledger-adjustments]', '-₱0.00');
      setPr('[data-pr-ledger-balance]', formatPHP(summary.balance));
      const frontProceedCheckout = modal.querySelector('#frontPatientProceedCheckoutBtn');
      if (frontProceedCheckout) {
        const hasBalance = Number(summary.balance || 0) > 0.009;
        frontProceedCheckout.hidden = !hasBalance;
        frontProceedCheckout.disabled = !hasBalance;
        frontProceedCheckout.setAttribute('aria-hidden', hasBalance ? 'false' : 'true');
      }

      const ledgerTbody = modal.querySelector('[data-pr-ledger-tbody], table[data-patient-ledger] tbody');
      if (ledgerTbody) {
        if (transactions.length > 0) {
          ledgerTbody.innerHTML = transactions.map(t => `
            <tr>
              <td>${dateTime(t.created_at)}</td>
              <td>${escapeHtml(t.reference || `TXN-${t.id}`)}</td>
              <td>${escapeHtml(t.description || 'Dental Procedure')}</td>
              <td>${formatPHP(t.amount)}</td>
              <td>${t.status === 'completed' ? formatPHP(t.amount) : '—'}</td>
              <td>₱0.00</td>
            </tr>
          `).join('');
        } else {
          ledgerTbody.innerHTML = `<tr><td class="muted" colspan="6">No billing transactions recorded.</td></tr>`;
        }
      }

      // Footer
      setPr('[data-pr-footer-updated]', `Last updated ${dateTime(new Date())}`);

      modal.showModal();
    } catch (err) {
      console.error(err);
      alert(err.message || 'Could not load patient record.');
    }
  }

  async function savePatientChart(dialog) {
    const patientId = dialog.dataset.rawPatientId;
    if (!patientId) return;
    const pickedOrModified = dialog.querySelectorAll('.tooth-unit:not(.tooth-sound), .tooth-unit.tooth-picked');
    const promises = [];
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    pickedOrModified.forEach(tooth => {
      const toothNum = tooth.dataset.tooth;
      const condition = tooth.dataset.condition || tooth.dataset.finding || 'Sound / Healthy';
      const notes = tooth.dataset.notes || '';
      const surfaces = tooth.dataset.surfaces ? tooth.dataset.surfaces.split('') : [];
      promises.push(
        fetch(`/api/patients/${patientId}/teeth`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            tooth_id: toothNum,
            condition: condition,
            surfaces: surfaces,
            notes: notes
          })
        })
      );
    });
    if (promises.length > 0) {
      await Promise.all(promises);
    }
  }

  async function loadPatients() {
    const tables = Array.from(document.querySelectorAll('#dentist-table-3, #admin-patient-table, #front-patient-table'));
    if (!tables.length) return;
    const params = new URLSearchParams({ per_page: '100' });
    const search = document.querySelector('[data-table-search="dentist-table-3"], [data-table-search="admin-patient-table"], [data-table-search="front-patient-table"]');
    if (search?.value) params.set('search', search.value);
    const view = document.body.dataset.workspaceView;
    if (view) params.set('view', view);
    const response = await fetch(`/api/patients?${params}`, { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error('Patient records could not be loaded.');
    const data = await response.json();
    const rows = data.data || [];

    tables.forEach(table => {
      if (!table?.tBodies[0]) return;
      const isDentist = table.id === 'dentist-table-3';
      const isFront = table.id === 'front-patient-table';

      table.tBodies[0].innerHTML = rows.map(patient => {
        const appointment = Array.isArray(patient.appointments) && patient.appointments.length ? patient.appointments[0] : null;
        const rawDob = patient.date_of_birth ? String(patient.date_of_birth).slice(0, 10) : '';
        const ageVal = rawDob ? Math.floor((Date.now() - new Date(rawDob).getTime()) / 31557600000) : null;
        const age = rawDob ? `${rawDob} || ${ageVal !== null && ageVal >= 0 ? ageVal : '—'}` : '—';
        const allergies = normalizeAllergy(patient.allergies || appointment?.intake_details?.allergies);
        const patientCode = patient.formatted_patient_code || window.CerilloFormat?.patientCode(patient.patient_code, patient.id) || patient.patient_code || '';
        const action = `<button class="${isFront ? 'action-btn' : 'table-action'}" type="button" data-live-patient-id="${patient.id}">${isDentist ? 'View / Update' : 'View'}</button>`;
        const dateStr = appointment ? dateTime(appointment.starts_at) : '—';
        const serviceName = appointment?.service?.name || 'Dental Visit';

        if (isDentist) {
          return `<tr data-procedure="${escapeHtml(serviceName)}" data-segment="Restorative"><td>${escapeHtml(patient.name)}${patientCode ? `<small class="table-subtext">${escapeHtml(patientCode)}</small>` : ''}</td><td>${escapeHtml(age)}</td><td>${escapeHtml(patient.formatted_phone || window.CerilloFormat?.phone(patient.phone) || '—')}</td><td>${escapeHtml(allergies)}</td><td>${dateStr} · ${escapeHtml(serviceName)}</td><td><span class="status success">Completed</span></td><td>${action}</td></tr>`;
        }
        if (isFront) {
          return `<tr data-procedure="${escapeHtml(serviceName)}" data-segment="Restorative"><td>${escapeHtml(patient.name)}${patientCode ? `<small class="table-subtext">${escapeHtml(patientCode)}</small>` : ''}</td><td>${escapeHtml(age)}</td><td>${escapeHtml(patient.formatted_phone || window.CerilloFormat?.phone(patient.phone) || patient.email || '—')}</td><td>${escapeHtml(allergies)}</td><td>${dateStr}</td><td>${action}</td></tr>`;
        }
        return `<tr data-procedure="${escapeHtml(serviceName)}" data-segment="Restorative"><td>${escapeHtml(patient.name)}<small class="table-subtext">${escapeHtml(patient.formatted_patient_code || window.CerilloFormat?.patientCode(patient.patient_code, patient.id) || patient.patient_code)}</small></td><td>${escapeHtml(age)}</td><td>${escapeHtml(patient.formatted_phone || window.CerilloFormat?.phone(patient.phone) || patient.email || '—')}</td><td>${escapeHtml(allergies)}</td><td>${dateStr}</td><td><span class="badge success">Active</span></td><td>${action}</td></tr>`;
      }).join('') || `<tr><td colspan="${isFront ? 6 : 7}" class="muted">No completed patient records found.</td></tr>`;
    });
  }

  async function loadAppointments() {
    const tables = Array.from(document.querySelectorAll('#admin-appointment-register, #dentist-table-2, #front-appointment-register'));
    if (!tables.length) return;
    const appointmentParams = new URLSearchParams({ per_page: '100' });
    if (document.body.dataset.workspaceView === 'dentist') appointmentParams.set('view', 'dentist');
    const response = await fetch('/api/appointments?' + appointmentParams.toString(), { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error('Appointments could not be loaded.');
    const data = await response.json();
    const rows = data.data || [];
    tables.forEach(table => {
      if (!table?.tBodies[0]) return;
      table.tBodies[0].innerHTML = rows.map(appointment => {
        const patient = appointment.patient?.name || appointment.guest_name || 'Guest patient';
        const service = appointment.service?.name || '—';
        const dentist = appointment.dentist?.name || '—';
        const date = dateTime(appointment.starts_at);
        const time = databaseTime(appointment.starts_at);
        const status = `<span class="status ${statusClass(appointment.status)}">${escapeHtml(appointment.status)}</span>`;
        if (table.id === 'dentist-table-2') return `<tr data-appointment-id="${appointment.id}" data-starts-at="${escapeHtml(appointment.starts_at || '')}"><td>${escapeHtml(patient)}</td><td>${escapeHtml(service)}</td><td>${escapeHtml(date)}</td><td>${escapeHtml(time)}</td><td>${status}</td><td><button class="table-action appointment-view" data-appointment-id="${appointment.id}" type="button">View</button></td></tr>`;
        if (table.id === 'front-appointment-register') {
          const arrival = appointment.status === 'Checked In' ? timeOnly(appointment.checked_in_at)
            : appointment.status === 'Cancelled' ? timeOnly(appointment.cancelled_at) : '—';
          const arrivalMarkup = `<span class="status ${statusClass(appointment.status)}">${escapeHtml(appointment.status)}</span>`;
          return `<tr data-appointment-id="${appointment.id}" data-filter-tags="${escapeHtml(appointment.status)}"><td><strong>${escapeHtml(patient)}</strong></td><td>${escapeHtml(dentist)}</td><td>${escapeHtml(service)}</td><td>${escapeHtml(date)}</td><td>${escapeHtml(time)}</td><td>${arrivalMarkup}</td><td><button class="table-action appointment-view" data-appointment-id="${appointment.id}" data-arrival="${escapeHtml(arrival)}" data-status="${escapeHtml(appointment.status)}" type="button">View</button></td></tr>`;
        }
        if (table.id === 'admin-appointment-register') {
          const arrival = appointment.status === 'Checked In' && appointment.checked_in_at ? timeOnly(appointment.checked_in_at)
            : (appointment.status === 'Completed' ? 'Completed' : (appointment.status === 'Cancelled' ? 'Cancelled' : 'Not arrived'));
          const arrivalMarkup = appointment.checked_in_at
            ? `<span class="arrival-state arrived">${escapeHtml(timeOnly(appointment.checked_in_at))}</span>`
            : `<span class="arrival-state ${appointment.status === 'Completed' ? 'arrived' : 'waiting'}">${escapeHtml(appointment.status === 'Completed' ? 'Completed' : (appointment.status === 'Cancelled' ? 'Cancelled' : 'Not arrived'))}</span>`;
          const pCode = appointment.patient?.formatted_patient_code || window.CerilloFormat?.patientCode(appointment.patient?.patient_code, appointment.patient?.id) || '';
          return `<tr data-appointment-id="${appointment.id}" data-filter-tags="${escapeHtml(appointment.status)}"><td><strong>${escapeHtml(patient)}</strong>${pCode ? `<small class="table-subtext">${escapeHtml(pCode)}</small>` : ''}</td><td>${escapeHtml(dentist)}</td><td>${escapeHtml(service)}</td><td>${escapeHtml(date)}</td><td>${escapeHtml(time)}</td><td>${arrivalMarkup}</td><td><button class="table-action appointment-view" data-appointment-id="${appointment.id}" type="button">View</button></td></tr>`;
        }
        return `<tr data-appointment-id="${appointment.id}"><td>${escapeHtml(date)} · ${escapeHtml(time)}</td><td>${escapeHtml(patient)}</td><td>${escapeHtml(dentist)}</td><td>${escapeHtml(service)}</td><td>${status}</td><td><button class="table-action appointment-view" data-appointment-id="${appointment.id}" type="button">View</button></td></tr>`;
      }).join('') || `<tr><td colspan="7" class="muted">No appointments found.</td></tr>`;
    });
    if (typeof window.renderDentistWeekKPIs === 'function') {
      window.renderDentistWeekKPIs(rows);
    }
  }

  let allTransactionsList = [];
  let adminPaymentCache = new Map();
  let activeAdminPaymentId = null;

  function ensureAdminPaymentModal() {
    let modal = document.getElementById('adminPaymentDetailModal');
    if (modal) return modal;
    modal = document.createElement('dialog');
    modal.id = 'adminPaymentDetailModal';
    modal.className = 'modal payment-receipt-modal';
    modal.innerHTML = `
      <div class="modal-shell payment-receipt-shell">
        <header class="modal-header payment-receipt-header">
          <div>
            <p class="eyebrow">Billing &amp; Payments · Admin</p>
            <h3>Payment Receipt</h3>
            <p data-admin-payment-reference>Transaction details</p>
          </div>
          <button class="icon-btn" data-admin-payment-close type="button" aria-label="Close payment details">×</button>
        </header>
        <div class="modal-body payment-receipt-body" data-admin-payment-body></div>
        <footer class="modal-footer payment-receipt-footer">
          <span class="muted" data-admin-payment-email-note></span>
          <div class="payment-receipt-actions">
            <button class="btn secondary" data-admin-payment-email type="button">Send to email</button>
            <button class="btn" data-admin-payment-pdf type="button">Export to PDF</button>
            <button class="btn secondary" data-admin-payment-close type="button">Close</button>
          </div>
        </footer>
      </div>`;
    document.body.append(modal);
    modal.querySelectorAll('[data-admin-payment-close]').forEach(btn => btn.addEventListener('click', () => modal.close()));
    modal.addEventListener('click', event => { if (event.target === modal) modal.close(); });

    modal.querySelector('[data-admin-payment-pdf]')?.addEventListener('click', () => {
      if (!activeAdminPaymentId) return;
      const link = document.createElement('a');
      link.href = `/api/payments/${encodeURIComponent(activeAdminPaymentId)}/pdf`;
      link.download = `Cerillo-Receipt-TXN-${String(activeAdminPaymentId).padStart(5, '0')}.pdf`;
      document.body.append(link);
      link.click();
      link.remove();
    });

    modal.querySelector('[data-admin-payment-email]')?.addEventListener('click', async event => {
      if (!activeAdminPaymentId) return;
      const button = event.currentTarget;
      const original = button.textContent;
      button.disabled = true;
      button.textContent = 'Sending...';
      try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
        const response = await fetch(`/api/payments/${encodeURIComponent(activeAdminPaymentId)}/email`, {
          method: 'POST',
          headers: { Accept: 'application/json', 'X-CSRF-TOKEN': csrf }
        });
        const data = await response.json();
        if (!response.ok) throw new Error(data.message || 'Receipt could not be sent.');
        const note = modal.querySelector('[data-admin-payment-email-note]');
        if (note) note.textContent = data.message || 'Receipt sent.';
      } catch (err) {
        const note = modal.querySelector('[data-admin-payment-email-note]');
        if (note) note.textContent = err.message || 'Receipt could not be sent.';
      } finally {
        button.disabled = false;
        button.textContent = original;
      }
    });

    return modal;
  }

  function renderAdminPaymentDetail(payment) {
    const modal = ensureAdminPaymentModal();
    const body = modal.querySelector('[data-admin-payment-body]');
    const reference = `TXN-${String(payment.id).padStart(5, '0')}`;
    const patient = payment.patient?.name || payment.appointment?.guest_name || 'Guest patient';
    const patientCode = payment.patient?.formatted_patient_code || window.CerilloFormat?.patientCode(payment.patient?.patient_code, payment.patient?.id) || 'Guest';
    const email = payment.patient?.email || payment.appointment?.guest_email || '';
    const service = payment.service?.name || payment.appointment?.service?.name || 'Dental Treatment';
    const dentist = payment.appointment?.dentist?.name || 'Not specified';
    const recordedBy = payment.recorded_by?.name || payment.recordedBy?.name || 'Front Desk';
    const date = payment.created_at ? new Date(payment.created_at).toLocaleString(undefined, { dateStyle: 'medium', timeStyle: 'short' }) : '—';
    const status = payment.status || 'completed';
    const statusClass = String(status).toLowerCase() === 'completed' ? 'success' : (String(status).toLowerCase() === 'voided' ? 'danger' : 'warning');

    const refEl = modal.querySelector('[data-admin-payment-reference]');
    if (refEl) refEl.textContent = `${reference} · ${date}`;

    body.innerHTML = `
      <section class="payment-receipt-hero">
        <div>
          <span>Amount paid</span>
          <strong>${new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(Number(payment.amount || 0))}</strong>
        </div>
        <span class="status ${statusClass}">${escapeHtml(status.charAt(0).toUpperCase() + status.slice(1))}</span>
      </section>
      <div class="payment-receipt-grid">
        <article><small>Patient</small><strong>${escapeHtml(patient)}</strong><span>${escapeHtml(patientCode)}</span></article>
        <article><small>Service / Treatment</small><strong>${escapeHtml(service)}</strong><span>${escapeHtml(dentist)}</span></article>
        <article><small>Payment method</small><strong>${escapeHtml(payment.payment_method || '—')}</strong><span>${escapeHtml(date)}</span></article>
        <article><small>Receipt</small><strong>${escapeHtml(reference)}</strong><span>Recorded by ${escapeHtml(recordedBy)}</span></article>
      </div>
      <section class="payment-receipt-contact">
        <div><small>Email receipt to</small><strong>${email ? escapeHtml(email) : 'No email address on file'}</strong></div>
        <div><small>Database transaction</small><strong>#${escapeHtml(String(payment.id))}</strong></div>
      </section>`;

    const emailBtn = modal.querySelector('[data-admin-payment-email]');
    const emailNote = modal.querySelector('[data-admin-payment-email-note]');
    if (emailBtn) {
      emailBtn.disabled = !email;
      emailBtn.title = email ? `Send receipt to ${email}` : 'Patient does not have an email address on file.';
    }
    if (emailNote) emailNote.textContent = email ? `Receipt can be sent to ${email}.` : 'Add a patient email before sending a receipt.';

    activeAdminPaymentId = payment.id;
    modal.showModal();
  }

  function renderBillingTable(filter = 'all', customDate = '') {
    const table = document.querySelector('#admin-table-3');
    if (!table?.tBodies[0]) return;
    let filtered = [...allTransactionsList];
    const now = new Date();
    const todayStr = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;
    if (filter === 'day') {
      filtered = filtered.filter(t => (t.created_at || '').slice(0, 10) === todayStr);
    } else if (filter === 'week') {
      const weekAgo = new Date();
      weekAgo.setDate(now.getDate() - 7);
      filtered = filtered.filter(t => new Date(t.created_at) >= weekAgo);
    } else if (filter === 'month') {
      const thisMonth = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}`;
      filtered = filtered.filter(t => (t.created_at || '').slice(0, 7) === thisMonth);
    } else if (filter === 'custom' && customDate) {
      filtered = filtered.filter(t => (t.created_at || '').slice(0, 10) === customDate);
    }
    table.tBodies[0].innerHTML = filtered.map(t => {
      const patient = t.patient?.name || t.appointment?.guest_name || 'Guest patient';
      const date = dateTime(t.created_at);
      const time = new Date(t.created_at).toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
      const amount = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(Number(t.amount || 0));
      return `<tr><td>${escapeHtml(date)} · ${escapeHtml(time)}</td><td>${escapeHtml(patient)}</td><td>${escapeHtml(amount)}</td><td><span class="status ${t.status === 'voided' ? 'danger' : 'success'}">${escapeHtml(t.status)}</span></td><td>${escapeHtml(t.payment_method || '—')}</td><td><button class="table-action" type="button" data-transaction-id="${t.id}">View</button></td></tr>`;
    }).join('') || '<tr><td colspan="6" class="muted">No transactions found for this date filter.</td></tr>';
  }

  async function loadTransactions() {
    const tables = [...document.querySelectorAll('#admin-table-3, #admin-table-4, #front-desk-table-5')];
    if (!tables.length) return;
    const response = await fetch('/api/payments?per_page=100', { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error('Transactions could not be loaded.');
    const data = await response.json();
    const rows = data.data || [];
    allTransactionsList = rows;
    adminPaymentCache.clear();
    rows.forEach(t => adminPaymentCache.set(String(t.id), t));
    const render = (transaction, ledger) => {
      const appointment = transaction.appointment;
      const patient = transaction.patient?.name || appointment?.guest_name || 'Guest patient';
      const service = transaction.service?.name || appointment?.service?.name || '—';
      const date = dateTime(transaction.created_at);
      const amount = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(Number(transaction.amount || 0));
      if (ledger) return `<tr><td>${escapeHtml(date)}</td><td>${escapeHtml(transaction.id ? `TXN-${transaction.id}` : '—')}</td><td>${escapeHtml(patient)}</td><td>${escapeHtml(appointment?.dentist?.name || '—')}</td><td>${escapeHtml(transaction.payment_method || '—')}</td><td>${escapeHtml(amount)}</td><td><span class="status ${transaction.status === 'voided' ? 'danger' : 'success'}">${escapeHtml(transaction.status)}</span></td></tr>`;
      return `<tr><td>${escapeHtml(date)} · ${escapeHtml(new Date(transaction.created_at).toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' }))}</td><td>${escapeHtml(patient)}</td><td>${escapeHtml(amount)}</td><td><span class="status ${transaction.status === 'voided' ? 'danger' : 'success'}">${escapeHtml(transaction.status)}</span></td><td>${escapeHtml(transaction.payment_method || '—')}</td><td><button class="table-action" type="button" data-transaction-id="${transaction.id}">View</button></td></tr>`;
    };
    tables.forEach(table => {
      table.tBodies[0].innerHTML = rows.map(transaction => render(transaction, table.id === 'admin-table-4')).join('') || `<tr><td colspan="${table.id === 'admin-table-4' ? 7 : 6}" class="muted">No transactions found.</td></tr>`;
    });
  }

  async function loadAdminServices() {
    const table = document.querySelector('#admin-table-5');
    if (!table?.tBodies[0]) return;
    const response = await fetch('/api/services', { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error('Services could not be loaded.');
    const services = await response.json();
    const total = services.reduce((sum, service) => sum + Number(service.appointments_count || 0), 0);
    table.tBodies[0].innerHTML = services.filter(service => Number(service.appointments_count || 0) > 0).map(service => {
      const cases = Number(service.appointments_count || 0);
      return `<tr><td>${escapeHtml(service.name)}</td><td>${cases.toLocaleString()}</td><td>${total ? `${Math.round(cases / total * 100)}%` : '0%'}</td></tr>`;
    }).join('') || '<tr><td colspan="3" class="muted">No service usage recorded.</td></tr>';
  }

  let allAdminAccounts = [];
  async function loadAdminAccounts() {
    const table = document.querySelector('#admin-table-7');
    if (!table?.tBodies[0]) return;
    const response = await fetch('/api/accounts', { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error('Accounts could not be loaded.');
    allAdminAccounts = await response.json();
    table.tBodies[0].innerHTML = allAdminAccounts.map(account => `
      <tr data-user-id="${account.id}">
        <td><strong>${escapeHtml(account.name)}</strong></td>
        <td>${escapeHtml((account.role || '').replace('_', ' '))}</td>
        <td>${escapeHtml(account.email)}</td>
        <td><span class="badge ${account.status === 'Inactive' ? 'danger' : 'success'}">${escapeHtml(account.status || 'Active')}</span></td>
        <td><button class="table-action account-view-btn" data-user-id="${account.id}" type="button">View</button></td>
      </tr>
    `).join('') || '<tr><td colspan="5" class="muted">No staff accounts found.</td></tr>';
  }

  async function loadAdminActivity(filter = 'all', search = '') {
    const table = document.querySelector('#admin-table-6');
    if (!table?.tBodies[0]) return;
    const params = new URLSearchParams({ date_filter: filter, search });
    const response = await fetch(`/api/activity?${params}`, { headers: { Accept: 'application/json' } });
    if (!response.ok) return;
    const events = await response.json();
    table.tBodies[0].innerHTML = events.map(event => `
      <tr>
        <td>${escapeHtml(event.date)}</td>
        <td><strong>${escapeHtml(event.user)}</strong></td>
        <td><span class="badge info">${escapeHtml(event.module)}</span></td>
        <td>${escapeHtml(event.activity)}</td>
      </tr>
    `).join('') || '<tr><td colspan="4" class="muted">No activity recorded for this period.</td></tr>';
  }

  async function loadAdminReports(period = 'this_month', from = '', to = '') {
    const section = document.getElementById('reports');
    if (!section) return;
    const params = new URLSearchParams({ period, from, to });
    const res = await fetch(`/api/reports?${params}`, { headers: { Accept: 'application/json' } });
    if (!res.ok) return;
    const rep = await res.json();
    
    // Update metric strip
    const boxes = section.querySelectorAll('.metric-strip > .metric-box');
    if (boxes.length >= 5) {
      boxes[0].querySelector('strong').textContent = rep.patients_served ?? 0;
      boxes[0].querySelector('span').textContent = rep.period_label;
      boxes[1].querySelector('strong').textContent = rep.completed_visits ?? 0;
      boxes[1].querySelector('span').textContent = `${rep.completion_rate}% completion`;
      boxes[2].querySelector('strong').textContent = `${rep.cancellation_rate}%`;
      boxes[2].querySelector('span').textContent = `${rep.cancelled_visits} cancelled`;
      boxes[3].querySelector('strong').textContent = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(Number(rep.total_revenue || 0));
      boxes[3].querySelector('span').textContent = 'posted payments';
      boxes[4].querySelector('strong').textContent = rep.new_patients ?? 0;
      boxes[4].querySelector('span').textContent = rep.period_label;
    }
    
    // Update Monthly Visits chart with a real axis, visit values, and proportional bars.
    const monthlyChart = section.querySelector('[data-monthly-visits-chart]');
    const monthlyPlot = monthlyChart?.querySelector('[data-monthly-visits-plot]');
    const monthlyScale = monthlyChart?.querySelector('[data-monthly-visits-scale]');
    if (monthlyPlot && Array.isArray(rep.monthly_visits)) {
      const values = rep.monthly_visits.map(mv => Number(mv.count || 0));
      const peak = Math.max(...values, 1);
      const step = Math.max(1, Math.ceil(peak / 4));
      const axisMax = step * 4;
      if (monthlyScale) {
        monthlyScale.innerHTML = [axisMax, axisMax - step, axisMax - (step * 2), axisMax - (step * 3), 0]
          .map(value => `<span>${value}</span>`).join('');
      }
      monthlyPlot.innerHTML = rep.monthly_visits.map(mv => {
        const count = Number(mv.count || 0);
        const percent = Math.max(count > 0 ? 8 : 0, Math.min(100, (count / axisMax) * 100));
        const label = `${escapeHtml(mv.month)}${mv.year ? ` ${escapeHtml(String(mv.year))}` : ''}`;
        return `
          <div class="monthly-visits-bar" style="--bar-height:${percent}%;" title="${label}: ${count} completed visits">
            <strong>${count}</strong><i></i><span>${escapeHtml(mv.month)}</span>
          </div>
        `;
      }).join('');
    }
    
    // Update Appointment Outcomes compact donut + breakdown.
    const outcomesWrap = section.querySelector('[data-appointment-outcomes]');
    if (outcomesWrap && rep.total_appointments !== undefined) {
      const total = Math.max(Number(rep.total_appointments || 0), 0);
      const denominator = Math.max(total, 1);
      const values = {
        completed: Number(rep.completed_visits || 0),
        cancelled: Number(rep.cancelled_visits || 0),
        'no-show': Number(rep.no_show_visits || 0)
      };
      const percentages = Object.fromEntries(Object.entries(values).map(([key, value]) => [key, (value / denominator) * 100]));
      const totalNode = outcomesWrap.querySelector('[data-outcomes-total]');
      if (totalNode) totalNode.textContent = total;
      Object.entries(values).forEach(([key, value]) => {
        const row = outcomesWrap.querySelector(`[data-outcome="${key}"]`);
        if (!row) return;
        const strong = row.querySelector('.outcome-label strong');
        const bar = row.querySelector('.outcome-track i');
        const small = row.querySelector('small');
        const pct = percentages[key];
        if (strong) strong.textContent = value;
        if (bar) bar.style.width = `${Math.min(100, pct)}%`;
        if (small) small.textContent = `${pct.toFixed(1)}%`;
      });
      const completedEnd = Math.min(100, percentages.completed);
      const cancelledEnd = Math.min(100, completedEnd + percentages.cancelled);
      const noShowEnd = Math.min(100, cancelledEnd + percentages['no-show']);
      const donut = outcomesWrap.querySelector('[data-outcomes-donut]');
      if (donut) {
        donut.style.background = `conic-gradient(#30469b 0 ${completedEnd}%, #b33142 ${completedEnd}% ${cancelledEnd}%, #d28c00 ${cancelledEnd}% ${noShowEnd}%, #e8edf5 ${noShowEnd}% 100%)`;
      }
    }
    
    // Update Service Utilization table (#admin-table-5)
    const svcTable = document.querySelector('#admin-table-5 tbody');
    if (svcTable && rep.services) {
      svcTable.innerHTML = rep.services.map(s => `
        <tr>
          <td><strong>${escapeHtml(s.name)}</strong></td>
          <td>${s.cases}</td>
          <td>${s.share}%</td>
        </tr>
      `).join('') || '<tr><td colspan="3" class="muted">No service records for this period.</td></tr>';
    }
    
    // Update Patient Indicators
    const indItems = section.querySelectorAll('.detail-grid > .detail-item');
    if (indItems.length >= 2) {
      indItems[0].querySelector('strong').textContent = rep.recall_due ?? 0;
      indItems[1].querySelector('strong').textContent = rep.active_treatment_plans ?? 0;
    }
  }

  function load() {
    const role = document.body?.dataset.workspaceRole || '';
    const queue = [
      loadPatients(),
      loadAppointments(),
    ];
    if (role === 'admin' || role === 'front_desk') {
      queue.push(loadTransactions());
    }
    if (role === 'admin') {
      queue.push(loadAdminAccounts());
      queue.push(loadAdminServices());
      queue.push(loadAdminActivity());
      queue.push(loadAdminReports());
    }
    Promise.all(queue).catch(error => console.error(error));
  }
  load();
  function prepareAdminAppointmentChart(dialog) {
    const host = dialog.querySelector('[data-admin-appointment-chart-host]');
    if (!host || host.dataset.chartReady === 'true') return;
    const source = document.querySelector('#patientViewModal .premium-dental-chart');
    if (!source) {
      host.innerHTML = '<p class="muted small">Dental chart template is unavailable.</p>';
      return;
    }
    const clone = source.cloneNode(true);
    clone.classList.add('appointment-embedded-dental-chart', 'active');
    clone.removeAttribute('hidden');
    clone.querySelectorAll('[data-patient-record-prescriptions]').forEach(node => node.remove());
    clone.querySelectorAll('.tooth-unit').forEach(tooth => {
      tooth.removeAttribute('aria-disabled');
      tooth.removeAttribute('tabindex');
      tooth.classList.remove('tooth-picked', 'selected');
      tooth.setAttribute('aria-pressed', 'false');
    });
    const titleNode = clone.querySelector('.premium-chart-title h4');
    const descNode = clone.querySelector('.premium-chart-title p');
    if (titleNode) titleNode.textContent = 'Dental Chart';
    if (descNode) descNode.textContent = 'Select one or more teeth to record findings, diagnoses and treatment.';
    host.replaceChildren(clone);
    host.dataset.chartReady = 'true';
  }

  function adminAppointmentDialog() {
    let dialog = document.getElementById('adminAppointmentDetailModal');
    if (dialog) return dialog;
    dialog = document.createElement('dialog');
    dialog.id = 'adminAppointmentDetailModal';
    dialog.className = 'modal modal-xl admin-appointment-detail-modal clinical-record-modal';
    dialog.innerHTML = `
      <div class="modal-shell">
        <div class="modal-head">
          <div>
            <p class="eyebrow">Admin · Appointment</p>
            <h3 data-admin-detail="title">Appointment Details</h3>
            <p data-admin-detail="subtitle">Review the patient schedule and appointment information.</p>
          </div>
          <button aria-label="Close appointment details" class="icon-btn" type="button" data-admin-detail-close>×</button>
        </div>
        <div class="modal-body appointment-dialog-grid">
          <div class="appointment-main">
            <div class="appointment-banner">
              <div>
                <h4 data-admin-detail="datetime">—</h4>
                <p data-admin-detail="service">—</p>
              </div>
              <span class="status-pill info" data-admin-detail="status">Pending</span>
            </div>
            <div class="appointment-meta-row">
              <div class="appointment-meta-card"><small>Patient</small><strong data-admin-detail="patient">—</strong></div>
              <div class="appointment-meta-card"><small>Date of birth / age</small><strong data-admin-detail="dob">—</strong></div>
              <div class="appointment-meta-card"><small>Dentist</small><strong data-admin-detail="dentist">—</strong></div>
              <div class="appointment-meta-card"><small>Booking type</small><strong data-admin-detail="source">—</strong></div>
              <div class="appointment-meta-card"><small>Contact</small><strong data-admin-detail="contact">—</strong></div>
              <div class="appointment-meta-card"><small>Duration</small><strong data-admin-detail="duration">—</strong></div>
              <div class="appointment-meta-card"><small>Appointment ID</small><strong data-admin-detail="reference">—</strong></div>
            </div>
            <div class="record-section">
              <div class="record-section-head"><h4>Visit reason &amp; notes</h4><span>Appointment intake</span></div>
              <p class="muted small" data-admin-detail="notes">No additional appointment notes.</p>
            </div>
          </div>
          <aside class="appointment-side">
            <div class="appointment-side-card">
              <h4>Patient snapshot</h4>
              <div class="info-field"><small>Patient</small><strong data-admin-detail="patient-side">—</strong></div>
              <div class="info-field" style="margin-top:12px"><small>Date of birth / age</small><strong data-admin-detail="dob-side">—</strong></div>
              <div class="info-field" style="margin-top:12px"><small>Contact</small><strong data-admin-detail="contact-side">—</strong></div>
            </div>
            <div class="appointment-side-card">
              <h4>Schedule</h4>
              <div class="info-field"><small>Date</small><strong data-admin-detail="date">—</strong></div>
              <div class="info-field" style="margin-top:12px"><small>Time</small><strong data-admin-detail="time">—</strong></div>
            </div>
          </aside>
          <section class="admin-appointment-dental-assessment">
            <div class="admin-appointment-dental-assessment-header">
              <div>
                <span>Clinical odontogram &amp; assessment</span>
                <h4>Dental Assessment</h4>
                <p>Interactive chart retained for the appointment workflow.</p>
              </div>
            </div>
            <div data-admin-appointment-chart-host></div>
          </section>
        </div>
        <div class="dialog-footer"><button class="btn secondary" type="button" data-admin-detail-close>Close</button></div>
      </div>`;
    document.body.append(dialog);
    prepareAdminAppointmentChart(dialog);
    dialog.addEventListener('click', event => {
      if (event.target === dialog || event.target.closest('[data-admin-detail-close]')) dialog.close();
    });
    return dialog;
  }

  async function openAdminAppointment(id) {
    const response = await fetch(`/api/appointments/${encodeURIComponent(id)}`, { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error('Appointment details could not be loaded.');
    const appointment = await response.json();
    const dialog = adminAppointmentDialog();
    const starts = new Date(appointment.starts_at);
    const ends = new Date(appointment.ends_at);
    const validStart = !Number.isNaN(starts.getTime());
    const validEnd = !Number.isNaN(ends.getTime());
    const dateLabel = validStart ? starts.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : '—';
    const startLabel = databaseTime(appointment.starts_at);
    const endLabel = databaseTime(appointment.ends_at);
    const duration = validStart && validEnd ? Math.max(0, Math.round((ends - starts) / 60000)) : null;
    const set = (name, value) => {
      const node = dialog.querySelector(`[data-admin-detail="${name}"]`);
      if (node) node.textContent = value || '—';
    };
    const patient = appointment.patient?.name || appointment.guest_name || 'Guest patient';
    const contact = appointment.patient?.formatted_phone || appointment.formatted_guest_phone || window.CerilloFormat?.phone(appointment.patient?.phone || appointment.guest_phone) || appointment.patient?.email || appointment.guest_email || '—';
    const service = appointment.service?.name || 'Appointment';
    const dentist = appointment.dentist?.name || 'Unassigned';
    const source = appointment.source === 'walk_in' ? 'Front Desk registration'
      : appointment.source === 'online' ? 'Online request' : 'Staff booking';
    const intake = appointment.intake_details && typeof appointment.intake_details === 'object' ? appointment.intake_details : {};
    const concern = intake.concern || intake.medical_concern || intake.reason_for_visit || intake.chief_concern || '';
    const noteParts = [];
    if (concern) noteParts.push(concern);
    if (appointment.cancellation_reason) noteParts.push(`Cancellation: ${appointment.cancellation_reason}`);
    if (!noteParts.length) noteParts.push('No additional appointment notes were recorded.');

    const rawDob = appointment.patient?.date_of_birth || intake.date_of_birth;
    if (rawDob) {
      const dobVal = String(rawDob).slice(0, 10);
      const ageVal = Math.floor((Date.now() - new Date(dobVal).getTime()) / 31557600000);
      set('dob', `${dobVal} || ${ageVal >= 0 ? ageVal : '—'}`);
      set('dob-side', `${dobVal} || ${ageVal >= 0 ? ageVal : '—'}`);
      set('age', `${ageVal >= 0 ? ageVal : '—'}`);
    }

    set('title', `${patient} · ${service}`);
    set('subtitle', `Appointment #${appointment.id} · ${source}`);
    set('datetime', `${dateLabel} · ${startLabel}${validEnd ? ` – ${endLabel}` : ''}`);
    set('date', dateLabel);
    set('time', `${startLabel}${validEnd ? ` – ${endLabel}` : ''}`);
    set('service', service);
    set('patient', patient);
    set('patient-side', patient);
    set('dentist', dentist);
    set('status', appointment.status || 'Pending');
    set('source', source);
    set('contact', contact);
    set('contact-side', contact);
    set('duration', duration !== null ? `${duration} minutes` : '—');
    set('reference', `APT-${appointment.id}`);
    set('notes', noteParts.join(' · '));
    const statusNode = dialog.querySelector('[data-admin-detail="status"]');
    if (statusNode) {
      statusNode.className = `status-pill ${statusClass(appointment.status)}`;
    }

    dialog.dataset.patientName = patient;
    dialog.dataset.patientId = appointment.patient?.formatted_patient_code || appointment.patient?.patient_code || String(appointment.patient_id || appointment.patient?.id || appointment.id);
    dialog.dataset.rawPatientId = String(appointment.patient_id || appointment.patient?.id || '');
    prepareAdminAppointmentChart(dialog);

    const patientId = appointment.patient_id || appointment.patient?.id;
    if (patientId) {
      try {
        const patientResponse = await fetch(`/api/patients/${encodeURIComponent(patientId)}`, { headers: { Accept: 'application/json' } });
        if (patientResponse.ok) {
          const patientData = await patientResponse.json();
          hydrateDentalChart(dialog, patientData.teeth || []);
        }
      } catch (chartError) {
        console.error('Admin appointment dental chart could not be hydrated.', chartError);
      }
    }

    dialog.showModal();
  }

  window.openAdminAppointment = openAdminAppointment;

  document.addEventListener('click', event => {
    const visitRow = event.target.closest('.visit-history-row[data-visit-index]');
    if (visitRow) {
      const modal = visitRow.closest('dialog');
      const idx = Number(visitRow.dataset.visitIndex);
      if (modal && modal._patientVisits && modal._patientVisits[idx]) {
        openVisitHistoryDetail(modal._patientVisits[idx]);
        return;
      }
    }

    const patientBtn = event.target.closest('[data-live-patient-id], #dentist-table-3 .table-action, #admin-patient-table .table-action, #front-patient-table .action-btn');
    if (patientBtn) {
      const patientId = patientBtn.dataset.livePatientId;
      if (patientId) {
        openPatientRecord(patientId);
      } else {
        const modal = document.querySelector('#dentistPatientModal, #patientViewModal, #frontPatientModal');
        if (modal) modal.showModal();
      }
      return;
    }

    const chartSaveBtn = event.target.closest('[data-chart-save]');
    if (chartSaveBtn) {
      const dialog = chartSaveBtn.closest('dialog');
      if (dialog && dialog.dataset.rawPatientId) {
        const msg = dialog.querySelector('[data-tooth-form-message]');
        if (msg) msg.textContent = 'Saving dental chart changes...';
        savePatientChart(dialog).then(() => {
          if (msg) msg.textContent = 'Dental chart changes saved to database.';
        }).catch(err => {
          if (msg) msg.textContent = 'Error saving dental chart.';
        });
      }
    }

    const accBtn = event.target.closest('.account-view-btn');
    if (accBtn) {
      openAccountModal(accBtn.dataset.userId);
      return;
    }

    const txnBtn = event.target.closest('#admin-table-3 [data-transaction-id]');
    if (txnBtn) {
      const payment = adminPaymentCache.get(String(txnBtn.dataset.transactionId));
      if (payment) {
        renderAdminPaymentDetail(payment);
      }
      return;
    }

    const button = event.target.closest('.appointment-view[data-appointment-id], #dentist-table-2 .appointment-view, #dentist-table-2 button.table-action');
    if (!button) return;
    if (button.closest('#front-appointment-register') && window.openFrontAppointment) {
      window.openFrontAppointment(button);
      return;
    }
    if (button.closest('#dentist-table-2')) {
      if (window.openDentistAppointment) {
        window.openDentistAppointment(button);
      } else {
        const modal = document.getElementById('dentistAppointmentDetailModal');
        if (modal) modal.showModal();
      }
      return;
    }
    if (button.closest('#admin-appointment-register')) {
      openAdminAppointment(button.dataset.appointmentId || button).catch(error => alert(error.message));
    }
  });

  function openAccountModal(userId) {
    const account = allAdminAccounts.find(a => String(a.id) === String(userId));
    if (!account) return;
    const modal = document.getElementById('accountDetailModal');
    if (!modal) return;

    document.getElementById('editAccountId').value = account.id;
    document.getElementById('editAccountName').value = account.name || '';
    document.getElementById('editAccountEmail').value = account.email || '';
    document.getElementById('editAccountRole').value = account.role || 'front_desk';
    document.getElementById('editAccountStatus').value = account.status || 'Active';
    document.getElementById('editAccountPassword').value = '';

    const msg = document.getElementById('accountFormMessage');
    if (msg) msg.textContent = '';

    modal.showModal();
  }

  document.addEventListener('submit', async event => {
    if (event.target.id === 'accountCreateForm') {
      event.preventDefault();
      const form = event.target;
      const firstName = document.getElementById('createAccountFirstName')?.value.trim() || '';
      const lastName = document.getElementById('createAccountLastName')?.value.trim() || '';
      const email = document.getElementById('createAccountEmail')?.value.trim() || '';
      const role = document.getElementById('createAccountRole')?.value || '';
      const phone = document.getElementById('createAccountPhone')?.value.replace(/\D/g, '') || '';
      const password = document.getElementById('createAccountPassword')?.value || '';
      const msg = document.getElementById('accountCreateMessage');
      const name = `${firstName} ${lastName}`.replace(/\s+/g, ' ').trim();

      if (msg) {
        msg.className = 'account-form-message';
        msg.textContent = 'Creating staff account…';
      }

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        const res = await fetch('/api/accounts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ name, email, role, phone, password, status: 'Active' })
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.message || Object.values(data.errors || {}).flat().join(' ') || 'Account could not be created.');

        await loadAdminAccounts();
        window.CerilloPagination?.refreshTable?.('admin-table-7', true);
        if (msg) {
          msg.className = 'account-form-message success';
          msg.textContent = `Account created and saved to the database for ${data.name || name}.`;
        }
        form.reset();
        window.setTimeout(() => {
          form.closest('dialog')?.close();
          if (msg) {
            msg.textContent = '';
            msg.className = 'account-form-message';
          }
        }, 900);
      } catch (err) {
        if (msg) {
          msg.className = 'account-form-message error';
          msg.textContent = err.message || 'Account could not be created.';
        }
      }
      return;
    }

    if (event.target.id === 'accountUpdateForm') {
      event.preventDefault();
      const form = event.target;
      const userId = document.getElementById('editAccountId').value;
      const name = document.getElementById('editAccountName').value.trim();
      const email = document.getElementById('editAccountEmail').value.trim();
      const role = document.getElementById('editAccountRole').value;
      const status = document.getElementById('editAccountStatus').value;
      const password = document.getElementById('editAccountPassword').value.trim();

      const payload = { name, email, role, status };
      if (password) payload.password = password;

      const msg = document.getElementById('accountFormMessage');
      if (msg) {
        msg.textContent = 'Saving account updates...';
        msg.style.color = 'var(--navy)';
      }

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const res = await fetch(`/api/accounts/${userId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken || ''
          },
          body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.message || Object.values(data.errors || {}).flat().join(' ') || 'Error updating account.');

        if (msg) {
          msg.textContent = '✓ Account updated successfully!';
          msg.style.color = '#12b76a';
        }
        await loadAdminAccounts();
        setTimeout(() => {
          form.closest('dialog')?.close();
        }, 800);
      } catch (err) {
        if (msg) {
          msg.textContent = '⚠️ ' + err.message;
          msg.style.color = '#dc2626';
        }
      }
    }
  });

  // Billing Date Filters
  const billingFilter = document.getElementById('adminBillingDateFilter');
  const billingCustomDate = document.getElementById('adminBillingCustomDate');
  if (billingFilter) {
    billingFilter.addEventListener('change', () => {
      if (billingFilter.value === 'custom') {
        if (billingCustomDate) billingCustomDate.style.display = 'inline-block';
      } else {
        if (billingCustomDate) billingCustomDate.style.display = 'none';
        renderBillingTable(billingFilter.value);
      }
    });
  }
  if (billingCustomDate) {
    billingCustomDate.addEventListener('change', () => {
      renderBillingTable('custom', billingCustomDate.value);
    });
  }

  // Activity Logs Date Filters
  const activityDateFilter = document.getElementById('adminActivityDateFilter');
  const activityCustomDate = document.getElementById('adminActivityCustomDate');
  const activitySearch = document.querySelector('[data-table-search="admin-table-6"]');
  if (activityDateFilter) {
    activityDateFilter.addEventListener('change', () => {
      if (activityDateFilter.value === 'custom') {
        if (activityCustomDate) activityCustomDate.style.display = 'inline-block';
      } else {
        if (activityCustomDate) activityCustomDate.style.display = 'none';
        loadAdminActivity(activityDateFilter.value, activitySearch?.value || '');
      }
    });
  }
  if (activityCustomDate) {
    activityCustomDate.addEventListener('change', () => {
      loadAdminActivity('custom', activitySearch?.value || '');
    });
  }
  if (activitySearch) {
    activitySearch.addEventListener('input', () => {
      clearTimeout(activitySearch._timer);
      activitySearch._timer = setTimeout(() => {
        loadAdminActivity(activityDateFilter?.value || 'all', activitySearch.value);
      }, 300);
    });
  }

  // Reports Period Filters
  const reportsPeriodFilter = document.getElementById('reportsPeriodFilter');
  const reportsCustomWrap = document.getElementById('reportsCustomDateWrap');
  const reportsFrom = document.getElementById('reportsFromDate');
  const reportsTo = document.getElementById('reportsToDate');
  const reportsCustomApplyBtn = document.getElementById('reportsCustomApplyBtn');
  if (reportsPeriodFilter) {
    reportsPeriodFilter.addEventListener('change', () => {
      if (reportsPeriodFilter.value === 'custom') {
        if (reportsCustomWrap) reportsCustomWrap.style.display = 'flex';
      } else {
        if (reportsCustomWrap) reportsCustomWrap.style.display = 'none';
        loadAdminReports(reportsPeriodFilter.value);
      }
    });
  }
  if (reportsCustomApplyBtn) {
    reportsCustomApplyBtn.addEventListener('click', () => {
      loadAdminReports('custom', reportsFrom?.value || '', reportsTo?.value || '');
    });
  }

  document.querySelectorAll('[data-table-search="dentist-table-3"], [data-table-search="admin-patient-table"], [data-table-search="front-patient-table"]').forEach(input => {
    input.addEventListener('change', loadPatients);
    input.addEventListener('input', () => {
      clearTimeout(input._timer);
      input._timer = setTimeout(loadPatients, 300);
    });
  });

  window.loadPatients = loadPatients;
  window.loadAppointments = loadAppointments;
  window.openPatientRecord = openPatientRecord;
  window.openVisitHistoryDetail = openVisitHistoryDetail;
  window.loadAdminAccounts = loadAdminAccounts;
  window.loadAdminActivity = loadAdminActivity;
  window.loadAdminReports = loadAdminReports;
  window.renderBillingTable = renderBillingTable;
})();
