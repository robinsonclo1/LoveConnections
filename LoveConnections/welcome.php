<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
  header("location: homepage.php");
  exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'loveConnections');
  if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
  }

require "topnav.php";

function eventDateSorter($operator, $conn) {
  $currentDate = date('Y-m-d H:i:s'); 
    $getEvents = "Select eventName, eventDate FROM eventInfo WHERE " .  $_SESSION['id'] . " = organizationID_fk;";
    $events = $conn->query($getEvents);
    foreach ($events as $row): 
      $mysqltime = date("n/j/y", strtotime($row['eventDate']));
    
    if ($operator) {
      if ($currentDate <= $mysqltime) { ?>
        <a class='eventTitle' href='#'><?=$mysqltime?> <?=$row['eventName']?></a>
      <?php };
    } else {
      if ($currentDate > $mysqltime) { ?>
        <a class='eventTitle' href='#'><?=$mysqltime?> <?=$row['eventName']?></a>
      <?php };
    }
  
      
    endforeach;
}
?>


<!DOCTYPE HTML>
<HTML>
  <head>
    <title>Welcome</title>
    
  </head>

  <body >
    <div class="container no-gutters">
    <div class="row">
      <div class="col-lg-offset-0 col-md-offset-1 col-md-pull-1 col-md-4 col-sm-4 col-xs-6">
        <div class="sidenavContainer">
         <div class="nicescroll-box">
          <div class="eventBox upcoming wrap">
            <h1>Upcoming Events</h1>
              <div class="UpcomingEventNames events">
                <?php
                  $less = TRUE;
                  eventDateSorter($less, $conn);
                ?>
                
              </div>
            <a href="#" data-toggle="modal" data-target="#changeDetailsModal" id="changeDetails-trigger">Add New Event</a>
          </div>
          </div>
          <div class="nicescroll-box">
          <div class="eventBox past wrap">
            <h1>Past Events</h1>
            <div class="PastEventNames events">
              <!--<a href="#">Event Name</a>-->
              <?php
                $less = FALSE;
                eventDateSorter($less, $conn);
              ?>
            </div>
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
                <h4 class="modal-title">Add an event</h4>
              </div>
              
              <div class="modal-body addEvent"> 
                <h4>Event Details</h4>
                  
                <!-- The events are added here -->
                <form id="eventForm" action="newEvent.php" method="POST">
                  <div class="detailsModalContainer">
                    <label>Event Name</label>
                    <input type='text' name="eventName" id="eventName" placeholder='Name of the new event' class='eventName newEvent'/>
                    <label>Location</label>
                    <input type="text" name="eventLocation" id="eventLocation" autocomplete="off" id="us2-address"/>
                  </div>
                  <div class="detailsModalContainer">
                    <label>Number of Rounds</label>
                    <input type='number' name="numRounds" id="numRounds" class='numRounds'/>
                    <label>Event Date</label>
                    <input type='date' name="eventDate" id="eventDate" class='eventDate'/>
                  </div>
                  <div id="us2"></div>
                  <script>
                     $('#us2').locationpicker({
                         location: {
                             latitude: 40,
                             longitude: -82.9
                         },
                         radius: 30,
                         inputBinding: {
                             radiusInput: $('#us2-radius'),
                             locationNameInput: $('#us2-address')
                         },
                         enableAutocomplete: true
                     });
                  </script>
                </form>
              </div>
                  
              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="saveChanges">Save Changes</button>
                <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
              </div>

            </div>
          </div>
        </div> 
        <!--End Modal -->
      </div>
    
      <div class="col-lg-8 col-md-6 col-sm-8 col-xs-6 eventDetails">
        <h2>Event Details</h2>
        <p>Click on an event to see more details.</p>
        <a type="submit" class="btn btn-default" id="toMemberMatcher" href="recruitment buddy.html">Match Members</a>
      </div>
    </div>
</div>
<script></script>
  </body>
</HTML>

