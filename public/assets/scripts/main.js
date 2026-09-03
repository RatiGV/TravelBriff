// BURGER MENU FUNCTION -- ორი ვარიანტი 1. მენუზე დაკლიკებისას იშლება მობილურის ნავიგაცია, ხოლო ბურგერ მენიუ ქრება როგორც დიზაინში.
// 2. ვარიანტი - ბურგერ მენიუზე დაკლიკებისას ირთვება პატარა ანიმაცია ბურგერ მენიუზე.

const burgerMenu = document.querySelector('.burger-menu');
const mobileNavigationwrapper = document.querySelector(
  '.mobile-navigation-wrapper'
);
const topLine = document.querySelector('.top-line');
const bottomLine = document.querySelector('.bottom-line');
const middleLine = document.querySelector('.middle-line');

// BURGER MENU OPEN WITHOUT ANIMATION

// burgerMenu.addEventListener('click', function() {
//     mobileNavigationwrapper.classList.toggle('active');
//     burgerMenu.style.display = 'none';
// });

// BURGER MENU OPEN WITH ANIMATION

burgerMenu.addEventListener('click', function () {
  const isOpen = mobileNavigationwrapper.classList.toggle('active');
  if (isOpen) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }

  topLine.classList.toggle('rotate-top-line', isOpen);
  middleLine.classList.toggle('rotate-middle-line', isOpen);
  bottomLine.classList.toggle('rotate-bottom-line', isOpen);

  topLine.classList.toggle('rotate-top-back', !isOpen);
  middleLine.classList.toggle('rotate-middle-back', !isOpen);
  bottomLine.classList.toggle('rotate-bottom-back', !isOpen);
});

const selectLangs = document.querySelectorAll('.select-lang');
const mobileSelectLangs = document.querySelectorAll('.mobile-select-lang');

function toggleLang(containerEng, containerGeo) {
  containerEng.classList.toggle('change-lang');
  containerGeo.classList.toggle('change-lang');
}

function syncLangSelectors(langSelectors) {
  langSelectors.forEach((selectLang) => {
    const langContainerEng = selectLang.querySelector('.lang-container-eng');
    const langContainerGeo = selectLang.querySelector('.lang-container-geo');
    if (langContainerEng && langContainerGeo) {
      toggleLang(langContainerEng, langContainerGeo);
    }
  });
}

function syncMobileLangSelectors(mobileLangSelectors) {
  mobileLangSelectors.forEach((mobileSelectLang) => {
    const mobileLangContainerEng = mobileSelectLang.querySelector(
      '.mobile-lang-container-eng'
    );
    const mobileLangContainerGeo = mobileSelectLang.querySelector(
      '.mobile-lang-container-geo'
    );
    if (mobileLangContainerEng && mobileLangContainerGeo) {
      toggleLang(mobileLangContainerEng, mobileLangContainerGeo);
    }
  });
}

if (selectLangs && mobileSelectLangs) {
  selectLangs.forEach((selectLang) => {
    selectLang.addEventListener('click', function () {
      syncLangSelectors(selectLangs);
      syncMobileLangSelectors(mobileSelectLangs);
    });
  });

  mobileSelectLangs.forEach((mobileSelectLang) => {
    mobileSelectLang.addEventListener('click', function () {
      syncLangSelectors(selectLangs);
      syncMobileLangSelectors(mobileSelectLangs);
    });
  });
}

// კატეგორიების ფილტრი
const filterButtons = document.querySelectorAll('.filter-buttons button');
const roomTemplates = document.querySelectorAll(
  '.internal-similar-template.rooms'
);
const roomSelectionContainer = document.querySelector(
  '.room-selection-container'
);

roomTemplates.forEach((room) => (room.style.display = 'block'));

filterButtons.forEach((button) => {
  button.addEventListener('click', () => {
    const category = button.getAttribute('data-category');

    filterButtons.forEach((btn) => btn.classList.remove('active'));
    button.classList.add('active');

    roomTemplates.forEach((room) => {
      if (
        category === 'All' ||
        room.getAttribute('data-category') === category
      ) {
        room.style.display = 'block';
      } else {
        room.style.display = 'none';
      }
    });
    if (category === 'All') {
      roomSelectionContainer.style.flexDirection = 'column';
    } else {
      roomSelectionContainer.style.flexDirection = 'column';
    }
  });
});

if (window.location.pathname.includes('rooms.html')) {
  const buttons = document.querySelectorAll('.room-button');
  const leftArrow = document.querySelector('.left-arrow img');
  const rightArrow = document.querySelector('.right-arrow img');

  buttons.forEach((button) => {
    button.addEventListener('click', () => {
      setActiveButton(button);
    });
  });

  leftArrow.addEventListener('click', () => {
    changeActiveButton(-1);
  });

  rightArrow.addEventListener('click', () => {
    changeActiveButton(1);
  });

  function setActiveButton(activeButton) {
    buttons.forEach((button) => button.classList.remove('active'));
    activeButton.classList.add('active');
  }

  function changeActiveButton(direction) {
    const currentIndex = Array.from(buttons).findIndex((button) =>
      button.classList.contains('active')
    );
    let newIndex = currentIndex + direction;
    if (newIndex < 0) newIndex = buttons.length - 1;
    if (newIndex >= buttons.length) newIndex = 0;
    setActiveButton(buttons[newIndex]);
  }
}

  document.getElementById('bookRoomBtn').addEventListener('click', function () {
    document.getElementById('popup').style.display = 'block';
    document.getElementById('dimOverlay').style.display = 'block';
    document.body.style.overflow = 'hidden';
  });

  document.getElementById('closePopup').addEventListener('click', function () {
    document.getElementById('popup').style.display = 'none';
    document.getElementById('dimOverlay').style.display = 'none';
    document.body.style.overflow = '';
  });

  document.getElementById('dimOverlay').addEventListener('click', function () {
    document.getElementById('popup').style.display = 'none';
    document.getElementById('dimOverlay').style.display = 'none';
    document.body.style.overflow = '';
  });
  const checkInHeader = document.querySelector('.popup-header.check-in');
  const checkOutHeader = document.querySelector('.popup-header.check-out');
  const checkInCalendar = document.querySelector('.calendar.check-in');
  const checkOutCalendar = document.querySelector('.calendar.check-out');

  checkInHeader.addEventListener('click', function () {
    if (window.innerWidth <= 1880) {
      checkInCalendar.style.display =
        checkInCalendar.style.display === 'none' ||
        checkInCalendar.style.display === ''
          ? 'block'
          : 'none';
    }
  });

  checkOutHeader.addEventListener('click', function () {
    if (window.innerWidth <= 1880) {
      checkOutCalendar.style.display =
        checkOutCalendar.style.display === 'none' ||
        checkOutCalendar.style.display === ''
          ? 'block'
          : 'none';
    }
  });
  document.querySelectorAll('.popup-header-amount').forEach((container) => {
    const minusBtn = container.querySelector('.minus');
    const plusBtn = container.querySelector('.plus');
    const countDisplay = container.querySelector('.count');

    minusBtn.addEventListener('click', () => {
      let count = parseInt(countDisplay.textContent);
      if (count > 0) {
        countDisplay.textContent = count - 1;
      }
    });

    plusBtn.addEventListener('click', () => {
      let count = parseInt(countDisplay.textContent);
      countDisplay.textContent = count + 1;
    });
  });

