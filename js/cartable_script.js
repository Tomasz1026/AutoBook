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

/*$("#list").mouseleave(function() {
    $("#list").hide()
})*/