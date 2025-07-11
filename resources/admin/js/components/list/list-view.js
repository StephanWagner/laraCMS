import Sortable from 'sortablejs';
import { apiFetch } from '../../utils/api-fetch';
import { getNestedValue } from '../../utils/object';
import { formatDatetime } from '../../utils/datetime';
import { networkError, success } from '../../utils/message';
import { config } from '../../config/config';
import { confirmModal, closeConfirmModal } from '../../utils/modal';
import { debounce } from '../../utils/debounce';
import { textfield } from '../../form/input/textfield';
import { select } from '../../form/input/select';

export class ListView {
  constructor({ key, wrapper }) {
    if (!key || !wrapper) return;

    this.key = key;
    this.wrapper = wrapper;

    this.listData = window.listData || null;

    // TODO get list data then init

    this.init();
  }

  init() {
    // Container
    this.container = document.createElement('div');
    this.container.className = 'list__container';

    // Header
    const headerEl = document.createElement('div');
    headerEl.className = 'list-header__container';

    // Filters container
    const filtersContainerEl = document.createElement('div');
    filtersContainerEl.className = 'list-filters__container';
    headerEl.appendChild(filtersContainerEl);

    // Search
    const searchContainerEl = document.createElement('div');
    searchContainerEl.className = 'list-search__container';
    filtersContainerEl.appendChild(searchContainerEl);
    const searchInputContainerEl = textfield({
      name: 'list-search',
      size: 'small',
      icon: 'search',
    });
    searchContainerEl.appendChild(searchInputContainerEl);
    this.searchInputEl = searchInputContainerEl._inputEl;
    const handleSearch = debounce(() => {
      const searchTerm = this.searchInputEl.value.trim();
      this.listData.config.searchTerm = searchTerm;
      this.loadData();
    }, 300);
    this.searchInputEl.addEventListener('input', handleSearch);

    // Options container
    const optionsContainerEl = document.createElement('div');
    optionsContainerEl.className = 'list-options__container';
    headerEl.appendChild(optionsContainerEl);

    // Item amount
    this.itemsAmountContainerEl = document.createElement('div');
    this.itemsAmountContainerEl.className =
      'list-items-amount__container button -selectable -all no-select';
    optionsContainerEl.appendChild(this.itemsAmountContainerEl);
    this.itemsAmountContainerEl.addEventListener('click', () => {
      if (this.listData.config.trashed) {
        this.listData.config.trashed = false;
        this.listData.config.orderBy = null;
        this.listData.config.orderDirection = null;
        this.loadData({
          renderHeader: true,
        });
      }
    });

    this.trashItemsAmountContainerEl = document.createElement('div');
    this.trashItemsAmountContainerEl.className =
      'list-items-amount__container button -selectable -trashed no-select';
    optionsContainerEl.appendChild(this.trashItemsAmountContainerEl);
    this.trashItemsAmountContainerEl.addEventListener('click', () => {
      if (!this.listData.config.trashed) {
        this.listData.config.trashed = true;
        this.listData.config.orderBy = null;
        this.listData.config.orderDirection = null;
        this.loadData({
          renderHeader: true,
        });
      }
    });

    updateItemAmountButtons(
      this.itemsAmountContainerEl,
      this.trashItemsAmountContainerEl,
      this.listData
    );

    // Per-page
    const perPageContainerEl = document.createElement('div');
    perPageContainerEl.className = 'list-per-page__container';
    optionsContainerEl.appendChild(perPageContainerEl);

    const perPageSelectContainerEl = select({
      name: 'per-page',
      size: 'small',
      value: this.listData.config.perPage || this.listData.config.defaultPerPage || 25,
      options: [
        { value: '1', label: '1' },
        { value: '10', label: '10' },
        { value: '25', label: '25' },
        { value: '50', label: '50' },
        { value: '100', label: '100' },
      ],
      onChange: () => {
        const perPage = perPageSelectContainerEl._selectEl.value;
        this.listData.config.perPage = parseInt(perPage);
        this.loadData();
      },
    });
    perPageContainerEl.appendChild(perPageSelectContainerEl);

    // Content
    const contentEl = document.createElement('div');
    contentEl.className = 'list-content__container';

    this.contentHeader = document.createElement('div');
    this.contentHeader.className = 'list-content__header';
    contentEl.appendChild(this.contentHeader);

    this.contentItems = document.createElement('div');
    this.contentItems.className = 'list-content__items';
    contentEl.appendChild(this.contentItems);

    // Footer
    const footerEl = document.createElement('div');
    footerEl.className = 'list-footer__container';
    footerEl.innerHTML = 'FOOTER';

    this.container.appendChild(headerEl);
    this.container.appendChild(contentEl);
    this.container.appendChild(footerEl);
    this.wrapper.appendChild(this.container);

    this.render({
      renderHeader: true,
    });
  }

