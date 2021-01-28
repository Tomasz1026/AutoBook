$("#eye_svg").on('click', () => {
    if ($("#pass_input input").attr("type") == "password") {
        $("#eye_svg").css({"background":"url(../img/crossed_out_eye.svg)"})
        $("#pass_input input").attr("type", "text");
      } else {
        $("#eye_svg").css({"background":"url(../img/eye.svg)"})
        $("#pass_input input").attr("type", "password");
      }
})

if($("header::after").height() < $("#main").height())
{
  console.log("penis");
}