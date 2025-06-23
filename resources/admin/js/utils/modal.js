import { config } from '../config/config';

const timeouts = {};
const keyupHandlers = {};

function openModal(id, onOpen, sourceEl) {
  const modalEl = getModal(id);

  document.body.classList.add('block-scroll');
  modalEl.classList.add('-open', '-show');

  if (timeouts[`closeModal-${id}`]) {
    clearTimeout(timeouts[`closeModal-${id}`]);
  }

  onOpen?.(modalEl, sourceEl);

  const modalOnOpenData = modalEl.querySelector('[data-modal-content]')?.dataset?.onOpen;
  if (modalOnOpenData && typeof modalOnOpenData === 'function') {
    modalOnOpenData(modalEl, sourceEl);
  }

  requestAnimationFrame(() => {
    modalEl.classList.add('-animate');
  });

  // Escape key close
  const keyupHandler = (ev) => {
    if (ev.key === "Escape") {
      closeModal(id);
    }
  };

  keyupHandlers[id] = keyupHandler;
  document.addEventListener('keyup', keyupHandler);

  return modalEl;
}

function closeModal(id, onClose, onCloseComplete) {
  const modalEl = getModal(id);

  if (!modalEl.classList.contains('-open')) return;
  if (modalEl.dataset.blockClosing === 'true') return;

  document.body.classList.remove('block-scroll');
  modalEl.classList.remove('-open', '-animate');

  onClose?.(modalEl);

  timeouts[`closeModal-${id}`] = setTimeout(() => {
    modalEl.classList.remove('-show');
    onCloseComplete?.();
  }, config.defaultTransitionSpeed);

  // Remove keyup listener
  if (keyupHandlers[id]) {
    document.removeEventListener('keyup', keyupHandlers[id]);
    delete keyupHandlers[id];
  }

  return modalEl;
}

function getModal(id) {
  let modalEl = document.querySelector(`.modal__wrapper[data-id="${id}"]`);

  if (modalEl) {
    return modalEl;
  }

  // Create wrapper
  modalEl = document.createElement('div');
  modalEl.classList.add('modal__wrapper');
  modalEl.dataset.id = id;

  modalEl.addEventListener('click', (ev) => {
    if (!ev.target.closest('.modal__content-container')) {
      closeModal(id);
    }
  });

  document.body.appendChild(modalEl);

  // Create structure
  const containerEl = document.createElement('div');
  containerEl.classList.add('modal__container');
  modalEl.appendChild(containerEl);

  const contentContainerEl = document.createElement('div');
  contentContainerEl.classList.add('modal__content-container');
  containerEl.appendChild(contentContainerEl);

  const closeButtonEl = document.createElement('div');
  closeButtonEl.classList.add('modal__close-button');
  closeButtonEl.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
      <path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/>
    </svg>`;
  closeButtonEl.addEventListener('click', () => closeModal(id));
  contentContainerEl.appendChild(closeButtonEl);

  const contentEl = document.createElement('div');
  contentEl.classList.add('modal__content');
  contentContainerEl.appendChild(contentEl);

  const sourceContent = document.querySelector(`[data-modal-content="${id}"]`);
  if (sourceContent) {
    contentEl.appendChild(sourceContent);
  }

  return modalEl;
}

function disableClosingModal(id) {
  const modalEl = document.querySelector(`.modal__wrapper[data-id="${id}"]`);
  if (modalEl) modalEl.dataset.blockClosing = 'true';
}

function enableClosingModal(id) {
  const modalEl = document.querySelector(`.modal__wrapper[data-id="${id}"]`);
  if (modalEl) modalEl.dataset.blockClosing = 'false';
}

function confirmModal(data) {
  const {
    title,
    description,
    cancelButtonText,
    submitButtonText,
    cancelCallback,
    submitCallback
  } = data;

  const modalId = 'confirm';

  function onOpen() {
    document.querySelectorAll(`[data-modal-content="${modalId}"]`).forEach(el => el.remove());

    const containerEl = document.createElement('div');
    containerEl.classList.add('confirm-modal-container');
    containerEl.dataset.modalContent = modalId;

    const titleEl = document.createElement('div');
    titleEl.classList.add('confirm-modal-title');
    titleEl.innerHTML = title;
    containerEl.appendChild(titleEl);

    const descEl = document.createElement('div');
    descEl.classList.add('confirm-modal-description');
    descEl.innerHTML = description;
    containerEl.appendChild(descEl);

    const footerEl = document.createElement('div');
    footerEl.classList.add('confirm-modal-footer');

    const cancelBtn = document.createElement('button');
    cancelBtn.classList.add('confirm-modal-button', 'button', '-v2', '-small', '-secondary', '-cancel');
    cancelBtn.innerHTML = `<span>${cancelButtonText}</span>`;
    cancelBtn.addEventListener('click', () => {
      closeConfirmModal();
      cancelCallback?.();
    });

    const submitBtn = document.createElement('button');
    submitBtn.classList.add('confirm-modal-button', 'button', '-v2', '-primary', '-small', '-submit');
    submitBtn.innerHTML = `<span>${submitButtonText}</span><em></em><u></u>`;
    submitBtn.addEventListener('click', () => {
      submitCallback?.(containerEl);
    });

    footerEl.appendChild(cancelBtn);
    footerEl.appendChild(submitBtn);
    containerEl.appendChild(footerEl);

    document.querySelector(`.modal__wrapper[data-id="${modalId}"] .modal__content`).appendChild(containerEl);
  }

  openModal(modalId, onOpen);
}

function closeConfirmModal(onClose, onCloseComplete) {
  const modalId = 'confirm';
  closeModal(modalId, onClose, onCloseComplete);
}

export {
  openModal,
  closeModal,
  disableClosingModal,
  enableClosingModal,
  confirmModal,
  closeConfirmModal
};
