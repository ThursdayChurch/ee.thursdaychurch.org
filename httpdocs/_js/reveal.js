$(document).ready(function() {

  // Store window height
  var height = $(window).height();

  // Global Variables
  var count = 1;
  var lastSlide = 6;
  var scrollScale = 0.015;
  var scrollSpeed = scrollScale*height;



  // Move up a slide when arrow up is clicked
  $('nav #arrow-up').click(function() {

    // Get the height of first slide and the current slide
    var slide1Height = $('#cover-1').height();
    var currentHeight = $('#cover-'+count).height();

    // Only move if the first cover doesn't have full height
    if (slide1Height < height) {

      // Move up to next closest slide (could be itself or the one before it
      if (currentHeight < height) {
        $('#cover-'+count).animate({
          'height': '100%'
        }, 200);

      }
      else {
        $('#cover-'+(count-1)).animate({
          'height': '100%'
        }, 200);

        count-=1;
      }
    }

    // Fade In/Fade Out arrows
    if (count == lastSlide) {
      $('nav #arrow-down').fadeOut('fast');
    }
    else {
      $('nav #arrow-down').fadeIn('fast');
    }

    if (count == 1) {
      $('nav #arrow-up').fadeOut('fast');
    }
    else {
      $('nav #arrow-up').fadeIn('fast');
    }
  });



  // Move down a slide when arrow down is clicked
  $('nav #arrow-down').click(function() {

    // Get height of second to last slide
    var secondToLastHeight = $('#cover-'+(lastSlide-1)).height();

    // Move down to next closest slide
    if (secondToLastHeight > 0) {
        $('#cover-'+count).animate({
          'height': '0'
        }, 200);

        count+=1;
    }

    // Fade In/Fade Out arrows
    if (count == lastSlide) {
      $('nav #arrow-down').fadeOut('fast');
    }
    else {
      $('nav #arrow-down').fadeIn('fast');
    }

    if (count == 1) {
      $('nav #arrow-up').fadeOut('fast');
    }
    else {
      $('nav #arrow-up').fadeIn('fast');
    }
  });



  // First version of mousescroll
  $('body').bind('DOMMouseScroll', function(e){

    // Get height of first slide and second to last slide
    var slide1Height = $('#cover-1').height();
    var secondToLastHeight = $('#cover-'+(lastSlide-1)).height();

    // Fade In/Out arrow up on scroll
    if (slide1Height < height) {
      $('nav #arrow-up').fadeIn('fast');
    }
    else {
      $('nav #arrow-up').fadeOut('fast');
    }

    // Fade In/Out arrow down on scroll
    if (secondToLastHeight == 0) {
      $('nav #arrow-down').fadeOut('fast');
    }
    else {
      $('nav #arrow-down').fadeIn('fast');
    }

      //scroll down
     if(e.originalEvent.detail > 0) {

       // Height of current slide
        var currentHeight = $('#cover-'+count).height();

        // If the side runs out of height, start to change height of next one
        // This will not happen for last slide because it has a height 100% !important
        if (currentHeight == 0) {
          count+=1;
        }
        else {

          // If not out of height, subtract 9px and update
          currentHeight-=scrollSpeed;
          $('#cover-'+count).css('height', currentHeight + 'px');
        }

      //scroll up
     }else {

         // Store current slide height and the first slide height
         var slide1Height = $('#cover-1').height();
         var currentHeight = $('#cover-'+count).height();

         // Make sure that the page is not moving backward past the first slide
         if (slide1Height < height) {

           // If the current slide is less than the window height, keep adding the height
           if (currentHeight < height) {
             currentHeight+=scrollSpeed;
             $('#cover-'+count).css('height', currentHeight + 'px');
           }

           // Otherwise move backwards and increase that slide's height
           else {
             count-=1;
           }
         }
     }

     //prevent page fom scrolling
     return false;
   });




   //Second version mousescroll - IE, Opera, Safari
   $('body').bind('mousewheel', function(e){

     // Get height of first slide and second to last slide
     var slide1Height = $('#cover-1').height();
     var secondToLastHeight = $('#cover-'+(lastSlide-1)).height();

     // Fade In/Out arrow up on scroll
     if (slide1Height < height) {
       $('nav #arrow-up').fadeIn('fast');
     }
     else {
       $('nav #arrow-up').fadeOut('fast');
     }

     // Fade In/Out arrow down on scroll
     if (secondToLastHeight == 0) {
       $('nav #arrow-down').fadeOut('fast');
     }
     else {
       $('nav #arrow-down').fadeIn('fast');
     }

     //scroll down
     if(e.originalEvent.wheelDelta < 0) {

       // Height of current slide
        var currentHeight = $('#cover-'+count).height();

        // If the side runs out of height, start to change height of next one
        // This will not happen for last slide because it has a height 100% !important
        if (currentHeight == 0) {
          count+=1;
        }
        else {

          // If not out of height, subtract 9px and update
          currentHeight-=scrollSpeed;
          $('#cover-'+count).css('height', currentHeight + 'px');
        }
     //scroll up
     }else {

         // Store current slide height and the first slide height
         var slide1Height = $('#cover-1').height();
         var currentHeight = $('#cover-'+count).height();

         // Make sure that the page is not moving backward past the first slide
         if (slide1Height < height) {

           // If the current slide is less than the window height, keep adding the height
           if (currentHeight < height) {
             currentHeight+=scrollSpeed;
             $('#cover-'+count).css('height', currentHeight + 'px');
           }

           // Otherwise move backwards and increase that slide's height
           else {
             count-=1;
           }
         }
     }


     //prevent page fom scrolling
     return false;
   });
});
