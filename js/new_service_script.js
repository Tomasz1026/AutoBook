$('#models_list option').hide()

$(".profile").mouseenter(function() {
    $("#list").show()
}).mouseleave(function() {
    
    $("#list").hide()
})

$('#marks_list').change(function(){
    $('#models_list').val('')
    $('#models_list option').hide()
    $('#models_list option[id='+$( this ).val()+']').show()
})

$("#logo").on("click", function() {
    window.location.href = "cartable.php";
})