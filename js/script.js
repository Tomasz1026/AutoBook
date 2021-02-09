$( document ).ready(function() {
  $("#eye_svg").on('click', () => {
    if ($("#pass_input input").attr("type") == "password") {
        $("#eye_svg").css({"background":"url(../img/crossed_out_eye.svg)"})
        $("#pass_input input").attr("type", "text");
      } else {
        $("#eye_svg").css({"background":"url(../img/eye.svg)"})
        $("#pass_input input").attr("type", "password");
      }
})


var opisA = "Wymiana oleju, wymiana klocków hamulcowych, wymiana wycieraczek, kręcenie licznika"
var opisB = "Steven Paul Jobs - jeden z trzech założycieli, były prezes i przewodniczący rady nadzorczej Apple Inc."
var opisC = "Steven Paul Jobs - jeden z trzech założycieli, były prezes i przewodniczący rady nadzorczej Apple Inc."

function checkDesc(description) {
    if(description.length > 52) {
        let newdesc = "";

        for(let i=0;i<53;i++)
        {
            newdesc += description[i];
        }

        newdesc+="...";
        return newdesc;
    }
}


console.log(checkDesc(opisA));

$("#edit").on('click', () => {
    if($("#passive_textarea").css('display') == 'none') { 
      $("#passive_textarea").show();
      $("#richer_description textarea").hide();
    } else {
      $("#passive_textarea").hide();
      $("#richer_description textarea").show();
    }

})

$(".category").mouseenter( function() {

  $(this).find("div").show();

})

$(".category").mouseleave( function() {
  
  $(this).find("div").hide();

})

$(".sub_list span").on('click', function() {

  $("textarea").val($("textarea").val()+$(this).parents(".category").find("span:last").html()+" "+$(this).html()+"\n");

})
});

