export default () => {
  var hamburger = document.getElementById("hamburger");
  var mobileNav = document.getElementsByClassName("menu-main-container");
  if (hamburger) {
    var hamburgerFunction = function() {
      if (hamburger.classList.contains("hamburger-close")) {
        hamburger.classList.remove("hamburger-close");
        document.body.classList.remove("nav-open");
        for (var a = 0; a < mobileNav.length; a++) {
          mobileNav[a].classList.remove("show");
        }
      } else {
        hamburger.classList.add("hamburger-close");
        document.body.classList.add("nav-open");
        for (var a = 0; a < mobileNav.length; a++) {
          mobileNav[a].classList.add("show");
        }
      }
    };
    hamburger.addEventListener("click", hamburgerFunction, false);
  }

  // I don't like doing this with an ongoing timeout like this but under the circumstances
  // it is going to be the best route to go for now. Set the current values and check
  // every second and when they change, update the social links so they are ready to go.
  let currUrl = "";
  const twitterLink = document.querySelector(".header-twitter");
  const facebookLink = document.querySelector(".header-facebook");
  const emailLink = document.querySelector(".header-email");

  setInterval(() => {
    const newUrl = document.location.href;
    const newTitle = document.title;
    if (newUrl != currUrl) {
      const encodedUrl = encodeURIComponent(newUrl);
      const encodedTitle = encodeURIComponent(newTitle);
      twitterLink.href = "https://twitter.com/intent/tweet?text=" + encodedTitle + "&url=" + encodedUrl;
      facebookLink.href = "https://www.facebook.com/sharer/sharer.php?u=" + encodedUrl;
      emailLink.href = "mailto:?subject=" + encodedTitle + "&body=" + encodedUrl;
      currUrl = newUrl;
    }
  }, 1000);

  // wire up the mobile social button that makes them appear when tapped on
  var mobileSocial = document.getElementById("header-social");
  if (mobileSocial) {
    var fixedSocial = document.getElementsByClassName("fixed-container");
    var mobileSocialFunction = function() {
      if (mobileSocial.classList.contains("mobile-clicked")) {
        mobileSocial.classList.remove("mobile-clicked");
        for (var a = 0; a < fixedSocial.length; a++) {
          fixedSocial[a].classList.remove("mobile-clicked");
        }
      } else {
        mobileSocial.classList.add("mobile-clicked");
        for (var a = 0; a < fixedSocial.length; a++) {
          fixedSocial[a].classList.add("mobile-clicked");
        }
      }
    };
    mobileSocial.addEventListener("click", mobileSocialFunction, false);
  }

  // set scrolling for styling when past the first part
  const checkScroll = () => {
    if (window.scrollY == 0) {
      document.body.classList.remove("scrolling");
    } else {
      document.body.classList.add("scrolling");
    }
  };
  window.addEventListener("scroll", checkScroll);
  checkScroll();
};
