(function () {
  'use strict';

  function initWorkspaceNavigation() {
    const sidebar = document.querySelector('.workspace-sidebar');
    const topbar = document.querySelector('.workspace-topbar');
    if (!sidebar || !topbar || document.getElementById('cerilloMobileNavToggle')) return;

    sidebar.id = sidebar.id || 'cerilloWorkspaceSidebar';

    const toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.id = 'cerilloMobileNavToggle';
    toggle.className = 'cerillo-mobile-nav-toggle';
    toggle.setAttribute('aria-label', 'Open workspace navigation');
    toggle.setAttribute('aria-controls', sidebar.id);
    toggle.setAttribute('aria-expanded', 'false');
    toggle.innerHTML = '<span aria-hidden="true">☰</span><span>Menu</span>';

    const backdrop = document.createElement('button');
    backdrop.type = 'button';
    backdrop.className = 'cerillo-sidebar-backdrop';
    backdrop.setAttribute('aria-label', 'Close workspace navigation');
    backdrop.hidden = true;

    topbar.prepend(toggle);
    document.body.append(backdrop);

    function setOpen(open) {
      sidebar.classList.toggle('cerillo-sidebar-open', open);
      document.body.classList.toggle('cerillo-nav-open', open);
      toggle.setAttribute('aria-expanded', String(open));
      toggle.setAttribute('aria-label', open ? 'Close workspace navigation' : 'Open workspace navigation');
      backdrop.hidden = !open;
    }

    toggle.addEventListener('click', function () {
      setOpen(!sidebar.classList.contains('cerillo-sidebar-open'));
    });
    backdrop.addEventListener('click', function () { setOpen(false); });
    sidebar.addEventListener('click', function (event) {
      if (event.target.closest('.side-link') && window.matchMedia('(max-width: 860px)').matches) setOpen(false);
    });
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') setOpen(false);
    });
    window.addEventListener('resize', function () {
      if (!window.matchMedia('(max-width: 860px)').matches) setOpen(false);
    });
  }

  function keepDialogsInsideViewport() {
    document.querySelectorAll('dialog.modal').forEach(function (dialog) {
      dialog.addEventListener('show', function () {
        dialog.scrollTop = 0;
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      initWorkspaceNavigation();
      keepDialogsInsideViewport();
    });
  } else {
    initWorkspaceNavigation();
    keepDialogsInsideViewport();
  }
})();
