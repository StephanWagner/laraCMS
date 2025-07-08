export function scrollToTop(selector) {
  const container = document.querySelector(selector);

  if (container) {
    container.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }
}
