if (document.querySelector("button.ppv-menubutton")) {
    document.querySelector("button.ppv-menubutton").addEventListener("click", function () {
        let navbar = document.querySelector("nav.ppv-navbar-outer");
        let tofuburger = navbar.querySelector(".ppv-tofuburger");
        let navMenuItems = navbar.querySelector(".ppv-app-navmenu-items");
        let navOverlay = document.querySelector(".ppv-open-nav-overlay");
        navMenuItems.classList.toggle("is-active");
        navOverlay.classList.toggle("is-active");

        toggleButton(tofuburger);
    });
}

function toggleButton(tofuburger) {
    if (tofuburger.classList.contains("is-active")) {
        tofuburger.classList.remove("is-active");
        setTimeout(() => {
            tofuburger.classList.remove("is-transition");
        }, 250);
    } else {
        tofuburger.classList.add("is-transition");
        setTimeout(() => {
            tofuburger.classList.add("is-active");
        }, 250);
    }
}

function setNavStyles(prev, current) {
    let navbar = document.querySelector("nav.ppv-navbar-outer");

    if (prev > current) {
        navbar.classList.remove("is-scrollbar");
    } else {
        navbar.classList.add("is-scrollbar");
    }

    if (current > 0) {
        navbar.classList.add("is-scrolled");
    } else {
        navbar.classList.remove("is-scrolled");
    }
    return current;
}

var prev = window.pageYOffset;

window.addEventListener("scroll", function () {
    var current = window.pageYOffset;
    setNavStyles(prev, current);
    prev = current;
});