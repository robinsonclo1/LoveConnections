<?php
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

  /**
   * Constructors are always named __construct, starting with two underscores.
   * Here we've added six parameters to initialize the six properties on our
   * object.
   */
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

  /*public function getInterest($individualInterest) {
    return this->$individualInterest;
  }

  public function compareInterests($interest1, $interest2) {
    if ($this->$interest1 = TRUE && $this->$interest2 = TRUE) {
      return TRUE;
    }
  }

  public function getAllInteretsAsArray() {
    return (array) $this;
  }
  /**
   * This function will generate the SQL necessary to save the game to the
   * database. Depending on whether the game has an ID, it will return either
   * an update (yes) or an insert (no) statement.
   */
  public function getQuery() {
    // note the curly braces where we call a method inside the double quotes
    if ($this->haveGameId()) {
      return "update game
        set title = '$this->title',
        release_year = '$this->year',
        beaten = {$this->beatenAsInt()},
        system_id = $this->system,
        developer_id = $this->developer
        where game_id = $this->id";
    } else {
      return "insert game (system_id, developer_id, title, release_year, beaten)
        values($this->system, $this->developer, '$this->title', '$this->year',
        {$this->beatenAsInt()})";
    }
  }

  /**
   * A simple function to determine whether we have a game ID or not on this
   * game object.
   */
  private function haveMemberId() {
    return isset($this->id) && is_numeric($this->id);
  }

  public function convertToArray() {
    $interestsArray = array();
    foreach ($this as $key => $value) {
      if ($value = false) {
        array_push($interestsArray, $key, 0);
      } elseif ($value = true) {
        array_push($interestsArray, $key, 1);
      }
    }
    return $interestsArray;
  }

  private function updateClass($str) {
    $this->$str = true;
  }

  private function updateSQL() {
    $interestsList = convertToArray();
    /* return "update UserInterests
      set " .
      foreach($key => $value) {
        $key " = " $value ", ";
      }
      . "where memberID_FK = $this->id"; */
  }
}
