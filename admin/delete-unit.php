<?php

  include_once("../functions.php");
  $functions = new Functions();

  $unitId = $_GET['unit_id'];
  $unitImage = $_GET['unit_image'];

  $deleteUnit = $functions->deleteUnit($unitId);
  unlink($unitImage); // DELETE IMAGE FROM FOLDER

  if ($deleteUnit) {
    header("Location: units.php");
  }

?>