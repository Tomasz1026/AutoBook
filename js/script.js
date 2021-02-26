
  $("#eye_svg").click()

    $("#eye_svg").on('click', () => {
      if ($("#pass_input input").attr("type") == "password") {
          $("#eye_svg").attr("src","../img/crossed_out_eye.svg")
          $("#pass_input input").attr("type", "text");
        } else {
          $("#eye_svg").attr("src","../img/eye.svg")
          $("#pass_input input").attr("type", "password");
        }
    })



