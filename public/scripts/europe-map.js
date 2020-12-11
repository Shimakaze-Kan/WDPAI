function showMessage(result)
{
    if(result==true)
    {
        $('#messageboxq').html("Success");
        $('#messageboxq').css("background-color"," rgba(72, 205, 183, 0.9)");
    }
    else
    {
        $('#messageboxq').html("Failure");
        $('#messageboxq').css("background-color"," rgba(240, 52, 52, 0.9)");
    }
    $( "#messageboxq" ).slideDown( 300 ).delay( 5000 ).slideUp( 400 );
}

    var countries = [];

$.getJSON( "public/json/data_json.json", function( data ) {
    $.each( data, function( key, val ) {
        countries[val.Code] = val.Name;
    });

});

var box = document.getElementById("selectCountries");
countries.forEach(function(item){
    var opt = document.createElement("option");
    //opt.value = 1;
    opt.innerHTML = "sd";
    box.appendChild(opt);
});

    var names = [];

    jQuery(function ($) {
        var countryId;

        $('#send-updated-country').click(function (){
            var word = $('#new-word-input').val();

            if(word=='')
            {
                showMessage(false);
            }
            else {
                $.ajax({
                    url: "returnConfirm",
                    type: "POST",
                    data: {value: word+" "+countryId},
                    success: function (response) {
                        names[countryId] = word;
                        showMessage(response == "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showMessage(false);
                    }
                });
            }

            $('.background-shade').slideUp(300);
        });

        //$('#test-button').click(function (){
            $.ajax({
                url: "getCountriesData",
                type: "POST",
                data: {},
                dataType: "json",
                success: function (response) {
                    for(var i in response) {
                        if(response[i]!=null)
                            names[i] = response[i];
                    }
                    updateValues();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("error"+response);
                }
            });
        //});

        function updateValues() {
            $('path').each(function () {
                if ($(this).attr('id').toUpperCase().substring(0, 2) in names) {
                    $(this).css({fill: "#ff0000"});
                }
            });
        };

        var currentMousePos = { x: -1, y: -1 };
        $(document).mousemove(function (event) {
            currentMousePos.x = event.pageX + 10;
            currentMousePos.y = event.pageY;
        });

        $('path').click(function () {
            var country = jQuery(this).attr('id').toUpperCase().substring(0, 2);
            //alert(countries[country]);
            countryId=country;
            $('#country-name').text(countries[country].toUpperCase());
            jQuery(this).css({ fill: "#ff0000" });
            $('#new-word-input').val(names[country]);
            $('.background-shade').slideDown(300);
        });

        $('path').mouseover(function () {
            var country = jQuery(this).attr('id').toUpperCase().substring(0, 2);
            $('#country-text').text(countries[country]);


            if ($(this).attr('id').toUpperCase().substring(0, 2) in names) {
                $('#DivToShow').css({ 'top': currentMousePos.y, 'left': currentMousePos.x }).fadeIn('fast');
                $('#DivToShow').text(names[country]);
            }


        });

        $('path').mouseout(function () {
            $('#DivToShow').css({ 'display': 'none' });
            $('#DivToShow').text('');
        });

        $('path').mousemove(function () {
            $('#DivToShow').css({ 'top': currentMousePos.y, 'left': currentMousePos.x });
        });

    });

