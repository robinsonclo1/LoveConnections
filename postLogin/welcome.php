<?php
  require '../include/connection.php';
  require '../include/session.php';
  require "../include/topnav.php";

function getEventDetails($conn) {
  $records = [];

  if (!empty($_GET)) {
    $getEvents = "Select eventName, eventDate, eventLocation, numRounds FROM eventInfo WHERE " .  $_GET['id'] . " = eventID_PK;";

    $result = $conn->query($getEvents);
    if($result) {
      $records = $result;
      return $records;
    }
  } else {
    error_reporting(0);
  }
}

function eventDateSorter($operator, $conn) {
  $currentDate = date('Y-m-d H:i:s');
    $getEvents = "Select eventID_PK, eventName, eventDate, eventLocation, numRounds FROM eventInfo WHERE " .  $_SESSION['id'] . " = memberID_fk;";
    $events = $conn->query($getEvents);
    foreach ($events as $row):
      $mysqltime = date("n/j/y", strtotime($row['eventDate']));
      $id = $row['eventID_PK'];
      $name = $row['eventName'];
      $location = $row['eventLocation'];
      $numRounds = $row['numRounds'];


    if ($operator) {
      if ($currentDate <= $mysqltime) { ?>
        <div class="specificEventBox">
          <a class='eventCard' href='?id=<?=$id?>'>
            <div id="date" style="display: inline-block;">
              <?=$mysqltime?>
            </div>
            <div id="title" style="display: inline-block;">
              <?=$name?>
            </div>
            <p id="location"><?= $location?></p>
            <p id="numRounds"><?= $numRounds?></p>
          </a>
        </div>
      <?php };
    } else {
      if ($currentDate > $mysqltime) { ?>
        <div class="specificEventBox">
          <a class='eventCard' href='?id=<?=$id?>'>
            <div id="date" style="display: inline-block;">
              <?=$mysqltime?>
            </div>
            <div id="title" style="display: inline-block;">
              <?=$name?>
            </div>
            <p id="location"><?= $location?></p>
            <p id="numRounds"><?= $numRounds?></p>
          </a>
        </div>
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
            <a href="#" data-toggle="modal" data-target="#addDetailsModal" id="changeDetails-trigger">Add New Event</a>
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

        <!-- Add Details Modal -->
        <div id="addDetailsModal" class="modal fade" role="dialog">
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
                <form class="eventForm" id="addEventForm" action="../postLogin/newEvent.php" method="POST">

                  <div class="detailsModalContainer">
                    <label>Event Name</label>
                    <input type='text' name="eventName" id="eventName" placeholder='Name of the new event' class='eventName newEvent'/>
                    <label>Location</label>
                    <input type="text" name="eventLocation" id="eventLocation" autocomplete="off" id="us2-address"/>
                    <label>Number of Rounds</label>
                    <input type='number' name="numRounds" id="eventNumRounds" class='numRounds'/>
                    <label>Event Date</label>
                    <input type='date' name="eventDate" id="eventDate" class='eventDate'/>
                  </div>
                </form>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="addEventSaveChanges">Save Changes</button>
                <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
              </div>

            </div>
          </div>
        </div>
        <!--End Modal -->


      </div>

      <div class="col-lg-8 col-md-6 col-sm-8 col-xs-6 eventDetails">
        <h1>Event Details</h1>
        <?php
          $currentEvent = getEventDetails($conn)->fetch_assoc();
          if ($currentEvent) {
            $name= $currentEvent["eventName"];
            $date= $currentEvent["eventDate"];
            $displayDate = date("n/j/y", strtotime($date));
            $location= $currentEvent["eventLocation"];
            $numRounds= $currentEvent["numRounds"];
            ?>
            <table class="details">
              <tbody>
                <tr>
                  <td class="logistics" scope="row">Name:</td>
                  <td id="detailsEventName"><?=$name?></td>
                </tr>
                <tr>
                  <td class="logistics" scope="row">Date:</td>
                  <td id="detailsEventDate"><?=$displayDate?></td>
                </tr>
                <tr>
                  <td class="logistics" scope="row">Location:</td>
                  <td id="detailsLocation"><?=$location?></td>
                </tr>
                <tr>
                  <td class="logistics" scope="row">Number of Rounds:</td>
                  <td id="detailsNumRounds"><?=$numRounds?></td>
                </tr>
              </tbody>
            </table>
            <div class="buttonHolder">
              <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteEventModal" id="editEventDeleteEvent">Delete Event</a>
              <a type="button" class="btn btn-default" data-toggle="modal" data-target="#changeDetailsModal" id="editEventDetails">Change Details</a>
              <a type="button" class="btn btn-default" id="toMemberMatcher" href="../postLogin/matchMembers.php">Match Members</a>
            </div>

            <!-- Change Details Modal -->
            <div id="changeDetailsModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change this event</h4>
                  </div>

                  <div class="modal-body addEvent">
                    <h4>Event Details</h4>

                    <!-- The events are added here -->
                    <form class="eventForm"  id="alterEventForm" action="../postLogin/alterEvent.php" method="POST">

                      <div class="detailsModalContainer">
                        <input type="hidden" name="id" id="eventID" value="<?=$_GET['id']?>" />
                        <label>Event Name</label>
                        <input type='text' name="eventName" id="eventName" placeholder='Name of the new event' class='eventName newEvent' value='<?=$name?>' />
                        <label>Location</label>
                        <input type="text" name="eventLocation" id="eventLocation" autocomplete="off" id="us2-address" value='<?=$location?>' />
                        <label>Number of Rounds</label>
                        <input type='number' name="numRounds" id="eventNumRounds" class='numRounds' value='<?=$numRounds?>' />
                        <label>Event Date</label>
                        <input type='date' name="eventDate" id="eventDate" class='eventDate' value='<?=$date?>' />
                      </div>
                    </form>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="alterEventSaveChanges">Save Changes</button>
                    <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
                  </div>

                </div>
              </div>
            </div>
            <!--End Modal -->

            <!-- Delete Event Modal -->
            <div id="deleteEventModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete This Event?</h4>
                  </div>

                  <div class="modal-body">
                    <h4>Event Details</h4>

                    <form class="eventForm"  id="deleteEventForm" action="../postLogin/deleteEvent.php" method="POST">
                      <div class="detailsModalContainer">
                        <input type="hidden" name="id" id="eventID" value="<?=$_GET['id']?>" />
                        <label>Event Name:</label> <?=$name?><br>
                        <label>Date:</label> <?=$displayDate?><br>
                        <label>Location:</label> <?=$location?><br>
                        <label>Number of Rounds:</label> <?=$numRounds?>
                      </div>
                    </form>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteEvent">Delete Event</button>
                    <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
                  </div>

                </div>
              </div>
            </div>
            <!--End Modal -->

            <?php
            } else { ?>
              <p>Click on an event to see more details.</p>
          <?php } ?>
      </div>
    </div>
</div>
<script></script>
  </body>
</HTML>
