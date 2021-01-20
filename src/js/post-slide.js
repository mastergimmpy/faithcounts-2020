export default () => {
  //post slide next button
  var nextBtn = document.getElementsByClassName("post-more-button");
  var nextBtnFunction = function() {
    var slider = this.parentNode.querySelector(".post-slide-wrapper");
    slider.scrollLeft += 411;
  };
  for (var i = 0; i < nextBtn.length; i++) {
    nextBtn[i].addEventListener("click", nextBtnFunction, false);
  }

  // determine if the width of post-slides is less than the window size (due to fewer
  // items). If so, mark it to be centered in the area it appears in
  const sliders = document.querySelectorAll(".post-slides");
  const checkCentering = () => {
    // get the window width
    const windowWidth = window.innerWidth;
    sliders.forEach(el => {
      // calculate the width without padding of element
      const slidesWidth = el.scrollWidth - (parseInt(window.getComputedStyle(el).paddingLeft) || 0);
      // 80 is the default padding at larger sizes
      if (slidesWidth + 80 > windowWidth) {
        // greater in size so let the normal layout with scrollbar happen
        el.parentElement.classList.remove("center-slides");
      } else {
        // smaller in size, set it to center
        el.parentElement.classList.add("center-slides");
      }
    });
  };
  window.addEventListener("resize", checkCentering);
  checkCentering();
};
