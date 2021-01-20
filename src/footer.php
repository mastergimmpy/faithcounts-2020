<?php 
global $no_search_pop;
?>
<footer>
  <div class="container">
    <div class="social-column">
      <div class="social-title"><?php the_field('social_section_title','global_options'); ?></div>
      <div class="footer-social-icons">
      <?php 
      $twitter_url = get_field('twitter_url','global_options');
      $instagram_url = get_field('instagram_url','global_options');
      $facebook_url = get_field('facebook_url','global_options');
      $pinterest_url = get_field('pinterest_url','global_options');
      $youtube_url = get_field('youtube_url','global_options');
      if ($twitter_url) { ?>
        <a href="<?php echo $twitter_url; ?>" target="_blank" class="footer-twitter" data-footersocial="twitter"></a>
      <?php }
      if ($instagram_url) { ?>
        <a href="<?php echo $instagram_url; ?>" target="_blank" class="footer-instagram" data-footersocial="instagram"></a>
      <?php }
      if ($facebook_url) { ?>
        <a href="<?php echo $facebook_url; ?>" target="_blank" class="footer-facebook" data-footersocial="facebook"></a>
      <?php }
      if ($pinterest_url) { ?>
        <a href="<?php echo $pinterest_url; ?>" target="_blank" class="footer-pinterest" data-footersocial="pinterest"></a>
      <?php }
      if ($youtube_url) { ?>
        <a href="<?php echo $youtube_url; ?>" target="_blank" class="footer-youtube" data-footersocial="youtube"></a>
      <?php }
      ?>
      <div class="clearfix"></div>
      </div>
    </div>
    <div class="contact-column">
      <?php $form_shortcode = get_field('form_shortcode', 'global_options'); 
      echo do_shortcode($form_shortcode);
      ?>
    </div>
    <div class="clearfix"></div>
    <div class="footer-copy">Copyright &copy; <?php echo Date('Y'); ?> FaithCounts</div>
  </div>
</footer>
<div id="overlay-all"></div>
<div id="mobile-mask"></div>

<div id="popup">
  <div id="popup-body">
    <!-- Content for the popup goes in here -->
    <!-- Any links that should hide the popup in here should have a class of
    .popup-close-link. It should be an <a> and point to the parent page that
    the popup appears over. Javascript will detect any links with that class
    when the popup is loaded and wire them up to close the popup as needed. -->
  </div>
</div>

<?php
if (!$no_search_pop) { ?>
  <div id="search-pop">
    <div class="inner-content"></div>
  </div> <?php
} ?>
<?php wp_footer(); ?>

