(function () {
  'use strict';

  const stateClasses = ['tooth-decay','tooth-finding','tooth-planned','tooth-completed','tooth-impacted'];

  function appointmentChart(tooth) {
    return tooth?.closest('#dentistAppointmentDetailModal .premium-dental-chart, #appointmentModal .admin-appointment-odontogram');
  }

  function clearActive(modal) {
    modal?.querySelectorAll('.appointment-tooth-active').forEach(tooth => tooth.classList.remove('appointment-tooth-active'));
  }

  function inferVisualState(tooth) {
    if (!tooth) return;
    const isMissing = tooth.classList.contains('tooth-missing') || /missing|extracted/i.test(tooth.dataset.finding || tooth.dataset.condition || tooth.dataset.presence || '');
    if (isMissing) {
      if (!tooth.classList.contains('appointment-tooth-ghost')) tooth.classList.add('appointment-tooth-ghost');
      if (tooth.classList.contains('appointment-tooth-marked')) tooth.classList.remove('appointment-tooth-marked');
      return;
    }
    if (tooth.classList.contains('appointment-tooth-ghost')) tooth.classList.remove('appointment-tooth-ghost');
    const hasFinding = stateClasses.some(cls => tooth.classList.contains(cls)) || Boolean((tooth.dataset.finding || '').trim());
    const isMarked = tooth.classList.contains('appointment-tooth-marked');
    if (hasFinding !== isMarked) {
      tooth.classList.toggle('appointment-tooth-marked', hasFinding);
    }
  }


  function ensureStateLegend(chart) {
    if (!chart || chart.querySelector('.appointment-state-legend')) return;
    const legend = document.createElement('div');
    legend.className = 'appointment-state-legend';
    legend.setAttribute('aria-label', 'Dental chart color legend');
    legend.innerHTML = '<span><i class="appointment-legend-dot selected"></i>Selected</span><span><i class="appointment-legend-dot finding"></i>Finding recorded</span><span><i class="appointment-legend-dot missing"></i>Missing / Extracted</span>';
    const toolbar = chart.querySelector('.premium-chart-toolbar');
    if (toolbar) toolbar.insertAdjacentElement('afterend', legend);
    else chart.prepend(legend);
  }

  let isSyncing = false;
  function syncStates(root) {
    if (isSyncing) return;
    isSyncing = true;
    try {
      (root || document).querySelectorAll?.('#dentistAppointmentDetailModal .premium-dental-chart .tooth-unit, #appointmentModal .admin-appointment-odontogram .tooth-unit')
        ?.forEach(inferVisualState);
    } finally {
      setTimeout(() => { isSyncing = false; }, 0);
    }
  }

  function installAdminAppointmentChart() {
    const modal = document.getElementById('appointmentModal');
    if (!modal || modal.querySelector('[data-admin-appointment-chart]')) return;
    const source = document.querySelector('#patientViewModal .premium-dental-chart');
    const main = modal.querySelector('.appointment-main');
    if (!source || !main) return;

    const section = document.createElement('section');
    section.className = 'record-section admin-appointment-chart-section';
    section.dataset.adminAppointmentChart = '';
    section.innerHTML = '<div class="record-section-head"><div><h4>Dental assessment</h4><span>Appointment odontogram</span></div></div>';

    const chart = source.cloneNode(true);
    chart.classList.add('active', 'admin-appointment-odontogram');
    chart.removeAttribute('data-record-panel');
    chart.querySelectorAll('[id]').forEach(node => node.removeAttribute('id'));
    chart.querySelectorAll('.premium-chart-actions,.tooth-detail-panel,.clinical-details,.chart-history,.consultation-cart-panel').forEach(node => node.remove());
    const title = chart.querySelector('.premium-chart-title h4');
    const copy = chart.querySelector('.premium-chart-title p');
    if (title) title.textContent = 'Dental Chart';
    if (copy) copy.textContent = 'Select a tooth to review or record an appointment finding.';
    section.appendChild(chart);

    const firstRecordSection = main.querySelector('.record-section');
    if (firstRecordSection) main.insertBefore(section, firstRecordSection);
    else main.appendChild(section);
    modal.classList.add('clinical-record-modal');
    ensureStateLegend(chart);
    syncStates(section);
  }

  function applyFindingFromSelect(select) {
    const modal = select.closest('#dentistAppointmentDetailModal, #appointmentModal');
    if (!modal) return;
    const tooth = modal.querySelector('.appointment-tooth-active');
    if (!tooth) return;
    const value = String(select.value || '').trim();
    if (!value) return;

    tooth.dataset.finding = value;
    if (/missing|extracted/i.test(value)) {
      tooth.classList.add('appointment-tooth-ghost', 'tooth-missing');
      tooth.classList.remove('appointment-tooth-marked', ...stateClasses);
    } else if (/sound|healthy/i.test(value)) {
      tooth.classList.remove('appointment-tooth-marked','appointment-tooth-ghost','tooth-missing',...stateClasses);
      tooth.classList.add('tooth-sound');
    } else {
      tooth.classList.remove('appointment-tooth-ghost','tooth-missing','tooth-sound');
      tooth.classList.add('appointment-tooth-marked');
    }
    tooth.classList.remove('appointment-tooth-active');
  }

  document.addEventListener('DOMContentLoaded', () => {
    installAdminAppointmentChart();
    document.querySelectorAll('#dentistAppointmentDetailModal .premium-dental-chart, #appointmentModal .admin-appointment-odontogram').forEach(ensureStateLegend);
    syncStates(document);
  });

  document.addEventListener('pointerdown', event => {
    const tooth = event.target.closest('.tooth-unit');
    if (!tooth || !appointmentChart(tooth)) return;
    const modal = tooth.closest('#dentistAppointmentDetailModal, #appointmentModal');
    clearActive(modal);
    tooth.classList.add('appointment-tooth-active');
  }, true);

  document.addEventListener('change', event => {
    const select = event.target.closest('[data-local-finding-select], [data-tq-finding], #toothCondition, #toothPresence');
    if (!select || !select.closest('#dentistAppointmentDetailModal, #appointmentModal')) return;
    applyFindingFromSelect(select);
  });

  document.addEventListener('click', event => {
    const closer = event.target.closest('[data-local-find-close],[data-local-charge-close],[data-local-charge-cancel],[data-local-charge-save]');
    if (!closer) return;
    clearActive(closer.closest('#dentistAppointmentDetailModal, #appointmentModal'));
  });

  document.addEventListener('close', event => {
    if (event.target?.matches?.('#dentistAppointmentDetailModal, #appointmentModal')) clearActive(event.target);
  }, true);

  let scheduledSync = false;
  const observer = new MutationObserver(records => {
    if (isSyncing || scheduledSync) return;
    if (!records.some(record => record.target?.closest?.('#dentistAppointmentDetailModal, #appointmentModal') || record.target?.matches?.('#dentistAppointmentDetailModal, #appointmentModal'))) return;
    scheduledSync = true;
    requestAnimationFrame(() => {
      scheduledSync = false;
      syncStates(document);
    });
  });
  observer.observe(document.body, { subtree: true, childList: true, attributes: true, attributeFilter: ['class','data-finding','data-condition','data-presence'] });

  installAdminAppointmentChart();
  document.querySelectorAll('#dentistAppointmentDetailModal .premium-dental-chart, #appointmentModal .admin-appointment-odontogram').forEach(ensureStateLegend);
  syncStates(document);
})();
