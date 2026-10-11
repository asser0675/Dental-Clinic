(function () {
  'use strict';

  function initSettings() {
    document.querySelectorAll('#settings').forEach(section => {
      const darkToggle = section.querySelector('#darkModeToggle');
      const accessPanel = darkToggle?.closest('.panel');
      if (accessPanel) {
        accessPanel.classList.add('settings-reference-card', 'accessibility-settings-panel');
        if (!accessPanel.querySelector('.settings-save-row')) {
          const row = document.createElement('div');
          row.className = 'settings-save-row';
          row.innerHTML = '<button type="button" class="settings-save-btn">Save preferences</button><span class="settings-save-status" aria-live="polite"></span>';
          accessPanel.appendChild(row);
          const btn = row.querySelector('.settings-save-btn');
          const status = row.querySelector('.settings-save-status');
          btn?.addEventListener('click', () => {
            status.textContent = 'Preferences saved for this browser.';
            window.setTimeout(() => { status.textContent = ''; }, 2400);
          });
        }
      }

      const clinicForm = Array.from(section.querySelectorAll('form.panel')).find(form => form.querySelector('input, textarea, select'));
      if (clinicForm) clinicForm.classList.add('settings-reference-card', 'settings-clinic-card');
    });
  }

  document.addEventListener('DOMContentLoaded', initSettings);
  initSettings();
})();
