$(".row").on("click", function() {
    if($(this).find("#make").length) {
        $("form").find("input[name='car_id']").val($( this ).attr('id')) 

        $("form").find("input[type='submit']").click()
    }
})

$(".profile").mouseenter(function() {
    $("#list").show()
}).mouseleave(function() {
    
    $("#list").hide()
})

$("#add").on("click", function() {
    alert("NIE GOTOWY! Kliknij w logo aby wyjść")
    window.location.href = "new_service.php"
})

$(".arrow").on("click", function() {
    if($(this).attr('id') == "right") {
        $("#page_count input").val(parseInt($("#page_count input").val())+1)
        $("#page_count").submit()
    } else {
        $("#page_count input").val(parseInt($("#page_count input").val())-1)
        $("#page_count").submit()
    }
})

function closeErrorTab() {
    //console.log($(this).parent().remove());
    $("#error_tab").remove();
}