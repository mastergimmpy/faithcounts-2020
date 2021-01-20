import axios from "axios";
import wirePlayer from "./audio-player";

const popupInit = () => {
  /************************************************
   POPUP LINKS
  ************************************************/
  const $popup = document.getElementById("popup");
  const $popupBody = document.getElementById("popup-body");
  let origUrl = location.href;
  let origTitle = document.title;
  let showingPopup = false;
  let onClose = null;

  const closePopup = function(e) {
    if (showingPopup) {
      if (e && e.preventDefault) {
        e.preventDefault();
      }
      history.replaceState({}, document.title, origUrl);
      document.title = origTitle;
      $popupBody.innerHTML = "";
      if (onClose) {
        onClose();
      }
    } else {
      // this is on a full page load, not a popup, just honor
      // the url in the link
      if (location.href != origUrl && !onClose) {
        location.href = location.href;
      }
      return true;
    }
    showingPopup = false;
    document.body.classList.remove("showing-popup");
    return false;
  };
  const popupPageClick = function(e, self = this, mode = "pushState") {
    showingPopup = true;
    origUrl = location.href;
    e.preventDefault();
    // change the URL
    history[mode]({}, document.title, self.href);
    // setup the popup (remove old html and show loading)
    $popup.classList.add("loading");
    $popupBody.innerHTML = "";

    // show the popup
    document.body.classList.add("showing-popup");
    // load the popup content
    axios.get(self.href).then(rslt => {
      const range = document.createRange();
      const docFrag = range.createContextualFragment(rslt.data);
      document.title = docFrag.querySelector("title").innerText;
      // NOTE: This depends on a single element underneath the #popup-body to work
      // if there is more than one, only the first will be added to the popup
      $popupBody.appendChild(
        docFrag.querySelector("#popup-body").children.item(0)
      );
      $popup.classList.remove("loading");

      // console.log("I am in the popup.");
      var pageName = pageInfo();
      // console.log("pageName : ", pageName);

      window.digitalData.push({
        event: window.digitalDataEvents.pageView,
        page: {
          info: {
            name: pageName,
            language: "eng",
            siteName: "Faith Counts"
          }
        }
      });

      var popupBodyClose = $popupBody.querySelectorAll(".popup-close-link");
      for (var i = 0; i < popupBodyClose.length; i++) {
        popupBodyClose[i].addEventListener("click", closePopup);
      }
      // // just try and wire up any podcasts
      wirePlayer($popupBody);
    });

    return false;
  };

  function pageInfo() {
      var pageName = document.title;
      pageName = pageName.slice(2, (pageName.length));
      // console.log("The pageName is : ",pageName);
      var siteNameInfo = "Faith Counts";
      var breadcrumb = window.location.href;
      // console.log("The breadcrumb is : ", breadcrumb);
      var temp = breadcrumb.indexOf('.com');
      // console.log("temp index is : ", temp);
      breadcrumb = breadcrumb.slice((temp+4), (breadcrumb.length));
      // console.log("the new breadcrumb is : ", breadcrumb);
    
      if(breadcrumb === '/') {
        //console.log("breadcrumb is root");
        breadcrumb = 'home';
        //console.log("Final breadcrumb is : ", breadcrumb);
      }
      else {
        var temp = breadcrumb.split('/');
        var tempBuild = "";
    
        for(var i = 0; i < temp.length-1; i++) {
          tempBuild = tempBuild + temp[i] + "|";
        }
    
        temp = tempBuild.split('-');
        tempBuild = "";
    
        for(var j = 0; j < temp.length; j++) {
          tempBuild = tempBuild + temp[j] + " ";
        }
    
        breadcrumb = tempBuild.slice(1, (tempBuild.length - 2));
       // console.log("Final breadcrumb is : ", breadcrumb);
      }
    
      return pageName;
    
    }


  // going to use a little more sophisticated approach to capturing popup links than just
  // a class name. The problem with class names is that in the Wordpress world when creating
  // links in content, the user won't know to add the class name on to the link. Here we'll
  // loop through the different possible post types that are popups and wire them up to be
  // recognized as popups.
  function capturePopupLinks(
    newURL = "",
    newTitle = "",
    wrapperSelector = "",
    onLinkClick = null,
    onLinkClose = null
  ) {
    if (newURL) {
      origUrl = newURL;
    }
    if (newTitle) {
      origTitle = newTitle;
    }
    if (onLinkClose) {
      onClose = onLinkClose;
    }
    ["videos", "sharables", "podcasts"].forEach(type => {
      document
        .querySelectorAll(
          `${wrapperSelector + wrapperSelector ? " " : ""}a[href^="${
            fcWp.baseUrl
          }/${type}/"]`
        )
        .forEach(link => {
          if (onLinkClick) {
            link.addEventListener("click", e => {
              popupPageClick(e, link, "replaceState");
              onLinkClick(e);
            });
          } else {
            link.addEventListener("click", popupPageClick);
          }
        });
    });
  }
  capturePopupLinks();
  // Turned this portion into a function so that it can be called from the search module when it needs to
  popupInit.capturePopupLinks = capturePopupLinks;
  // const popupLaunch = document.getElementsByClassName("popup-page-link");
  // for (var i = 0; i < popupLaunch.length; i++) {
  //   popupLaunch[i].addEventListener("click", popupPageClick);
  // }
  const popupClose = document.getElementById("popup-close");
  if (popupClose) {
    popupClose.addEventListener("click", closePopup);
  } else {
    document.getElementById("popup-body").addEventListener("click", e => {
      if (
        e.target.id == "popup-body" ||
        e.target.parentElement.id == "popup-body"
      ) {
        closePopup(e);
      }
    });
  }
  window.addEventListener("popstate", closePopup);
};

export default popupInit;
