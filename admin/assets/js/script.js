"use strict"

$(document).ready(function () {
  const $sidebar = $(".sidebar");
  
  const $sidebar_img_container = $sidebar.find(".sidebar-background");

  const $full_page = $(".full-page");

  const $sidebar_responsive = $("body > .navbar-collapse");
  const sidebar_mini_active = false;

  const window_width = $(window).width();

  const fixed_plugin_open = $(
    ".sidebar .sidebar-wrapper .nav li.active a p"
  ).html();

  // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
  //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
  //         $('.fixed-plugin .dropdown').addClass('show');
  //     }
  //
  // }

  $(".fixed-plugin a").click(function (event) {
    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
    if ($(this).hasClass("switch-trigger")) {
      if (event.stopPropagation) {
        event.stopPropagation();
      } else if (window.event) {
        window.event.cancelBubble = true;
      }
    }
  });

  $(".fixed-plugin .active-color span").click(function () {
    $full_page_background = $(".full-page-background");

    $(this).siblings().removeClass("active");
    $(this).addClass("active");

    var new_color = $(this).data("color");

    if ($sidebar.length != 0) {
      $sidebar.attr("data-active-color", new_color);
    }

    if ($full_page.length != 0) {
      $full_page.attr("data-active-color", new_color);
    }

    if ($sidebar_responsive.length != 0) {
      $sidebar_responsive.attr("data-active-color", new_color);
    }
  });

  $(".fixed-plugin .background-color span").click(function () {
    $(this).siblings().removeClass("active");
    $(this).addClass("active");

    var new_color = $(this).data("color");

    if ($sidebar.length != 0) {
      $sidebar.attr("data-color", new_color);
    }

    if ($full_page.length != 0) {
      $full_page.attr("filter-color", new_color);
    }

    if ($sidebar_responsive.length != 0) {
      $sidebar_responsive.attr("data-color", new_color);
    }
  });

  $(".fixed-plugin .img-holder").click(function () {
    $full_page_background = $(".full-page-background");

    $(this).parent("li").siblings().removeClass("active");
    $(this).parent("li").addClass("active");

    var new_image = $(this).find("img").attr("src");

    if (
      $sidebar_img_container.length != 0 &&
      $(".switch-sidebar-image input:checked").length != 0
    ) {
      $sidebar_img_container.fadeOut("fast", function () {
        $sidebar_img_container.css(
          "background-image",
          'url("' + new_image + '")'
        );
        $sidebar_img_container.fadeIn("fast");
      });
    }

    if (
      $full_page_background.length != 0 &&
      $(".switch-sidebar-image input:checked").length != 0
    ) {
      var new_image_full_page = $(".fixed-plugin li.active .img-holder")
        .find("img")
        .data("src");

      $full_page_background.fadeOut("fast", function () {
        $full_page_background.css(
          "background-image",
          'url("' + new_image_full_page + '")'
        );
        $full_page_background.fadeIn("fast");
      });
    }

    if ($(".switch-sidebar-image input:checked").length == 0) {
      var new_image = $(".fixed-plugin li.active .img-holder")
        .find("img")
        .attr("src");
      var new_image_full_page = $(".fixed-plugin li.active .img-holder")
        .find("img")
        .data("src");

      $sidebar_img_container.css(
        "background-image",
        'url("' + new_image + '")'
      );
      $full_page_background.css(
        "background-image",
        'url("' + new_image_full_page + '")'
      );
    }

    if ($sidebar_responsive.length != 0) {
      $sidebar_responsive.css("background-image", 'url("' + new_image + '")');
    }
  });

  $(".switch-sidebar-image input").on(
    "switchChange.bootstrapSwitch",
    function () {
      $full_page_background = $(".full-page-background");

      $input = $(this);

      if ($input.is(":checked")) {
        if ($sidebar_img_container.length != 0) {
          $sidebar_img_container.fadeIn("fast");
          $sidebar.attr("data-image", "#");
        }

        if ($full_page_background.length != 0) {
          $full_page_background.fadeIn("fast");
          $full_page.attr("data-image", "#");
        }

        background_image = true;
      } else {
        if ($sidebar_img_container.length != 0) {
          $sidebar.removeAttr("data-image");
          $sidebar_img_container.fadeOut("fast");
        }

        if ($full_page_background.length != 0) {
          $full_page.removeAttr("data-image", "#");
          $full_page_background.fadeOut("fast");
        }

        background_image = false;
      }
    }
  );

  $(".switch-mini input").on("switchChange.bootstrapSwitch", function () {
    $body = $("body");

    $input = $(this);

    if (paperDashboard.misc.sidebar_mini_active == true) {
      $("body").removeClass("sidebar-mini");
      paperDashboard.misc.sidebar_mini_active = false;
    } else {
      $("body").addClass("sidebar-mini");
      paperDashboard.misc.sidebar_mini_active = true;
    }

    // we simulate the window Resize so the charts will get updated in realtime.
    var simulateWindowResize = setInterval(function () {
      window.dispatchEvent(new Event("resize"));
    }, 180);

    // we stop the simulation of Window Resize after the animations are completed
    setTimeout(function () {
      clearInterval(simulateWindowResize);
    }, 1000);
  });
});

