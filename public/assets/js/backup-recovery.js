/**
 * Cerillo Dental Clinic - Backup and Recovery Client Module
 * Provides administration and head dentist tooling to create, download, maintain, and restore clinic records.
 */
(() => {
  const getCsrfToken = () => {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  };

  let pendingRestoreFilename = null;

  const modal = document.getElementById('backupRecoveryModal');
  const confirmModal = document.getElementById('backupRestoreConfirmModal');
  const openBtn = document.getElementById('openBackupModalBtn');
  const refreshBtn = document.getElementById('refreshBackupsListBtn');
  const createForm = document.getElementById('createBackupForm');
  const quickRestoreForm = document.getElementById('quickSnapshotRestoreForm');
  const uploadForm = document.getElementById('uploadRestoreBackupForm');
  const toggleUploadBtn = document.getElementById('toggleUploadFormBtn');
  const executeRestoreBtn = document.getElementById('executeRestoreConfirmedBtn');

  if (!modal) return;

  // Open modal handler
  if (openBtn) {
    openBtn.addEventListener('click', (e) => {
      e.preventDefault();
      if (typeof modal.showModal === 'function') {
        modal.showModal();
      } else {
        modal.setAttribute('open', '');
      }
      loadBackups();
    });
  }

  if (refreshBtn) {
    refreshBtn.addEventListener('click', (e) => {
      e.preventDefault();
      loadBackups();
    });
  }

  if (toggleUploadBtn) {
    toggleUploadBtn.addEventListener('click', (e) => {
      e.preventDefault();
      if (uploadForm) {
        const isHidden = uploadForm.style.display === 'none' || !uploadForm.style.display;
        uploadForm.style.display = isHidden ? 'block' : 'none';
        toggleUploadBtn.textContent = isHidden ? 'Hide File Upload' : 'Upload External File Instead';
      }
    });
  }

  // Load backups list and system stats from server
  async function loadBackups() {
    const tableBody = document.getElementById('backupsTableBody');
    if (!tableBody) return;

    tableBody.innerHTML = `
      <tr>
        <td colspan="5" style="text-align: center; padding: 24px; color: #64748b;">
          <span style="display: inline-block; animation: spin 1s linear infinite; margin-right: 6px;">⟳</span>
          Scanning backup snapshots...
        </td>
      </tr>
    `;

    try {
      const res = await fetch('/api/backups', {
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': getCsrfToken()
        }
      });

      if (!res.ok) {
        throw new Error(`Failed to load backups (HTTP ${res.status})`);
      }

      const data = await res.json();
      renderStats(data);
      renderTable(data.backups || []);
    } catch (err) {
      console.error('Error fetching backups:', err);
      tableBody.innerHTML = `
        <tr>
          <td colspan="5" style="text-align: center; padding: 24px; color: #dc2626;">
            Failed to load backups: ${escapeHtml(err.message)}
          </td>
        </tr>
      `;
    }
  }

  function renderStats(data) {
    const totalRecordsEl = document.getElementById('backupTotalRecordsCount');
    const snapshotsCountEl = document.getElementById('backupSnapshotsCount');
    const storageSizeEl = document.getElementById('backupStorageSize');
    const latestDateEl = document.getElementById('backupLatestDate');
    const latestByEl = document.getElementById('backupLatestBy');

    if (totalRecordsEl) {
      totalRecordsEl.textContent = (data.system_stats?.total_records || 0).toLocaleString();
    }
    if (snapshotsCountEl) {
      snapshotsCountEl.textContent = (data.total_backups || 0).toLocaleString();
    }
    if (storageSizeEl) {
      storageSizeEl.textContent = `${data.total_storage_size || '0 B'} storage space used`;
    }
    if (latestDateEl) {
      latestDateEl.textContent = data.latest_backup ? data.latest_backup.created_at_formatted : 'None yet';
    }
    if (latestByEl) {
      latestByEl.textContent = data.latest_backup ? `By: ${data.latest_backup.created_by}` : 'No backups on file';
    }
  }

  function renderTable(backups) {
    const tableBody = document.getElementById('backupsTableBody');
    const dropdown = document.getElementById('snapshotSelectDropdown');

    // Populate quick restore dropdown
    if (dropdown) {
      if (!backups.length) {
        dropdown.innerHTML = '<option value="">-- No snapshots created yet --</option>';
      } else {
        dropdown.innerHTML = '<option value="">-- Choose a snapshot from the list below --</option>' +
          backups.map(b => {
            const label = `${b.created_at_formatted} — ${b.notes || 'Snapshot'} (${b.total_records} records)`;
            return `<option value="${escapeHtml(b.filename)}">${escapeHtml(label)}</option>`;
          }).join('');
      }
    }

    if (!tableBody) return;

    if (!backups.length) {
      tableBody.innerHTML = `
        <tr>
          <td colspan="5" style="text-align: center; padding: 36px 20px; color: #64748b;">
            <div style="font-size: 24px; margin-bottom: 8px;">📁</div>
            <strong style="display: block; color: #334155; margin-bottom: 4px;">No Backup Snapshots Available</strong>
            <span>Use the "Create New Backup" panel above to save a snapshot of all clinic records.</span>
          </td>
        </tr>
      `;
      return;
    }

    tableBody.innerHTML = backups.map(b => {
      const isSafety = b.is_safety_snapshot;
      const badgeHtml = isSafety 
        ? `<span style="display: inline-block; font-size: 10px; font-weight: 700; text-transform: uppercase; padding: 2px 6px; border-radius: 4px; background: #fef3c7; color: #92400e; white-space: nowrap;">Auto Safety Rollback</span>`
        : `<span style="display: inline-block; font-size: 10px; font-weight: 700; text-transform: uppercase; padding: 2px 6px; border-radius: 4px; background: #e0e7ff; color: #3730a3; white-space: nowrap;">Manual Backup</span>`;

      // Clean title & notes to prevent long string collisions
      let title = isSafety ? 'Safety Rollback Snapshot' : (b.notes || 'Manual Clinic Backup');
      let note = '';
      if (isSafety) {
        note = 'Automated pre-restoration rollback snapshot';
      } else if (b.notes && b.notes !== title) {
        note = b.notes;
      }

      return `
        <tr style="border-bottom: 1px solid #f1f5f9;">
          <td class="backup-snapshot-cell">
            <div style="font-weight: 700; color: #0f172a; display: flex; align-items: center; flex-wrap: wrap; gap: 6px; margin-bottom: 3px;">
              <span>${escapeHtml(title)}</span>
              ${badgeHtml}
            </div>
            <code class="backup-filename-code">${escapeHtml(b.filename)}</code>
            ${note ? `<div class="backup-notes-text">${escapeHtml(note)}</div>` : ''}
          </td>
          <td style="padding: 12px 14px; vertical-align: middle; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <div style="font-weight: 600; color: #334155;">${escapeHtml(b.created_at_formatted)}</div>
            <small style="color: #64748b;">By: ${escapeHtml(b.created_by)}</small>
          </td>
          <td style="padding: 12px 14px; vertical-align: middle; white-space: nowrap;">
            <strong style="color: #0f172a; font-size: 14px;">${(b.total_records || 0).toLocaleString()}</strong>
            <span style="font-size: 11px; color: #64748b; display: block;">records</span>
          </td>
          <td style="padding: 12px 14px; vertical-align: middle; color: #475569; font-variant-numeric: tabular-nums; white-space: nowrap;">
            ${escapeHtml(b.file_size)}
          </td>
          <td style="padding: 12px 14px; vertical-align: middle; text-align: right; white-space: nowrap;">
            <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 6px; width: 100%;">
              <button type="button" class="btn primary sm restore-backup-btn" data-filename="${escapeHtml(b.filename)}" style="padding: 6px 12px; font-size: 12px; font-weight: 700; background: #2563eb; color: #ffffff; border-radius: 6px; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; box-shadow: 0 1px 3px rgba(37,99,235,0.3);" title="Restore clinic records from this snapshot">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                  <path d="M21 3v5h-5"></path>
                  <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                  <path d="M8 16H3v5"></path>
                </svg>
                <span>Restore</span>
              </button>
              <a href="/api/backups/${encodeURIComponent(b.filename)}/download" class="btn secondary sm" style="padding: 6px 10px; font-size: 12px; text-decoration: none;" title="Download backup archive file">
                Download
              </a>
              <button type="button" class="btn secondary sm delete-backup-btn" data-filename="${escapeHtml(b.filename)}" style="padding: 6px 8px; font-size: 12px; color: #dc2626;" title="Delete backup file">
                ✕
              </button>
            </div>
          </td>
        </tr>
      `;
    }).join('');

    // Attach row events
    tableBody.querySelectorAll('.restore-backup-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const filename = btn.getAttribute('data-filename');
        promptRestore(filename);
      });
    });

    tableBody.querySelectorAll('.delete-backup-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const filename = btn.getAttribute('data-filename');
        confirmDelete(filename);
      });
    });
  }

  // Create Backup Form Submission
  if (createForm) {
    createForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const submitBtn = document.getElementById('createBackupSubmitBtn');
      const notesInput = document.getElementById('backupNotesInput');
      const originalText = submitBtn ? submitBtn.innerHTML : '';

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span>Saving Backup...</span>`;
      }

      try {
        const notes = notesInput ? notesInput.value.trim() : '';
        const res = await fetch('/api/backups', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCsrfToken()
          },
          body: JSON.stringify({ notes })
        });

        const data = await res.json();
        if (!res.ok) {
          throw new Error(data.message || `Failed to create backup (HTTP ${res.status})`);
        }

        if (notesInput) notesInput.value = '';
        alert(`Backup Created Successfully!\n\nArchive: ${data.filename}\nRecords Protected: ${data.total_records.toLocaleString()}`);
        loadBackups();
      } catch (err) {
        alert('Could not create backup: ' + err.message);
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
      }
    });
  }

  // Quick Snapshot Restore Form Submission (Dropdown)
  if (quickRestoreForm) {
    quickRestoreForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const dropdown = document.getElementById('snapshotSelectDropdown');
      const filename = dropdown ? dropdown.value : null;

      if (!filename) {
        alert('Please select a saved snapshot from the dropdown list first.');
        return;
      }

      promptRestore(filename);
    });
  }

  // Upload & Restore Form Submission
  if (uploadForm) {
    uploadForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const fileInput = document.getElementById('backupFileInput');
      const submitBtn = document.getElementById('uploadRestoreSubmitBtn');

      if (!fileInput || !fileInput.files.length) {
        alert('Please choose a valid JSON backup archive file.');
        return;
      }

      const file = fileInput.files[0];
      if (!confirm(`Warning: Restoring will overwrite existing clinical and patient database records with the contents of "${file.name}".\n\nAn automated safety backup will be created beforehand.\n\nDo you wish to proceed?`)) {
        return;
      }

      const originalText = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span>Restoring Clinic Records...</span>`;
      }

      const formData = new FormData();
      formData.append('backup_file', file);

      try {
        const res = await fetch('/api/backups/restore', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCsrfToken()
          },
          body: formData
        });

        const data = await res.json();
        if (!res.ok) {
          throw new Error(data.message || `Restoration failed (HTTP ${res.status})`);
        }

        alert(`Restoration Successful!\n\nSource: ${data.source}\nTotal Records Restored: ${data.total_restored.toLocaleString()}\nSafety Snapshot Created: ${data.safety_snapshot}\n\nThe page will now refresh to display the updated data.`);
        fileInput.value = '';
        window.location.reload();
      } catch (err) {
        alert('Error during restoration: ' + err.message);
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
      }
    });
  }

  // Open Restore Confirmation Modal for an existing backup
  function promptRestore(filename) {
    pendingRestoreFilename = filename;
    const targetText = document.getElementById('restoreTargetFilenameText');
    if (targetText) {
      targetText.textContent = filename;
    }

    if (confirmModal) {
      if (typeof confirmModal.showModal === 'function') {
        confirmModal.showModal();
      } else {
        confirmModal.setAttribute('open', '');
      }
    } else {
      if (confirm(`Restore records from snapshot "${filename}"? Live records will be overwritten. An automatic safety snapshot will be created first.`)) {
        executeRestore(filename);
      }
    }
  }

  // Execute Confirmed Restore
  if (executeRestoreBtn) {
    executeRestoreBtn.addEventListener('click', async () => {
      if (!pendingRestoreFilename) return;
      executeRestore(pendingRestoreFilename);
    });
  }

  async function executeRestore(filename) {
    if (executeRestoreBtn) {
      executeRestoreBtn.disabled = true;
      executeRestoreBtn.textContent = 'Restoring Records...';
    }

    try {
      const res = await fetch('/api/backups/restore', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify({ filename })
      });

      const data = await res.json();
      if (!res.ok) {
        throw new Error(data.message || `Restoration failed (HTTP ${res.status})`);
      }

      if (confirmModal && typeof confirmModal.close === 'function') {
        confirmModal.close();
      }

      alert(`Restoration Successful!\n\nSnapshot: ${data.source}\nTotal Records Restored: ${data.total_restored.toLocaleString()}\nSafety Snapshot Created: ${data.safety_snapshot}\n\nThe page will now refresh.`);
      window.location.reload();
    } catch (err) {
      alert('Error during restore: ' + err.message);
    } finally {
      if (executeRestoreBtn) {
        executeRestoreBtn.disabled = false;
        executeRestoreBtn.textContent = 'Yes, Restore Clinic Records';
      }
    }
  }

  // Delete Backup
  async function confirmDelete(filename) {
    if (!confirm(`Are you sure you want to permanently delete the backup archive:\n\n"${filename}"?\n\nThis cannot be undone.`)) {
      return;
    }

    try {
      const res = await fetch(`/api/backups/${encodeURIComponent(filename)}`, {
        method: 'DELETE',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': getCsrfToken()
        }
      });

      const data = await res.json();
      if (!res.ok) {
        throw new Error(data.message || `Failed to delete backup (HTTP ${res.status})`);
      }

      loadBackups();
    } catch (err) {
      alert('Could not delete backup: ' + err.message);
    }
  }

  function escapeHtml(str) {
    if (!str) return '';
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }
})();