  loadData(params = {}) {
    if (this.loading) return false;

    const listConfig = this.listData?.config || {};

    apiFetch({
      url: '/admin/api/list',
      data: getListParams(params, listConfig),
      before: () => {
        this.loading = true;
        this.wrapper.classList.add('-loading');
      },
      complete: () => {
        this.loading = false;
        this.wrapper.classList.remove('-loading');
      },
      success: response => {
        if (response.success && response.listData) {
          this.listData = response.listData;
          this.render({
            renderHeader: params.renderHeader,
          });
        } else {
          networkError(response);
        }
      },
      error: xhr => {
        networkError(xhr);
      },
    });
  }

  render(params = {}) {
    console.log('listData', this.listData);

    // Config
    const listConfig = this.listData?.config || {};
    let listColumns = listConfig?.columns || [];
    const listItems = this.listData?.items?.data || [];
    const listTexts = this.listData?.texts || {};

    if (listConfig.trashed) {
      listColumns.unshift({
        key: 'multiselect',
        type: 'multiselect',
        label: null,
        allowTrashed: true,
      });

      listColumns.push({
        key: 'deleted-at',
        type: 'datetime',
        label: 'Deleted',
        allowTrashed: true,
        source: 'deleted_at',
        sortable: true,
      });

      listColumns.push({
        key: 'actions',
        type: 'actions',
        label: null,
        allowTrashed: true,
        actions: ['restore', 'force-delete'],
      });
    }

    // Head columns
    if (params.renderHeader) {
      this.contentHeader.innerHTML = '';

      listColumns.forEach(column => {
        if (listConfig.trashed && !column.allowTrashed && column.type !== 'title') {
          return;
        }

        const columnEl = document.createElement('div');
        columnEl.classList.add('list__column', '-head', '-type-' + column.type);

        if (column.visibility) {
          Object.entries(column.visibility).forEach(([breakpoint, isVisible]) => {
            if (isVisible === false) {
              columnEl.classList.add(`-hide-${breakpoint}`);
            }
          });
        }

        if (listConfig.orderBy == column.source) {
          columnEl.classList.add('-current-order');
        }

        if (column.label) {
          const columnLabelEl = document.createElement('div');
          columnLabelEl.innerHTML = resolveText(listTexts, column.label);
          columnEl.append(columnLabelEl);
        }

        if (column.type == 'multiselect') {
          columnEl.classList.add('no-select');
          const columnMultiselectIconEl = document.createElement('div');
          columnMultiselectIconEl.classList.add('list__multiselect-icon', 'icon');
          columnMultiselectIconEl.innerHTML = 'check_box_outline_blank';
          columnEl.append(columnMultiselectIconEl);
          columnEl.addEventListener('click', () => {
            const multiSelectAllEls = this.wrapper.querySelectorAll('.list-item__container');
            const multiSelectSelectedEls = this.wrapper.querySelectorAll(
              '.list-item__container[data-is-selected]'
            );
            const multiSelectNotSelectedEls = this.wrapper.querySelectorAll(
              '.list-item__container:not([data-is-selected])'
            );

            let triggerEls;

            if (
              multiSelectSelectedEls.length === 0 ||
              multiSelectAllEls.length === multiSelectSelectedEls.length
            ) {
              triggerEls = multiSelectAllEls;
            } else {
              triggerEls = multiSelectNotSelectedEls;
            }

            triggerEls.forEach(container => {
              const multiselectEl = container.querySelector(
                '.list__column.-body.-type-multiselect'
              );
              if (multiselectEl) {
                multiselectEl.click();
              }
            });

            updateMultiselect(this.wrapper);
          });
        }

        if (column.sortable) {
          columnEl.classList.add('-sortable');
          columnEl.dataset.orderBy = column.source;
          columnEl.dataset.orderDirection =
            listConfig.orderDirection || column.defaultOrderDirection || 'asc';
          columnEl.dataset.defaultOrderDirection = column.defaultOrderDirection || 'asc';

          const columnSortableEl = document.createElement('div');
          columnSortableEl.classList.add('icon', 'list__order-icon');
          columnSortableEl.innerHTML = 'keyboard_arrow_up';

          columnEl.addEventListener('click', () => {
            const listConfig = this.listData?.config || {};
            let newDirection;
            if (listConfig.orderBy === column.source) {
              const currentDirection = columnEl.dataset.orderDirection;
              newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            } else {
              const currentDirection = columnEl.dataset.orderDirection;
              newDirection = currentDirection;
            }
            this.listData.config.orderBy = column.source;
            this.listData.config.orderDirection = newDirection;
            this.loadData();
          });

          columnEl.append(columnSortableEl);
        }

        if (column.type == 'actions') {
          column.actions.forEach(action => {
            const actionHeaderEl = document.createElement('div');
            actionHeaderEl.classList.add('list__action');
            columnEl.append(actionHeaderEl);
          });
        }

        this.contentHeader.append(columnEl);
      });
    } else {
      const currentOrderEl = document.querySelector('.list__column.-head.-sortable.-current-order');
      currentOrderEl?.classList.remove('-current-order');

      const nextOrderEl = document.querySelector(
        '.list__column.-head.-sortable[data-order-by="' + listConfig.orderBy + '"]'
      );
      if (nextOrderEl) {
        nextOrderEl.classList.add('-current-order');
        nextOrderEl.dataset.orderDirection = listConfig.orderDirection;
      }
    }

    // Items
    this.contentItems.innerHTML = '';

    if (!listItems || !listItems.length) {
      this.contentItems.innerHTML = '<div class="list-item__container">' + (listConfig.trashed && !listConfig.meta.trashCount ? listTexts.empty.trash : listTexts.empty.items) + '</div>';
      this.wrapper.classList.add('-empty');
    } else {
      this.wrapper.classList.remove('-empty');
    }

    listItems.forEach(item => {
      const itemContainerEl = document.createElement('div');
      itemContainerEl.className = 'list-item__container';
      itemContainerEl.dataset.id = item.id;
      if (!listConfig.trashed && (item.active === false || item.active === 0)) {
        itemContainerEl.classList.add('-inactive');
      }
      this.contentItems.appendChild(itemContainerEl);

      listColumns.forEach(column => {
        if (listConfig.trashed && !column.allowTrashed && column.type !== 'title') {
          return;
        }
        const itemColumnEl = document.createElement('div');
        itemColumnEl.classList.add('list__column', '-body', '-type-' + column.type);

        if (column.visibility) {
          Object.entries(column.visibility).forEach(([breakpoint, isVisible]) => {
            if (isVisible === false) {
              itemColumnEl.classList.add(`-hide-${breakpoint}`);
            }
          });
        }

        const basePath = listConfig.key || '';
        const editLink = listConfig.editRoute
          ? listConfig.editRoute.replace('{id}', item.id)
          : `/admin/${basePath}/edit/${item.id}`;

        switch (column.type) {
          case 'multiselect':
            itemColumnEl.classList.add('no-select');
            const itemColumnMultiselectIconEl = document.createElement('div');
            itemColumnMultiselectIconEl.classList.add('list__multiselect-icon', 'icon');
            itemColumnMultiselectIconEl.innerHTML = 'check_box_outline_blank';
            itemColumnEl.append(itemColumnMultiselectIconEl);
            itemColumnEl.addEventListener('click', () => {
              let isSelected = itemContainerEl.hasAttribute('data-is-selected');
              if (isSelected) {
                itemContainerEl.removeAttribute('data-is-selected');
                isSelected = false;
              } else {
                itemContainerEl.setAttribute('data-is-selected', '');
                isSelected = true;
              }
              itemColumnMultiselectIconEl.innerHTML = isSelected
                ? 'check_box'
                : 'check_box_outline_blank';
              updateMultiselect(this.wrapper);
            });
            break;

          case 'sortable':
            itemColumnEl.classList.add('no-select');
            const itemColumnSortableEl = document.createElement('div');
            itemColumnSortableEl.classList.add('list__sortable-handle', 'icon');
            itemColumnSortableEl.innerHTML = 'drag_handle';
            itemColumnEl.append(itemColumnSortableEl);
            break;

          case 'icon':
            const itemColumnIconEl = document.createElement('div');
            itemColumnIconEl.classList.add('icon');
            itemColumnIconEl.innerHTML = getNestedValue(item, column.source);
            itemColumnEl.append(itemColumnIconEl);
            break;

          case 'title':
            const title = getNestedValue(item, column.source);
            const itemColumnTitleLinkEl = document.createElement('a');
            itemColumnTitleLinkEl.href = editLink;
            itemColumnTitleLinkEl.innerHTML = title;
            itemColumnEl.append(itemColumnTitleLinkEl);
            break;

          case 'email':
            const email = getNestedValue(item, column.source);
            const itemColumnEmailLinkEl = document.createElement('a');
            itemColumnEmailLinkEl.href = 'mailto:' + email;
            itemColumnEmailLinkEl.innerHTML = email;
            itemColumnEl.append(itemColumnEmailLinkEl);
            break;

          case 'badge':
            const badgeKey = getNestedValue(item, column.source);
            const badgeText = column.config?.map[badgeKey]?.text || badgeKey;
            const itemColumnBadgeEl = document.createElement('div');
            itemColumnBadgeEl.classList.add('badge', '-' + badgeKey);
            itemColumnBadgeEl.innerHTML = badgeText;
            itemColumnEl.append(itemColumnBadgeEl);
            break;

          case 'datetime':
            let datetime = getNestedValue(item, column.source);
            datetime = formatDatetime(datetime, { relative: column.relativeDatetime });
            itemColumnEl.innerHTML = datetime;
            break;

          case 'username':
            itemColumnEl.innerHTML = getNestedValue(item, column.source);
            break;

          case 'actions':
            column.actions.forEach(action => {
              let actionType = action;

              if (typeof action === 'object' && action !== null && 'type' in action) {
                actionType = action.type;
              }

              const actionEl = document.createElement('div');
              actionEl.classList.add('list__action', '-type-' + actionType);

              const actionIconEl = document.createElement('div');
              actionIconEl.classList.add('icon', 'list__action-icon');

              switch (actionType) {
                case 'toggle':
                  actionIconEl.innerHTML = item.active ? 'toggle_on' : 'toggle_off';
                  actionEl.append(actionIconEl);

                  actionEl.addEventListener('click', () => {
                    if (item._toggleRequestRunning) return;

                    apiFetch({
                      url: '/admin/api/toggle',
                      data: {
                        key: listConfig.key,
                        id: item.id,
                      },
                      before: () => {
                        item._toggleRequestRunning = true;
                      },
                      complete: () => {
                        item._toggleRequestRunning = false;
                      },
                      success: response => {
                        if (response.success) {
                          item.active = response.value;
                          actionIconEl.innerHTML = item.active ? 'toggle_on' : 'toggle_off';
                          itemContainerEl.classList[item.active ? 'remove' : 'add']('-inactive');
                          success(response.message);
                        } else {
                          networkError(response);
                        }
                      },
                      error: xhr => {
                        networkError(xhr);
                      },
                    });
                  });
                  break;

                case 'duplicate':
                  actionIconEl.innerHTML = 'content_copy';
                  actionEl.append(actionIconEl);
                  break;

                case 'edit':
                  actionIconEl.innerHTML = 'edit';
                  const actionEditLinkEl = document.createElement('a');
                  actionEditLinkEl.href = editLink;
                  actionEditLinkEl.append(actionIconEl);
                  actionEl.append(actionEditLinkEl);
                  break;

                case 'delete':
                  actionIconEl.innerHTML = 'delete';
                  actionEl.append(actionIconEl);

                  actionEl.addEventListener('click', () => {
                    confirmModal({
                      title: this.listData.texts.deleteModal.title,
                      description: this.listData.texts.deleteModal.textSoftDelete,
                      cancelButtonText: this.listData.texts.deleteModal.cancelButtonText,
                      submitButtonText: this.listData.texts.deleteModal.submitButtonText,
                      submitCallback: (container, submitBtn) => {
                        if (item._deleteRequestRunning) return;

                        apiFetch({
                          url: '/admin/api/delete',
                          data: getListParams({}, listConfig, { id: item.id }),
                          before: () => {
                            item._deleteRequestRunning = true;
                            submitBtn.classList.add('-loading');
                            submitBtn.disabled = true;
                          },
                          complete: () => {
                            item._deleteRequestRunning = false;
                            submitBtn.classList.remove('-loading');
                            submitBtn.disabled = false;
                          },
                          success: response => {
                            if (response.success) {
                              this.listData = response.listData;
                              this.render();
                              success(response.message);
                              closeConfirmModal();
                            } else {
                              networkError(response);
                            }
                          },
                          error: xhr => {
                            networkError(xhr);
                          },
                        });
                      },
                    });
                  });
                  break;

                case 'force-delete':
                  actionIconEl.innerHTML = 'delete_forever';
                  actionEl.append(actionIconEl);

                  actionEl.addEventListener('click', () => {
                    confirmModal({
                      title: this.listData.texts.deleteModal.title,
                      description: this.listData.texts.deleteModal.textForceDelete,
                      cancelButtonText: this.listData.texts.deleteModal.cancelButtonText,
                      submitButtonText: this.listData.texts.deleteModal.submitButtonText,
                      submitCallback: (container, submitBtn) => {
                        if (item._forceDeleteRequestRunning) return;

                        apiFetch({
                          url: '/admin/api/delete',
                          data: getListParams({}, listConfig, { id: item.id, force: true }),
                          before: () => {
                            item._forceDeleteRequestRunning = true;
                            submitBtn.classList.add('-loading');
                            submitBtn.disabled = true;
                          },
                          complete: () => {
                            item._forceDeleteRequestRunning = false;
                            submitBtn.classList.remove('-loading');
                            submitBtn.disabled = false;
                          },
                          success: response => {
                            if (response.success) {
                              this.listData = response.listData;
                              this.render();
                              success(response.message);
                              closeConfirmModal();
                            } else {
                              networkError(response);
                            }
                          },
                          error: xhr => {
                            networkError(xhr);
                          },
                        });
                      },
                    });
                  });
                  break;

                case 'restore':
                  actionIconEl.innerHTML = 'restore_from_trash';
                  actionEl.append(actionIconEl);

                  actionEl.addEventListener('click', () => {
                    if (item._restoreRequestRunning) return;

                    apiFetch({
                      url: '/admin/api/restore',
                      data: getListParams({}, listConfig, { id: item.id }),
                      before: () => {
                        item._restoreRequestRunning = true;
                      },
                      complete: () => {
                        item._restoreRequestRunning = false;
                      },
                      success: response => {
                        if (response.success) {
                          this.listData = response.listData;
                          this.render();
                          success(response.message);
                        } else {
                          networkError(response);
                        }
                      },
                      error: xhr => {
                        networkError(xhr);
                      },
                    });
                  });
                  break;

                case 'more':
                  actionIconEl.innerHTML = 'more_horiz';
                  actionEl.append(actionIconEl);
                  break;
              }

              itemColumnEl.append(actionEl);
            });
            break;
        }

        itemContainerEl.append(itemColumnEl);
      });
    });

    // Sortable lists
    this.wrapper.classList.remove('-sortable');

    if (this.sortable) {
      this.sortable.destroy();
      this.sortable = null;
    }

    if (
      listItems &&
      listItems.length &&
      !listConfig.trashed &&
      listConfig.orderBy === 'order' &&
      listConfig.orderDirection === 'asc' &&
      !listConfig.searchTerm
    ) {
      this.wrapper.classList.add('-sortable');

      this.sortable = Sortable.create(this.contentItems, {
        handle: '.list__sortable-handle',
        animation: config.fastTransitionSpeed,
        ghostClass: '-sortable-ghost',
        dragClass: '-sortable-dragging',
        onStart: () => {
          document.body.classList.add('-is-dragging');
        },
        onEnd: evt => {
          document.body.classList.remove('-is-dragging');

          // TODO add pagination

          const oldIndex = evt.oldIndex;
          const newIndex = evt.newIndex;

          if (oldIndex === newIndex) {
            return;
          }

          const rows = Array.from(this.contentItems.children);

          const [start, end] = [oldIndex, newIndex].sort((a, b) => a - b);
          const affectedRows = rows.slice(start, end + 1);

          const reorderPayload = affectedRows.map((el, i) => ({
            id: el.dataset.id,
            order: start + i + 1,
          }));

          apiFetch({
            url: '/admin/api/list-reorder',
            data: {
              key: listConfig.key,
              items: reorderPayload,
            },
            success: response => {
              if (response.success) {
                success(response.message);
              } else {
                networkError(response);
              }
            },
            error: xhr => {
              networkError(xhr);
            },
          });
        },
      });
    }

    updateMultiselect(this.wrapper);
    updateItemAmountButtons(
      this.itemsAmountContainerEl,
      this.trashItemsAmountContainerEl,
      this.listData
    );
  }
}

