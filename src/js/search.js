import axios from "axios";
import popups from "./popups";

export default lazyLoader => {
  var onClose = null;
  var ogPath = window.location.pathname;

  //Search buttons
  var showSearchBtn = document.getElementById("search-icon");
  var searchCloseBtn = document.getElementById("search-close");

  // to prevent spinning up lots of different watchers if the user
  // opens and closes the search, this watchTimerId is used to track
  // the last known timeout and it is canceled immediately when the
  // method is called. This should help coalesce multiple running
  // chains into one.
  let watchTimerId = false;
  let changeException = false;
  function watchLocationChange(
    onChange,
    comp = "href",
    currLoc = window.location[comp]
  ) {
    clearTimeout(watchTimerId);
    if (currLoc === window.location[comp] || changeException) {
      setTimeout(() => {
        watchTimerId = watchLocationChange(onChange, comp, currLoc);
      }, 300);
    } else {
      onChange(currLoc, window.location[comp]);
    }
  }
  function openSearchPopup(searchPopup) {
    document.body.classList.add("search-open");
    searchPopup.classList.add("closed");
    setTimeout(() => {
      searchPopup.classList.add("opening");
      searchPopup.classList.remove("closed");
      setTimeout(() => {
        searchPopup.classList.remove("opening");
      }, 600);
    }, 100);
  }

  function updateQueryParameters(
    qparam,
    qvalue,
    href = window.location.href,
    search = window.location.search
  ) {
    if (!qvalue) {
      return removeQueryParameter(qparam, href);
    }
    if (search.includes(qparam + "=")) {
      return href.replace(
        new RegExp(qparam + "=([^&]*)"),
        qparam + "=" + qvalue
      );
    } else {
      if (href.includes("?")) {
        return href + "&" + qparam + "=" + qvalue;
      } else {
        return href + "?" + qparam + "=" + qvalue;
      }
    }
  }

  function removeQueryParameter(qparam, href = window.location.href) {
    return href
      .replace(new RegExp(qparam + "=[^&]*&?"), "")
      .replace(/(\?|&)$/, s => s.slice(0, s.length - 1));
  }

  function getQueryParams(url = window.location.href) {
    const qpairs = url.match(/([^&?]+)=([^&]*)/g);
    const params = {};
    if (qpairs) {
      qpairs
        .map(pair => pair.split("="))
        .forEach(pair => {
          if (pair[1]) {
            params[pair[0]] = pair[1];
          }
        });
    }
    return params;
  }

  //open search
  if (showSearchBtn) {
    var closeSearch = function(e) {
      if (e) {
        e.preventDefault();
      }
      if (searchCloseBtn.matches("[nav-back]")) {
        window.history.back();
      } else {
        document.body.classList.remove("search-open");
        if (e) {
          window.history.back();
        }
        if (onClose) {
          onClose();
        }
      }
    };
    // this will take the href of the clicked on element (climbing up if the target isn't an anchor)
    // and call for that as the search query.
    var showSearch = function(e) {
      if (e) {
        e.preventDefault();
        // log that search is opening
        // console.log("Search has opened and pushing pageView event");
        
        // push pageView event for search
        window.digitalData.push({
          event: window.digitalDataEvents.pageView,
          page: {
            info: {
              name: "search page",
              language: "eng",
              siteName: "Faith Counts"
            }
          }
        });
      }
      let link = e.target;
      if (link.tagName != "A") {
        // climb up until we find the anchor tag, only anchor tags
        // will have been wired up with
        link = e.target.parentElement;
        while (link && link.tagName != "A") {
          link = link.parentElement;
        }
      }
      if (!link) {
        // just bail, something went really screwy
        return;
      }
      const searchPopup = document.getElementById("search-pop");
      const innerContent = searchPopup.querySelector(".inner-content");
      innerContent.innerHTML = "";
      searchPopup.classList.add("loading");
      axios
        .get(link.href)
        .then(res => {
          const searchPage = document.createElement("html");
          searchPage.innerHTML = res.data;
          if (searchPopup) {
            searchPopup.classList.remove("loading");
            innerContent.innerHTML =
              "<main>" + searchPage.querySelector("main").innerHTML + "</main>";
            setTimeout(() => {
              setupSearchPage();
            }, 500);
            // Run the code for popups again because we need to ;)
            popups.capturePopupLinks(
              location.href,
              document.title,
              ".search-wrapper",
              () => {
                changeException = true;
              },
              () => (changeException = false)
            );
            lazyLoader.update();
          }
        })
        .catch(console.error);
      openSearchPopup(searchPopup);
      window.history.pushState({ pade_id: "search" }, "search-page", this.href);
      watchTimerId = watchLocationChange(function(from, to) {
        // console.log(to, ogPath);
        if (to == ogPath) {
          closeSearch(false);
        } else {
          window.location.pathname = to;
        }
      }, "pathname");
    };
    // find all the search links on the page and wire those up
    document
      .querySelectorAll(`a[href^="${fcWp.baseUrl}/search/"]`)
      .forEach(link => {
        link.addEventListener("click", showSearch);
      });
    //close search
    if (searchCloseBtn) {
      searchCloseBtn.addEventListener("click", closeSearch, false);
    }
  }

  function setupSearchPage() {
    //the search form
    var searchForm = document.getElementById("searchform");

    //the search sections
    var searchWrapper = document.querySelector(".search-wrapper");
    var singleFilters = document.querySelectorAll(
      ".filter-wrapper .single-filter"
    );

    // This represents the currently selected filter really, but is used to remove
    // 'active' class from selected filter when new one is selected,
    // so it is the previous filter in the context of when it is used.
    let lastFilter = document.querySelector(
      ".filter-wrapper .single-filter.active"
    );
    // Adding event logic for all of the filters
    document
      .querySelectorAll(".filter-wrapper .single-filter")
      .forEach(filter => {
        const dataType = filter.getAttribute("data-type");
        filter.addEventListener("click", e => {
          // checks if it is selected or not, or if it is the 'all filters' filter,
          // which has similar logic to when the others are deselected even when being selected
          // The datatype attribute should be empty string for 'all filters' filter
          if (filter.classList.contains("active") || dataType == "") {
            let makeLastNull = true;
            if (dataType != "") {
              filter.classList.remove("active");
              filter.parentElement.classList.remove("has-selection");
            } else {
              if (filter.classList.contains("active")) {
                filter.classList.remove("active");
                filter.parentElement.classList.remove("has-selection");
              } else {
                filter.classList.add("active");
                filter.parentElement.classList.add("has-selection");
                makeLastNull = false;
              }
            }
            // Selects all slides that are hidden
            const pSlides = document.querySelectorAll(
              ".search-wrapper .post-slide.hiddenBlock"
            );
            // Using conventional for loops for speed
            for (let i = 0; i < pSlides.length; i++) {
              const pSLide = pSlides[i];
              pSLide.classList.remove("hiddenBlock");
            }
            lastFilter = makeLastNull ? null : filter;
            window.history.replaceState(
              {},
              "search-filter",
              removeQueryParameter("f")
            );
          } else {
            if (lastFilter) {
              // Removes the selection if there is one for new selection to take place
              lastFilter.classList.remove("active");
            }
            lastFilter = filter;
            filter.classList.add("active");
            window.history.replaceState(
              {},
              "search-filter",
              updateQueryParameters("f", filter.getAttribute("data-type"))
            );
            filter.parentElement.classList.add("has-selection");
            // Finds all slides that are not hidden and hides them
            const oldSlides = document.querySelectorAll(
              `.search-wrapper .post-slide:not(.hiddenBlock)`
            );
            // Unhides all of the slides that match the filter
            const newSlides = document.querySelectorAll(
              `.search-wrapper .post-slide[data-type=${dataType}]`
            );
            for (let i = 0; i < oldSlides.length; i++) {
              const oldSlide = oldSlides[i];
              oldSlide.classList.add("hiddenBlock");
            }
            for (let i = 0; i < newSlides.length; i++) {
              const newSlide = newSlides[i];
              newSlide.classList.remove("hiddenBlock");
            }
          }
        });
      });

    if (searchForm) {
      const input = searchForm.querySelector("input[name=q]");
      // Keeps track of the previous value in case it was the same
      // and then it knows it doesn't need to re-request
      let lastValue = input.value;
      const searchFormFunction = function(event, closing = false) {
        event.preventDefault();
        // console.log("The search has fired off");
        if (lastValue != input.value) {
          lastValue = input.value;
          // Search now must include any other params that might effect the results
          
          const params = getQueryParams();
          params["q"] = input.value;
          // Before request, let's empty the results and add a loading indicator
          searchWrapper.innerHTML =
            "<div class='search-loading' style='height: 400px; width: 100%'></div>";
          axios
            .get(searchForm.getAttribute("action"), {
              params
            })
            .then(res => {
              const virDoc = document.createElement("html");
              virDoc.innerHTML = res.data;
              const filters = virDoc.querySelectorAll(
                ".filter-wrapper .single-filter"
              );
              const results = virDoc.querySelector(".search-wrapper");
              searchWrapper.innerHTML = results.innerHTML;
              singleFilters.forEach((filter, i) => {
                filter.innerHTML = filters[i].innerHTML;
              });
              lazyLoader.update();


                var searchTerm = "not yet set";
                var videos, articles, sharables, podcasts, downloads; 
                var searchResults = 0;
                // console.log("marker load");
    
                // console.log("search has been submitted");
                searchTerm = input.value;
                // console.log("The searchTerm is : ", searchTerm);
    
                if(searchTerm === "") {
                  searchTerm = "No search term was specified";
                }
    
                videos = Number(document.getElementById("video-filter-count").getAttribute("data-videosearchcount"));
                articles = Number(document.getElementById("article-filter-count").getAttribute("data-articlesearchcount"));
                sharables = Number(document.getElementById("sharable-filter-count").getAttribute("data-sharablessearchcount"));
                podcasts = Number(document.getElementById("podcast-filter-count").getAttribute("data-podcastsearchcount"));
                downloads = Number(document.getElementById("download-filter-count").getAttribute("data-downloadssearchcount"));
      
                searchResults = videos + articles + sharables + podcasts + downloads;
                // console.log("The search result total is : ", searchResults);
    
                window.digitalData.push({
                  event: window.digitalDataEvents.search,
                  search: {
                    info: {
                      term: searchTerm,
                      results: searchResults,
                    },
                    category: {
                      primary: "keyword"
                    }
                  }
                });
              // console.log(digitalData);
              
            })
            .catch(err => {
              console.error(err);
              if (!closing) {
                searchForm.submit();
              }
            });
          window.history.replaceState(
            {},
            "search",
            updateQueryParameters("q", input.value)
          );
        }
      };
      searchForm.addEventListener("submit", searchFormFunction);
      onClose = function() {
        if (input.value) {
          input.value = "";
          searchFormFunction({ preventDefault() {} }, true);
          
        }
      };
    }
  }

  setupSearchPage();
};
