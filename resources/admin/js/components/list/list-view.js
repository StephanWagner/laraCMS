import { apiFetch } from '../../utils/api-fetch';

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

    const contentHeader = document.createElement('div');
    contentHeader.className = 'list-content__header';
    contentHeader.innerHTML = 'CONTENT HEADER';
    content.appendChild(contentHeader);

    const contentItems = document.createElement('div');
    contentItems.setAttribute('data-list-items', '');
    contentItems.className = 'list-content__items';
    contentItems.innerHTML = 'ITEMS';
    content.appendChild(contentItems);

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

    const itemsEl = this.container.querySelector('[data-list-items]');
    itemsEl.innerHTML = '';

    const listItems = listData?.items?.data || [];

    if (!listItems || !listItems.length) {
      itemsEl.innerHTML = '<p>No items found.</p>';
      return;
    }

    listItems.forEach(item => {
      const el = document.createElement('div');
      el.className = 'list-item__container';
      el.textContent = item.name || item.title || '[no title]';
      itemsEl.appendChild(el);
    });
  }
}
