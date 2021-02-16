
/*
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
*/
   
    function numberWithCommas(value, separator) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, separator)
    }

    function dateConversion(date)
    {
        let day = date.slice(0, $("#passive_date").html().search('-'))
        date = date.slice(date.search('-')+1, date.length)
        let month = date.slice(0, $("#passive_date").html().search('-'))
        let year = date.slice(date.search('-')+1, date.length)

        return year + "-" + month + "-" + day
    }

    function mileageConversion(mileage, howManyTimes)
    { 

        for(let i=0;i<howManyTimes;i++)
        {
            mileage = mileage.replace(".", '')
            //console.log(mileage)
            //console.log(mileage.search("."))
        }
        return parseInt(mileage)
    }

    $("#edit").on('click', () => {
        
        if($("#passive_textarea").css('display') == 'none') {
            $("#add").hide()
            $("#save").hide()
            
            $("#date_input").hide()
            $("#mileage_input").hide()

            $("#passive_date").show()
            $("#passive_mileage").show()

            $("#passive_textarea").show()
            $("textarea").hide()
        } else {
            console.log("test")
            $("textarea").val($("#passive_textarea").html())
            $("#passive_textarea").hide()
            $("#richer_description textarea").show()

            $("#date_input").show()
            $("#mileage_input").show()
            
            $("#mileage_input").val(mileageConversion($("#passive_mileage").html(), 2))

            $("#date_input").val(dateConversion($("#passive_date").html()))

            $("#passive_date").hide()
            $("#passive_mileage").hide()

            $("#add").show()
            $("#save").show()
        }
    })

    $("#save").on('click', () => {
        
        $("#passive_textarea").html($("textarea").val());
        console.log("penis")
        $("#passive_mileage").html(numberWithCommas(parseInt(mileageConversion($("#mileage_input").val(), 2)), "."))

        let date = new Date($("#date_input").val())

        $("#passive_date").html(('0' + date.getDate()).slice(-2) +'-'+ ('0' + (date.getMonth()+1)).slice(-2) +'-'+ date.getFullYear());

        

        $("#edit").click()
    })

    

    $(".category").mouseenter( function() {

        $(this).find(">:first-child").css("left", $(this).parent().innerWidth())
        $(this).find(">:first-child").show()
        
        console.log($(this).outerWidth())

    }).mouseleave( function() {
    
        $(this).find(">:first-child").hide()

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
        //let kaka = 0
        //console.log(niba);
        let arrayId = 1
        do{
            //console.log(kaka)
            
            
            parentTree = parentTree.parent()

            idOfParent = parentTree.attr('id')

            if(parentTree.attr("class") == "category")
            {
                categoriesHtml[arrayId] = parentTree.find("span:last").html()
                //console.log(niba);
                //console.log(nigger);
                    arrayId++
            }
            
            //kaka++
            
            
            

        }while(parentTree.attr('id') != "list")
            
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

