(function () {
  const root = document.body;
  const role = root.dataset.workspaceRole || '';
  const view = root.dataset.workspaceView || '';
  const money = value => new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
    maximumFractionDigits: 2
  }).format(Number(value || 0));

  function setMetric(name, value) {
    const targets = document.querySelectorAll(`[data-dashboard-metric="${name}"] strong, [data-dashboard-metric="${name}"]:not(:has(strong))`);
    targets.forEach(node => {
      node.textContent = name === 'collections_today' ? money(value) : Number(value || 0).toLocaleString();
    });
  }

  function renderWeeklyBars(daily) {
    const chart = document.querySelector('[data-dashboard-weekly-bars]');
    if (!chart) return;
    const values = Object.values(daily || {}).map(Number);
    const max = Math.max(...values, 1);
    chart.querySelectorAll('.bar-column').forEach((column, index) => {
      const value = values[index] || 0;
      const label = column.querySelector('.bar-value');
      const bar = column.querySelector('.bar');
      if (label) label.textContent = value;
      if (bar) bar.style.height = `${Math.max(value ? (value / max) * 100 : 2, 2)}%`;
    });
  }

  function renderStatusMix(statuses, total) {
    const donut = document.querySelector('[data-dashboard-donut]');
    if (donut) {
      const completed = Number(statuses.Completed || 0);
      const checkedIn = Number(statuses['Checked In'] || 0);
      const pending = Number(statuses.Pending || 0) + Number(statuses['Pending Verification'] || 0);
      const cancelled = Number(statuses.Cancelled || 0) + Number(statuses['No-Show'] || 0);
      const denominator = Math.max(Number(total || 0), 1);
      const first = completed / denominator * 100;
      const second = first + checkedIn / denominator * 100;
      const third = second + pending / denominator * 100;
      donut.style.background = `conic-gradient(#12b76a 0 ${first}%, #2e90fa ${first}% ${second}%, #f79009 ${second}% ${third}%, #f04438 ${third}% 100%)`;
    }
    document.querySelectorAll('[data-dashboard-status]').forEach(node => {
      node.textContent = Number(statuses[node.dataset.dashboardStatus] || 0).toLocaleString();
    });
    const totalNode = document.querySelector('[data-dashboard-total-appointments]');
    if (totalNode) totalNode.textContent = Number(total || 0).toLocaleString();
  }

  function renderCollections(collections) {
    const chart = document.querySelector('[data-dashboard-collections]');
    if (!chart) return;
    const entries = Object.entries(collections || {});
    const max = Math.max(...entries.map(([, amount]) => Number(amount)), 1);
    const hasAny = entries.some(([, amount]) => Number(amount) > 0);
    
    chart.innerHTML = entries.map(([method, amount]) => {
      const num = Number(amount || 0);
      const width = max > 0 && num > 0 ? Math.max((num / max) * 100, 4) : 0;
      return `<div>
        <span>${escapeHtml(method)}</span>
        <div><i style="width:${width}%"></i></div>
        <strong>${money(num)}</strong>
      </div>`;
    }).join('') || '<p class="muted small" style="padding:12px 0;">No payments posted today.</p>';
  }

  function renderRecentActivity(activities) {
    const list = document.querySelector('.activity-list');
    if (!list) return;
    if (!activities || !activities.length) {
      list.innerHTML = '<p class="muted small" style="padding:12px 0;">No recent activity recorded.</p>';
      return;
    }
    list.innerHTML = activities.map(act => `
      <div>
        <time title="${escapeHtml(act.date)}">${escapeHtml(role === 'admin' && view !== 'dentist' ? (act.time_ago || act.date) : act.date)}</time>
        <strong>${escapeHtml(act.title)}</strong>
        <p>${escapeHtml(act.description)}</p>
      </div>
    `).join('');
  }

  function renderPatientVisitsTrend(trendData) {
    const totalEl = document.querySelector('.analytics-card .chart-total');
    if (totalEl && trendData?.total !== undefined) {
      totalEl.textContent = `${trendData.total} visit${trendData.total === 1 ? '' : 's'}`;
    }
    const svg = document.querySelector('.line-chart-svg');
    if (!svg || !trendData?.days || !trendData.days.length) return;
    const days = trendData.days;
    const counts = days.map(d => Number(d.count || 0));
    const max = Math.max(...counts, 4);

    const xCoords = [54, 158, 262, 366, 470, 574, 682];
    const points = counts.map((c, i) => {
      const x = xCoords[i] || 54 + i * 104;
      const y = Math.round(190 - (c / max) * 140);
      return { x, y };
    });

    let pathD = `M${points[0].x},${points[0].y}`;
    for (let i = 1; i < points.length; i++) {
      const prev = points[i - 1];
      const curr = points[i];
      const cpX = (prev.x + curr.x) / 2;
      pathD += ` C${cpX},${prev.y} ${cpX},${curr.y} ${curr.x},${curr.y}`;
    }
    const areaD = `${pathD} L${points[points.length - 1].x},190 L${points[0].x},190 Z`;

    const linePath = svg.querySelector('.chart-line');
    const areaPath = svg.querySelector('.chart-area');
    if (linePath) linePath.setAttribute('d', pathD);
    if (areaPath) areaPath.setAttribute('d', areaD);

    const circlesG = svg.querySelector('.chart-points');
    if (circlesG) {
      circlesG.innerHTML = points.map((p, index) => {
        const day = days[index] || {};
        const label = escapeHtml(day.day || `Day ${index + 1}`);
        const value = Number(day.count || 0);
        return `<circle cx="${p.x}" cy="${p.y}" r="5" tabindex="0" role="img" data-tooltip-label="${label}" data-tooltip-value="${value}" aria-label="${label}: ${value} patient visits"></circle>`;
      }).join('');
    }
  }

  function renderClinicCapacity(capacity) {
    if (!capacity) return;
    const grid = document.querySelector('.compact-count-grid');
    if (!grid) return;
    const items = grid.querySelectorAll(':scope > div');
    if (items.length >= 4) {
      if (items[0].querySelector('strong')) items[0].querySelector('strong').textContent = capacity.dentists_on_duty ?? 0;
      if (items[1].querySelector('strong')) items[1].querySelector('strong').textContent = capacity.operatories_active ?? 0;
      if (items[2].querySelector('strong')) items[2].querySelector('strong').textContent = capacity.follow_ups_due ?? 0;
      if (items[3].querySelector('strong')) items[3].querySelector('strong').textContent = capacity.radiographs_added ?? 0;
    }
  }

  function renderBillingAndPatientKPIs(data) {
    // Ortho Installment oversight
    const ortho = data.ortho_installments;
    const orthoPanel = document.getElementById('orthoInstallmentPanel');
    if (orthoPanel && ortho) {
      const summaryItems = orthoPanel.querySelectorAll('.installment-summary-row > div');
      if (summaryItems.length >= 3) {
        if (summaryItems[0].querySelector('strong')) summaryItems[0].querySelector('strong').textContent = ortho.active_plans ?? 0;
        if (summaryItems[1].querySelector('strong')) summaryItems[1].querySelector('strong').textContent = money(ortho.next_due ?? 0);
        if (summaryItems[2].querySelector('strong')) summaryItems[2].querySelector('strong').textContent = money(ortho.collected_this_month ?? 0);
      }
    }

    // Billing & Payments section KPI cards
    const billing = data.billing_kpis;
    const paymentsSection = document.getElementById('payments');
    if (paymentsSection && billing) {
      const cards = paymentsSection.querySelectorAll('.stats-grid > .stat-card');
      if (cards.length >= 4) {
        // Card 1: Collected today
        const c1Strong = cards[0].querySelector('strong');
        const c1Span = cards[0].querySelector('span');
        if (c1Strong) c1Strong.textContent = money(billing.collected_today);
        if (c1Span) c1Span.textContent = `${billing.payments_today} payment${billing.payments_today === 1 ? '' : 's'}`;

        // Card 2: Outstanding
        const c2Strong = cards[1].querySelector('strong');
        const c2Span = cards[1].querySelector('span');
        if (c2Strong) c2Strong.textContent = money(billing.outstanding_total);
        if (c2Span) c2Span.textContent = `${billing.outstanding_patients_count} patient${billing.outstanding_patients_count === 1 ? '' : 's'}`;

        // Card 3: Partial balances
        const c3Strong = cards[2].querySelector('strong');
        const c3Span = cards[2].querySelector('span');
        if (c3Strong) c3Strong.textContent = money(billing.partial_total);
        if (c3Span) c3Span.textContent = `${billing.partial_count} active plan${billing.partial_count === 1 ? '' : 's'}`;

        // Card 4: Adjustments
        const c4Strong = cards[3].querySelector('strong');
        if (c4Strong) c4Strong.textContent = money(billing.adjustments_month);
      }
    }

    // Patient Records section KPI cards
    const patientKpis = data.patient_kpis;
    const patientSection = document.getElementById('patients');
    if (patientSection && patientKpis) {
      const pCards = patientSection.querySelectorAll('.patient-summary-grid > .patient-summary-card');
      if (pCards.length >= 4) {
        // Card 1: Total patient records
        const p1Label = pCards[0].querySelector('small');
        const p1Strong = pCards[0].querySelector('strong');
        const p1Trend = pCards[0].querySelector('.trend');
        if (p1Label) p1Label.textContent = 'Total patient records';
        if (p1Strong) p1Strong.textContent = patientKpis.total_registered_patients ?? 0;
        if (p1Trend) p1Trend.textContent = `↑ ${patientKpis.new_registrations_month ?? 0} this month`;

        // Card 2: Active patients
        const p2Strong = pCards[1].querySelector('strong');
        const p2Span = pCards[1].querySelector('span');
        if (p2Strong) p2Strong.textContent = patientKpis.total_registered_patients ?? 0;
        if (p2Span) p2Span.textContent = '100% of records';

        // Card 3: Recall due this month
        const p3Strong = pCards[2].querySelector('strong');
        const p3Span = pCards[2].querySelector('span');
        if (p3Strong) p3Strong.textContent = patientKpis.recall_contacts_due ?? 0;
        if (p3Span) p3Span.textContent = `${patientKpis.recall_contacts_due ?? 0} due for recall`;

        // Card 4: Accounts with balance
        const p4Strong = pCards[3].querySelector('strong');
        const p4Span = pCards[3].querySelector('span');
        if (p4Strong) p4Strong.textContent = patientKpis.accounts_with_balance ?? 0;
        if (p4Span) p4Span.textContent = `${money(patientKpis.outstanding_balance ?? 0)} outstanding`;
      }
    }
  }

  function escapeHtml(value) {
    return String(value ?? '').replace(/[&<>"']/g, char => ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
    }[char]));
  }

  function formatTime12(value) {
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
  }

  function renderAppointments(rows) {
    const tables = document.querySelectorAll('#front-desk-table-1 tbody, #dentist-table-1 tbody');
    if (!tables.length) return;
    tables.forEach(table => {
      table.innerHTML = (rows || []).map(appointment => {
        const time = formatTime12(appointment.starts_at);
        const patient = appointment.patient?.name || appointment.guest_name || 'Guest patient';
        const service = appointment.service?.name || 'Unassigned service';
        const dentist = appointment.dentist?.name || 'Unassigned';
        const statusClass = appointment.status === 'Completed' ? 'success'
          : ['Cancelled', 'No-Show'].includes(appointment.status) ? 'danger'
            : ['Checked In', 'In Progress'].includes(appointment.status) ? 'info' : 'warning';
        if (table.closest('#front-desk-table-1')) {
          return `<tr data-appointment-id="${appointment.id}"><td>${escapeHtml(time)}</td><td>${escapeHtml(patient)}</td><td>${escapeHtml(service)}</td><td>${escapeHtml(dentist)}</td><td><span class="status ${statusClass}">${escapeHtml(appointment.status)}</span></td></tr>`;
        }
        return `<tr data-appointment-id="${appointment.id}" style="cursor:pointer;"><td>${escapeHtml(time)}</td><td>${escapeHtml(patient)}</td><td>${escapeHtml(service)}</td><td><span class="status ${statusClass}">${escapeHtml(appointment.status)}</span></td></tr>`;
      }).join('') || '<tr><td colspan="5" class="muted">No appointments recorded today.</td></tr>';
    });
  }

  async function loadDashboard() {
    const params = new URLSearchParams();
    if (role === 'admin' && view === 'dentist') params.set('view', 'dentist');
    const response = await fetch(`/api/dashboard?${params}`, { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error('Dashboard data could not be loaded.');
    const data = await response.json();
    Object.entries(data).forEach(([name, value]) => {
      if (typeof value === 'number' && document.querySelector(`[data-dashboard-metric="${name}"]`)) setMetric(name, value);
    });
    renderWeeklyBars(data.daily_appointments);
    renderStatusMix(data.status_counts, data.appointments?.length);
    renderCollections(data.collections_by_method);
    renderAppointments(data.appointments);
    renderRecentActivity(data.recent_activity);
    renderPatientVisitsTrend(data.patient_visits_trend);
    renderClinicCapacity(data.clinic_capacity);
    renderBillingAndPatientKPIs(data);
  }

  loadDashboard().catch(error => console.error(error));

  // Admin-management dashboard only: keep recent activity current without
  // changing the refresh behaviour of Dentist, Front Desk, or Patient views.
  if (role === 'admin' && view !== 'dentist') {
    window.setInterval(() => {
      const dashboard = document.getElementById('dashboard');
      if (!document.hidden && dashboard?.classList.contains('active-section')) {
        loadDashboard().catch(error => console.error(error));
      }
    }, 15000);
    window.addEventListener('focus', () => {
      const dashboard = document.getElementById('dashboard');
      if (dashboard?.classList.contains('active-section')) loadDashboard().catch(error => console.error(error));
    });
  }

  window.refreshDashboard = loadDashboard;
})();
