
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
        //console.log($("#list.filter").css('display'))
        //if(!$("#list.filter").is(":visible")) {
            $("#list.filter").css({"right":$( document ).width()-currentMousePosX-$("#list.filter").width(), "top": currentMousePosY})
            $("#list.filter").show()
        //}
    })
    
    $("#list.filter").mouseleave(function() {
        $("#list.filter").hide()
    })

    $("#list.filter span:not([id='filter_accept'])").on('click', function() {
        let filter_list = $("input[name='filter']").val().split('.')
        if($(this).find("img").length > 0) {
            $(this).find("img").remove()
            
            let filter_name = $(this).attr('name')
            filter_list = $.grep(filter_list, function(value) {

                return value !== filter_name;
            });
            
        }else {
            $(this).html($(this).html()+"<img src='../img/check.svg' style='margin-left: 10px;' height='10px'>")
            filter_list.push($(this).attr('name'))
        }
        if(filter_list[0] === "") {
            filter_list = filter_list[1]
        } else {
            filter_list = filter_list.join(".")
        }

        $("input[name='filter']").val(filter_list)
    })

    $("#filter_accept").click(function() {
        $("form").first().submit()
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
            $("input[name='filter']").val($("input[name='filter']").val())
        }
        
        if($.trim($("input[name='search_text']").val()) == "") {
            $("input[name='search_text']").attr("name", "")
        } 
        
        if(url.get("search_text") !== null && $.trim($("input[name='search_text']").val()) !== url.get("search_text")) {
            $("input[name='page']").val(1)
        }
    }