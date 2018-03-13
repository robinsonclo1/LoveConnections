$(document).ready(function(){
    $('.btn').mouseenter(function() {
        $(this).fadeTo('fast');
    });
    $('.btn').mouseleave(function() {
        $(this).fadeTo('fast');
    });
});  
  
$(document).ready(function(){
  $('#login-trigger').off().on("click", function(){
    $(this).next('#login-content').slideToggle();
    $(this).toggleClass('active');          
  });
});

//Log in dropdown
$(document).ready(function() {
  $('#login-trigger').off("click").on("click", function(){
    $('#login-content').fadeToggle('slow');
  });
});
//member splash screen functions

$(document).ready(function() {
  $("#organizationBtn").off("click").on("click", function() {
    $(".organizationBox").show();
    $(".participantBox").hide();
  });
  $("#participantBtn").off("click").on("click", function() {
    $(".participantBox").show();
    $(".organizationBox").hide();
  });

});

$(document).ready(function () {
  $("#eventForm").off().on("submit", function(e) {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax({
      url: formURL,
      type: "POST",
      data: postData,
      success: function(data, textStatus, jqXHR) {
        $('#changeDetailsModal .modal-header .modal-title').html("Event Added");
        $('#changeDetailsModal .modal-body').html(data);
        $("#saveChanges").remove();
        $("#changeDetailsModal #dismiss").html("Continue");
        window.location.reload();
      },
      error: function(jqXHR, status, error) {
        console.log(status + ": " + error);
      }
    });
    e.preventDefault();
  });
        
  $("#saveChanges").on('click', function() {
    $("#eventForm").submit();
  });
});

$(document).ready(function() {
  var header = $(".eventDetails h2").text();
    if (header == "Event Details") {
      $("#toMemberMatcher").hide();
    }
  $(".eventBox").off("click").on("click", function() {
	
  });
});
  
$(document).ready(function () {
  $(".eventBox").niceScroll( {
    cursorcolor: "rgb(261,160,230)",
    cursorwidth: "10px"
  });
});

