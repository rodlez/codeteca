/* Get the button: */
console.log('script js loaded...');
let mybutton = document.getElementById("myBtn");

/* When the user scrolls down 20px from the top of the document, show the button */
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    console.log('scrollFunction js loaded...');
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

/* When the user clicks on the button, scroll to the top of the document */
function parriba() {
  document.body.scrollTop = 0; 
  document.documentElement.scrollTop = 0; 
}  