import './js/prism/prism.js'
import { render } from './js/toc/index.js'
let startTime = new Date().getTime()
document.addEventListener('DOMContentLoaded', () => {
  let article = document.querySelector('#article')
  if (article !== null) {
    render()
  }
})
window.addEventListener('load', () => {
  let loadTimeEle = document.querySelector('.loadTime')
  if (loadTimeEle !== null) {
    let endTime = new Date().getTime()
    let onloadTime = loadTimeEle.outerText.slice(0, -2).trim()
    loadTimeEle.innerText = endTime - startTime + Number(onloadTime) + ' ms'
    loadTimeEle.style.display = 'block'
  }
})
