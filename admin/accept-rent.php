<?php

  include_once("../functions.php");
  $functions = new Functions();

  $rentId = $_GET['rent_id'];

  $acceptRent = $functions->acceptRent($rentId);

  if ($acceptRent) {
    header("Location: rentals.php");
  }

?>