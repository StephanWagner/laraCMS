import { config } from '../../config/config';
import { getBoundsContainer } from '../list-service';
import { keepInBounds } from '../../utils/keep-in-bounds';
import { resolveText } from '../../utils/text';
import { closeMenu } from '../../ui/menu';

export const getListFilterUi = listService => {
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
  filtersMenuHeaderClearButtonEl.addEventListener('click', () => {
    filtersOptionsContainerEl.querySelectorAll('.list-filters__option-items').forEach(optionItemsEl => {
      const filterType = optionItemsEl.dataset.listFilterType;

      switch (filterType) {
        case 'radio':
          optionItemsEl.querySelectorAll('.list-filters__option-item[data-is-selected]').forEach(optionItemEl => {
            optionItemEl.removeAttribute('data-is-selected');
            optionItemEl.querySelector('.list-filters__option-item-icon').innerHTML =
              'radio_button_unchecked';
          });
          break;
      }
    });
    listService.loadData({}, true);
    closeMenu('list-filters-menu-' + listService.key);
  });
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
  filtersMenuHeaderClearButtonTextEl.innerHTML = resolveText(
    listService.listData.texts,
    'filtersClearAll'
  );
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
    filterOptionLabelEl.innerHTML = resolveText(
      listService.listData.texts,
      'filterLabel.' + filter.key
    );
    filterOptionEl.appendChild(filterOptionLabelEl);

    const filterOptionItemsEl = document.createElement('div');
    filterOptionItemsEl.classList.add('list-filters__option-items');
    filterOptionItemsEl.dataset.listFilter = filter.key;
    filterOptionItemsEl.dataset.listFilterColumn = filter.column;
    filterOptionItemsEl.dataset.listFilterType = 'radio';
    filterOptionEl.appendChild(filterOptionItemsEl);

    switch (filter.type) {
      case 'checkbox':
        break;

      case 'radio':
        filter.options.forEach(option => {
          const filterOptionItemEl = document.createElement('div');
          filterOptionItemEl.classList.add('list-filters__option-item', '-has-icon', '-radio');
          filterOptionItemEl.dataset.listFilterValue = option.value;
          filterOptionItemsEl.appendChild(filterOptionItemEl);

          const filterOptionItemIconEl = document.createElement('div');
          filterOptionItemIconEl.classList.add('list-filters__option-item-icon', 'icon');
          filterOptionItemIconEl.innerHTML = 'radio_button_unchecked';
          filterOptionItemEl.appendChild(filterOptionItemIconEl);

          const filterOptionItemLabelEl = document.createElement('div');
          filterOptionItemLabelEl.classList.add('list-filters__option-item-label');
          filterOptionItemLabelEl.innerHTML = resolveText(
            listService.listData.texts,
            option.label
          );
          filterOptionItemEl.appendChild(filterOptionItemLabelEl);

          filterOptionItemEl.addEventListener('click', () => {
            const isSelected = filterOptionItemEl.hasAttribute('data-is-selected');
            if (isSelected) {
              filterOptionItemEl.removeAttribute('data-is-selected');
              filterOptionItemIconEl.innerHTML = 'radio_button_unchecked';
            } else {
              filterOptionItemsEl.querySelectorAll('.list-filters__option-item').forEach(itemEl => {
                itemEl.removeAttribute('data-is-selected');
                itemEl.querySelector('.list-filters__option-item-icon').innerHTML =
                  'radio_button_unchecked';
              });
              filterOptionItemEl.setAttribute('data-is-selected', '');
              filterOptionItemIconEl.innerHTML = 'radio_button_checked';
            }

            listService.loadData({}, true);
          });
        });
        break;
    }
  });

  return filterOptionsEl;
}
