import Catalog from '../progress-catalog/index.js'
export function render(toc) {
  new Catalog({
    contentEl: 'article',
    catalogEl: 'toc',
    scrollWrapper: document.getElementById('scrollWrapper'),
    selector: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
    cool: false,
  })
}
