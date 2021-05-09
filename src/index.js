import './js/prism/prism.js'
import { render } from './js/toc/index.js'
document.addEventListener('DOMContentLoaded', () => {
  let article = document.querySelector('#article')
  if (article !== null) {
    let title = Array.from(article.children).filter((child) => /^H\d+/.test(child.nodeName))
    const toc = title.map((item) => {
      return {
        level: +item.nodeName.match(/^H(\d+)$/)[1],
        content: item.outerText,
      }
    })
    render(toc)
  }
})
