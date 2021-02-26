$(".row").on("click", function() {
    
    $("form").find("input[name='vin']").val($( this ).find("#vin").html()) 

    $("form").find("input[type='submit']").click()
})

$(".profile").mouseenter(function() {
    $("#list").show()
}).mouseleave(function() {
    
    $("#list").hide()
})

/*$("#list").mouseleave(function() {
    $("#list").hide()
})*/