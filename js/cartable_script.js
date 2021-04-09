$(".row").on("click", function() {
    if($(this).find("#mark").length) {
        $("form").find("input[name='car_id']").val($( this ).attr('id')) 

        $("form").find("input[type='submit']").click()
    }
})

$(".profile").mouseenter(function() {
    $(this).parent().find("#list").show()
}).mouseleave(function() {
    
    $(this).parent().find("#list").hide()
})

$("#add").on("click", function() {
    alert("NIE GOTOWY! Kliknij w logo aby wyjść")
    window.location.href = "new_service.php"
})

$(".arrow").on("click", function() {
    if($(this).attr('id') == "right") {
        $("input[name='page']").val(parseInt($("input[name='page']").val())+1)
        $("form").first().submit()
    } else {
        $("input[name='page']").val(parseInt($("input[name='page']").val())-1)
        $("form").first().submit()
    }
})

localStorage.setItem("URL", window.location.href);

$(document).mousemove(function(event) {
    currentMousePosX = event.pageX;
    currentMousePosY = event.pageY;
});

$("#search_filter").click(function() {
    if(!$(this).find("#list").is(":visible")) {
        $(this).find("#list").css({"right":$( document ).width()-currentMousePosX-$(this).find("#list").width(), "top": currentMousePosY})
        $(this).find("#list").show()
    }
}).mouseleave(function() {
    $(this).find("#list").hide()
})

$("#search_filter #list span").on('click', function() {
    if($(this).find("img").length > 0) {
        $(this).find("img").remove()
        let d = $("input[name='filter']").val().slice(0, $("input[name='filter']").val().length-1).split(".")

        for( var i = 0; i < d.length; i++) { 
    
            if ( d[i] === $(this).attr('name')) { 
        
                d.splice(i, 1); 
            }
        }
        d = d.join(".")

        if(d !== "") {
            d += "."
        }
        $("input[name='filter']").val(d)
    }else {
        $(this).html($(this).html()+"<img src='../img/check.svg' style='margin-left: 10px;' height='10px'>")
        //console.log($(this).attr('name'))
        
       
        $("input[name='filter']").val($("input[name='filter']").val()+$(this).attr('name')+".")
        
        //console.log($("input[name='filter']").val().slice(0, $("input[name='filter']").val().length - 1))
    }
})




$("div[id^=table_header_]").click(function() {

    if($(this).find("#list").length == 0) {
        let innerHtml
        if($(this).attr("id") == "table_header_year" || $(this).attr("id") == "table_header_last") {
            innerHtml = "<span id='list'><span name='DESC'>Malejąco</span><hr></hr><span name='ASC'>Rosnąco</span></span>"
        } else {
            innerHtml = "<span id='list'><span name='DESC'>Z-A</span><hr></hr><span name='ASC'>A-Z</span></span>"
        }

        $(this).html($(this).html()+innerHtml)
        $(this).find("#list").css({"right":$( document ).width()-currentMousePosX-$(this).find("#list").width(), "top": currentMousePosY})
        $(this).find("#list").show()
        
    } else {
        $(this).find("#list").remove()
    }
}).mouseleave(function() {
    $(this).find("#list").remove()
})

$("div[id^=table_header_]").on('click', "#list span", function() { //event listener for dynamically added elements
    $("input[name='sort_by']").val($(this).closest("div").attr("name"))
    $("input[name='sort_type']").val($(this).attr("name"))
    $("form").first().submit()
})

function test() {
    let url = new URLSearchParams((new URL(window.location.href)).search);

    if($("input[name='filter']").val() === "") {
        $("input[name='filter']").attr("name", "")
    } else {
        $("input[name='filter']").val($("input[name='filter']").val().slice(0, $("input[name='filter']").val().length-1))
    }
    
    if($("input[name='search_text']").val() == "") {
        $("input[name='search_text']").attr("name", "")
    } 
    if(url.get("search_text") != null) {
        if($("input[name='search_text']").val() != url.get("search_text")) {
            $("input[name='page']").val(1)
        }
    }
}