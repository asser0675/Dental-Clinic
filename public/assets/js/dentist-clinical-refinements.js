(function () {
  'use strict';

  const PERMANENT_FDI = [
    18,17,16,15,14,13,12,11,
    21,22,23,24,25,26,27,28,
    38,37,36,35,34,33,32,31,
    41,42,43,44,45,46,47,48
  ];
  const PRIMARY_FDI = [55,54,53,52,51,61,62,63,64,65,75,74,73,72,71,81,82,83,84,85];
  const UNIVERSAL_TO_FDI = {};
  PERMANENT_FDI.forEach((fdi, index) => { UNIVERSAL_TO_FDI[String(index + 1)] = fdi; });
  'ABCDEFGHIJKLMNOPQRST'.split('').forEach((letter, index) => { UNIVERSAL_TO_FDI[letter] = PRIMARY_FDI[index]; });

  const isExtraction = value => /\bext\b|extract/i.test(String(value || ''));

  function chartMeta(code) {
    const normalized = String(code || '').trim().toUpperCase();
    const fdi = UNIVERSAL_TO_FDI[normalized] || (/^[1-8][1-8]$/.test(normalized) ? Number(normalized) : null);
    if (!fdi) return null;
    return { fdi, chartNumber: Number(fdi) % 10 };
  }

  function permanentPosition(universal) {
    const n = Number(universal);
    if (!Number.isInteger(n) || n < 1 || n > 32) return null;

    // Keep the clinical arch shape, but tighten the horizontal spacing so the
    // tooth images read as one continuous dentition without overlapping.
    const leftToRight = n <= 16 ? n - 1 : 32 - n;
    const x = 11 + leftToRight * (78 / 15);
    let y;
    if (n <= 16) {
      const distance = Math.abs(n - 8.5) / 7.5;
      y = 28 + Math.pow(distance, 1.42) * 14.0;
    } else {
      const distance = Math.abs(n - 24.5) / 7.5;
      y = 72 - Math.pow(distance, 1.42) * 14.0;
    }
    return { x, y };
  }

  function mixedPermanentPosition(universal) {
    const n = Number(universal);
    if (!Number.isInteger(n) || n < 1 || n > 32) return null;

    // Mixed dentition keeps the permanent arches outside the primary set.
    // The maxillary arch sits slightly lower and the mandibular arch slightly
    // higher than before so the four clinical rows read as one compact chart.
    const leftToRight = n <= 16 ? n - 1 : 32 - n;
    const x = 10.5 + leftToRight * (79 / 15);
    const distance = n <= 16
      ? Math.abs(n - 8.5) / 7.5
      : Math.abs(n - 24.5) / 7.5;
    const curve = Math.pow(distance, 1.35) * 8.5;
    const y = n <= 16 ? 17.5 + curve : 82.5 - curve;
    return { x, y, arch: n <= 16 ? 'maxillary' : 'mandibular' };
  }

  function mixedPrimaryPosition(code) {
    const normalized = String(code || '').trim().toUpperCase();
    if (!/^[A-T]$/.test(normalized)) return null;
    const index = normalized.charCodeAt(0) - 65;
    const upper = index < 10;
    const archIndex = upper ? index : index - 10;

    // Match the dedicated Primary chart: ten teeth centered as
    // 5 4 3 2 1 | 1 2 3 4 5 on both arches.
    const x = 25.5 + archIndex * (49 / 9);
    // The dedicated Primary chart uses two clean, compact rows. Keep the same
    // row logic in Mixed rather than bending the primary teeth into the
    // permanent arch geometry.
    const y = upper ? 39.5 : 60.5;
    return { x, y, arch: upper ? 'maxillary' : 'mandibular' };
  }

  function annotateTooth(tooth) {
    const code = String(tooth.dataset.tooth || '').trim().toUpperCase();
    const meta = chartMeta(code);
    if (!meta) return;

    if (tooth.dataset.toothFdi !== String(meta.fdi)) tooth.dataset.toothFdi = String(meta.fdi);
    if (tooth.dataset.chartNumber !== String(meta.chartNumber)) tooth.dataset.chartNumber = String(meta.chartNumber);

    const number = tooth.querySelector('.tooth-number');
    if (number && number.textContent !== String(meta.chartNumber)) number.textContent = String(meta.chartNumber);

    const name = tooth.dataset.toothName || 'Tooth';
    tooth.setAttribute('aria-label', `Tooth ${meta.chartNumber}, ${name}, FDI ${meta.fdi}`);
    tooth.title = `Tooth ${meta.chartNumber} · ${name} · FDI ${meta.fdi}`;

    const grid = tooth.closest('[data-dentition-grid]');
    if (grid?.dataset.dentitionGrid === 'permanent' && /^\d+$/.test(code)) {
      const pos = permanentPosition(code);
      if (pos) {
        tooth.style.setProperty('--tooth-x', `${pos.x.toFixed(2)}%`);
        tooth.style.setProperty('--tooth-y', `${pos.y.toFixed(2)}%`);
      }
    } else if (grid?.dataset.dentitionGrid === 'mixed') {
      const permanent = /^\d+$/.test(code);
      const pos = permanent ? mixedPermanentPosition(code) : mixedPrimaryPosition(code);
      if (pos) {
        tooth.dataset.mixedLayer = permanent ? 'permanent' : 'primary';
        tooth.dataset.mixedArch = pos.arch;
        tooth.style.setProperty('--mixed-x', `${pos.x.toFixed(2)}%`);
        tooth.style.setProperty('--mixed-y', `${pos.y.toFixed(2)}%`);
      }
    }
  }

  function annotateAll(root) {
    (root || document).querySelectorAll?.('.premium-dental-chart .tooth-unit')
      ?.forEach(annotateTooth);
  }

  function patientChartIsReadOnly() {
    const modal = document.getElementById('dentistPatientModal') || document.getElementById('patientViewModal');
    if (!modal) return;
    modal.querySelectorAll('.premium-dental-chart .tooth-unit').forEach(tooth => {
      tooth.removeAttribute('aria-disabled');
      tooth.removeAttribute('tabindex');
      tooth.style.pointerEvents = 'auto';
      tooth.style.cursor = 'pointer';
    });
  }

  function selectedToothLabel(modal) {
    const selected = modal?.querySelector('.premium-dental-chart .tooth-unit.tooth-picked, .premium-dental-chart .tooth-unit.selected');
    if (!selected) return 'Extraction treatment';
    const number = selected.dataset.chartNumber || selected.dataset.tooth || '—';
    return `Tooth ${number}`;
  }

  function extractionSelectedInChart(modal) {
    if (!modal) return false;
    const values = [];
    const treatment = modal.querySelector('#toothTreatment');
    if (treatment) values.push(treatment.value);
    modal.querySelectorAll('[data-local-charge-procedure], [data-tqc-procedure]').forEach(el => values.push(el.value));
    modal.querySelectorAll('.tooth-unit[data-procedure]').forEach(el => values.push(el.dataset.procedure));
    const cart = modal.querySelector('[data-consultation-items]');
    if (cart) values.push(cart.textContent);
    return values.some(isExtraction);
  }

  function refreshPrescriptionPanel(modal) {
    if (!modal || modal.id !== 'dentistAppointmentDetailModal') return;
    const panel = modal.querySelector('[data-extraction-prescription-panel]');
    if (!panel) return;

    const show = extractionSelectedInChart(modal) || modal.dataset.hasExtractionPrescription === 'true';
    panel.hidden = !show;
    panel.classList.toggle('is-visible', show);

    const tooth = panel.querySelector('[data-extraction-prescription-tooth]');
    if (tooth) tooth.textContent = selectedToothLabel(modal);
  }

  function setPrescriptionField(modal, selector, value) {
    const input = modal?.querySelector(selector);
    if (input) input.value = value || '';
  }

  function parseStoredPrescription(text) {
    const result = { medication: '', dosage: '', frequency: '', instructions: '' };
    String(text || '').split(/\r?\n/).forEach(line => {
      const match = line.match(/^\s*(Medication|Dosage|Frequency|Instructions)\s*:\s*(.*)$/i);
      if (!match) return;
      const key = match[1].toLowerCase();
      result[key] = match[2].trim();
    });
    if (!result.medication && text && !String(text).includes(':')) result.instructions = String(text).trim();
    return result;
  }

  window.resetDentistExtractionPrescription = function (modal) {
    if (!modal) return;
    modal.dataset.hasExtractionPrescription = 'false';
    setPrescriptionField(modal, '[data-extraction-rx-medication]', '');
    setPrescriptionField(modal, '[data-extraction-rx-dosage]', '');
    setPrescriptionField(modal, '[data-extraction-rx-frequency]', '');
    setPrescriptionField(modal, '[data-extraction-rx-instructions]', '');
    refreshPrescriptionPanel(modal);
  };

  window.syncDentistExtractionPrescription = function (modal, appointment) {
    if (!modal) return;
    const session = appointment?.clinical_session || appointment?.clinicalSession || null;
    const stored = session?.prescriptions || '';
    const extractionContext = isExtraction(appointment?.service?.name)
      || isExtraction(session?.treatment_recommendations)
      || isExtraction(session?.treatment_notes)
      || Boolean(String(stored).trim());

    if (stored) {
      const parsed = parseStoredPrescription(stored);
      setPrescriptionField(modal, '[data-extraction-rx-medication]', parsed.medication);
      setPrescriptionField(modal, '[data-extraction-rx-dosage]', parsed.dosage);
      setPrescriptionField(modal, '[data-extraction-rx-frequency]', parsed.frequency);
      setPrescriptionField(modal, '[data-extraction-rx-instructions]', parsed.instructions);
    }
    modal.dataset.hasExtractionPrescription = extractionContext ? 'true' : 'false';
    refreshPrescriptionPanel(modal);
  };

  function applyAll() {
    annotateAll(document);
    patientChartIsReadOnly();
    refreshPrescriptionPanel(document.getElementById('dentistAppointmentDetailModal'));
  }

  document.addEventListener('DOMContentLoaded', applyAll);
  applyAll();

  document.addEventListener('change', event => {
    const target = event.target;
    if (!target) return;
    if (target.matches('#toothTreatment, [data-local-charge-procedure], [data-tqc-procedure]')) {
      refreshPrescriptionPanel(target.closest('#dentistAppointmentDetailModal'));
    }
  });

  document.addEventListener('click', event => {
    if (event.target.closest('[data-dentition], .tooth-unit, [data-local-charge-save], [data-tqc-save], [data-consultation-remove], [data-consultation-clear]')) {
      requestAnimationFrame(() => {
        applyAll();
        refreshPrescriptionPanel(document.getElementById('dentistAppointmentDetailModal'));
      });
    }
  });

  document.addEventListener('close', event => {
    if (event.target?.id === 'dentistAppointmentDetailModal') {
      window.resetDentistExtractionPrescription(event.target);
    }
  }, true);

  // Existing chart scripts occasionally redraw number labels after a dentition
  // toggle. Re-apply the clinic numbering after those redraws settle.
  let isAnnotating = false;
  const observer = new MutationObserver(records => {
    if (isAnnotating) return;
    if (!records.some(record => record.target?.closest?.('.premium-dental-chart') || record.target?.classList?.contains('premium-dental-chart'))) return;
    isAnnotating = true;
    requestAnimationFrame(() => {
      try {
        annotateAll(document);
      } finally {
        setTimeout(() => { isAnnotating = false; }, 0);
      }
    });
  });
  const workspace = document.querySelector('.workspace-body') || document.body;
  if (workspace) observer.observe(workspace, { subtree: true, childList: true, attributes: true, attributeFilter: ['class'] });
})();
