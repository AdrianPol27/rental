<?php

  include_once("functions.php");
  $functions = new Functions();

  $rentId = $_GET['rent_id'];

  $cancelRent = $functions->cancelRent($rentId);

  if ($cancelRent) {
    header("Location: my-rents.php");
  }

?>