/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// include icons from font awesome
import '@fortawesome/fontawesome-free/js/all.js';

// any SCSS you import will output into a single SCSS file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// Toggle responsive mobile menu
const navToggle = document.getElementById("nav-toggle");
const mobileNav = document.getElementById("mobile-nav");
const navUl = mobileNav.querySelector("ul");

let mobileMenuActive = false;
navToggle.addEventListener("click", () => {
    if (!mobileMenuActive) {
        mobileNav.style.height = navUl.offsetHeight + "px";
        navToggle.classList.add("active");
        mobileMenuActive = true;
    } else {
        mobileNav.removeAttribute("style");
        navToggle.classList.remove("active");
        mobileMenuActive = false;
    }
});

window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
        mobileNav.removeAttribute("style");
        navToggle.classList.remove("active");
        mobileMenuActive = false;
    }
});