export default () => {
  var $videoLink = document.getElementById("video-hero");
  var $videoPlayer = document.getElementById("dynamicIframe");
  var openVideo = function(e) {
    e.preventDefault();
    var video_link = $videoLink.href;
    $videoPlayer.src = video_link;
    document.body.classList.add("showing-videopop");
    console.log($videoPlayer.href);
  };
  if ($videoLink) {
    $videoLink.addEventListener("click", openVideo, false);
  }

  /************************************************
  POPUP LINKS
 ************************************************/
  var $popup = document.getElementById("popup");
  var $popupBody = document.getElementById("popup-body");
  var origUrl = location.href;
  // it is assumed this is being called from a click action on a link, but should
  // function fine in other scenarios
  function httpGet(theUrl) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl, false); // false for synchronous request
    xmlHttp.send(null);
    return xmlHttp.responseText;
  }
  var closePopup = function(e) {
    document.body.classList.remove("showing-popup");
    document.body.classList.remove("showing-videopop");
    if ($videoPlayer) {
      $videoPlayer.src = "";
    }
    history.replaceState({}, document.title, origUrl);
    return false;
  };
  var popupPageClick = function(e) {
    e.preventDefault();
    // change the URL
    history.pushState({}, document.title, this.href);
    // setup the popup (remove old html and show loading)
    $popup.classList.add("loading");
    $popupBody.innerHTML = "";

    // show the popup
    document.body.classList.add("showing-popup");
    // load the popup content
    var getHttp = httpGet(this.href);
    $popupBody.innerHTML = getHttp;

    $popup.classList.remove("loading");
    var popupBodyClose = document.getElementsByClassName("popup-close-link");
    for (var i = 0; i < popupBodyClose.length; i++) {
      popupBodyClose[i].addEventListener("click", closePopup, false);
    }

    return false;
  };
  var popupLaunch = document.getElementsByClassName("popup-page-link");
  for (var i = 0; i < popupLaunch.length; i++) {
    popupLaunch[i].addEventListener("click", popupPageClick, false);
  }
  var popupClose = document.getElementById("popup-close");
  if (popupClose) {
    popupClose.addEventListener("click", closePopup, false);
    window.addEventListener("popstate", function(e) {
      closePopup();
    });
  }
};
