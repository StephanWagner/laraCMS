import { config } from '../../config/config';
import { getBoundsContainer } from '../list-service';
import { keepInBounds } from '../../utils/keep-in-bounds';
import { resolveText } from '../../utils/text';

export const getListFilters = listService => {
  const filtersContainerEl = document.createElement('div');
  filtersContainerEl.className = 'list-filters__container';

  const filtersButtonEl = document.createElement('div');
  filtersButtonEl.className = 'list-filters__button button -selectable no-select -single-icon';
  filtersButtonEl.dataset.toggleMenu = 'list-filters-menu-' + listService.key;
  filtersContainerEl.appendChild(filtersButtonEl);

  const filtersButtonIconEl = document.createElement('div');
  filtersButtonIconEl.className = 'list-filters__button-icon icon';
  filtersButtonIconEl.innerHTML = 'filter_list';
  filtersButtonEl.appendChild(filtersButtonIconEl);

  const filtersButtonAmountEl = document.createElement('div');
  filtersButtonAmountEl.className = 'list-filters__button-amount';
  filtersButtonAmountEl.innerHTML = '0';
  filtersButtonEl.appendChild(filtersButtonAmountEl);

  const filtersOptionsContainerEl = document.createElement('div');
  filtersOptionsContainerEl.className =
    'list-filters__options-container menu-overlay__wrapper -compact -left';
  filtersOptionsContainerEl.dataset.menu = 'list-filters-menu-' + listService.key;

  filtersOptionsContainerEl.keepInBounds = menuEl => {
    keepInBounds(menuEl, {
      padding: config.menuPadding,
      container: getBoundsContainer(listService),
    });
  };
  filtersContainerEl.appendChild(filtersOptionsContainerEl);

  const filtersMenuHeaderEl = document.createElement('div');
  filtersMenuHeaderEl.classList.add('list-filters__options-header');
  filtersOptionsContainerEl.appendChild(filtersMenuHeaderEl);

  const filtersMenuHeaderTitleEl = document.createElement('div');
  filtersMenuHeaderTitleEl.classList.add('list-filters__options-title');
  filtersMenuHeaderTitleEl.innerHTML = resolveText(listService.listData.texts, 'filtersTitle');

  filtersMenuHeaderEl.appendChild(filtersMenuHeaderTitleEl);

  const filtersMenuHeaderClearButtonEl = document.createElement('div');
  filtersMenuHeaderClearButtonEl.classList.add('list-filters__options-clear-button');
  filtersMenuHeaderEl.appendChild(filtersMenuHeaderClearButtonEl);

  const filtersMenuHeaderClearButtonIconEl = document.createElement('div');
  filtersMenuHeaderClearButtonIconEl.classList.add(
    'list-filters__options-clear-button-icon',
    'icon'
  );
  filtersMenuHeaderClearButtonIconEl.innerHTML = 'clear';
  filtersMenuHeaderClearButtonEl.appendChild(filtersMenuHeaderClearButtonIconEl);

  const filtersMenuHeaderClearButtonTextEl = document.createElement('div');
  filtersMenuHeaderClearButtonTextEl.classList.add('list-filters__options-clear-button-text');
  filtersMenuHeaderClearButtonTextEl.innerHTML = resolveText(listService.listData.texts, 'filtersClearAll');
  filtersMenuHeaderClearButtonEl.appendChild(filtersMenuHeaderClearButtonTextEl);

  const filterOptionsEl = getListFilterOptions(listService);
  filtersOptionsContainerEl.appendChild(filterOptionsEl);

  return filtersContainerEl;
};

function getListFilterOptions(listService) {
  const filterOptionsEl = document.createElement('div');
  filterOptionsEl.classList.add('list-filters__options');

  const filterOptions = listService.listData.config.filters || [];

  filterOptions.forEach(filter => {
    const filterOptionEl = document.createElement('div');
    filterOptionEl.classList.add('list-filters__option', '-type-' + filter.type);
    filterOptionsEl.appendChild(filterOptionEl);

    const filterOptionLabelEl = document.createElement('div');
    filterOptionLabelEl.classList.add('list-filters__option-label');
    filterOptionLabelEl.innerHTML = resolveText(listService.listData.texts, 'filterLabel.' + filter.type);
    filterOptionEl.appendChild(filterOptionLabelEl);

    switch (filter.type) {
      case 'created-by':
        const filterOptionCreatedByEl = document.createElement('div');
        filterOptionCreatedByEl.classList.add('list-filters__option-created-by');
        filterOptionEl.appendChild(filterOptionCreatedByEl);
        break;

      case 'status':
        const filterOptionStatusEl = document.createElement('div');
        filterOptionStatusEl.classList.add('list-filters__option-status');
        filterOptionEl.appendChild(filterOptionStatusEl);
        break;
    }
  });

  return filterOptionsEl;
}
