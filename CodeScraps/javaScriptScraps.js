//Unmatched Name cards

$(document).ready(function() {
  $('#unmatched').off().on("mouseover", function() {
    var newNameCard = '<div class="nameCard preClick unmatched"><h2 class="memberName">Hi</div>';
    newNameCard.appendTo('#unmatched');
  });
});

$(document).ready(function(){
	$('#unmatched').off().on("mouseover", ".unmatched.nameCard", function() {
      var currentCard = $(this);
	  var memberName = $(this).children(".memberName").text();
	  
	  currentCard.off('click').on("click", function() {
        //switches between "active" and "inactive (preClick)" card
		$("#unmatched .nameCard").addClass('nameCard preClick');
		currentCard.toggleClass('nameCard');
	    currentCard.toggleClass('nameCard preClick');
	
	    var cardContents = $('.nameCardContents');
    	cardContents.appendTo(currentCard);
	
	
	    if (currentCard.is(".nameCard.preClick") ) {
  	      cardContents.hide();
	    } else {
		  cardContents.show();
	    }
	  });
	  
	  
	  //stops card from closing if you click on buttons/input and carries out button events
	  currentCard.off('click', ".btn").on("click", ".btn", function(event) {
        var pnmLastName = $("#lastName").val();
	    var pnmFirstName = $('#firstName').val();
		var pnmIDNumber = $("#IDNumber").val();
		if (!pnmFirstName || !pnmLastName || !pnmIDNumber) {
		  $("#pairDialog").text("Please enter the PNM's details.");
		  $("#pairButton").hide();
		  $("#dismissButton").text("Return");
		} else {
		  $("#pairDialog").text("Are you sure you want to pair " + memberName + " with " + pnmFirstName + "  " + pnmLastName + "?");
		  $("#pairButton").show();
		  $("#dismissButton").text("Never Mind");
		}
		$("#removeMember").text("How long do you want to remove " + memberName + " from recruitment?");
	  });
	
      currentCard.off('click', ".ansField").on("click", ".ansField", function(event) {
		event.stopPropagation();
	  });
      	  
	  //Unmatched to Matched
      $('#pairModal #pairButton').off('click').on("click", function(event) {
		var pnmLastName = $("#lastName").val();
	    var pnmFirstName = $('#firstName').val();
		var pnmIDNumber = $("#IDNumber").val();
		
		currentCard.removeClass('unmatched');
		currentCard.addClass('matched');
		currentCard.children(".nameCardContents").hide();
		var addPNM = $("<div class='matchedNameCardContents'><p class='pnmName'>" + pnmFirstName + " " + pnmLastName + "</p><button type='button' class='btn btn-default'  data-toggle='modal' data-target='#unpairModal'>Unpair</button></div>");
		currentCard.append(addPNM);
		currentCard.addClass('preClick');
		currentCard.prependTo("#matched");
		$("#lastName").val("");
		$("#firstName").val("");
		$("#IDNumber").val("");
	  });
	  
	  //Move from Unmatched to Unavailible
	  //Remove for one party
	  $('#discardModal #onePartyButton').off('click').on("click", function(event) {
		currentCard.removeClass('unmatched').addClass('unavailable');
		currentCard.prependTo("#unavailable");
		var newDiv = $("<div class='unavailableNameCardContents' id='partyRemoval'><p>Removed for one party</p><button type='button' class='btn btn-default'  data-toggle='modal' data-target='#undoModal'>Undo</button></div>")
		newDiv.appendTo(currentCard);
	  });
	  //Remove for one event
	  $('#discardModal #oneEventButton').off('click').on("click", function(event) {
		currentCard.removeClass('unmatched').addClass('unavailable');
		currentCard.prependTo("#unavailable");
		var newDiv = $("<div class='unavailableNameCardContents' id='eventRemoval'><p>Removed for one event</p><button type='button' class='btn btn-default'  data-toggle='modal' data-target='#undoModal'>Undo</button></div>")
		newDiv.appendTo(currentCard);
	  });
	  //Remove for all recruitment
	  $('#discardModal #allRecruitmentButton').off('click').on("click", function(event) {
		currentCard.removeClass('unmatched');
		currentCard.addClass('unavailable');
		currentCard.prependTo("#unavailable");
		var newDiv = $("<div class='unavailableNameCardContents' id='recruitmentRemoval'><p>Removed from recruitment</p><button type='button' class='btn btn-default'  data-toggle='modal' data-target='#undoModal'>Undo</button></div>")
		newDiv.appendTo(currentCard);
	  });
	});
});

//Matched Name cards

$(document).ready(function(){
  $('#matched').off().on("mouseover", '.matched.nameCard', function() {	  
      var currentCard = $(this); 
	  var memberName = $(this).children(".memberName").text();
	  var pnmName = $(this).children().children(".pnmName").text();
	  
	  //switches between "active" and "inactive (preClick)" card
	  currentCard.off("click").on("click", function(event) {
      	//$("#matched .nameCard").addClass('nameCard preClick');
        currentCard.toggleClass('nameCard');
	    currentCard.toggleClass('nameCard preClick');
	
	    var cardContents = $('.matchedNameCardContents');	
	
	    if (currentCard.is(".nameCard.preClick") ) {
  	      currentCard.cardContents.hide();
	    } else {
	      currentCard.cardContents.show();
	    }
	  });
	  
	  	  
	  //stops card from closing if you click on buttons/input and carries out button events
	  currentCard.off("click", ".btn").on("click", ".btn", function() {
		$("#unpairDialog").text("Are you sure you want to unpair " + memberName + " and " + pnmName + "?");
	  });
	  
	  //Unmatched to Matched
      $('#unpairModal').off("click").on("click", "#unpair", function(event) {
		currentCard.removeClass('matched');
		currentCard.addClass('unmatched');
		currentCard.children(".matchedNameCardContents").empty();
		currentCard.prependTo("#unmatched");
	  });
	});
});

//Unavailible Name cards

$(document).ready(function(){
    $('#unavailable').off().on("mouseover", '.nameCard', function() {	  
      var currentCard = $(this); 
	  var memberName = $(this).children(".memberName").text();
	  
	  //switches between "active" and "inactive (preClick)" card
	  currentCard.off("click").on("click", function(event) {
		//$("#unavailable .nameCard").addClass('nameCard preClick');
        currentCard.toggleClass('nameCard');
	    currentCard.toggleClass('nameCard preClick');
	
	    var cardContents = $('.unavailableNameCardContents');	
	
	    if (currentCard.hasClass("nameCard preClick") ) {
  	      currentCard.cardContents.hide();
	    } else {
	      currentCard.cardContents.show();
	    }
	  });	
	  
	  
	  //stops card from closing if you click on buttons/input and carries out button events
	  currentCard.off("click", ".btn").on("click", ".btn", function() {
		$("#undoDialog").text("Are you sure you want to add " + memberName + " back into Recruitment?");
	  });
	  
	  //Unmatched to Matched
      $('#undoModal').off("click").on("click", "#undoButton", function(event) {
		currentCard.removeClass('unavailable');
		currentCard.addClass('unmatched');
		currentCard.children(".unavailableNameCardContents").empty();
		currentCard.prependTo("#unmatched");
	  });
	});
});