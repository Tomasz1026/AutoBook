

    //var opisA = "Wymiana oleju, wymiana klocków hamulcowych, wymiana wycieraczek, kręcenie licznika"
    //var opisB = "Steven Paul Jobs - jeden z trzech założycieli, były prezes i przewodniczący rady nadzorczej Apple Inc."
    //var opisC = "Steven Paul Jobs - jeden z trzech założycieli, były prezes i przewodniczący rady nadzorczej Apple Inc."


    function checkDesc(description, size) {
        if(description.length > size) {
            let newdesc = "";

            for(let i=0;i<size+1;i++)
            {
                newdesc += description[i];
            }

            newdesc+="...";
            return newdesc;
        } else {
            return description;
        }
    }

    function numberWithCommas(value, separator) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, separator)
    }

    function dateConversionISO(date)
    {
        let day = date.slice(0, $("#passive_date").html().search('-'))
        date = date.slice(date.search('-')+1, date.length)
        let month = date.slice(0, $("#passive_date").html().search('-'))
        let year = date.slice(date.search('-')+1, date.length)

        return year + "-" + month + "-" + day
    }

    function dateConversionPOL(date)
    {
        let datePOL = new Date(date)

        return ('0' + datePOL.getDate()).slice(-2) +'-'+ ('0' + (datePOL.getMonth()+1)).slice(-2) +'-'+ datePOL.getFullYear();
    }

    function mileageConversion(mileage, howManyTimes)
    {
        for(let i=0;i<howManyTimes;i++)
        {
            mileage = mileage.replace(".", '')
        }

        return parseInt(mileage)
    }

    function serviceTableClick() {
        $("#id").val($( this ).attr("id"))
        $("#passive_date").html($( this ).find("#date").html())
        $("#passive_mileage").html($( this ).find("#mileage").html())
        $("#passive_textarea").html($( this ).find("#description").html())
    }

    $("#logo").on("click", function() {
        window.location.href = localStorage.getItem("URL");
    })

    $("[id^='profile_']").mouseenter(function() {
        $("#profile_list").show()
    }).mouseleave(function() {
        
        $("#profile_list").hide()
    })

    $(".row").each( function(i) {
        
        $(this).find("#mileage").html(numberWithCommas($(this).find("#mileage").html(), "."))

        $(this).find("#short_desc").html(checkDesc($(this).find("#description").html(), 38))

        if(i === 0) {
            $("#id").val($( this ).attr("id"))
            $("#passive_date").html($( this ).find("#date").html())
            $("#passive_mileage").html($( this ).find("#mileage").html())
            $("#passive_textarea").html($( this ).find("#description").html())
            //console.log( $("#id").val())
        }
    })

    $(".row").on("click", serviceTableClick)

    $("#edit").on('click', () => {
       // $("#service_list_element").load("test.php") //do testow
        
        if($("#passive_textarea").css('display') == 'none') {
            $(".row").on("click", serviceTableClick)
            
            $("#add").hide()
            $("#save").hide()
            
            $("#date_input").hide()
            $("#mileage_input").hide()

            $("#passive_date").show()
            $("#passive_mileage").show()

            $("#passive_textarea").show()
            $("textarea").hide()
        } else {
            $(".row").off("click")
            $("textarea").val($("#passive_textarea").html())
            $("#passive_textarea").hide()
            $("#richer_description textarea").show()

            $("#date_input").show()
            $("#mileage_input").show()
            
            $("#mileage_input").val(mileageConversion($("#passive_mileage").html(), 2))

            $("#date_input").val(dateConversionISO($("#passive_date").html()))

            $("#passive_date").hide()
            $("#passive_mileage").hide()

            $("#add").show()
            $("#save").show()
        }
    })

    $("#save").on('click', () => {
        

        if($("#mileage_input").val() < 0 || $("#mileage_input").val().length == 0){
            alert("niba")
        } else {
            $("#submit_form").click()
        }

       
        //window.location.href = "../update_services.php";
        
        //$("#passive_textarea").html($("textarea").val());

        //$("#passive_mileage").html(numberWithCommas(parseInt(mileageConversion($("#mileage_input").val(), 2)), "."))

        //$("#passive_date").html(dateConversionPOL($("#date_input").val()));

        //$("#edit").click()
    })


    $(".category").mouseenter( function() {

        $(this).find(">:first-child").css("left", $(this).parent().innerWidth())
        $(this).find(">:first-child").show()
        $(this).css("background", "rgb(230, 230, 230)")

    }).mouseleave( function() {
    
        $(this).find(">:first-child").hide()
        $(this).css("background", "rgb(255, 255, 255)")
    })

    $(".category").on('click', function() {

        if($(this).find("span").length == 0)
        {
            $("textarea").val($("textarea").val()+$(this).html()+"\n")
        }
    })

    $(".sub_list span").on('click', function() {
        
        let parentTree = $(this).parent()
        
        if(parentTree.attr("class") == "sub_list")
        {
            let categoriesHtml = [$(this).html()]
            let arrayId = 1

            do {
                parentTree = parentTree.parent()

                idOfParent = parentTree.attr('id')

                if(parentTree.attr("class") == "category")
                {
                    categoriesHtml[arrayId] = parentTree.find("span:last").html()
                    arrayId++
                }

            } while(parentTree.attr('id') != "add_text")
                
            for(let i=arrayId-1;i>=0;i--)
            {
                $("textarea").val($("textarea").val() + categoriesHtml[i] + " ")
            }

            $("textarea").val($("textarea").val()+"\n")
        }
    })
/*
    window.onbeforeunload = function() {
        return '';
    };*/

