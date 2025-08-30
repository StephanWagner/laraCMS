import { apiFetch } from '../services/api-fetch';
import { attachDragDrop } from '../utils/drag-drop';
import { getFilePreviewFromFileInput } from '../utils/file-icon';

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
      console.warn('Target element not found.');
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
  let wrapperEl = listWrapperEl.querySelector('.upload-progress__wrapper');
  if (!wrapperEl) {
    wrapperEl = document.createElement('div');
    wrapperEl.className = 'upload-progress__wrapper';
    listWrapperEl.prepend(wrapperEl);
  }

  // Get list service
  const listService = listWrapperEl._listService;

  // Upload files
  files.forEach(file => {
    const itemContainerEl = document.createElement('div');
    itemContainerEl.className = 'upload-progress__item-container';
    wrapperEl.prepend(itemContainerEl);

    const itemEl = document.createElement('div');
    itemEl.className = 'upload-progress__item';
    itemContainerEl.appendChild(itemEl);

    const itemPreviewEl = document.createElement('div');
    itemPreviewEl.className = 'upload-progress__preview';

    const itemPreviewIconEl = getFilePreviewFromFileInput(file);
    itemEl.appendChild(itemPreviewIconEl);

    const itemContentEl = document.createElement('div');
    itemContentEl.className = 'upload-progress__content';
    itemEl.appendChild(itemContentEl);

    const itemTextContainerEl = document.createElement('div');
    itemTextContainerEl.className = 'upload-progress__text-container';
    itemContentEl.appendChild(itemTextContainerEl);

    const itemTextEl = document.createElement('div');
    itemTextEl.className = 'upload-progress__text';
    itemTextEl.innerHTML = '<div class="upload-progress__filename">' + file.name + '</div>';
    itemTextContainerEl.appendChild(itemTextEl);

    const itemStatusEl = document.createElement('div');
    itemStatusEl.className = 'upload-progress__status';
    itemStatusEl.innerHTML = '0%';
    itemTextContainerEl.appendChild(itemStatusEl);

    const itemProgressBarContainerEl = document.createElement('div');
    itemProgressBarContainerEl.className = 'upload-progress__bar-container';
    itemContentEl.appendChild(itemProgressBarContainerEl);

    const itemProgressBarEl = document.createElement('div');
    itemProgressBarEl.className = 'upload-progress__bar';
    itemProgressBarEl.style.width = '0%';
    itemProgressBarContainerEl.appendChild(itemProgressBarEl);

    // Upload request
    const formData = new FormData();
    formData.append('file', file);

    apiFetch({
      url: '/admin/api/media-upload',
      method: 'POST',
      data: formData,
      isUpload: true,
      progress: percent => {
        itemProgressBarEl.style.width = Math.floor(percent) + '%';
        itemStatusEl.innerHTML = Math.floor(percent) + '%';
      },
      success: response => {
        if (response.success) {
          itemContainerEl.classList.add('-success');
          if (response.listData) {
            listService.listData = response.listData;
            listService.render();
          }
        } else {
          itemContainerEl.classList.add('-error');
          if (response.error) {
            const errorEl = document.createElement('div');
            errorEl.className = 'upload-progress__error';
            errorEl.innerHTML = response.error;
            itemTextEl.appendChild(errorEl);
          }
        }
      },
      error: xhr => {
        networkError(xhr);
      },
    });
  });
}
