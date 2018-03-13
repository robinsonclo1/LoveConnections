<!DOCTYPE html>
<html>
  <head>
    <title>Love Connections Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="main.css">
    <script src='bootstrap.min.js'></script>
  	<script src="mains.js" type="text/javascript"></script>
  </head>

  <body>
  	<script src="main.js" type="text/javascript"></script>

    <header class="container-fluid">
	  <div class="topnav loggedIn">	  
	    <h1 class="col-xs-10"><a href='#'>Love Connections</a></h1>
		<nav class="col-xs-2" id="siteNav">
		  <li id="logout">
		    <a href="#" data-toggle="modal" data-target="#logOutModal" id="logout-trigger">Log out</a>                
          </li>
		</nav>
      </div>
	</header>
	<!-- Log Out Modal -->
    <div id="logOutModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Log Out?</h4>
          </div>
		  <div class="modal-body">
		    <p>Are you sure you want to log out?</p>
		  </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="logOut" data-dismiss="modal">Log Out</button>
            <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
          </div>
        </div>

      </div>
    </div> 
	<div class="container">
	
	<div class="col-md-pull-1 col-sm-4 col-xs-6">
	  <div class="sidenavContainer">
	    <div class="eventBox upcoming">
			<h1>Upcoming Events</h1>
			<div class="UpcomingEventNames">
			  <!-- <a href="#">Event Name</a> -->
			  <a class='eventTitle' href='#'>5/17 Beer Kitchen</a>
			  
			</div>
		  <a href="#" data-toggle="modal" data-target="#changeDetailsModal" id="changeDetails-trigger">Add New Event</a>
	    </div>
		
		<div class="eventBox past">
			<h1>Past Events</h1>
			<div class="PastEventNames">
			  <!--<a href="#">Event Name</a>-->
			  <a class='eventTitle' href='#'>3/17 Applebees</a>
			</div>
	    </div>
	  </div>
	  
	  
	  
	  <!-- Change Details Modal -->
      <div id="changeDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Change Recruitment Details?</h4>
            </div>
            <div class="modal-body recruitmentDetails"> 
			
				<h4>Event Details</h4>
                <!--I don't think this is the best way to add events. They should be added one at a time.
				<button type="button" class="btn btn-default" id="addEvent">Add an event</button>
                <button type="button" class="btn btn-default" id="removeEvent">Remove an event</button>
				
				<hr>
				-->
				<!-- The events are added here -->
				<div id="eventNameInputs">
				  <div class='extraEvent'>
				    <input type='text' placeholder='Name of the new event' class='eventName newEvent'/><input type='date' class='eventDate'/>
				  </div>
				</div>
				
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" id="saveChanges" data-dismiss="modal">Save Changes</button>
              <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
            </div>
          </div>

        </div>
      </div> 
	</div>
	
	<div class="col-md-8 col-md-push-1 col-sm-6 col-xs-6 eventDetails">
	  <h2>Event Details</h2>
	  <p>Click on an event to see more details.</p>
      <a type="submit" class="btn btn-default" id="toMemberMatcher" href="recruitment buddy.html">Match Members</a>
	</div>
	</div>
  </body>
</html>