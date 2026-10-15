(()=>{'use strict';
const reports = document.getElementById('reports');
if (!reports) return;

const htmlEscape = s => String(s ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
let cache = null, cacheTime = 0;

async function data(){
  if (cache && Date.now() - cacheTime < 10000) return cache;
  const p = reports.querySelector('#reportsPeriodFilter, [data-report-period], select[name="period"]');
  const fromEl = reports.querySelector('#reportsFromDate');
  const toEl = reports.querySelector('#reportsToDate');
  const q = new URLSearchParams();
  if (p?.value) q.set('period', p.value);
  if (p?.value === 'custom') {
    if (fromEl?.value) q.set('from', fromEl.value);
    if (toEl?.value) q.set('to', toEl.value);
  }
  const r = await fetch('/api/reports?' + q, { cache: 'no-store', headers: { Accept: 'application/json' } });
  if (!r.ok) throw new Error('Unable to load report records (' + r.status + ').');
  cache = await r.json();
  cacheTime = Date.now();
  return cache;
}

function modal(){
  let d = document.getElementById('cerilloReportRecordsModal');
  if (d) return d;
  d = document.createElement('dialog');
  d.id = 'cerilloReportRecordsModal';
  d.className = 'modal modal-lg cerillo-analytics-dialog';
  d.innerHTML = `
    <div class="modal-shell">
      <div class="modal-head">
        <div>
          <p class="eyebrow">Performance intelligence</p>
          <h3 data-record-report-title></h3>
          <p data-record-report-summary></p>
        </div>
        <button type="button" class="icon-btn" data-close-record-report aria-label="Close">×</button>
      </div>
      <div data-record-report-body role="region" aria-label="Report records" style="padding:16px 24px 24px;max-height:70vh;overflow-y:auto;"></div>
      <div class="modal-actions" style="padding:12px 24px;display:flex;justify-content:space-between;align-items:center;border-top:1px solid #e2e8f0;background:#f8fafc;">
        <div id="reportModalNavActions"></div>
        <button type="button" class="btn secondary" data-close-report-btn>Close</button>
      </div>
    </div>
  `;
  document.body.append(d);
  d.querySelector('[data-close-record-report]').onclick = () => d.close();
  d.querySelector('[data-close-report-btn]').onclick = () => d.close();
  d.addEventListener('click', e => { if (e.target === d) d.close(); });
  return d;
}

function heading(panel){
  return panel.querySelector('h3')?.textContent?.trim() || panel.querySelector('small')?.textContent?.trim() || panel.dataset.kpiType || 'Report details';
}

function detailsRows(report, title, kpiType){
  let rows = [...(report.appointment_details || [])];
  const h = (title + ' ' + (kpiType || '')).toLowerCase();
  if (/completed|patient visit|monthly visit/.test(h)) return rows.filter(x => x.status === 'Completed');
  if (/cancel/.test(h)) return rows.filter(x => x.status === 'Cancelled' || x.status === 'No-Show');
  if (/no.show/.test(h)) return rows.filter(x => x.status === 'No-Show');
  if (/patients served/.test(h)) return rows.filter(x => x.status === 'Completed');
  if (/new patients/.test(h)) return rows;
  if (/outcome/.test(h)) return rows.filter(x => x.status && x.status !== 'Pending Verification');
  return rows;
}

function table(items){
  return '<div class="cerillo-insight-records"><table style="width:100%;border-collapse:collapse;"><thead><tr><th style="padding:8px;text-align:left;border-bottom:2px solid #e2e8f0;">Date</th><th style="padding:8px;text-align:left;border-bottom:2px solid #e2e8f0;">Time</th><th style="padding:8px;text-align:left;border-bottom:2px solid #e2e8f0;">Patient</th><th style="padding:8px;text-align:left;border-bottom:2px solid #e2e8f0;">Dentist</th><th style="padding:8px;text-align:left;border-bottom:2px solid #e2e8f0;">Service</th><th style="padding:8px;text-align:left;border-bottom:2px solid #e2e8f0;">Status</th></tr></thead><tbody>' + items.map(a => `<tr style="border-bottom:1px solid #f1f5f9;"><td style="padding:8px;">${htmlEscape(a.date)}</td><td style="padding:8px;">${htmlEscape(a.time)}</td><td style="padding:8px;font-weight:600;">${htmlEscape(a.patient)}</td><td style="padding:8px;">${htmlEscape(a.dentist)}</td><td style="padding:8px;">${htmlEscape(a.service)}</td><td style="padding:8px;"><span class="status ${a.status === 'Completed' ? 'success' : (['Cancelled','No-Show'].includes(a.status) ? 'danger' : 'info')}">${htmlEscape(a.status)}</span></td></tr>`).join('') + '</tbody></table></div>';
}

async function show(panel){
  const title = heading(panel);
  const kpiType = panel.dataset.kpiType || '';
  const d = modal();
  d.querySelector('[data-record-report-title]').textContent = title;
  d.querySelector('[data-record-report-summary]').textContent = 'Loading records for ' + title + '…';
  const body = d.querySelector('[data-record-report-body]');
  const navActions = d.querySelector('#reportModalNavActions');
  body.replaceChildren();
  if (navActions) navActions.innerHTML = '';
  if (!d.open) d.showModal();

  try {
    const r = await data();
    const list = detailsRows(r, title, kpiType);
    d.querySelector('[data-record-report-summary]').textContent = `${r.period_label || 'Selected period'} · ${list.length} appointment record(s) matching criteria.`;

    let html = '';

    // Specialized views
    if (/payment method|collection|revenue/i.test(title)) {
      html += `<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:14px;margin-bottom:16px;">
        <h4 style="margin:0 0 4px 0;color:#166534;font-size:14px;">Total Posted Collections</h4>
        <strong style="font-size:24px;color:#15803d;">PHP ${Number(r.total_revenue || 0).toLocaleString('en-PH', {minimumFractionDigits: 2})}</strong>
        <p style="margin:4px 0 0;font-size:12px;color:#166534;">Collection rate: <strong>${r.collection_rate ?? 100}%</strong></p>
      </div>`;

      if (Array.isArray(r.payment_method_mix) && r.payment_method_mix.length) {
        html += `<h4 style="margin:16px 0 8px 0;font-size:14px;">Payment Method Breakdown</h4>
        <div class="cerillo-insight-records" style="margin-bottom:16px;">
          <table style="width:100%;border-collapse:collapse;">
            <thead><tr><th style="padding:8px;text-align:left;">Method</th><th style="padding:8px;text-align:right;">Transactions</th><th style="padding:8px;text-align:right;">Total Amount</th><th style="padding:8px;text-align:right;">Share</th></tr></thead>
            <tbody>
              ${r.payment_method_mix.map(m => `
                <tr style="border-bottom:1px solid #f1f5f9;">
                  <td style="padding:8px;font-weight:600;">${htmlEscape(m.method)}</td>
                  <td style="padding:8px;text-align:right;">${m.count}</td>
                  <td style="padding:8px;text-align:right;font-weight:600;">PHP ${Number(m.amount || 0).toLocaleString('en-PH', {minimumFractionDigits: 2})}</td>
                  <td style="padding:8px;text-align:right;">${m.share}%</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>`;
      }
      if (navActions) {
        navActions.innerHTML = `<button type="button" class="btn sm" id="btnGoToPayments">Open Payments Module &rarr;</button>`;
        navActions.querySelector('#btnGoToPayments').onclick = () => {
          d.close();
          document.querySelector('a[href="#payments"]')?.click();
        };
      }
    } else if (/dentist workload/i.test(title)) {
      if (Array.isArray(r.dentist_workload) && r.dentist_workload.length) {
        html += `<h4 style="margin:0 0 12px 0;font-size:14px;">Dentist Completed Cases & Activity</h4>
        <div class="cerillo-insight-records" style="margin-bottom:16px;">
          <table style="width:100%;border-collapse:collapse;">
            <thead><tr><th style="padding:8px;text-align:left;">Dentist</th><th style="padding:8px;text-align:right;">Completed Cases</th><th style="padding:8px;text-align:right;">Total Period Appointments</th></tr></thead>
            <tbody>
              ${r.dentist_workload.map(dw => `
                <tr style="border-bottom:1px solid #f1f5f9;">
                  <td style="padding:8px;font-weight:600;">${htmlEscape(dw.name)}</td>
                  <td style="padding:8px;text-align:right;color:#16a34a;font-weight:700;">${dw.completed_cases}</td>
                  <td style="padding:8px;text-align:right;">${dw.total_appointments}</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>`;
      }
      if (navActions) {
        navActions.innerHTML = `<button type="button" class="btn sm" id="btnGoToAppts">Open Appointments Module &rarr;</button>`;
        navActions.querySelector('#btnGoToAppts').onclick = () => {
          d.close();
          document.querySelector('a[href="#appointments"]')?.click();
        };
      }
    } else if (/treatment plan/i.test(title)) {
      const ta = r.treatment_acceptance || {};
      html += `<div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:14px;margin-bottom:16px;">
        <h4 style="margin:0 0 4px 0;color:#1e40af;font-size:14px;">Treatment Plan Acceptance Rate</h4>
        <strong style="font-size:28px;color:#1d4ed8;">${ta.acceptance_rate ?? 0}%</strong>
        <p style="margin:4px 0 0;font-size:12px;color:#1e40af;"><strong>${ta.accepted ?? 0}</strong> recommendations accepted / finalized &middot; <strong>${ta.pending ?? 0}</strong> pending</p>
      </div>`;
    } else if (/service utilization/i.test(title)) {
      html += `<h4 style="margin:0 0 8px 0;font-size:14px;">Service Utilization Breakdown</h4>
      <div class="cerillo-insight-records" style="margin-bottom:16px;">
        <table style="width:100%;border-collapse:collapse;">
          <thead><tr><th style="padding:8px;text-align:left;">Service</th><th style="padding:8px;text-align:right;">Cases</th><th style="padding:8px;text-align:right;">Share</th></tr></thead>
          <tbody>
            ${(r.services || []).map(s => `
              <tr style="border-bottom:1px solid #f1f5f9;">
                <td style="padding:8px;font-weight:600;">${htmlEscape(s.name)}</td>
                <td style="padding:8px;text-align:right;">${s.cases}</td>
                <td style="padding:8px;text-align:right;">${s.share}%</td>
              </tr>
            `).join('')}
          </tbody>
        </table>
      </div>`;
    }

    if (list.length) {
      html += '<h4 style="margin:16px 0 8px 0;font-size:14px;">Matching Appointment Records</h4>' + table(list);
    } else if (!html) {
      html = '<p class="report-empty-state" style="text-align:center;padding:24px;color:#64748b;">No matching appointment records for this period.</p>';
    }

    body.innerHTML = html;

    // Quick navigation actions for KPI cards
    if (!navActions.innerHTML) {
      if (/patients|new-patients/i.test(kpiType || title)) {
        navActions.innerHTML = `<button type="button" class="btn sm" id="btnGoToPatients">Open Patient Records &rarr;</button>`;
        navActions.querySelector('#btnGoToPatients').onclick = () => {
          d.close();
          document.querySelector('a[href="#patients"]')?.click();
        };
      } else if (/completed|cancellation/i.test(kpiType || title)) {
        navActions.innerHTML = `<button type="button" class="btn sm" id="btnGoToAppts">Open Appointments &rarr;</button>`;
        navActions.querySelector('#btnGoToAppts').onclick = () => {
          d.close();
          document.querySelector('a[href="#appointments"]')?.click();
        };
      }
    }
  } catch (err) {
    d.querySelector('[data-record-report-summary]').textContent = err.message;
  }
}

reports.addEventListener('click', e => {
  const panel = e.target.closest('.report-chart-card, .report-visual-card, .service-utilization-panel, .metric-box');
  if (!panel || e.target.closest('button, input, select, a, summary, details')) return;
  e.stopImmediatePropagation();
  show(panel);
}, true);

reports.querySelectorAll('.report-chart-card, .report-visual-card, .service-utilization-panel, .metric-box').forEach(p => {
  p.style.cursor = 'pointer';
  p.tabIndex = 0;
  p.addEventListener('keydown', e => {
    if (e.key === 'Enter') {
      e.preventDefault();
      e.stopImmediatePropagation();
      show(p);
    }
  }, true);
});

reports.addEventListener('change', () => {
  cache = null;
  cacheTime = 0;
}, true);
})();
