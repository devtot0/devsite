$(window).load(function(){

     $('div#navigation div ul li a').click(function(){
               var id = $(this).attr("href");
               $('html,body').stop().animate({scrollTop: $("div"+id).offset().top - 50},'slow', function(){
                         if ( navigator.userAgent.indexOf('iPad') != -1 ) {
                                   var yPos = window.pageYOffset;
                                   var $fixedElement = $('div#hidden_menu');
                                   $fixedElement.css({ "position": "relative" });
                                   window.scroll(0,yPos);
                                   $fixedElement.css({ "position": "fixed" });
                         }
               });

     return false;
     });

     $('#slider').flexslider({
               animation: "slide",              //String: Select your animation type, "fade" or "slide"
               slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
               slideshow: true,                //Boolean: Animate slider automatically
               slideshowSpeed: 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
               animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
               directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
               controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
               keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
               mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
               prevText: "",                   //String: Set the text for the "previous" directionNav item
               nextText: "",                   //String: Set the text for the "next" directionNav item
               pausePlay: false,               //Boolean: Create pause/play dynamic element
               pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
               playText: 'Play',               //String: Set the text for the "play" pausePlay item
               randomize: false,               //Boolean: Randomize slide order
               slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
               animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
               pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
               pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
               manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
               start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
               before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
               after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
               end: function(){}
     });
     
     /*
     var $filterType = $('#filterOptions li.active a').attr('class');
     var $holder = $('ul.sortablePortfolio');
     var $data = $holder.clone();

     $('#portfolioFilter li a').click(function(e) {

               $('#portfolioFilter li').removeClass('active');
               var $filterType = $(this).attr('class');
               $(this).parent().addClass('active');

               if ($filterType == 'all') {
                         var $filteredData = $data.find('li');
               } else {
                      var $filteredData = $data.find('li[data-type~=' + $filterType + ']');
                      }

               $holder.quicksand($filteredData, {
                         duration: 800,
                         adjustHeight: 'auto'
               });
               return false;
     });
     */

     //Load services - DISABLED - now using direct links to HTML pages
     /*
     $('a.read_more').click(function(){
               var source = $(this).attr('href');
               $('div#service_item').append('<div class="loading"></div>');
               $('html,body').animate({scrollTop: $('#services').offset().top},'slow', function(){
                         $('div#service_item div.loading').slideDown(300, function(){
                                   $('div#service_item').load(source, function(){
                                             $('div.loading').css("display","none");
                                             $('div#service_content').slideDown(300, function(){
                                                       $('div#service_content a#close_service').click(function(){
                                                                 $(this).parent('#services').slideUp(300, function(){
                                                                           $('div#service_item').empty();
                                                                 });
                                                       return false;
                                                       });//End: click();
                                             });//End: slideDown()
                                   });//End: load()
                         });//End: slideDown()
               });//End: animate()

     return false;
     });
     */
     
     //Animate testimonials
     $('#testimonials').cycle({ fx: 'fade', slideResize: 0, timeout: 10000, before: function(){ var $ht = $(this).height(); $(this).parent().animate({height: $ht}); } });

});

