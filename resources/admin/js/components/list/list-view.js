import { apiFetch } from '../../utils/api-fetch';
import { getNestedValue } from '../../utils/object';
import { formatDate } from '../../utils/datetime';

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
    this.contentHeader.innerHTML = 'CONTENT HEADER';
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
      this.render(this.listData);
    } else {
      this.loadData(); // TODO
    }
  }

  loadData(params = {}) {
    const url = this.buildUrl(params);

    apiFetch({
      url,
      success: data => this.render(data),
      error: xhr => {
        this.content.querySelector('.list-content__items').innerHTML = '<p>Error loading data.</p>';
      },
    });
  }

  buildUrl(params) {
    const query = new URLSearchParams(params).toString();
    return this.endpoint + (query ? `?${query}` : '');
  }

  render(listData) {
    console.log(listData);

    // Config
    const listConfig = listData?.config || [];

    // Head columns
    this.contentHeader.innerHTML = '';
    const listColumns = listConfig?.columns || [];

    listColumns.forEach(column => {
      const columnEl = document.createElement('div');
      columnEl.classList.add('list__column', '-' + column.type);

      if (column.label) {
        const columnLabelEl = document.createElement('div');
        columnLabelEl.innerHTML = column.label;
        columnEl.append(columnLabelEl);
      }

      if (column.sortable) {
        const columnSortableEl = document.createElement('div');
        columnSortableEl.classList.add('icon');
        columnSortableEl.innerHTML = 'keyboard_arrow_up';
        columnEl.append(columnSortableEl);
      }

      this.contentHeader.append(columnEl);
    });

    // Items
    this.contentItems.innerHTML = '';
    const listItems = listData?.items?.data || [];

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
        itemColumnEl.classList.add('list__column', '-' + column.type);

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
            datetime = formatDate(datetime, { relative: column.relativeDatetime });
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
                  itemColumnEl.append(actionIconEl);
                  break;

                case 'duplicate':
                  actionIconEl.innerHTML = 'content_copy';
                  itemColumnEl.append(actionIconEl);
                  break;

                case 'edit':
                  actionIconEl.innerHTML = 'edit';
                  const actionEditLinkEl = document.createElement('a');
                  actionEditLinkEl.href = editLink;
                  actionEditLinkEl.append(actionIconEl);
                  itemColumnEl.append(actionEditLinkEl);
                  break;

                case 'delete':
                  actionIconEl.innerHTML = 'delete';
                  itemColumnEl.append(actionIconEl);
                  break;
              }
            });
            break;
        }

        this.contentItems.append(itemColumnEl);
      });
    });
  }
}
