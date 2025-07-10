import { apiFetch } from '../../utils/api-fetch';
import { getNestedValue } from '../../utils/object';
import { formatDatetime } from '../../utils/datetime';
import { networkError } from '../../utils/message';

export class ListView {
  constructor({ key, wrapper }) {
    if (!key || !wrapper) return;

    this.key = key;
    this.wrapper = wrapper;

    this.listData = window.listData || null;

    this.init();
  }

  init() {
    // Container
    this.container = document.createElement('div');
    this.container.className = 'list__container';

    // Header
    const header = document.createElement('div');
    header.className = 'list-header__container';
    header.innerHTML = 'HEADER';

    // Filters
    const filters = document.createElement('div');
    header.className = 'list-filters__container';
    header.innerHTML = 'SEARCH / FILTERS';
    header.appendChild(filters);

    // Content
    const content = document.createElement('div');
    content.className = 'list-content__container';

    this.contentHeader = document.createElement('div');
    this.contentHeader.className = 'list-content__header';
    content.appendChild(this.contentHeader);

    this.contentItems = document.createElement('div');
    this.contentItems.className = 'list-content__items';
    this.contentItems.innerHTML = 'ITEMS';
    content.appendChild(this.contentItems);

    // Footer
    const footer = document.createElement('div');
    footer.className = 'list-footer__container';
    footer.innerHTML = 'FOOTER';

    this.container.appendChild(header);
    this.container.appendChild(content);
    this.container.appendChild(footer);
    this.wrapper.appendChild(this.container);

    if (this.listData) {
      this.render({
        renderHeader: true,
      });
    } else {
      this.loadData(); // TODO
    }
  }

  loadData(params = {}) {
    if (this.loading) return false;

    const listConfig = this.listData?.config || [];

    apiFetch({
      url: '/admin/api/list',
      data: {
        key: listConfig?.key,
        orderBy: params.orderBy || listConfig?.orderBy,
        orderDirection: params.orderDirection || listConfig?.orderDirection,
      },
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
          this.render();
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
    console.log('render', this.listData);

    // Config
    const listConfig = this.listData?.config || {};
    const listColumns = listConfig?.columns || [];
    const listItems = this.listData?.items?.data || [];

    // Head columns
    if (params.renderHeader) {
      this.contentHeader.innerHTML = '';

      listColumns.forEach(column => {
        const columnEl = document.createElement('div');
        columnEl.classList.add('list__column', '-head', '-type-' + column.type);

        if (listConfig.orderBy == column.source) {
          columnEl.classList.add('-current-order');
        }

        if (column.label) {
          const columnLabelEl = document.createElement('div');
          columnLabelEl.innerHTML = column.label;
          columnEl.append(columnLabelEl);
        }

        if (column.sortable) {
          columnEl.classList.add('-sortable');
          columnEl.dataset.orderBy = column.source;
          columnEl.dataset.orderDirection = column.defaultOrderDirection || 'asc';
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
            this.loadData({
              orderBy: column.source,
              orderDirection: newDirection,
            });
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
      console.log('aaa');

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
      // TODO
      this.contentItems.innerHTML = '<p>No items found.</p>';
      return;
    }

    listItems.forEach(item => {
      const itemContainerEl = document.createElement('div');
      itemContainerEl.className = 'list-item__container';
      this.contentItems.appendChild(itemContainerEl);

      listColumns.forEach(column => {
        const itemColumnEl = document.createElement('div');
        itemColumnEl.classList.add('list__column', '-body', '-type-' + column.type);

        const basePath = listConfig.key || '';
        const editLink = `/admin/${basePath}/edit/${item.id}`;

        switch (column.type) {
          case 'sortable':
            const itemColumnSortableEl = document.createElement('div');
            itemColumnSortableEl.classList.add('icon');
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
            const itemColumnLinkEl = document.createElement('a');
            itemColumnLinkEl.href = editLink;
            itemColumnLinkEl.innerHTML = title;
            itemColumnEl.append(itemColumnLinkEl);
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
              const actionEl = document.createElement('div');
              actionEl.classList.add('list__action');

              const actionIconEl = document.createElement('div');
              actionIconEl.classList.add('icon');

              switch (action) {
                case 'toggle':
                  actionIconEl.innerHTML = item.active ? 'toggle_on' : 'toggle_off';
                  actionEl.append(actionIconEl);
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
                  break;
              }

              itemColumnEl.append(actionEl);
            });
            break;
        }

        itemContainerEl.append(itemColumnEl);
      });
    });
  }
}