if ($("#datatable").length > 0) {
  $("#datatable").DataTable({
    pagingType: "full_numbers",
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    responsive: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
    },
  });
}

if ($("#products_list").length > 0) {
  var table = $("#products_list").DataTable({
    pagingType: "full_numbers",
    rowReorder: true,
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "products.php",
      type: "GET",
      data: function (data) {
        data.cat = $("#cat").val();
        data.subcat = $("#subcat").val();
        data.innercat = $("#innercat").val();
        data.subinnercat = $("#subinnercat").val();
        data.prod_type = $("#prod_type").val();
      },
    },
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
    },
  });

  $("#excel-upload").change(function () {
    $(this).siblings().html("Loading");

    $.ajax({
      type: "POST",
      data: { action: "excel-upload" },
      data: new FormData(this.form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        alert(response);
        $(this).siblings().html("Upload");
      },
    });
    $("#excel-upload").val("");
  });

  $("#subinnercat, #prod_type").change(function () {
    table.ajax.reload();
  });
}

if ($("#innercat_list").length > 0) {
  var table = $("#innercat_list").DataTable({
    pagingType: "full_numbers",
    rowReorder: true,
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "innercat_list.php",
      type: "GET",
    },
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
    },
  });
}

if (table != undefined) {
  table.on("row-reorder", function (e, diff, edit) {
    var result = [];

    for (var i = 0, ien = diff.length; i < ien; i++)
      result.push({
        id: $(table.row(diff[i].node).data()[1]).attr("id"),
        position: diff[i].newData,
      });
    if (result.length > 0) {
      $.ajax({
        url: "?action=sort",
        type: "POST",
        data: { sort: result },
        dataType: "JSON",
        success: function (result) {
          alert(result.message);
          table.ajax.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert("Something is not going good. Try again.");
        },
      });
    }
  });
}

/* var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      }); */

// Initialise Sweet Alert library
demo.showSwal();

// initialise Datetimepicker and Sliders
demo.initDateTimePicker();
if ($(".slider").length != 0) {
  demo.initSliders();
}

$("#cat").change(function () {
  $("#subcat").html('<option value="">Select Sub Category</option>');
  var cat = $("#cat").val();
  var htmlData = "";

  $.ajax({
    type: "GET",
    url: "category.php",
    data: { cat: cat },
    dataType: "json",
    cache: false,
    success: function (response) {
      $.each(response, function (index, val) {
        htmlData +=
          '<option value="' +
          val["sc_id"] +
          '">' +
          val["sc_name"] +
          "</option>";
      });
      $("#subcat").append(htmlData);
      if ($("#products_list").length > 0) table.ajax.reload();
    },
  });
});

$("#subcat").change(function () {
  $("#innercat").html('<option value="">Select Inner Category</option>');
  var subcat = $("#subcat").val();
  var htmlData = "";

  $.ajax({
    type: "GET",
    url: "innercategory.php",
    data: { subcat: subcat },
    dataType: "json",
    cache: false,
    success: function (response) {
      $.each(response, function (index, val) {
        htmlData +=
          '<option value="' + val["i_id"] + '">' + val["i_name"] + "</option>";
      });
      $("#innercat").append(htmlData);
      if ($("#products_list").length > 0) table.ajax.reload();
    },
  });
});

$("#innercat").change(function () {
  $("#subinnercat").html('<option value="">Select Sub Inner Category</option>');
  var innercat = $("#innercat").val();
  var htmlData = "";

  $.ajax({
    type: "GET",
    url: "innercat.php",
    data: { innercat: innercat },
    dataType: "json",
    cache: false,
    success: function (response) {
      $.each(response, function (index, val) {
        htmlData +=
          '<option value="' +
          val["si_id"] +
          '">' +
          val["si_name"] +
          "</option>";
      });
      $("#subinnercat").append(htmlData);
      if ($("#products_list").length > 0) table.ajax.reload();
    },
  });
});

$(".category-check").change(function () {
  const id = $(this).val();
  const dependent = $(this).data("dependent");
  const url = $(this).data("url");
  const value = $(this).data("value");
  let options = `<option value="">Select ${$(this).data("title")}</option>`;
  
  if(id)
  {
    $.ajax({
      type: "GET",
      url: `${url}.php`,
      data: { id: id },
      dataType: "json",
      cache: false,
      async: false,
      success: function (response) {
        $.each(response, function (index, val) {
          options += `<option ${value == val.id ? 'selected' : ''} value="${val.id}">${val.name}</option>`;
        });
      },
    });
  }

  $(`#${dependent}`).html(options);
});

if($(".category-check").length > 0) $(".category-check").trigger("change");