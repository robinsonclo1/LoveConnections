<?php

require '../include/connection.php';
/**
 * Our game class, which does two things for us:
 *  1. It helps map data in PHP to our game table in MySQL simply by existing
 *     as as datatype with properties that match the columns.
 *  2. It has some validation and helper methods to assist with saving data
 *     to MySQL.
 */
class Interests {

  // properties
  public $id;
  public $interestsArray = [];

  public function __construct($memberId = null, $intArray = [
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
    $this->id = $memberId;
    $this->interestsArray = $intArray;
  }

  public function arraySetter($interests) {
    foreach ($interests as $key => $value) {
      //$objectKey = $this->key;
      //$objectVal = $this->value;
      //$this->interestsArray[$key]
      if ($this->interestsArray[$key] = $key) {
        $this->interestsArray[$key] = TRUE;
      } else {
        $this->interestsArray[$key] = FALSE;
      }
    }
  }

  public function getQuery($conn) {
    $this->changeBoolToBinary();
    if (!$this->checkMemberID($conn)) {
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

  public function checkMemberId($conn) {
     $sql = "Select ? From UserInterests";

     if ($stmt = mysqli_prepare($conn, $sql)) {
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
