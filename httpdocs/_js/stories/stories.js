$(document).ready(function() {
  /*$("#fullpage").fullpage({
    onLeave: function(index, nextIndex, direction) {
        var leavingSection = $(this);

        setTimeout(function() {
            if (index == 2) {
                $('#stories-vid')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
            }
        }, 500);
    },

    afterLoad: function(anchorLink, index) {
        var loadedSection = $(this);

        setTimeout(function() {
            if (index == 2) {
                $('#stories-vid')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
            }
        }, 500);
    }
  });*/

  var windowHeight = $(window).height();

  $("section").css({
    "min-height" : windowHeight
  });

  $(window).resize(function() {
    windowHeight = $(window).height();

    $("section").css({
      "min-height" : windowHeight
    });
  });

  $("#stories-form").validate();

  var sections = $("section");
  var sectionScrollTops = [];

  sections.each(function() {
    sectionScrollTops.push($(this).offset().top);
  });

  function getSectionIndex() {
    var currentScrollTop = $(document).scrollTop();

    for (var i = 0; i < (sectionScrollTops.length)-1; ++i) {
      if (currentScrollTop >= sectionScrollTops[i] && currentScrollTop < sectionScrollTops[i+1]) {
        return i;
      }
    }

    return i;
  };

  var sectionIndex = getSectionIndex();

  $(".arrow-up").click(function() {
    sectionIndex = getSectionIndex();

    if ($(document).scrollTop() != sectionScrollTops[sectionIndex]) {
      $("html, body").animate({
        scrollTop: sectionScrollTops[sectionIndex]
      });
    }
    else {
      $("html, body").animate({
        scrollTop: sectionScrollTops[sectionIndex-1]
      });
    }
  });

  $(".arrow-down").click(function() {
    sectionIndex = getSectionIndex();

    $("html, body").animate({
      scrollTop: sectionScrollTops[sectionIndex+1]
    });
  });

  /*$("#stories-form").submit(function() {
    if ($(this).valid()) {
      var name = $("input[name=name]").val();
      var beginning = $("textarea[name=beginning]").val();
      var persevered = $("textarea[name=persevered]").val();
      var growth = $("textarea[name=growth]").val();
      var thanks = $("textarea[name=thanks]").val();
      var email = $("input[name=email]").val();

      var valuesArray = [name, beginning, persevered, growth, thanks, email];

      $.ajax({
        type: "POST",
        url: "/_scripts/stories/submit.php",
        data: {
          values : valuesArray
        },
        success: function(data) {
          $("input[name=name]").val("");
          $("textarea[name=beginning]").val("");
          $("textarea[name=persevered]").val("");
          $("textarea[name=growth]").val("");
          $("textarea[name=thanks]").val("");
          $("input[name=email]").val("");

          $("header").html(data);
          $("header").fadeIn("slow");

          setTimeout(function() {
            $("header").fadeOut("slow");
          }, 8000);
        }
      });

      event.preventDefault();
    }
    else {
      $("header").html("<p>Please fill out all fields</p>");
      $("header").fadeIn("slow");

      setTimeout(function() {
        $("header").fadeOut("slow");
      }, 8000);
    }
  });*/
});
