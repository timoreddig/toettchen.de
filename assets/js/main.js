const navToggle = document.querySelector('.nav-toggle');
const navLinks = document.querySelector('.main-nav__list');

navToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});