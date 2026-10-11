(function () {
  'use strict';

  function digits(value) {
    return String(value == null ? '' : value).replace(/\D+/g, '');
  }

  function normalizePhone(value) {
    let valueDigits = digits(value);
    if (!valueDigits) return '';
    if (valueDigits.length === 12 && valueDigits.startsWith('63')) valueDigits = valueDigits.slice(2);
    else if (valueDigits.length === 11 && valueDigits.startsWith('09')) valueDigits = valueDigits.slice(1);
    return valueDigits;
  }

  function phone(value, fallback) {
    const normalized = normalizePhone(value);
    if (/^9\d{9}$/.test(normalized)) {
      return `+63 ${normalized.slice(0, 3)} ${normalized.slice(3, 6)} ${normalized.slice(6, 10)}`;
    }
    return String(value || fallback || '—');
  }

  function patientCode(value, id, year) {
    const candidate = String(value || '').trim().toUpperCase();
    if (/^PT-\d{4}-\d{4,}$/.test(candidate)) return candidate;
    const safeYear = String(year || new Date().getFullYear());
    const numericId = Number(id);
    if (Number.isFinite(numericId) && numericId > 0) {
      return `PT-${safeYear}-${String(Math.trunc(numericId)).padStart(4, '0')}`;
    }
    return candidate || `PT-${safeYear}-0000`;
  }

  window.CerilloFormat = Object.freeze({ normalizePhone, phone, patientCode });
})();
