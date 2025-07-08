import { apiFetch } from '../../utils/api-fetch';

export class ListView {
  constructor({ wrapper, endpoint }) {
    if (!wrapper) return;

    this.wrapper = wrapper;
    this.endpoint = endpoint;

    this.container = null;

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
    filters.innerHTML = 'SEARCH / FILTERS';
    header.appendChild(filters);

    // Content
    const content = document.createElement('div');
    content.className = 'list-content__container';

    const contentHeader = document.createElement('div');
    contentHeader.className = 'list-content__header';
    filters.innerHTML = 'CONTENT HEADER';
    content.appendChild(contentHeader);

    const contentItems = document.createElement('div');
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

    this.loadData();
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

  render(data) {
    const itemsEl = this.container.querySelector('.list-content__items');
    itemsEl.innerHTML = '';

    if (!data || !data.length) {
      itemsEl.innerHTML = '<p>No items found.</p>';
      return;
    }

    data.forEach(item => {
      const el = document.createElement('div');
      el.className = 'list-item';
      el.textContent = item.title || '[no title]';
      itemsEl.appendChild(el);
    });
  }
}
