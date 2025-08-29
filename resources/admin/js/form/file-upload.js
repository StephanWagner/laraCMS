import { apiFetch } from '../services/api-fetch';
import { generateUUID } from '../utils/uuid';

export function initFileUpload() {
  const buttonsEl = document.querySelectorAll('[data-upload-file], [data-upload-files]');
  if (!buttonsEl.length) return;

  buttonsEl.forEach(buttonEl => {
    if (buttonEl._uploadEventAdded) return;

    buttonEl.addEventListener('click', function (e) {
      e.preventDefault();

      // Single vs multiple
      const attributeName = buttonEl.hasAttribute('data-upload-files')
        ? 'data-upload-files'
        : 'data-upload-file';
      const multiple = attributeName === 'data-upload-files';
      const target = buttonEl.getAttribute(attributeName);

      // Target element for preview
      let targetEl = null;
      if (target == 'content') {
        targetEl = document.querySelector('.content__content');
      } else {
        targetEl = document.querySelector(target);
      }

      // Hidden file input
      const input = document.createElement('input');
      input.type = 'file';
      if (multiple) input.multiple = true;

      // Change event
      input.onchange = function () {
        const files = Array.from(input.files);
        if (!files.length) return;

        // Preview
        if (targetEl) {
          targetEl.innerHTML = '';

          // Upload
          files.forEach(file => {
            // Check if container already exists
            const containerId = `upload-${generateUUID}`;
            if (document.getElementById(containerId)) return;

            const container = document.createElement('div');
            container.id = containerId;
            container.className = 'upload-item';
            container.innerHTML = `
          <div class="upload-filename">${file.name}</div>
          <div class="upload-progress">
            <div class="upload-bar" style="width:0%"></div>
          </div>
        `;
            targetEl.prepend(container);

            // Upload request
            const formData = new FormData();
            formData.append('file', file);

            apiFetch({
              url: '/admin/api/upload',
              method: 'POST',
              data: formData,
              isUpload: true,
              progress: percent => {
                container.querySelector('.upload-bar').style.width = percent + '%';
              },
              success: res => {
                container.classList.add('upload-success');
                console.log('Uploaded:', res);
              },
              error: () => {
                container.classList.add('upload-error');
              },
            });
          });
        }
      };

      input.click();
    });
  });
}
