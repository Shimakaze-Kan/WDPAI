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

jQuery(function ($) {
   $('#ban-button').click(function (){
       const userId = $('#user-id').text().substring(11);
       let banPeriod = {years:0, months:0, days:0, userId: userId};
       if($('#d3_graph_chart0001day').is(':checked'))
       {
           banPeriod = {years:0, months:0, days:1, userId: userId};
       }
       else if($('#d3_graph_chart0007day').is(':checked'))
       {
           banPeriod = {years:0, months:0, days:7, userId: userId};
       }
       else if($('#d3_graph_chart0010years').is(':checked'))
       {
           banPeriod = {years:10, months:0, days:0, userId: userId};
       }

       $.ajax({
           url: "banUser",
           type: "POST",
           data: banPeriod,
           success: function (response) {
               if(response=="success") {
                   showMessage(true);
                   let d = new Date();
                   const year = d.getFullYear();
                   const month = d.getMonth();
                   const day = d.getDate();
                   const date = new Date(year + banPeriod.years, month+banPeriod.months, day+banPeriod.days);
                   $('#user-state').prop('title', 'User banned until: '+date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate());
                   $('#user-state').css('color', 'black');
               }
               else
               {
                   showMessage(false);
               }
           },
           error: function (jqXHR, textStatus, errorThrown) {
               showMessage(false);
           }
       });
   });

   $('#unban-button').click(function (){
       const userId = $('#user-id').text().substring(11);
       $.ajax({
           url: "unbanUser",
           type: "POST",
           data: {userId: userId},
           success: function (response) {
               if(response=="success") {
                   showMessage(true);
                   $('#user-state').prop('title', 'Refresh the page to see the current status ');
                   $('#user-state').css('color', '#FFA500');
               }
               else
               {
                   showMessage(false);
               }
           },
           error: function (jqXHR, textStatus, errorThrown) {
               showMessage(false);
           }
       });
   });
});