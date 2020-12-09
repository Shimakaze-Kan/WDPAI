var state = false;
function openNav() {
    if (state) {
        document.getElementById("slide-nav").style.visibility = "collapse";
        document.querySelectorAll("main")[0].style.filter = "none";
        state = false;
    }
    else {
        state = true;
        document.getElementById("slide-nav").style.visibility = "visible";
        document.querySelectorAll("main")[0].style.filter = "blur(3px) grayscale(1)";
    }
}

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

    /*countries["AF"] = "Afghanistan";
    countries["AX"] = "Ã…land Islands";
    countries["AL"] = "Albania";
    countries["DZ"] = "Algeria";
    countries["AS"] = "American Samoa";
    countries["AD"] = "Andorra";
    countries["AO"] = "Angola";
    countries["AI"] = "Anguilla";
    countries["AQ"] = "Antarctica";
    countries["AG"] = "Antigua and Barbuda";
    countries["AR"] = "Argentina";
    countries["AM"] = "Armenia";
    countries["AW"] = "Aruba";
    countries["AU"] = "Australia";
    countries["AT"] = "Austria";
    countries["AZ"] = "Azerbaijan";
    countries["BS"] = "Bahamas";
    countries["BH"] = "Bahrain";
    countries["BD"] = "Bangladesh";
    countries["BB"] = "Barbados";
    countries["BY"] = "Belarus";
    countries["BE"] = "Belgium";
    countries["BZ"] = "Belize";
    countries["BJ"] = "Benin";
    countries["BM"] = "Bermuda";
    countries["BT"] = "Bhutan";
    countries["BO"] = "Bolivia, Plurinational State of";
    countries["BQ"] = "Bonaire, Sint Eustatius and Saba";
    countries["BA"] = "Bosnia and Herzegovina";
    countries["BW"] = "Botswana";
    countries["BV"] = "Bouvet Island";
    countries["BR"] = "Brazil";
    countries["IO"] = "British Indian Ocean Territory";
    countries["BN"] = "Brunei Darussalam";
    countries["BG"] = "Bulgaria";
    countries["BF"] = "Burkina Faso";
    countries["BI"] = "Burundi";
    countries["KH"] = "Cambodia";
    countries["CM"] = "Cameroon";
    countries["CA"] = "Canada";
    countries["CV"] = "Cape Verde";
    countries["KY"] = "Cayman Islands";
    countries["CF"] = "Central African Republic";
    countries["TD"] = "Chad";
    countries["CL"] = "Chile";
    countries["CN"] = "China";
    countries["CX"] = "Christmas Island";
    countries["CC"] = "Cocos (Keeling) Islands";
    countries["CO"] = "Colombia";
    countries["KM"] = "Comoros";
    countries["CG"] = "Congo";
    countries["CD"] = "Congo, the Democratic Republic of the";
    countries["CK"] = "Cook Islands";
    countries["CR"] = "Costa Rica";
    countries["CI"] = "CÃ´te d'Ivoire";
    countries["HR"] = "Croatia";
    countries["CU"] = "Cuba";
    countries["CW"] = "CuraÃ§ao";
    countries["CY"] = "Cyprus";
    countries["CZ"] = "Czech Republic";
    countries["DK"] = "Denmark";
    countries["DJ"] = "Djibouti";
    countries["DM"] = "Dominica";
    countries["DO"] = "Dominican Republic";
    countries["EC"] = "Ecuador";
    countries["EG"] = "Egypt";
    countries["SV"] = "El Salvador";
    countries["GQ"] = "Equatorial Guinea";
    countries["ER"] = "Eritrea";
    countries["EE"] = "Estonia";
    countries["ET"] = "Ethiopia";
    countries["FK"] = "Falkland Islands (Malvinas)";
    countries["FO"] = "Faroe Islands";
    countries["FJ"] = "Fiji";
    countries["FI"] = "Finland";
    countries["FR"] = "France";
    countries["GF"] = "French Guiana";
    countries["PF"] = "French Polynesia";
    countries["TF"] = "French Southern Territories";
    countries["GA"] = "Gabon";
    countries["GM"] = "Gambia";
    countries["GE"] = "Georgia";
    countries["DE"] = "Germany";
    countries["GH"] = "Ghana";
    countries["GI"] = "Gibraltar";
    countries["GR"] = "Greece";
    countries["GL"] = "Greenland";
    countries["GD"] = "Grenada";
    countries["GP"] = "Guadeloupe";
    countries["GU"] = "Guam";
    countries["GT"] = "Guatemala";
    countries["GG"] = "Guernsey";
    countries["GN"] = "Guinea";
    countries["GW"] = "Guinea-Bissau";
    countries["GY"] = "Guyana";
    countries["HT"] = "Haiti";
    countries["HM"] = "Heard Island and McDonald Islands";
    countries["VA"] = "Holy See (Vatican City State)";
    countries["HN"] = "Honduras";
    countries["HK"] = "Hong Kong";
    countries["HU"] = "Hungary";
    countries["IS"] = "Iceland";
    countries["IN"] = "India";
    countries["ID"] = "Indonesia";
    countries["IR"] = "Iran, Islamic Republic of";
    countries["IQ"] = "Iraq";
    countries["IE"] = "Ireland";
    countries["IM"] = "Isle of Man";
    countries["IL"] = "Israel";
    countries["IT"] = "Italy";
    countries["JM"] = "Jamaica";
    countries["JP"] = "Japan";
    countries["JE"] = "Jersey";
    countries["JO"] = "Jordan";
    countries["KZ"] = "Kazakhstan";
    countries["KE"] = "Kenya";
    countries["KI"] = "Kiribati";
    countries["KP"] = "Korea, Democratic People's Republic of";
    countries["KR"] = "Korea, Republic of";
    countries["KW"] = "Kuwait";
    countries["KG"] = "Kyrgyzstan";
    countries["LA"] = "Lao People's Democratic Republic";
    countries["LV"] = "Latvia";
    countries["LB"] = "Lebanon";
    countries["LS"] = "Lesotho";
    countries["LR"] = "Liberia";
    countries["LY"] = "Libya";
    countries["LI"] = "Liechtenstein";
    countries["LT"] = "Lithuania";
    countries["LU"] = "Luxembourg";
    countries["MO"] = "Macao";
    countries["MK"] = "Macedonia, the Former Yugoslav Republic of";
    countries["MG"] = "Madagascar";
    countries["MW"] = "Malawi";
    countries["MY"] = "Malaysia";
    countries["MV"] = "Maldives";
    countries["ML"] = "Mali";
    countries["MT"] = "Malta";
    countries["MH"] = "Marshall Islands";
    countries["MQ"] = "Martinique";
    countries["MR"] = "Mauritania";
    countries["MU"] = "Mauritius";
    countries["YT"] = "Mayotte";
    countries["MX"] = "Mexico";
    countries["FM"] = "Micronesia, Federated States of";
    countries["MD"] = "Moldova, Republic of";
    countries["MC"] = "Monaco";
    countries["MN"] = "Mongolia";
    countries["ME"] = "Montenegro";
    countries["MS"] = "Montserrat";
    countries["MA"] = "Morocco";
    countries["MZ"] = "Mozambique";
    countries["MM"] = "Myanmar";
    countries["NA"] = "Namibia";
    countries["NR"] = "Nauru";
    countries["NP"] = "Nepal";
    countries["NL"] = "Netherlands";
    countries["NC"] = "New Caledonia";
    countries["NZ"] = "New Zealand";
    countries["NI"] = "Nicaragua";
    countries["NE"] = "Niger";
    countries["NG"] = "Nigeria";
    countries["NU"] = "Niue";
    countries["NF"] = "Norfolk Island";
    countries["MP"] = "Northern Mariana Islands";
    countries["NO"] = "Norway";
    countries["OM"] = "Oman";
    countries["PK"] = "Pakistan";
    countries["PW"] = "Palau";
    countries["PS"] = "Palestine, State of";
    countries["PA"] = "Panama";
    countries["PG"] = "Papua New Guinea";
    countries["PY"] = "Paraguay";
    countries["PE"] = "Peru";
    countries["PH"] = "Philippines";
    countries["PN"] = "Pitcairn";
    countries["PL"] = "Poland";
    countries["PT"] = "Portugal";
    countries["PR"] = "Puerto Rico";
    countries["QA"] = "Qatar";
    countries["RE"] = "RÃ©union";
    countries["RO"] = "Romania";
    countries["RU"] = "Russian Federation";
    countries["RW"] = "Rwanda";
    countries["BL"] = "Saint BarthÃ©lemy";
    countries["SH"] = "Saint Helena, Ascension and Tristan da Cunha";
    countries["KN"] = "Saint Kitts and Nevis";
    countries["LC"] = "Saint Lucia";
    countries["MF"] = "Saint Martin (French part)";
    countries["PM"] = "Saint Pierre and Miquelon";
    countries["VC"] = "Saint Vincent and the Grenadines";
    countries["WS"] = "Samoa";
    countries["SM"] = "San Marino";
    countries["ST"] = "Sao Tome and Principe";
    countries["SA"] = "Saudi Arabia";
    countries["SN"] = "Senegal";
    countries["RS"] = "Serbia";
    countries["SC"] = "Seychelles";
    countries["SL"] = "Sierra Leone";
    countries["SG"] = "Singapore";
    countries["SX"] = "Sint Maarten (Dutch part)";
    countries["SK"] = "Slovakia";
    countries["SI"] = "Slovenia";
    countries["SB"] = "Solomon Islands";
    countries["SO"] = "Somalia";
    countries["ZA"] = "South Africa";
    countries["GS"] = "South Georgia and the South Sandwich Islands";
    countries["SS"] = "South Sudan";
    countries["ES"] = "Spain";
    countries["LK"] = "Sri Lanka";
    countries["SD"] = "Sudan";
    countries["SR"] = "Suriname";
    countries["SJ"] = "Svalbard and Jan Mayen";
    countries["SZ"] = "Swaziland";
    countries["SE"] = "Sweden";
    countries["CH"] = "Switzerland";
    countries["SY"] = "Syrian Arab Republic";
    countries["TW"] = "Taiwan, Province of China";
    countries["TJ"] = "Tajikistan";
    countries["TZ"] = "Tanzania, United Republic of";
    countries["TH"] = "Thailand";
    countries["TL"] = "Timor-Leste";
    countries["TG"] = "Togo";
    countries["TK"] = "Tokelau";
    countries["TO"] = "Tonga";
    countries["TT"] = "Trinidad and Tobago";
    countries["TN"] = "Tunisia";
    countries["TR"] = "Turkey";
    countries["TM"] = "Turkmenistan";
    countries["TC"] = "Turks and Caicos Islands";
    countries["TV"] = "Tuvalu";
    countries["UG"] = "Uganda";
    countries["UA"] = "Ukraine";
    countries["AE"] = "United Arab Emirates";
    countries["GB"] = "United Kingdom";
    countries["US"] = "United States";
    countries["UM"] = "United States Minor Outlying Islands";
    countries["UY"] = "Uruguay";
    countries["UZ"] = "Uzbekistan";
    countries["VU"] = "Vanuatu";
    countries["VE"] = "Venezuela, Bolivarian Republic of";
    countries["VN"] = "Viet Nam";
    countries["VG"] = "Virgin Islands, British";
    countries["VI"] = "Virgin Islands, U.S.";
    countries["WF"] = "Wallis and Futuna";
    countries["EH"] = "Western Sahara";
    countries["YE"] = "Yemen";
    countries["ZM"] = "Zambia";
    countries["ZW"] = "Zimbabwe";*/

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

