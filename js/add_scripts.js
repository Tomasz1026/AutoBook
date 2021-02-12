$( document ).ready(function() {
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
    

    $("#edit").on('click', () => {
        if($("#passive_textarea").css('display') == 'none') { 
            $("#add").hide(); 
            $("#save").hide(); 
            
            $("#date_input").hide();
            $("#mileage_input").hide();

            $("#passive_date").show();
            $("#passive_mileage").show();

            $("#passive_textarea").show();
            $("#richer_description textarea").hide();

           
        } else {
            $("textarea").val($("#passive_textarea").html()); 
            $("#passive_textarea").hide();
            $("#richer_description textarea").show();

            $("#date_input").show();
            $("#mileage_input").show();

            if(($("#passive_mileage").html()).search("tys.")!=-1)
            {
                $("#mileage_input").val(($("#passive_mileage").html()).replace(" tys.", "000"))
            }

            let fullDate = $("#passive_date").html();

            let day = fullDate.slice(0, $("#passive_date").html().search('-'));
            fullDate = fullDate.slice(fullDate.search('-')+1, fullDate.length);
            let month = fullDate.slice(0, $("#passive_date").html().search('-'));
            let year = fullDate.slice(fullDate.search('-')+1, fullDate.length);
            
            $("#date_input").val(year+"-"+month+"-"+day);

            $("#passive_date").hide();
            $("#passive_mileage").hide();

            $("#add").show(); 
            $("#save").show(); 
        }

    })

    $("#save").on('click', () => {
        $("#passive_textarea").html($("textarea").val());

        //system konwertowania przebiegu


        let date = new Date( $("#date_input").val());

        console.log()

        $("#passive_date").html(('0' + date.getDate()).slice(-2) +'-'+ ('0' + (date.getMonth()+1)).slice(-2) +'-'+ date.getFullYear());

        $("#edit").click(); 
    })

    $(".category").mouseenter( function() {

    $(this).find("div").show();

    }).mouseleave( function() {
    
    $(this).find("div").hide();

    })


    $(".sub_list span").on('click', function() {

    $("textarea").val($("textarea").val()+$(this).parents(".category").find("span:last").html()+" "+$(this).html()+"\n");
    })
/*
    window.onbeforeunload = function() {
        return '';
    };*/
})
