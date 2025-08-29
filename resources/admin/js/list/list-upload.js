import { apiFetch } from '../services/api-fetch';
import { attachDragDrop } from '../utils/drag-drop';

export function initListUpload() {
  const buttonsEl = document.querySelectorAll('[data-list-upload]');
  if (!buttonsEl.length) return;

  buttonsEl.forEach(buttonEl => {
    if (buttonEl._listUploadEventAdded) return;
    buttonEl._listUploadEventAdded = true;

    // List wrapper
    const listId = buttonEl.getAttribute('data-list-upload');
    const listWrapperEl = document.querySelector(`[data-list="${listId}"]`);

    if (!listWrapperEl) {
      console.error('Target element not found.');
      return;
    }

    // Attach drag & drop
    attachDragDrop(listWrapperEl, {
      onDrop: files => {
        if (!files.length) return;
        uploadFiles(files, listWrapperEl);
      },
    });

    buttonEl.addEventListener('click', function (e) {
      e.preventDefault();

      // Hidden file input
      const input = document.createElement('input');
      input.type = 'file';
      input.multiple = true;

      // Change event
      input.onchange = function () {
        const files = Array.from(input.files);
        if (!files.length) return;
        uploadFiles(files, listWrapperEl);
      };

      input.click();
    });
  });
}

/**
 * Upload files to list
 */
function uploadFiles(files, listWrapperEl) {
  // Ensure main container exists
  let container = document.getElementById('upload-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'upload-container';
    container.className = 'upload-container';
    listWrapperEl.prepend(container);
  }

  // Get list service
  const listService = listWrapperEl._listService;

  // Upload files
  files.forEach(file => {
    // Unique container ID per file
    const containerId = `upload-${crypto.randomUUID()}`;
    if (document.getElementById(containerId)) return;

    const item = document.createElement('div');
    item.id = containerId;
    item.className = 'upload-item';
    item.innerHTML = `
        <div class="upload-filename">${file.name}</div>
        <div class="upload-progress">
          <div class="upload-bar" style="width:0%"></div>
        </div>
      `;
    container.prepend(item);

    // Upload request
    const formData = new FormData();
    formData.append('file', file);

    apiFetch({
      url: '/admin/api/media-upload',
      method: 'POST',
      data: formData,
      isUpload: true,
      progress: percent => {
        item.querySelector('.upload-bar').style.width = percent + '%';
      },
      success: response => {
        if (response.success) {
          item.classList.add('upload-success');
          if (response.listData) {
            listService.listData = response.listData;
            listService.render();
          }
        } else {
          item.classList.add('upload-error');
        }
      },
      error: xhr => {
        networkError(xhr);
      },
    });
  });
}
