$("#eye_svg").on('click', () => {
    if ($("#pswd").attr("type") == "password") {
        $("#eye_svg").css({"background":"url(../img/crossed_out_eye.svg)"})
        $("#pswd").attr("type", "text");
      } else {
        $("#eye_svg").css({"background":"url(../img/eye.svg)"})
        $("#pswd").attr("type", "password");
      }
})