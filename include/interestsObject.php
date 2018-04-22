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
  public $basketball = false;
  public $bowling = false;
  public $cheer = false;
  public $dance = false;
  public $football = false;
  public $golf = false;
  public $gymnastics = false;
  public $lacrosse = false;
  public $soccer = false;
  public $softball = false;
  public $swimming = false;
  public $tennis = false;
  public $track = false;
  public $volleyball = false;
  public $mathematics = false;
  public $science = false;
  public $reading = false;
  public $history = false;
  public $languages = false;
  public $agriculture = false;
  public $church = false;
  public $politics = false;
  public $liberal = false;
  public $conservative = false;
  public $independent = false;
  public $art = false;
  public $music = false;
  public $singing = false;
  public $orchestra = false;
  public $band = false;
  public $acting = false;
  public $fashion = false;
  public $movies = false;
  /**
   * Constructors are always named __construct, starting with two underscores.
   * Here we've added six parameters to initialize the six properties on our
   * object.
   */
  public function __construct(
      $memberId = null,
      $basketball = false,
      $bowling = false,
      $cheer = false,
      $dance = false,
      $football = false,
      $golf = false,
      $gymnastics = false,
      $lacrosse = false,
      $soccer = false,
      $softball = false,
      $swimming = false,
      $tennis = false,
      $track = false,
      $volleyball = false,
      $mathematics = false,
      $science = false,
      $reading = false,
      $history = false,
      $languages = false,
      $agriculture = false,
      $church = false,
      $politics = false,
      $liberal = false,
      $conservative = false,
      $independent = false,
      $art = false,
      $music = false,
      $singing = false,
      $orchestra = false,
      $band = false,
      $acting = false,
      $fashion = false,
      $movies = false) {

    $this->id = $memberId;
    $this->basketball = $basketball;
    $this->bowling = $bowling;
    $this->cheer = $cheer;
    $this->dance = $dance;
    $this->football = $football;
    $this->golf = $golf;
    $this->gymnastics = $gymnastics;
    $this->lacrosse = $lacrosse;
    $this->soccer = $soccer;
    $this->softball = $softball;
    $this->swimming = $swimming;
    $this->tennis = $tennis;
    $this->track = $track;
    $this->volleyball = $volleyball;
    $this->mathematics = $mathematics;
    $this->science = $science;
    $this->reading = $reading;
    $this->history = $history;
    $this->languages = $languages;
    $this->agriculture = $agriculture;
    $this->church = $church;
    $this->politics = $politics;
    $this->liberal = $liberal;
    $this->conservative = $conservative;
    $this->independent = $independent;
    $this->art = $art;
    $this->music = $music;
    $this->singing = $singing;
    $this->band = $band;
    $this->acting = $acting;
    $this->fashion = $fashion;
    $this->orchestra = $orchestra;
    $this->movies = $movies;
  }

/*  public function getInterest($individualInterest) {
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
