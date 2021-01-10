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

    //var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

    var names = [];

    jQuery(function ($) {

        var countryId;
        var currentPath;
        let mapPathsQueue = [];

        $('#send-updated-country').click(function (){
            var word = $('#new-word-input').val();

            if(word=='' > word.length > 50)
            {
                showMessage(false);
            }
            else {
                const urlParams = new URLSearchParams(window.location.search);
                const topicId = urlParams.get('id');

                $.ajax({
                    url: "updateCountryData",
                    type: "POST",
                    data: {id: countryId, value: word, topicId: topicId},
                    success: function (response) {
                        if(response=="success") {
                            names[countryId] = word;
                            updateValues();
                            updateTable();
                            updateTableHeight();
                        }

                        showMessage(response == "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showMessage(false);
                    }
                });
            }

            $('#minimal-popup').fadeOut(300);
        });

        //$('#test-button').click(function (){
        const urlParams = new URLSearchParams(window.location.search);
        const topicId = urlParams.get('id');

            $.ajax({
                url: "getCountriesData",
                type: "POST",
                data: {id: topicId},
                dataType: "json",
                success: function (response) {
                    for(var i in response) {
                        if(response[i]!=null)
                            names[i] = response[i];
                    }
                    updateValues();
                    updateTable();
                    updateTableHeight();
                },
                error: function (jqXHR, textStatus, errorThrown) {
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
            if(!isMobile) {
                var country = jQuery(this).attr('id').toUpperCase().substring(0, 2);
                //alert(countries[country]);
                countryId = country;
                $('#country-name').text(countries[country].toUpperCase());
                mapPathsQueue.push(jQuery(this));
                $('#new-word-input').val(names[country]);
                $('#minimal-popup').fadeIn(300);
                $('#new-word-input').focus();
            }
        });

        $('path').mouseover(function () {
            if(!isMobile) {
                var country = jQuery(this).attr('id').toUpperCase().substring(0, 2);
                $('#country-text').text(countries[country]);


                if ($(this).attr('id').toUpperCase().substring(0, 2) in names) {
                    $('#DivToShow').css({'top': currentMousePos.y, 'left': currentMousePos.x}).fadeIn('fast');
                    $('#DivToShow').text(names[country]);
                }
            }

        });

        $('path').mouseout(function () {
            $('#DivToShow').css({ 'display': 'none' });
            $('#DivToShow').text('');
        });

        $('path').mousemove(function () {
            $('#DivToShow').css({ 'top': currentMousePos.y, 'left': currentMousePos.x });
        });

        $('#download-csv-button').click(function ()
        {
            let csvContent = "data:text/csv;charset=utf-8,";
            for(var e in names)
            {
                csvContent+="\n"+e+','+names[e];
            }
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", title+".csv");
            link.click();
        });

        function updateTable(action = 'appendAll'){
            let tbody = $('#myTable').children('tbody');
            tbody.empty();
            tbody.append(                '                <tr>\n' +
                '                    <td>ISO-3166-1-ALPHA2</td>\n' +
                '                    <td>Country Name</td>\n' +
                '                    <td><span>Value</span> <button id="add-new" class="purple-button">ADD NEW</button></td>\n' +
                '                </tr>\n');
            $('#add-new').click(function (){
                $('#full-popup').fadeIn(300);
                $('#country-predicate-input').focus();
            });
                for (let e in names) {
                    tbody.append('<tr><td>' + e + '</td><td>' + countries[e] + '</td><td>' + names[e] + '</td></tr>');
                }

            $('#myTable').find('tr').click( function(){
                countryId = $(this).children('td:eq(0)').text();
                const countryName = $(this).children('td:eq(1)').text();
                const countryValue = $(this).children('td:eq(2)').text();

                if(countryName!="Country Name") {
                    $('#country-name').text(countryName);
                    $('#new-word-input').val(countryValue);
                    $('#minimal-popup').fadeIn(300);
                    $('#new-word-input').focus();
                }
            });
        };

        $('#show-table-view-button').click(function (){

            if($('#data-table').is(':visible')) {
                $('#show-table-view-button').text('Show table view');
                $('#data-table').fadeOut('fast');
            }
            else {

                $('#show-table-view-button').text('Close table view');



                    updateTable();


                $('#data-table').fadeIn('fast');
                updateTableHeight();
            }



        });

        $('#close-enter-data-popup').click(function (){
           $('#minimal-popup').fadeOut(300);
        });

        $('#new-word-input').keypress(function (e) {
            if (e.which == 13) {
                $('#send-updated-country').click();
                return false;
            }
        });

        $(window).resize(updateTableHeight);
        function updateTableHeight() {
            $('#data-table').css('height', 'auto');
            if($('#data-table').offset().top + $('#data-table').height() > $(window).height())
            {
                $('#data-table').height($(window).height()-$('#data-table').offset().top);
            }
            //$('#data-table').height($(window).height()-$('#data-table').offset().top);
        }


        $('#close-full-enter-data-popup').click(function (){
           $('#full-popup').fadeOut(300);
        });

        $('#country-predicate-input').on('keyup', function(){
            const keyword = $('#country-predicate-input').val().toLowerCase();
            const match_pattern = new RegExp(keyword.replace(/[ ,]/g, ''), 'gi');
            let foundCountry = '-';
            for (let key in countries) {
                if(countries[key].toLowerCase().replace(/[ ,]/g, '').search(match_pattern) != -1)
                {
                    foundCountry = countries[key];
                    break;
                }
            }
            $('#value-for-country').text(foundCountry);
        });

        $('#send-full-updated-country').click(function (){
            let word = $('#new-word-input-full').val();
            const countryName = $('#value-for-country').text();
            let countryCode = '-';

            for(let key in countries){
                if(countries[key]==countryName)
                {
                    countryCode = key;
                }
            }

            if(countryCode=='-')
            {
                $('#full-popup').fadeOut(300);
                showMessage(false);
                return;
            }

            if(word==='' || word.length > 50)
            {
                showMessage(false);
            }
            else {
                const urlParams = new URLSearchParams(window.location.search);
                const topicId = urlParams.get('id');

                $.ajax({
                    url: "updateCountryData",
                    type: "POST",
                    data: {id: countryCode, value: word, topicId: topicId},
                    success: function (response) {
                        if(response=="success") {
                            names[countryCode] = word;
                            updateValues();
                            updateTable();
                            updateTableHeight();
                        }

                        showMessage(response == "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showMessage(false);
                    }
                });
            }

            $('#full-popup').fadeOut(300);
        });

        $('#new-word-input-full').keypress(function (e) {
            if (e.which == 13) {
                $('#send-full-updated-country').click();
                return false;
            }
        });

    });

