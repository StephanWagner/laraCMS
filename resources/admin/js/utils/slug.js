export function getSlug(title) {
	// Trim and decode HTML entities
	title = title.trim();
	const textarea = document.createElement('textarea');
	textarea.innerHTML = title;
	title = textarea.value;

	// Lowercase and replace German umlauts/ß
	title = title.toLowerCase()
		.replace(/ö/g, 'oe')
		.replace(/ä/g, 'ae')
		.replace(/ü/g, 'ue')
		.replace(/ß/g, 'ss')
		.replace(/ẞ/g, 'ss');

	// Replace spaces and underscores with hyphens
	title = title.replace(/[\s_]+/g, '-');

	// Remove all characters except a-z, 0-9, hyphen
	title = title.replace(/[^a-z0-9\-]/g, '');

	// Replace multiple hyphens with a single one
	title = title.replace(/-+/g, '-');

	// Trim leading/trailing hyphens
	title = title.replace(/^[-]+|[-]+$/g, '');

	return title;
}
