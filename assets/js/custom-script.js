// Init Foundation
jQuery(document).foundation();

// Content height between header and footer
function setMainHeight() {
    const headerHeight = document.querySelector('header').offsetHeight;
    const footerHeight = document.querySelector('footer').offsetHeight;
    const windowHeight = window.innerHeight;

    const mainElement = document.querySelector('main');
    const mainHeight = windowHeight - headerHeight - footerHeight;
    mainElement.style.minHeight = mainHeight + 'px';
}

// Initialization on page load
window.addEventListener('load', setMainHeight);

// Recalculate the height of the main block when the screen is resized
window.addEventListener('resize', setMainHeight);

