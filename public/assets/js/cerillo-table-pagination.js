(function () {
  'use strict';

  const PAGE_SIZE = 10;
  const states = new WeakMap();
  let autoId = 0;

  function isModuleTable(table) {
    if (!table || table.dataset.noPagination === 'true') return false;
    if (table.closest('.consultation-summary-table-wrap')) return false;
    if (table.closest('[data-consultation-summary]')) return false;
    if (table.matches('[data-no-pagination]')) return false;
    return Boolean(table.closest('.workspace-section, .section, .clinical-record-modal'));
  }

  function bodyRows(table) {
    const body = table.tBodies && table.tBodies[0];
    if (!body) return [];
    return Array.from(body.rows).filter(function (row) {
      return !row.classList.contains('no-filter-match-row') && row.dataset.paginationIgnore !== 'true';
    });
  }

  function hasActualData(row) {
    if (!row) return false;
    if (row.cells.length === 1 && row.cells[0].hasAttribute('colspan')) {
      const text = row.textContent.trim().toLowerCase();
      if (/^(no |there are no |nothing |empty|no records|no appointments|no patients|no transactions)/.test(text)) return false;
    }
    return true;
  }

  function getState(table) {
    let state = states.get(table);
    if (!state) {
      state = { page: 1, pager: null, info: null, pages: null, prev: null, next: null };
      states.set(table, state);
    }
    return state;
  }

  function ensurePager(table) {
    const state = getState(table);
    if (state.pager && state.pager.isConnected) return state;

    const pager = document.createElement('nav');
    pager.className = 'cerillo-pagination';
    pager.setAttribute('aria-label', 'Table pagination');

    const info = document.createElement('span');
    info.className = 'cerillo-pagination-info';

    const controls = document.createElement('div');
    controls.className = 'cerillo-pagination-controls';

    const prev = document.createElement('button');
    prev.type = 'button';
    prev.className = 'cerillo-page-btn cerillo-page-prev';
    prev.textContent = 'Previous';

    const pages = document.createElement('div');
    pages.className = 'cerillo-page-numbers';

    const next = document.createElement('button');
    next.type = 'button';
    next.className = 'cerillo-page-btn cerillo-page-next';
    next.textContent = 'Next';

    controls.append(prev, pages, next);
    pager.append(info, controls);

    const tableParent = table.parentElement;
    if (tableParent) table.insertAdjacentElement('afterend', pager);

    state.pager = pager;
    state.info = info;
    state.pages = pages;
    state.prev = prev;
    state.next = next;

    prev.addEventListener('click', function () {
      if (state.page > 1) {
        state.page -= 1;
        apply(table, false);
      }
    });
    next.addEventListener('click', function () {
      const total = eligibleRows(table).length;
      const pageCount = Math.max(1, Math.ceil(total / PAGE_SIZE));
      if (state.page < pageCount) {
        state.page += 1;
        apply(table, false);
      }
    });

    return state;
  }

  function eligibleRows(table) {
    return bodyRows(table).filter(function (row) {
      if (!hasActualData(row)) return false;
      const semanticHidden = row.dataset.searchHidden === 'true' || row.dataset.filterHidden === 'true' || row.dataset.segmentHidden === 'true';
      const displayHidden = row.style.display === 'none';
      return !semanticHidden && !displayHidden;
    });
  }

  function renderPageButtons(table, pageCount) {
    const state = getState(table);
    state.pages.replaceChildren();

    const candidates = [];
    if (pageCount <= 7) {
      for (let i = 1; i <= pageCount; i += 1) candidates.push(i);
    } else {
      candidates.push(1);
      if (state.page > 4) candidates.push('…');
      const start = Math.max(2, state.page - 1);
      const end = Math.min(pageCount - 1, state.page + 1);
      for (let i = start; i <= end; i += 1) candidates.push(i);
      if (state.page < pageCount - 3) candidates.push('…');
      candidates.push(pageCount);
    }

    candidates.forEach(function (candidate) {
      if (candidate === '…') {
        const ellipsis = document.createElement('span');
        ellipsis.className = 'cerillo-page-ellipsis';
        ellipsis.textContent = '…';
        state.pages.appendChild(ellipsis);
        return;
      }
      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'cerillo-page-btn cerillo-page-number';
      button.textContent = String(candidate);
      button.setAttribute('aria-label', `Go to page ${candidate}`);
      if (candidate === state.page) {
        button.classList.add('active');
        button.setAttribute('aria-current', 'page');
      }
      button.addEventListener('click', function () {
        state.page = candidate;
        apply(table, false);
      });
      state.pages.appendChild(button);
    });
  }

  function apply(table, captureBase) {
    if (!isModuleTable(table)) return;
    const state = ensurePager(table);
    const allRows = bodyRows(table);
    const eligible = eligibleRows(table);
    const pageCount = Math.max(1, Math.ceil(eligible.length / PAGE_SIZE));
    if (state.page > pageCount) state.page = pageCount;
    if (state.page < 1) state.page = 1;

    const start = (state.page - 1) * PAGE_SIZE;
    const end = start + PAGE_SIZE;
    const pageRows = new Set(eligible.slice(start, end));

    allRows.forEach(function (row) {
      const stateHidden = row.dataset.searchHidden === 'true' || row.dataset.filterHidden === 'true' || row.dataset.segmentHidden === 'true' || row.style.display === 'none';
      const pageHidden = hasActualData(row) && !pageRows.has(row);
      row.dataset.paginationHidden = pageHidden ? 'true' : 'false';
      row.hidden = stateHidden || pageHidden;
    });

    const visibleStart = eligible.length ? start + 1 : 0;
    const visibleEnd = Math.min(end, eligible.length);
    state.info.textContent = eligible.length
      ? `Showing ${visibleStart}–${visibleEnd} of ${eligible.length} records · 10 per page`
      : 'No matching records';

    state.pager.hidden = eligible.length <= PAGE_SIZE;
    state.prev.disabled = state.page <= 1;
    state.next.disabled = state.page >= pageCount;
    renderPageButtons(table, pageCount);
  }

  function tableFromControl(control) {
    const tableId = control?.dataset?.tableSearch || control?.dataset?.tableSort || control?.dataset?.tableDateFilter || control?.dataset?.tableStatusFilter || control?.dataset?.patientSegmentFor || control?.dataset?.patientProcedureFor;
    if (tableId) return document.getElementById(tableId);
    const filter = control?.closest?.('.filter-popover[data-filter-for]');
    return filter ? document.getElementById(filter.dataset.filterFor) : null;
  }

  function refreshAll(captureBase) {
    document.querySelectorAll('table').forEach(function (table) {
      if (!isModuleTable(table)) return;
      if (!table.id) table.id = `cerillo-auto-table-${++autoId}`;
      apply(table, captureBase);
    });
  }

  function scheduleFor(table, resetPage, captureBase) {
    if (!table || !isModuleTable(table)) return;
    window.setTimeout(function () {
      const state = getState(table);
      if (resetPage) state.page = 1;
      apply(table, captureBase);
    }, 0);
  }

  document.addEventListener('input', function (event) {
    const control = event.target.closest('[data-table-search], [data-table-date-filter], [data-filter-query], [data-filter-date], [data-filter-start-date], [data-filter-end-date]');
    if (!control) return;
    scheduleFor(tableFromControl(control), true, true);
  });

  document.addEventListener('change', function (event) {
    const control = event.target.closest('[data-table-sort], [data-table-date-filter], [data-table-status-filter], [data-patient-segment-for], [data-patient-procedure-for], [data-filter-status], [data-filter-date], [data-filter-start-date], [data-filter-end-date]');
    if (!control) return;
    const table = tableFromControl(control);
    scheduleFor(table, control.matches('[data-table-sort]') ? false : true, control.matches('[data-table-sort]') ? false : true);
  });

  document.addEventListener('click', function (event) {
    const filterButton = event.target.closest('[data-filter-apply], [data-filter-reset]');
    if (!filterButton) return;
    scheduleFor(tableFromControl(filterButton), true, true);
  });

  const observer = new MutationObserver(function (mutations) {
    const affected = new Set();
    mutations.forEach(function (mutation) {
      if (mutation.type !== 'childList') return;
      const table = mutation.target.closest?.('table');
      if (table && isModuleTable(table)) affected.add(table);
      mutation.addedNodes.forEach(function (node) {
        if (!(node instanceof Element)) return;
        if (node.matches('table') && isModuleTable(node)) affected.add(node);
        node.querySelectorAll?.('table').forEach(function (nestedTable) {
          if (isModuleTable(nestedTable)) affected.add(nestedTable);
        });
      });
    });
    affected.forEach(function (table) { scheduleFor(table, false, true); });
  });

  function init() {
    refreshAll(true);
    observer.observe(document.body, { childList: true, subtree: true });
    window.CerilloPagination = {
      pageSize: PAGE_SIZE,
      refreshTable: function (tableOrId, reset) {
        const table = typeof tableOrId === 'string' ? document.getElementById(tableOrId) : tableOrId;
        if (!table) return;
        scheduleFor(table, reset !== false, true);
      },
      refreshAll: function () { refreshAll(true); }
    };
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
