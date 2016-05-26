$(document).ready(function () {
  $( "#from" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    changeYear: true,
    onClose: function( selectedDate ) {
      $( "#to" ).datepicker( "option", "minDate", selectedDate );
    }
  });

  $( "#to" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    changeYear: true,
    onClose: function( selectedDate ) {
      $( "#from" ).datepicker( "option", "maxDate", selectedDate );
    }
  });

  $("#filter-form").validate({
    rules: {
      from: {
        date: true,
        minlength: 10
      },
      to: {
        date: true,
        minlength: 10
      }
    }
  });

  $.ajax({
    type: 'POST',
    url: '/_scripts/stories/get_stories.php',
    success: function(data) {
      $("#admin-main").html(data);
    }
  });

  $("#admin-main").css("min-height", $(document).height()-$("header").outerHeight());


  $('#save').click(function() {
    var remove = [];
    var categories = [];

    $('.story').each(function () {
      var id = this.id.substring(6, this.id.length);
      var hashId = '#' + this.id;

      if ($(hashId).hasClass("remove")) {
        remove.push(id);
      }

      var empty = $(hashId+' .categories').is(':empty');

      if (!empty) {
        var categoryArray = [];

        $(hashId+' .category').each(function() {
          categoryArray.push($(this).text().toUpperCase());
        });

        categories.push({
          id : id,
          categories : categoryArray
        });
      }
    });

    $('#filter-categories').find('input[type=checkbox]:checked').removeAttr('checked');
    $('#filter-tiers select').val('all');
    $('#filter-date input').val('');

    $.ajax({
      type: 'POST',
      url: '/_scripts/stories/admin_update.php',
      data: {
        remove : remove,
        categories : categories
      },
      success: function(data) {
        $("#admin-main").html(data);

        $("#notification").fadeIn();

        setTimeout(
          function() {
            $("#notification").fadeOut();
          }
        , 8000);
      }
    });
  });

  $('#filter').click(function() {
    if ($("#filter-form").valid()) {
      var categoriesChecks = $("#filter-categories input");
      var categories = [];

      categoriesChecks.each(function() {
        if ($(this).is(":checked")) {
          categories.push($(this).attr("name"));
        }
      });

      var tier = $("select").val();

      var date;
      var split;
      var startDate;
      var endDate;

      if ($("#from").val() != "") {
          date = $("#from").val();
          splitDate = date.split("/");
          startDate = splitDate[2] + "-" + splitDate[0] + "-" + splitDate[1] + " 00:00:01";
      }
      if ($("#to").val() != "") {
          date = $("#to").val();
          splitDate = date.split("/");
          endDate = splitDate[2] + "-" + splitDate[0] + "-" + splitDate[1] + " 23:59:59";
      }

      $.ajax({
        type: 'POST',
        url: '/_scripts/stories/get_stories.php',
        data: {
          categories : categories,
          tier : tier,
          startDate : startDate,
          endDate : endDate
        },
        success: function(data) {
          $("#admin-main").html(data);
        }
      });
    }
  });
});