$(document).ready(function(){

     /*  VALIDATE CONTACT FORM
     ==========================================*/
     var name_value   = 'Name *'; //default placeholder text for the name field
     var mail_value   = 'Email *'; //default placeholder text for the email field
     var message_value= 'Message *'; //default place holder text for the textarea

     var missing_name = 'Podaj swoje nazwisko'; //error message, if the name field is empty
     var missing_mail = 'Podaj adres email.'; //error message, if the mail field is empty
     var invalid_mail = 'Błędny adres email'; //error message, if the user's email address is invalid
     var missing_message = 'Please write us something beautiful!'; //error message, if the textarea is empty

     var error_color   = '#990000'; //text color of the error messages
     var default_color = '#666666'; //default text color of the contact form

     $('input#form-name').click(function() {

               var form_name = $('input#form-name').val();

               if (form_name == missing_name)
                  {
                  $('input#form-name').css("color" , default_color);
                  $('input#form-name').val('');
                  }
                  else if (form_name == name_value)
                          {
                          $('input#form-name').val('');
                          $('input#form-name').css("color" , default_color);
                          }

     });

     $('input#form-mail').click(function() {

               var form_mail = $('input#form-mail').val();

               if (form_mail == missing_mail || form_mail == invalid_mail)
               {
               $('input#form-mail').css("color" , default_color);
               $('input#form-mail').val('');
               }
               else if (form_mail == mail_value)
                       {
                       $('input#form-mail').val('');
                       $('input#form-mail').css("color" , default_color);
                       }

     });

     $('textarea#form-message').click(function() {

               var message_content = $('textarea#form-message').val();

               if (message_content == missing_message || message_content == message_value)
                  {
                  $('textarea#form-message').css("color" , default_color);
                  $('textarea#form-message').val('');
                  }
     });

     $('#contact_form button#button').click(function() {

               var name = $('input#form-name').val();
               var email = $('input#form-mail').val();
               var comments = $('textarea#form-message').val();

               if (name == "" || name == missing_name || name == name_value)
                  {
                  $('input#form-name').css("color" , error_color);
                  $('input#form-name').val(missing_name);
                  }

               if (email == "" || email == invalid_mail || email == mail_value)
                  {
                  $('input#form-mail').css("color" , error_color);
                  $('input#form-mail').val(missing_mail);
                  }
                  
               if (email != mail_value && email != missing_mail ) {
                  var atpos=email.indexOf("@");
                  var dotpos=email.lastIndexOf(".");
                  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
                     {
                     $('input#form-mail').css("color" , error_color);
                     $('input#form-mail').val(invalid_mail);
                     return false;
                     }
               }

               if (comments == "" || comments == message_value || comments == missing_message)
                  {
                  $('textarea#form-message').css("color" , error_color);
                  $('textarea#form-message').val(missing_message);
                  }

               if ( name == "" || name == missing_name || name == name_value || email == "" || email == invalid_mail || email == mail_value || email == missing_mail || comments == "" || comments == message_value || comments == missing_message ) { return false; }

               var atpos=email.indexOf("@");
               var dotpos=email.lastIndexOf(".");
               if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
                  {
                  $('input#form-mail').css("color" , error_color);
                  $('input#form-mail').val(invalid_mail);
                  return false;
                  }

               $("div#contact_form input[type='text']").remove();
               $('div#contact_form textarea').remove();
               $('div#contact_form button').remove();
               $('div#result').append('<div class="loading"></div>');

               $.ajax({
                         type: 'post',
                         url: 'mail.php',
                         data: 'name=' + name + '&email=' + email + '&comments=' + comments,

                         success: function(results) {
                                   $('div.loading').remove();
                                   $('div#result').html(results);
                                   $(".success a").click(function(){ $("div.success").fadeOut("slow"); return false; });
                                   $(".error a").click(function(){ $("div.error").fadeOut("slow"); return false; });
                         }
               });

        });//send click process ends here
        
     /*  . Tool tip settings
     ==========================================*/
     var fb_text = "Like this site!";
     var rss_text = "Subscribe to my rss feeds!";
     var twitter_text = "Follow me on twitter!";
     var skype_text = "Call me on skype!";
     var dribbble_text = "View my dribble profile!";
     var linked_in_text = "LinkedIn!"
     var vimeo_text = "View my Vimeo channel!";
     var youtube_text = "View my Youtube channel!";
     var deviantart_text = "Check out my DeviantArt profile!";
     var pinterest_text = "Pin it!";
     var tumblr_text = "Read my blog at Tumblr!";

     $("#fb").tipTip({ delay: 100, content: fb_text });
     $("#rss").tipTip({ delay: 100, content: rss_text });
     $("#twitter").tipTip({ delay: 100, content: twitter_text });
     $("#skype").tipTip({ delay: 100, content: skype_text });
     $("#dribbble").tipTip({ delay: 100, content: dribbble_text });
     $("#linked").tipTip({ delay: 100, content: linked_in_text });
     $("#vimeo").tipTip({ delay: 100, content: vimeo_text });
     $("#youtube").tipTip({ delay: 100, content: youtube_text });
     $("#deviantart").tipTip({ delay: 100, content: deviantart_text });
     $("#pinterest").tipTip({ delay: 100, content: pinterest_text });
     $("#tumblr").tipTip({ delay: 100, content: tumblr_text });

});