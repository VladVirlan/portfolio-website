function toggleMenu()
{
    const menu = document.querySelector(".menu-links");
    const icon = document.querySelector(".hamburger-icon");
    menu.classList.toggle("open");
    icon.classList.toggle("open");
}

document.getElementById("mobile-nav-icon").addEventListener("click", toggleMenu);
document.getElementById("mobile-home-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-about-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-experience-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-projects-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-contact-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-blog-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-portfolio-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-login-link").addEventListener("click", toggleMenu);
document.getElementById("mobile-addpost-link").addEventListener("click", toggleMenu);