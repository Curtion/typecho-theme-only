import './js/prism/prism.js'
import { render } from './js/toc/index.js'
document.addEventListener('DOMContentLoaded', () => {
  let article = document.querySelector('#article')
  if (article !== null) {
    render()
  }
})
