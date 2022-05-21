<?php

  define('DB_SERVER','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','rental_db');

  $errors = array();
  $errorSuccess = array();

  class Functions {

    // DATABASE CONNECTION
    function __construct() {
      $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
      $this->dbh = $conn;
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    }


    function login($email, $password) {
      $result = mysqli_query($this->dbh, "SELECT * FROM users_tbl WHERE email = '$email' AND password = '$password'");
      return $result;
    }
    function register($firstName, $lastName, $email, $password) {
      $result = mysqli_query($this->dbh, "INSERT INTO users_tbl (user_type, first_name, last_name, email, password) VALUES ('1','$firstName','$lastName','$email','$password')");
      return $result;
    }
    function ifEmailTaken($email) {
      $result = mysqli_query($this->dbh, "SELECT email FROM users_tbl WHERE email = '$email'");
      return $result;
    }


    function fetchUnits() {
      $result = mysqli_query($this->dbh, "SELECT * FROM units_tbl");
      return $result;
    }
    function ifUnitTaken($unitModel) {
      $result = mysqli_query($this->dbh, "SELECT unit_model FROM units_tbl WHERE unit_model = '$unitModel'");
      return $result;
    }
    function addUnit($unitImage, $unitModel, $unitCost, $unitDescription, $unitAvailability) {
      $result = mysqli_query($this->dbh, "INSERT INTO units_tbl (unit_image, unit_model, unit_cost, unit_description, unit_availability) VALUES ('$unitImage', '$unitModel', '$unitCost', '$unitDescription', '$unitAvailability')");
      return $result;
    }
    function deleteUnit($unitId) {
      $result = mysqli_query($this->dbh, "DELETE FROM units_tbl WHERE unit_id = '$unitId'");
      return $result;
    }


    function fetchRents() {
      $result = mysqli_query($this->dbh, "SELECT * FROM rents_tbl");
      return $result;
    }
    function fetchRentsPending() {
      $result = mysqli_query($this->dbh, "SELECT * FROM rents_tbl WHERE status = 'Pending'");
      return $result;
    }
    function rentUnit($userId, $fullname, $address, $unitModel, $unitCost, $startRent, $endRent, $days, $total) {
      $result = mysqli_query($this->dbh, "INSERT INTO rents_tbl (user_id, fullname, address, unit_model, unit_cost, start_rent, end_rent, days, total, status) VALUES ('$userId', '$fullname', '$address', '$unitModel', '$unitCost', '$startRent', '$endRent', '$days','$total','Pending')");
      return $result;
    }
    function fetchRentsByUserId($userId) {
      $result = mysqli_query($this->dbh, "SELECT * FROM rents_tbl WHERE user_id = '$userId'");
      return $result;
    }
    function cancelRent($rentId) {
      $result = mysqli_query($this->dbh, "DELETE FROM rents_tbl WHERE rent_id = '$rentId'");
      return $result;
    }
    function acceptRent($rentId) {
      $result = mysqli_query($this->dbh, "UPDATE rents_tbl SET status = 'Accepted' WHERE rent_id = '$rentId'");
      return $result;
    }

  }
