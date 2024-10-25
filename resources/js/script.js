/**  Make the navigation bar change color when we scroll more than X pixels vertically
 * @param {int} startPixel Number of pixels when the navbar will change color 
 * */
function userScroll(startPixel) {
    // To Show or Hide the top button when we scroll
    const toTopBtn = document.querySelector('#to-top');

    window.addEventListener('scroll', () => {
        if(window.scrollY > startPixel) {            
            toTopBtn.classList.add('show');
        } else {           
            toTopBtn.classList.remove('show');
        }
    });
}

/**
 * Position the DOM on the top
 */
function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

// Once the DOM id loaded the functions will be executed
document.addEventListener('DOMContentLoaded', userScroll(50));
// Event Listener when top button is clicked
document.querySelector('#to-top').addEventListener('click', scrollToTop);