function getListParams(params = {}, listConfig = {}, obj = {}) {
  return {
    key: listConfig?.key,
    orderBy: params?.orderBy || listConfig?.orderBy,
    orderDirection: params?.orderDirection || listConfig?.orderDirection,
    searchTerm: params?.searchTerm || listConfig?.searchTerm,
    perPage: params?.perPage || listConfig?.perPage,
    trashed: params?.trashed || listConfig?.trashed,
    ...obj,
  };
}

function updateMultiselect(wrapper) {
  const multiSelectIconEl = wrapper.querySelector(
    '.list__column.-head.-type-multiselect .list__multiselect-icon'
  );
  if (multiSelectIconEl) {
    const multiSelectAllEls = wrapper.querySelectorAll('.list-item__container');
    const multiSelectSelectedEls = wrapper.querySelectorAll(
      '.list-item__container[data-is-selected]'
    );

    if (multiSelectSelectedEls.length === 0) {
      multiSelectIconEl.innerHTML = 'check_box_outline_blank';
    } else if (multiSelectAllEls.length === multiSelectSelectedEls.length) {
      multiSelectIconEl.innerHTML = 'check_box';
    } else {
      multiSelectIconEl.innerHTML = 'indeterminate_check_box';
    }
  }
}

function updateItemAmountButtons(itemsEl, trashItemsEl, listData) {
  itemsEl.classList[listData.config.trashed ? 'remove' : 'add']('-active');
  trashItemsEl.classList[listData.config.trashed ? 'add' : 'remove']('-active');

  const countItems = listData.config.meta.totalCount;
  const countTrash = listData.config.meta.trashCount;

  const textItems = listData.texts.itemCount['items' + (countItems == 1 ? '1' : 'N')];
  const textTrash = listData.texts.itemCount['trash' + (countTrash == 1 ? '1' : 'N')];

  itemsEl.innerHTML = textItems.replace('{n}', countItems);
  trashItemsEl.innerHTML = textTrash.replace('{n}', countTrash);
}

function resolveText(texts, textId) {
  return getNestedValue(texts, textId) ?? textId;
}
