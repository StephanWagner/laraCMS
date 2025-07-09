import { DateTime } from 'luxon';
import { __ } from './locale';

export function formatDate(value, options = {}) {
  if (!value) return '';

  const {
    zone = DateTime.local().zoneName,
    format = 'dd.MM.yyyy HH:mm',
    relative = false,
  } = options;

  const date = DateTime.fromISO(value, { zone: 'utc' }).setZone(zone);

  if (relative) {
    const diff = date.diffNow('minutes').minutes;

    if (diff > -1) return __('relativeDateJustNow');
    if (diff > -60) return __('relativeDateMinutes', {'minutes': Math.abs(Math.round(diff))});
    if (diff > -1440) return __('relativeDateToday', {'time': date.toFormat('HH:mm')});
    if (diff > -2880) return __('relativeDateYesterday', {'time': date.toFormat('HH:mm')});

    return date.toFormat(format);
  }

  return date.toFormat(format);
}
