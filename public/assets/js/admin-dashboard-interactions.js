(function () {
  'use strict';

  const body = document.body;
  if (body?.dataset.workspaceRole !== 'admin') return;

  const iconMap = {
    patients_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 19v-1.7A3.3 3.3 0 0 0 12.7 14H7.3A3.3 3.3 0 0 0 4 17.3V19M10 10.5A3.25 3.25 0 1 0 10 4a3.25 3.25 0 0 0 0 6.5ZM18.2 10.9a2.45 2.45 0 1 0-1.5-4.6M18 14.1c1.2.4 2 1.5 2 2.8V19"/></svg>',
    pending_verifications: '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M12 8v4.5M12 16h.01"/></svg>',
    scheduled_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="5.5" width="16" height="14" rx="2"/><path d="M8 3.5v4M16 3.5v4M4 9.5h16M8 13h3M8 16h6"/></svg>',
    completed_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="m8.7 12.2 2.2 2.2 4.7-5"/></svg>',
    appointments_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="5.5" width="16" height="14" rx="2"/><path d="M8 3.5v4M16 3.5v4M4 9.5h16M8.2 13.1h.01M12 13.1h.01M15.8 13.1h.01M8.2 16.2h.01M12 16.2h.01"/></svg>',
    total_patients: '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 19v-1.7A3.3 3.3 0 0 0 12.7 14H7.3A3.3 3.3 0 0 0 4 17.3V19M10 10.5A3.25 3.25 0 1 0 10 4a3.25 3.25 0 0 0 0 6.5ZM18.2 10.9a2.45 2.45 0 1 0-1.5-4.6M18 14.1c1.2.4 2 1.5 2 2.8V19"/></svg>',
    collections_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="6" width="17" height="12" rx="2.2"/><path d="M3.5 10h17M7 14h3"/></svg>',
    cancelled_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="m9 9 6 6M15 9l-6 6"/></svg>',
    checked_in_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M8 12.3 10.7 15 16 9.5"/></svg>',
    in_progress_today: '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M12 7.5V12l3 2"/></svg>'
  };

  const metricContext = {
    patients_today: 'Unique patients with an appointment on the current clinic day.',
    pending_verifications: 'Appointments awaiting confirmation within the clinic verification window.',
    scheduled_today: 'Appointments currently scheduled for today and not yet completed.',
    completed_today: 'Appointments recorded as completed today.',
    appointments_today: 'All appointments currently recorded for today.',
    total_patients: 'Patient records connected to completed clinic visits.',
    collections_today: 'Payments posted today across all supported payment methods.',
    cancelled_today: 'Appointments marked Cancelled or No-Show today.',
    checked_in_today: 'Patients who have checked in and are ready for clinical care.',
    in_progress_today: 'Appointments currently undergoing clinical assessment or treatment.'
  };

  function ensureAnalyticsDialog() {
    let dialog = document.getElementById('cerilloAnalyticsDrilldown');
    if (dialog) return dialog;
    dialog = document.createElement('dialog');
    dialog.id = 'cerilloAnalyticsDrilldown';
    dialog.className = 'modal modal-lg cerillo-analytics-dialog';
    dialog.innerHTML = `
      <div class="modal-shell">
        <div class="modal-head">
          <div>
            <p class="eyebrow">Interactive insight</p>
            <h3 data-insight-title>Analytics detail</h3>
            <p data-insight-description>Expanded clinic information for the selected metric.</p>
          </div>
          <button class="icon-btn" type="button" data-insight-close aria-label="Close analytics detail">×</button>
        </div>
        <div class="cerillo-insight-body" data-insight-body></div>
      </div>`;
    document.body.appendChild(dialog);
    dialog.querySelector('[data-insight-close]')?.addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', event => { if (event.target === dialog) dialog.close(); });
    return dialog;
  }

  function cleanClone(root) {
    root.querySelectorAll('[id]').forEach(node => node.removeAttribute('id'));
    root.querySelectorAll('button,input,select,textarea,a').forEach(node => node.setAttribute('tabindex', '-1'));
    return root;
  }

  function text(node) { return node?.textContent?.replace(/\s+/g, ' ')?.trim() || ''; }

  function sourceTitle(source) {
    return text(source.querySelector('.panel-heading h3, h3, small:first-child, p:first-child, span:first-child')) || 'Analytics detail';
  }

  function extractFacts(source) {
    const facts = [];
    const add = (label, value) => {
      label = String(label || '').trim(); value = String(value || '').trim();
      if (label && value && !facts.some(item => item.label === label && item.value === value)) facts.push({ label, value });
    };

    source.querySelectorAll('.bar-column').forEach(node => add(text(node.querySelector('small')), text(node.querySelector('.bar-value'))));
    source.querySelectorAll('.monthly-visits-bar').forEach(node => add(text(node.querySelector('span')), text(node.querySelector('strong'))));
    source.querySelectorAll('.horizontal-bars > div').forEach(node => add(text(node.querySelector('span')), text(node.querySelector('strong'))));
    source.querySelectorAll('.compact-count-grid > div').forEach(node => add(text(node.querySelector('span')), text(node.querySelector('strong'))));
    source.querySelectorAll('.chart-legend-list > span').forEach(node => {
      const value = text(node.querySelector('strong'));
      const label = text(node).replace(value, '').trim();
      add(label, value);
    });
    source.querySelectorAll('.outcome-row').forEach(node => {
      const value = text(node.querySelector('.outcome-label strong'));
      const pct = text(node.querySelector('small'));
      const label = text(node.querySelector('.outcome-label span'));
      add(label, pct ? `${value} · ${pct}` : value);
    });
    source.querySelectorAll('.chart-points circle[data-tooltip-label]').forEach(node => add(node.dataset.tooltipLabel, node.dataset.tooltipValue));
    return facts.slice(0, 12);
  }

  function renderFacts(body, facts) {
    if (!facts.length) return;
    const wrap = document.createElement('div');
    wrap.className = 'cerillo-insight-facts';
    facts.forEach(({ label, value }) => {
      const item = document.createElement('div');
      item.className = 'cerillo-insight-fact';
      const l = document.createElement('span'); l.textContent = label;
      const v = document.createElement('strong'); v.textContent = value;
      item.append(l, v); wrap.appendChild(item);
    });
    body.appendChild(wrap);
  }

  function openInsight(source) {
    const dialog = ensureAnalyticsDialog();
    const heading = sourceTitle(source);
    const description = text(source.querySelector('.panel-heading p'))
      || text(source.querySelector('span:last-child, small:last-child'))
      || 'Current clinic metric and its supporting context.';
    dialog.querySelector('[data-insight-title]').textContent = heading;
    dialog.querySelector('[data-insight-description]').textContent = description;
    const bodyEl = dialog.querySelector('[data-insight-body]');
    bodyEl.innerHTML = '';

    const isKpi = source.matches('.metric-box, .stat-card, .patient-summary-card');
    if (isKpi) {
      const metric = document.createElement('div');
      metric.className = 'cerillo-insight-metric';
      const value = text(source.querySelector('strong')) || '—';
      const context = text(source.querySelector('span:last-child, small:last-child'));
      metric.innerHTML = `<span>${heading}</span><strong>${value}</strong><small>${context}</small>`;
      bodyEl.appendChild(metric);
      const contextBox = document.createElement('div');
      contextBox.className = 'cerillo-insight-context';
      contextBox.textContent = metricContext[source.dataset.dashboardMetric] || `This value reflects the current ${heading.toLowerCase()} result for the selected dashboard/report period.`;
      bodyEl.appendChild(contextBox);
    } else {
      const visual = source.querySelector('.bar-chart, .monthly-visits-chart, .v6-patient-trend, .progress-list, .svg-chart-wrap, .donut-layout, .horizontal-bars, .workload-bars, .big-percentage, .stacked-progress, .compact-count-grid, .appointment-outcomes-chart');
      if (visual) {
        const clone = cleanClone(visual.cloneNode(true));
        clone.classList.add('cerillo-insight-visual');
        bodyEl.appendChild(clone);
      }
      renderFacts(bodyEl, extractFacts(source));
      const note = document.createElement('div');
      note.className = 'cerillo-insight-context';
      note.textContent = 'This drilldown uses the same live clinic data shown in the selected chart. Values update with the active dashboard or report period.';
      bodyEl.appendChild(note);
    }
    if (!dialog.open) dialog.showModal();
    // The drilldown must show underlying records, not merely repeat the KPI value.
    const recordHost = document.createElement('div');
    recordHost.className = 'cerillo-insight-records';
    recordHost.textContent = 'Loading related appointment records...';
    bodyEl.appendChild(recordHost);
    const metricKey = source.dataset.dashboardMetric || heading.toLowerCase();
    fetch('/api/appointments?per_page=100', {headers:{Accept:'application/json'},cache:'no-store'})
      .then(r=>{if(!r.ok)throw new Error('Records unavailable');return r.json();})
      .then(payload=>{
        const today=new Date().toLocaleDateString('en-CA');
        let items=(payload.data||[]).filter(a=>{
          const stamp=String(a.starts_at||'');
          if(/today|scheduled|progress|checked_in|completed|cancelled/.test(metricKey)&&!stamp.startsWith(today))return false;
          if(/completed/.test(metricKey))return a.status==='Completed';
          if(/cancelled/.test(metricKey))return ['Cancelled','No-Show'].includes(a.status);
          if(/checked_in/.test(metricKey))return a.status==='Checked In';
          if(/in_progress/.test(metricKey))return a.status==='In Progress';
          if(/pending/.test(metricKey))return /Pending/.test(a.status);
          return true;
        });
        recordHost.replaceChildren();
        const desc=document.createElement('p');desc.textContent=`${items.length} matching appointment(s) in the latest 100 records`;recordHost.append(desc);
        if(!items.length)return;
        const table=document.createElement('table');
        const tr=document.createElement('tr');['Date','Patient','Dentist','Service','Status'].forEach(label=>{const th=document.createElement('th');th.textContent=label;tr.append(th);});const head=document.createElement('thead');head.append(tr);table.append(head);
        const tbody=document.createElement('tbody');items.forEach(a=>{const row=document.createElement('tr');[String(a.starts_at||'').slice(0,16),a.patient?.name||a.guest_name||'Guest',a.dentist?.name||'Unassigned',a.service?.name||'Service',a.status||'—'].forEach(value=>{const td=document.createElement('td');td.textContent=value;row.append(td);});tbody.append(row);});table.append(tbody);recordHost.append(table);
      }).catch(()=>{recordHost.textContent='Related appointment records could not be loaded.';});
  }

  function bindKpis() {
    document.querySelectorAll('#dashboard [data-dashboard-metric].metric-box, #dashboard [data-dashboard-metric].stat-card').forEach(card => {
      const metric = card.dataset.dashboardMetric;
      if (!card.querySelector('.cerillo-kpi-icon')) {
        const icon = document.createElement('i');
        icon.className = `cerillo-kpi-icon cerillo-kpi-icon--${metric}`;
        icon.setAttribute('aria-hidden', 'true');
        icon.innerHTML = iconMap[metric] || iconMap.scheduled_today;
        card.appendChild(icon);
      }
      card.classList.add('cerillo-interactive-kpi');
      card.tabIndex = 0;
      card.setAttribute('role', 'button');
      card.title = `${sourceTitle(card)} — view details`;
      const open = () => openInsight(card);
      card.addEventListener('click', open);
      card.addEventListener('keydown', event => {
        if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); open(); }
      });
    });

    document.querySelectorAll('#reports .metric-strip .metric-box').forEach(card => {
      card.classList.add('cerillo-report-kpi', 'cerillo-interactive-kpi');
      card.tabIndex = 0;
      card.setAttribute('role', 'button');
      card.title = `${sourceTitle(card)} — view report detail`;
      const open = () => openInsight(card);
      card.addEventListener('click', open);
      card.addEventListener('keydown', event => {
        if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); open(); }
      });
    });
  }

  function makeInsightInteractive(panel) {
    if (!panel || panel.dataset.cerilloInteractiveBound === '1') return;
    panel.dataset.cerilloInteractiveBound = '1';
    panel.classList.add('cerillo-analytics-interactive');
    panel.tabIndex = 0;
    panel.setAttribute('role', 'button');
    panel.title = `${sourceTitle(panel)} — click for insight details`;
    panel.addEventListener('click', event => {
      if (event.target.closest('button, a, input, select, textarea, summary, details')) return;
      openInsight(panel);
    });
    panel.addEventListener('keydown', event => {
      if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); openInsight(panel); }
    });
  }

  function bindAnalytics() {
    document.querySelectorAll('#dashboard .chart-card, #dashboard .analytics-card').forEach(makeInsightInteractive);
    document.querySelectorAll('#reports .panel').forEach(panel => {
      if (panel.querySelector('.bar-chart, .progress-list, .svg-chart-wrap, .donut-layout, .horizontal-bars, .workload-bars, .big-percentage, .stacked-progress, .appointment-outcomes-chart')) makeInsightInteractive(panel);
    });
  }

  function ensureTooltip() {
    let tip = document.getElementById('cerilloChartTooltip');
    if (tip) return tip;
    tip = document.createElement('div');
    tip.id = 'cerilloChartTooltip';
    tip.className = 'cerillo-chart-tooltip';
    tip.setAttribute('role', 'tooltip');
    document.body.appendChild(tip);
    return tip;
  }

  function tooltipData(target) {
    if (!target) return null;
    if (target.matches('.chart-points circle')) return { label: target.dataset.tooltipLabel || target.getAttribute('aria-label') || 'Patient visits', value: target.dataset.tooltipValue || '' };
    if (target.matches('.bar-column')) return { label: text(target.querySelector('small')), value: `${text(target.querySelector('.bar-value'))} appointments` };
    if (target.matches('.monthly-visits-bar')) return { label: text(target.querySelector('span')), value: `${text(target.querySelector('strong'))} completed visits` };
    if (target.matches('.horizontal-bars > div')) return { label: text(target.querySelector('span')), value: text(target.querySelector('strong')) };
    if (target.matches('.compact-count-grid > div')) return { label: text(target.querySelector('span')), value: text(target.querySelector('strong')) };
    if (target.matches('.chart-legend-list > span')) {
      const value = text(target.querySelector('strong')); return { label: text(target).replace(value, '').trim(), value };
    }
    if (target.matches('.outcome-row')) return { label: text(target.querySelector('.outcome-label span')), value: `${text(target.querySelector('.outcome-label strong'))} · ${text(target.querySelector('small'))}` };
    return null;
  }

  function tooltipTarget(eventTarget) {
    return eventTarget.closest?.('#dashboard .bar-column, #dashboard .horizontal-bars > div, #dashboard .compact-count-grid > div, #dashboard .chart-legend-list > span, #dashboard .chart-points circle, #reports .monthly-visits-bar, #reports .outcome-row');
  }

  function placeTooltip(tip, x, y) {
    const pad = 14;
    const rect = tip.getBoundingClientRect();
    let left = x + 14, top = y + 14;
    if (left + rect.width > window.innerWidth - pad) left = x - rect.width - 14;
    if (top + rect.height > window.innerHeight - pad) top = y - rect.height - 14;
    tip.style.left = `${Math.max(pad, left)}px`;
    tip.style.top = `${Math.max(pad, top)}px`;
  }

  function showTooltip(target, x, y) {
    const data = tooltipData(target); if (!data?.label) return;
    const tip = ensureTooltip();
    tip.innerHTML = `<strong>${data.label}</strong><span>${data.value}</span>`;
    tip.classList.add('is-visible');
    placeTooltip(tip, x, y);
  }
  function hideTooltip() { document.getElementById('cerilloChartTooltip')?.classList.remove('is-visible'); }

  document.addEventListener('pointerover', event => {
    const target = tooltipTarget(event.target); if (!target) return;
    showTooltip(target, event.clientX, event.clientY);
  });
  document.addEventListener('pointermove', event => {
    const target = tooltipTarget(event.target); if (!target) return;
    const tip = document.getElementById('cerilloChartTooltip'); if (tip?.classList.contains('is-visible')) placeTooltip(tip, event.clientX, event.clientY);
  });
  document.addEventListener('pointerout', event => { if (tooltipTarget(event.target)) hideTooltip(); });
  document.addEventListener('focusin', event => {
    const target = tooltipTarget(event.target); if (!target) return;
    const rect = target.getBoundingClientRect(); showTooltip(target, rect.left + rect.width / 2, rect.top + rect.height / 2);
  });
  document.addEventListener('focusout', event => { if (tooltipTarget(event.target)) hideTooltip(); });

  let isRefreshingMetadata = false;
  function refreshChartMetadata() {
    if (isRefreshingMetadata) return;
    isRefreshingMetadata = true;
    try {
      document.querySelectorAll('#dashboard .chart-points circle').forEach((point, index) => {
        if (point.getAttribute('tabindex') !== '0') point.setAttribute('tabindex', '0');
        if (point.getAttribute('role') !== 'img') point.setAttribute('role', 'img');
        if (!point.dataset.tooltipLabel) point.dataset.tooltipLabel = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'][index] || `Day ${index + 1}`;
      });
    } finally {
      Promise.resolve().then(() => { isRefreshingMetadata = false; });
    }
  }

  bindKpis();
  bindAnalytics();
  refreshChartMetadata();

  const observer = new MutationObserver((mutations) => {
    if (isRefreshingMetadata) return;
    const hasExternalChange = mutations.some(m => m.type === 'childList' || (m.type === 'attributes' && m.attributeName !== 'tabindex' && m.attributeName !== 'role' && m.attributeName !== 'data-tooltip-label'));
    if (hasExternalChange) refreshChartMetadata();
  });
  document.querySelectorAll('#dashboard [data-dashboard-weekly-bars], #dashboard .chart-points, #reports [data-monthly-visits-plot], #reports [data-appointment-outcomes]').forEach(node => {
    observer.observe(node, { childList: true, subtree: true, characterData: true, attributes: true });
  });
})();
