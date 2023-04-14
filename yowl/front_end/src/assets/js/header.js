const hamburger = document.querySelector('.nav-toggle')
const nav = document.querySelector('.nav')

hamburger.addEventListener('click', () => {
  nav.classList.toggle('nav--visible')
})
