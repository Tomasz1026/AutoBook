
    $(".eye_svg").on("click", function() {
      if ($(this).parent().find("input").attr("type") == "password") {
          $(this).attr("src","../img/crossed_out_eye.svg")
          $(this).parent().find("input").attr("type", "text");
        } else {
          $(this).attr("src","../img/eye.svg")
          $(this).parent().find("input").attr("type", "password");
        }
    })