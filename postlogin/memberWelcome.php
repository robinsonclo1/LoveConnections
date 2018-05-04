<?php
require '../include/connection.php';
require '../include/session.php';
require "../include/topnav.php";

$isOrg = $_SESSION['org'];
if (isset($_GET['success'])) {
  echo "<h1>You registered for the event</h1>";
}
if ($isOrg) {
  header("location: ../postLogin/organizationWelcome.php");
}

function getEventDetails($conn) {
$records = [];
  if (!empty($_GET) && isset($_GET['id']) ) {
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

function eventDateSorter($operator, $conn, $isOrg) {
$currentDate = date('Y-m-d H:i:s');
if ($isOrg) {
  $getEvents = "Select eventID_PK, eventName, eventDate, eventLocation, numRounds FROM eventInfo WHERE " .  $_SESSION['id'] . " = memberID_fk;";
} else {
  $getEvents = "Select eventID_PK, eventName, eventDate, eventLocation, numRounds FROM eventInfo;";
}
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

function hasChangedInterests($conn) {
$sql = "SELECT * FROM memberInterestLink WHERE memberID_FK = " . $_SESSION['id'];
if ($stmt = $conn->prepare($sql)) {

  /* execute query */
  $stmt->execute();

  /* store result */
  $stmt->store_result();

  if ($stmt->num_rows >= 1) {
    return TRUE;
  } else {
    return FALSE;
  }
  /* close statement */
  $stmt->close();
}
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
                  eventDateSorter($less, $conn, $isOrg);
                ?>

              </div>
          </div>
          </div>
          <div class="nicescroll-box">
          <div class="eventBox past wrap">
            <h1>Past Events</h1>
            <div class="PastEventNames events">
              <!--<a href="#">Event Name</a>-->
              <?php
                $less = FALSE;
                eventDateSorter($less, $conn, $isOrg);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

      <div class="col-lg-8 col-md-6 col-sm-8 col-xs-6 eventDetails sign-up-box">
        <?php
          if(hasChangedInterests($conn)) {
            echo "<h3>Modify your personal interests?</h3>";
          } else {
            echo "<h3>It looks like you haven't selected your personal interests!</h3>";
          }
        ?>
        <a class="btn btn-primary" href="../postLogin/personalityProfile.php">Personality Profile</a>
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
            </tbody>
          </table>
          <div class="buttonHolder">
            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#RSVPModal" id="toRSVP">RSVP</a>
          </div>

          <?php
          } else { ?>
            <p>Click on an event to see more details.</p>
        <?php } ?>

    </div>
  </div>
</div>

<!-- RSVP Event Modal -->
<div id="RSVPModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RSVP for this Event?</h4>
      </div>

      <div class="modal-body">
        <h4>Event Details</h4>

        <form class="RSVPeventForm"  id="RSVPEventForm" action="../postLogin/RSVPForEvent.php" method="POST">
          <div class="detailsModalContainer">
            <input type="hidden" name="eventID" id="eventID" value="<?= $_GET['id']?>" />
            <input type="hidden" name="memberID" id="memberID" value="<?= $_SESSION['id'] ?>"/>
            <label>Event Name:</label> <?=$name?><br>
            <label>Date:</label> <?=$displayDate?><br>
            <label>Location:</label> <?=$location?><br>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default submit" id="RSVPForEvent">Confirm RSVP</button>
        <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
      </div>

    </div>
  </div>
</div>
<!--End Modal -->

</body>
</HTML>
