const burgerMenu = document.querySelector('.burger-menu');
const mobileNavigationwrapper = document.querySelector(
  '.mobile-navigation-wrapper'
);
const topLine = document.querySelector('.top-line');
const bottomLine = document.querySelector('.bottom-line');
const middleLine = document.querySelector('.middle-line');
const imageDiv = document.querySelector('.image');
const detailsContainerDiv = document.querySelector('.details-container');
const headerLogo = document.querySelector('.header-logo');

burgerMenu.addEventListener('click', function () {
  const isOpen = mobileNavigationwrapper.classList.toggle('active');
  if (isOpen) {
    document.body.style.overflow = 'hidden';
    imageDiv.style.opacity = '0';
    detailsContainerDiv.style.opacity = '0';
    headerLogo.style.borderBottom = '1px solid rgba(0, 0, 0, 0.08)';
  } else {
    document.body.style.overflow = '';
    imageDiv.style.opacity = '1';
    detailsContainerDiv.style.opacity = '1';
    headerLogo.style.borderBottom = '';
  }

  topLine.classList.toggle('rotate-top-line', isOpen);
  middleLine.classList.toggle('rotate-middle-line', isOpen);
  bottomLine.classList.toggle('rotate-bottom-line', isOpen);

  topLine.classList.toggle('rotate-top-back', !isOpen);
  middleLine.classList.toggle('rotate-middle-back', !isOpen);
  bottomLine.classList.toggle('rotate-bottom-back', !isOpen);
});

const buttons = document.querySelectorAll('.filter-buttons button');
const templates = document.querySelectorAll('.internal-similar-template.tours');

buttons.forEach((button) => {
  button.addEventListener('click', function () {
    const category = this.getAttribute('data-category');

    buttons.forEach((btn) => btn.classList.remove('active'));
    this.classList.add('active');

    templates.forEach((template) => {
      const templateCategory = template.getAttribute('data-category');
      if (category === 'All' || templateCategory === category) {
        template.style.display = 'block';
      } else {
        template.style.display = 'none';
      }
    });
  });
});

const carousels = document.querySelectorAll('.main-carousel-container');

carousels.forEach((carouselContainer) => {
  const carouselId = carouselContainer.getAttribute('data-carousel');
  const carousel = document.getElementById(`carousel-${carouselId}`);
  const projects = carousel
    ? carousel.querySelectorAll('.main-carousel-project')
    : [];
  let currentIndex = 0;

  function shiftLeft() {
    if (currentIndex > 0) {
      currentIndex--;
      carousel.style.transform = `translateX(-${
        currentIndex * (projects[0].offsetWidth + 20)
      }px)`;
    }
  }

  function shiftRight() {
    if (currentIndex < projects.length - 1) {
      currentIndex++;
      carousel.style.transform = `translateX(-${
        currentIndex * (projects[0].offsetWidth + 20)
      }px)`;
    }
  }

  const leftArrow = document.querySelector(
    `.main-carousel-arrow-left[data-carousel="${carouselId}"]`
  );
  const rightArrow = document.querySelector(
    `.main-carousel-arrow-right[data-carousel="${carouselId}"]`
  );

  if (leftArrow && rightArrow) {
    leftArrow.addEventListener('click', shiftLeft);
    rightArrow.addEventListener('click', shiftRight);
  }
});
