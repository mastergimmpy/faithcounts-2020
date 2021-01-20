// this is the main file for the site's layout and javascript.
import "../css/main.scss";
import nav from "./navigation";
import popups from "./popups";
import search from "./search";
import audioPlayer from "./audio-player";
import postSlide from "./post-slide";
import LazyLoad from "vanilla-lazyload";

// setup analytics
window.digitalData = window.digitalData || [];
window.digitalDataEvents = {
  pageView: "Page View",
  search: "Search",
  component: {
    click: "Component Click",
    share: "Share",
    formStart: "Form Start",
    formError: "Form Error",
    formSubmit: "Form Submit",
    download: "Download",
    checklistUpdated: "Checklist Updated"
  }
};

// variables
// var footerFormView = 0;
// var myFaithFormView = 0;

// Page Info
// function pageInfo() {
//   var pageName = document.title;
//   pageName = pageName.slice(2, (pageName.length));
//   console.log("The pageName is : ",pageName);
//   var siteNameInfo = "Faith Counts";
//   var breadcrumb = window.location.href;
//   console.log("The breadcrumb is : ", breadcrumb);
//   var temp = breadcrumb.indexOf('.com');
//   console.log("temp index is : ", temp);
//   breadcrumb = breadcrumb.slice((temp+4), (breadcrumb.length));
//   console.log("the new breadcrumb is : ", breadcrumb);

//   if(breadcrumb === '/') {
//     console.log("breadcrumb is root");
//     breadcrumb = 'home';
//     console.log("Final breadcrumb is : ", breadcrumb);
//   }
//   else {
//     var temp = breadcrumb.split('/');
//     var tempBuild = "";

//     for(var i = 0; i < temp.length-1; i++) {
//       tempBuild = tempBuild + temp[i] + "|";
//     }

//     temp = tempBuild.split('-');
//     tempBuild = "";

//     for(var j = 0; j < temp.length; j++) {
//       tempBuild = tempBuild + temp[j] + " ";
//     }

//     breadcrumb = tempBuild.slice(1, (tempBuild.length - 2));
//     console.log("Final breadcrumb is : ", breadcrumb);
//   }

//   window.digitalData.push({
//     event: window.digitalDataEvents.pageView,
//     page: {
//       info: {
//         name: pageName,
//         language: "eng",
//         siteName: siteNameInfo
//       }
//     }
//   });

// }

 // Social Header links
//  document.getElementsByClassName("header-twitter").addEventListener("click", (e) => {
//   var linkURL = window.location.href;
//   window.digitalData.push({
//     event: window.digitalDataEvents.component.share,
//     component: {
//       info: {
//         channel: "Twitter",
//         link: linkURL
//       },
//       category: {
//         primary: "Social Media"
//       }
//     }
//   });
// });

// document.getElementsByClassName("header-facebook").addEventListener("click", (e) => {
//   var linkURL = window.location.href;
//   window.digitalData.push({
//     event: window.digitalDataEvents.component.share,
//     component: {
//       info: {
//         channel: "Facebook",
//         link: linkURL
//       },
//       category: {
//         primary: "Social Media"
//       }
//     }
//   });
// });

// document.getElementsByClassName("header-email").addEventListener("click", (e) => {
//   var linkURL = window.location.href;
//   window.digitalData.push({
//     event: window.digitalDataEvents.component.share,
//     component: {
//       info: {
//         channel: "Email",
//         link: linkURL
//       },
//       category: {
//         primary: "Social Media"
//       }
//     }
//   });
// });

// Form start footer
// document.getElementById("field_contactname").addEventListener("blur", (e) => {
//   footerFormView = footerFormView + 1;
//   if(footerFormView === 1) {
//     window.digitalData.push({
//       event: window.digitalDataEvents.component.formStart,
//       component: {
//         info: {
//           name: "Footer Contact Form"
//         }
//       },
//       category: {
//         primary: "form"
//       }
//     });
//   }
// });

// setup page load functions
document.addEventListener("DOMContentLoaded", e => {
  var myLazyLoad = new LazyLoad({
    elements_selector: ".lazy"
  });
  nav();
  popups();
  search(myLazyLoad);
  audioPlayer();
  postSlide();
  //pageInfo();
});
