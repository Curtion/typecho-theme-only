import './js/prism/prism.js'
import { render } from './js/toc/index.js'
let startTime = new Date().getTime()
document.addEventListener('DOMContentLoaded', () => {
  let article = document.querySelector('#article')
  if (article !== null) {
    render()
    article.addEventListener('click', (e) => {
      if (e.target.nodeName === 'IMG') {
        const img = e.target
        document.querySelector('#topImg img').src = img.src
        document.querySelector('#topImg').style.display = 'block'
        document.querySelector('.container').style['pointer-events'] = 'none'
        document.querySelector('.container').style.opacity = '0.2'
      }
    })
    let img = document.querySelector('#topImg img')
    img.addEventListener('click', (e) => {
      document.querySelector('#topImg').style.display = 'none'
      document.querySelector('.container').style['pointer-events'] = 'auto'
      document.querySelector('.container').style.opacity = '1'
    })
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
