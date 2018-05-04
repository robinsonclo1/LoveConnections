$(document).ready(function(){

  //Nicelooking Buttons
  $('.btn').mouseenter(function() {
    $(this).fadeTo('fast');
  });
  $('.btn').mouseleave(function() {
    $(this).fadeTo('fast');
  });

  //Activates log-in menu
  $('#login-trigger').off().on("click", function(){
    $(this).next('#login-content').slideToggle();
    $(this).toggleClass('active');
  });

  //Log in dropdown
  $('#login-trigger').off("click").on("click", function(){
    $('#login-content').fadeToggle('slow');
  });


  //Sign Up Form: show organization/participant divs
  $("#organizationBtn").off("click").on("click", function() {
    $(".organizationBox").hide();
    $(".organizationBox").show();
    $(".firstName").text("Contact First Name");
    $(".lastName").text("Contact Last Name");
    $(".orgName").show();
    $(".orgBoolInput").attr('value', "true");
  });
  $("#participantBtn").off("click").on("click", function() {
    $(".organizationBox").hide();
    $(".organizationBox").show();
    $(".firstName").text("First Name");
    $(".lastName").text("Last Name");
    $(".orgName").hide();
    $(".orgBoolInput").attr('value', "false");
  });

  //welcome.php functions
    //addNewEvent Modal
      //form handling
      $(".eventForm").off().on("submit", function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
          url: formURL,
          type: "POST",
          data: postData,
          success: function(data, textStatus, jqXHR) {
            window.location.reload();
          },
          error: function(jqXHR, status, error) {
            console.log(status + ": " + error);
          }
        });
        e.preventDefault();
      });

      //Submit Modal
      $("#alterEventSaveChanges").on('click', function() {
        $("#alterEventForm").submit();
      });
      $("#addEventSaveChanges").on('click', function() {
        $("#addEventForm").submit();
      });
      $("#deleteEvent").on('click', function() {
        $("#deleteEventForm").submit();
      });
      $("#RSVPForEvent").on('click', function() {
        $("#RSVPEventForm").submit();
      });


  //Nice scroll
  $(".eventBox").niceScroll( {
    cursorcolor: "rgb(261,160,230)",
    cursorwidth: "10px"
  });
});
