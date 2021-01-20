import "../css/main-block.scss";
import LazyLoad from "vanilla-lazyload";

// this is the main file for the block editor styles and

document.addEventListener("DOMContentLoaded", (e) => {
  // just going to disable any anchor tags that are inside of the preview so the user doesn't inadvertently
  // click on a link and leave the page while editing
  document.getElementById("editor").addEventListener("click", (e) => {
    let parent = e.target;
    // just going to climb up 20 and if nothing is found then we're probably not in a place we
    // care about
    let foundLink = false;
    for (let x = 0; x < 20; x++) {
      if (parent) {
        if (foundLink) {
          if ("classList" in parent && parent.classList.contains("acf-block-preview")) {
            // found a match, stop the event and bail
            e.preventDefault();
            return;
          }
        } else if (parent.tagName === "A") {
          foundLink = true;
        }
        if ("parentNode" in parent) {
          parent = parent.parentNode;
        } else {
          // ran out of elements to climb up
          break;
        }
      }
    }
    // if we got here then it was a link somewhere else, just let it pass through
  });

  // lazy loading here will be a bit different. Because a user can add new blocks
  // in after the page has loaded, every second we'll have the update called.
  const myLazyLoad = new LazyLoad({
    elements_selector: ".lazy",
  });
  const updateImages = () => {
    myLazyLoad.update();
    setTimeout(updateImages, 1000);
  };
  setTimeout(updateImages, 1000);
});