<script type="text/javascript">
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

        var pageName = jQuery("title").text();
        pageName = pageName.slice(3, (pageName.length));
        // console.log(pageName);
        var siteNameInfo = "Faith Counts";
        var breadcrumb = "<?php echo $_SERVER['REQUEST_URI']?>";

        if(breadcrumb == '/') {
          breadcrumb = 'home';
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
        }

        window.addEventListener('load', function(){
          window.digitalData.push({
            event: window.digitalDataEvents.pageView,
            page: {
              info: {
                name: pageName,
                language: "eng",
                siteName: siteNameInfo
              }
            }
          });
        });

        // Form start footer
        jQuery(function() {
          var view = 0;
          jQuery("#field_contactname").blur(function() {
              view = view + 1;

              if(view === 1) {                
                window.digitalData.push({
                  event: window.digitalDataEvents.component.formStart,
                  component: {
                    info: {
                      name: "Footer Contact Form"
                    },
                    category: {
                      primary: "form"
                    }
                  }
                });
              }
          });
        });

        // form error footer
        jQuery(function() {

          var validName = false;
          var validEmail = false;
          var validMessage = false;
          let errorFields = [];

          jQuery("#form_footercontact").submit(function(event) {

            var name = jQuery("#field_contactname").val();
            var email = jQuery("#field_contactemail").val();
            var message = jQuery("#field_contactmessage").val();

            validateNameField(name, event);
            validateEmailField(email, event);
            validateMessageField(message, event);

            if((validName == false) || (validEmail == false) || (validMessage == false)) {
              window.digitalData.push({
                event: window.digitalDataEvents.component.formError,
                component: {
                  info: {
                    name: "Footer Contact Form",
                    error: errorFields
                  },
                  category: {
                    primary: "form"
                  }
                }
              });

              errorFields = [];
            }
            else {
              window.digitalData.push({
                event: window.digitalDataEvents.component.formSubmit,
                component: {
                  info: {
                    name: "Footer Contact Form"
                  },
                  category: {
                    primary: "form"
                  }
                }
              });
            }
          });


          function isNameVaild(name) {
            if(name.trim().length >= 2){
              return true;
            }
            return false;
          }

          function isEmailVaild(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

          function isMessageValid(message) {
            return message.trim() !== "";
          }

          function validateNameField(name, event) {
            if(!isNameVaild(name)) {
              errorFields.push("name field");
              event.preventDefault();
            }
            else {
              validName = true;
            }
          }

          function validateEmailField(email, event) {
            if(!isEmailVaild(email)) {
              errorFields.push("email field");
              event.preventDefault();
            }
            else {
              validEmail = true;
            }
          }

          function validateMessageField(message, event) {
            if(!isMessageValid(message)) {
              errorFields.push("message field");
              event.preventDefault();
            }
            else {
              validMessage = true;
            }
          }
        });

        // Social Header links
        jQuery(function() {
          var linkURL = "<?php echo $_SERVER['REQUEST_URI']?>";
          var temp;
          if(linkURL === '/') {
            linkURL = "https://faithcounts.com" + linkURL;
          }
          else {
            temp = linkURL.slice(0, (linkURL.length - 1));
            linkURL = "https://faithcounts.com" + temp;
          }

          jQuery('a[data-headersocial="twitter"]').click(function(event) {
            window.digitalData.push({
              event: window.digitalDataEvents.component.share,
              component: {
                info: {
                  channel: "Twitter",
                  link: linkURL
                },
                category: {
                  primary: "Social Media"
                }
              }
            });
          });

          jQuery('a[data-headersocial="facebook"]').click(function(event) {
            window.digitalData.push({
              event: window.digitalDataEvents.component.share,
              component: {
                info: {
                  channel: "Facebook",
                  link: linkURL
                },
                category: {
                  primary: "Social Media"
                }
              }
            });
          });

          jQuery('a[data-headersocial="email"]').click(function(event) {
            window.digitalData.push({
              event: window.digitalDataEvents.component.share,
              component: {
                info: {
                  channel: "email",
                  link: linkURL
                },
                category: {
                  primary: "Social Media"
                }
              }
            });
          });

        });

        // MyFaith Form
        jQuery(function() {
          var myFaithView = 0;
          jQuery("#field_myfaithname").blur(function() {
            myFaithView = myFaithView + 1;

            if(myFaithView === 1) {
              window.digitalData.push({
                event: window.digitalDataEvents.component.formStart,
                component: {
                  info: {
                    name: "MyFaith Form"
                  },
                  category: {
                    primary: "form"
                  }
                }
              });
            }
          });
        });

        jQuery(function() {
          var validName = false;
          var validEmail = false;
          var validAboutMe = false;
          var validIAmFaith = false;
          var validWhyAmIFaith = false;
          // var validPhoto = false;
          let errorFieldsMyFaith = [];

          jQuery("#form_myfaith").submit(function(event) {
            var name = jQuery("#field_myfaithname").val();
            var email = jQuery("#field_myfaithemail").val();
            var aboutMe = jQuery("#field_aboutme").val();
            var iAmFaith = jQuery("#field_iamreligion").val();
            var whyAmIFaith = jQuery("#field_whyamifaith").val();
            // var photoUpload = jQuery('span').data('data-dz-name').text();

            // console.log("checking photo upload field value :", photoUpload);

            // validatePhotoUpload(photoUpload, event);
            validateNameField(name, event);
            validateEmailField(email, event);
            validateAboutMeField(aboutMe, event);
            validateIAmFaithField(iAmFaith, event);
            validateWhyAmIFaithField(whyAmIFaith, event);

            // form validation check
            if((validName == false) || (validEmail == false) || (validAboutMe == false) || (validIAmFaith == false) || (validWhyAmIFaith == false)) {
              window.digitalData.push({
                event: window.digitalDataEvents.component.formError,
                component: {
                  info: {
                    name: "MyFaith Form",
                    error: errorFieldsMyFaith
                  },
                  category: {
                    primary: "form"
                  }
                }
              });

              errorFieldsMyFaith = [];
            }
            else {
              window.digitalData.push({
                event: window.digitalDataEvents.component.formSubmit,
                component: {
                  info: {
                    name: "MyFaith Form Submit"
                  },
                  category: {
                    primary: "form"
                  }
                }
              });
            }

            // function isPhotoValid(photoUpload) {
            //   console.log("Start of photo validation");
            //   console.log("photo upload value : ", photoUpload);
            //   var photoOK = false;
            //   var temp = photoUpload.split('.');
            //   console.log("Temp is : ", temp);

            //   var extension = "";
            //   if(photoUpload.length < 1){
            //     photoOK = false;
            //   }
            //   else if((extension != "PNG") || (extension != "JPG") || (extension != "GIF") || (extension != "JPEG")) {
            //     photoOK = false;
            //   }
            //   else {
            //     photoOK = true;
            //   }

            //   return photoOK;
            // }

            function isNameValid(name) {
              if(name.trim().length >= 2){
                      return true;
                    }
                    return false;
            }

            function isEmailValid(email) {
              var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              return regex.test(email);
            }

            function isAboutMeValid(aboutMe) {
              return aboutMe.trim() !== "";
            }

            function isIAmFaithValid(iAmFaith) {
              return iAmFaith.trim() !== "";
            }

            function isWhyAmIFaithValid(whyAmIFaith) {
              return whyAmIFaith.trim() !== "";
            }

            function validatePhotoUpload(photoUpload, event) {
              if(!isPhotoValid(photoUpload)) {
                errorFieldsMyFaith.push("photo upload field");
                event.preventDefault();
              }
              else {
                validPhoto = true;
              }
            }

            function validateNameField(name, event) {
              if(!isNameValid(name)) {
                errorFieldsMyFaith.push("name field");
                event.preventDefault();
              }
              else {
                validName = true;
              }
            }

            function validateEmailField(email, event) {
              if(!isEmailValid(email)) {
                errorFieldsMyFaith.push("email field");
                event.preventDefault();
              }
              else {
                validEmail = true;
              }
            }

            function validateAboutMeField(aboutMe, event) {
              if(!isAboutMeValid(aboutMe)) {
                errorFieldsMyFaith.push("about me field");
                event.preventDefault();
              }
              else {
                validAboutMe = true;
              }
            }

            function validateIAmFaithField(iAmFaith, event) {
              if(!isIAmFaithValid(iAmFaith)) {
                errorFieldsMyFaith.push("i am faith field");
                event.preventDefault();
              }
              else {
                validIAmFaith = true;
              }
            }

            function validateWhyAmIFaithField(whyAmIFaith, event) {
              if(!isWhyAmIFaithValid(whyAmIFaith)) {
                errorFieldsMyFaith.push("why i am faith field");
                event.preventDefault();
              }
              else {
                validWhyAmIFaith = true;
              }
            }

          });
        });


    </script>
  </body>
</html>