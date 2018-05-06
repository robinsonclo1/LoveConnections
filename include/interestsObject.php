<?php

require '../include/connection.php';

class Interests {

  // properties
  public $conn;
  public $id;
  public $interestsArray = [];

  public function __construct($conn, $memberId = null, $intArray = [
    'basketball' => false,
    'bowling' => false,
    'cheer' => false,
    'dance' => false,
    'football' => false,
    'golf' => false,
    'gymnastics' => false,
    'lacrosse' => false,
    'soccer' => false,
    'softball' => false,
    'swimming' => false,
    'tennis' => false,
    'track' => false,
    'volleyball' => false,
    'mathematics' => false,
    'science' => false,
    'reading' => false,
    'history' => false,
    'languages' => false,
    'agriculture' => false,
    'church' => false,
    'politics' => false,
    'liberal' => false,
    'conservative' => false,
    'independent' => false,
    'art' => false,
    'music' => false,
    'singing' => false,
    'orchestra' => false,
    'band' => false,
    'acting' => false,
    'fashion' => false,
    'movies' => false,
  ]) {
    $this->conn = $conn;
    $this->id = $memberId;
    $this->interestsArray = $intArray;
  }

  public function createAndPopulateCheckboxes() {
    //This is a terrible way to do this, but running low on time.
    //I separated them into categories by counting the number of items in each.
    //Athletics:
    $numAthletics = 14;
    $numAcademic = 6;
    $numReligion = 5;
    $numArts = 8;
    $i=0;
    $this->popArraySql();
    echo "<div class='col-xs-12'>
            <div class='col-md-4 col-sm-6' style='text-align:center;'>
              <div id='athletics'>
                <h3>Athletics</h3>";
                $this->sectionOfCheckboxes($i, $numAthletics);
    echo "    </div>
            </div>
            <div class='col-md-4 col-sm-6' style='text-align:center;'>
              <div id='academic'>
              <h3>Academic</h3>";
              $this->sectionOfCheckboxes($numAthletics, $numAthletics+$numAcademic);
    echo    "</div>
             <div id='community'>
               <h3>Religion & Politics</h3>";
               $this->sectionOfCheckboxes($numAthletics+$numAcademic, $numAthletics+$numAcademic+$numReligion);
    echo "  </div>
          </div>
          <div class='col-md-4 col-sm-12' style='text-align:center;'>
            <div id='artistic'>
              <h3>Arts & Music</h3>";
              $this->sectionOfCheckboxes($numAthletics+$numAcademic+$numReligion, $numAthletics+$numAcademic+$numReligion+$numArts);
   echo "   </div>
          </div>";
  }

  public function sectionOfCheckboxes($startValue, $endValue) {
    $i = 0;
    foreach ($this->interestsArray as $key => $value) {
      $i++;
      if($i>$startValue && $startValue<$endValue) {
        if ($value === true) {
          echo "<label class='interest-container container'>" . ucfirst($key) . "
                  <input type='checkbox' name='interestList[]' id='$key' value='$key' checked>
                  <span class='checkmark'></span>
                </label>";
        } else {
          echo "<label class='interest-container container'>" . ucfirst($key) . "
                  <input type='checkbox' name='interestList[]' id='$key' value='$key'>
                  <span class='checkmark'></span>
                </label>";
        }
        $startValue++;
      }
    }
  }

  public function popArraySql() {
    $memInterests = [];
    $sql = "SELECT i.interest
              FROM memberInfo m
              Join MemberInterestLink mi on (mi.memberID_FK = m.memberID_PK)
              Join interests i on (mi.interestID_FK = i.interestID_PK)
              WHERE memberID_PK = $this->id";
    $result = $this->conn->query($sql);
    foreach ($result as $row) {
      array_push($memInterests, $row['interest']);
    }

   foreach ($this->interestsArray as $key => $value) {
     for ($i=0; $i<sizeof($memInterests); $i++) {
       if ($memInterests[$i] === $key) {
         $this->interestsArray[$key] = true;
       }
     }
   }
  }

  public function modifyArray() {
    
  }

  public function getQuery() {
    $this->changeBoolToBinary();
    if (!$this->checkMemberID($this->conn)) {
      $insert = "insert into UserInterests (memberID_FK, " .
        implode(',', array_keys($this->interestsArray)) .
        ") VALUES (" . $this->id . "," . implode(',', $this->interestsArray) .
        "); ";
        echo $insert;
    } else {
      $insert = "update UserInterests (memberID_FK, " .
        implode(',', array_keys($this->interestsArray)) .
        ") VALUES (" . $this->id . "," . implode(',', $this->interestsArray) .
        "); ";

        //UPDATE UserInterests SET football=1 WHERE memberID_FK = id;
        echo $insert;
    }
  }

  public function checkMemberId() {
     $sql = "Select ? From UserInterests";

     if ($stmt = mysqli_prepare($this->conn, $sql)) {
       mysqli_stmt_bind_param($stmt, "i", $id);

       if (mysqli_stmt_execute($stmt)) {
         mysqli_stmt_store_result($stmt);

         if (mysqli_stmt_num_rows($stmt) == 1) {
           return TRUE;
         } else {
           return FALSE;
         }
       }
     }
  }

  //won't need this anymore because I'm storing them in the link table...
  public function changeBoolToBinary() {
    foreach ($this->interestsArray as $key => $value) {
      if ($value === TRUE) {
        $this->interestsArray[$key] = 1;
      } else {
        $this->interestsArray[$key] = 0;
      }
    }
  }
}
