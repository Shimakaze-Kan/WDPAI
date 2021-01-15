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
       const urlParams = new URLSearchParams(window.location.search);
       const userId = urlParams.get('id');
       //const userId = $('#user-id').text().substring(11);
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
       const urlParams = new URLSearchParams(window.location.search);
       const userId = urlParams.get('id');
       //const userId = $('#user-id').text().substring(11);
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

   $('i.fas.fa-cog').click(function (){
       if($('.edit-profile').is(":hidden")) {
           $('.edit-profile > input').val($('#avatar-container > img').attr('src'));
           $('.edit-profile > textarea').val($('#about-desc').text());
           $('.edit-profile').fadeIn(300);
       }else
       {
           $('.edit-profile').fadeOut(300);
       }
   });

   $('#close-edit-profile').click(function (){
       $('.edit-profile').fadeOut(300);
   });

   $('#send-updated-profile-details').click(function (){
       const avatar_url = $('.edit-profile > input').val();
       const about = $('.edit-profile > textarea').val();

       $.ajax({
           url: "updateUsersDetails",
           type: "POST",
           data: {avatar_url: avatar_url, about: about},
           dataType: "json",
           success: function (response) {
               if(response.state == 'success') {
                   showMessage(true);
                   if(!$('#about').length)
                   {
                       $('#profile-content').after("<div id=\"about\">\n" +
                           "                       <span class=\"bigfont\">About:</span>\n" +
                           "                       <span id=\"about-desc\"><span/>\n" +
                           "                       </div>");
                   }
                   $('#about-desc').text(about);
                   if(about.length == 0)
                   {
                       $('#about').remove();
                   }
                   $('.avatar').attr('src', avatar_url);
               }
               else
               {
                   showMessage(false);
                   if('message' in response)
                   {
                       $('.alert-messages > span').text(response.message);
                       $('.alert-messages').slideDown( 300 ).delay( 5000 ).slideUp( 400 );
                   }
               }
           },
           error: function (jqXHR, textStatus, errorThrown) {
               showMessage(false);
           }
       });

       $('.edit-profile').fadeOut(300);
   });
});