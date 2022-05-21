<?php

  session_start();

  include_once("functions.php");
  $functions = new Functions();
  $errors = array();

  $userId = ''; // Default user id

  // Redirect if unit model is empty 
  if (empty($_POST['unit_model'])) {
    header('Location: index.php');
  }

  if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Set user id if user has login
  }
  if (isset($_SESSION['first_name'])) {
    $firstName = $_SESSION['first_name']; // Set first name if user has login
  }
  if (isset($_SESSION['last_name'])) {
    $lastName = $_SESSION['last_name']; // Set last name if user has login
  }
  if (isset($_POST['unit_image'])) {
    $unitImage = $_POST['unit_image'];
  }
  if (isset($_POST['unit_model'])) {
    $unitModel = $_POST['unit_model'];
  }
  if (isset($_POST['unit_cost'])) {
    $unitCost = $_POST['unit_cost'];
  }
  if (isset($_POST['start_rent'])) {
    $startRent = $_POST['start_rent'];
  }
  if (isset($_POST['end_rent'])) {
    $endRent = $_POST['end_rent'];
  }
  if (isset($_POST['address'])) {
    $address = $_POST['address'];
  }

  $date1 =  new DateTime($startRent);
  $date2 =  new DateTime($endRent);
  $days = $date2->diff($date1)->format("%a");

  $getTotal = $unitCost * $days;

  $total = number_format($getTotal,2);

  if (isset($_POST['rent_unit_btn'])) {
    $userId = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $unitModel = $_POST['unit_model'];
    $unitCost = $_POST['unit_cost'];
    $startRent = $_POST['start_rent'];
    $endRent = $_POST['end_rent'];
    $days = $_POST['days'];
    $total = $_POST['total'];

    $rentUnit = $functions->rentUnit($userId, $fullname, $address, $unitModel, $unitCost, $startRent, $endRent, $days, $total);

    if ($rentUnit) {
      header('Location: index.php');
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rental | Place Rent</title>

  <?php include('./layout/styles.php') ?>

</head>
<body>
  <header role="banner">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
        <a href="index.php" class="navbar-brand">Rental</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample05">
          <ul class="navbar-nav ml-auto pl-lg-5 pl-0">
            <li class="nav-item">
              <a href="index.php" class="nav-link active">Home</a>
            </li>
            <?php
              if ($userId == 0) { ?>
                <li class="nav-item px-lg-3 px-0">
                  <a href="login.php" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                  <a href="register.php" class="nav-link">Register</a>
                </li>
              <?php } else { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $firstName . ' ' . $lastName ?></a>
                  <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a href="my-rents.php" class="dropdown-item">My Rents</a>
                    <a href="logout.php" class="dropdown-item">Logout</a>
                  </div>
                </li>
              <?php } ?>  
          </ul>

          <ul class="navbar-nav ml-auto mt-2">
            <li class="nav-item cta-btn">
              <a href="#" class="nav-link bg-warning">Contact Us</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
  </header>
  <!-- END header -->

  <div id="site-hero__place-rent">
    <h1 class="text-center">Place Rent</h1>
  </div>

  <main>
    <section id="section-units">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <img src="<?= $unitImage ?>"class="w-100 unit-image" alt="<?= $unitModel ?>">
            <div class="card-description">
              <strong><?= $unitModel ?></strong>
            </div>
          </div>
          <div class="col-lg-9 d-flex align-items-center justify-content-between">
            <div class="card w-100">
              <div class="card-header">Rent Details</div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-center">
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Unit Cost</th>
                      <th>Start Rent</th>
                      <th>End Rent</th>
                      <th>Days</th>
                    </thead>
                    <tbody class="text-center">
                      <tr>
                        <td><?= $firstName . ' ' . $lastName ?></td>
                        <td><?= $address ?></td>
                        <td><?= $unitCost ?></td>
                        <td><?= $startRent ?></td>
                        <td><?= $endRent ?></td>
                        <td><?= $days ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <h2 class="m-0">Total: &#8369;<?= $total ?></h2>
                <form action="place-rent.php" method="post">
                  <!-- Hiiden values to be sent to the database -->
                  <input type="hidden" name="user_id" value="<?= $userId ?>">
                  <input type="hidden" name="fullname" value="<?= $firstName . ' ' . $lastName ?>">
                  <input type="hidden" name="address" value="<?= $address ?>">
                  <input type="hidden" name="unit_model" value="<?= $unitModel ?>">
                  <input type="hidden" name="unit_cost" value="<?= $unitCost ?>">
                  <input type="hidden" name="start_rent" value="<?= $startRent ?>">
                  <input type="hidden" name="end_rent" value="<?= $endRent ?>">
                  <input type="hidden" name="days" value="<?= $days ?>">
                  <input type="hidden" name="total" value="<?= $total ?>">
                  <button type="submit" class="btn btn-warning" name="rent_unit_btn">Rent Unit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Grid row -->
    <section id="section-footer">
      <!-- Grid column -->
      <div class="col-md-12">
        <!--Footer-->
        <footer class="page-footer deep-purple center-on-small-only pt-0">
          <!--Footer links-->
          <div class="container">
            <!--Grid row-->
            <div class="row pt-5 mb-3 text-center d-flex justify-content-center">
              <!--Grid column-->
              <div class="col-md-2 mb-3">
                  <h6><a href="#!" class="text-warning">About Us</a></h6>
              </div>
              <!--Grid column-->
              <!--Grid column-->
              <div class="col-md-2 mb-3">
                  <h6><a href="#!" class="text-warning">Units</a></h6>
              </div>
              <!--Grid column-->
              <!--Grid column-->
              <div class="col-md-2 mb-3">
                  <h6><a href="#!" class="text-warning">FAQs</a></h6>
              </div>
              <!--Grid column-->
              <!--Grid column-->
              <div class="col-md-2 mb-3">
                  <h6><a href="#!" class="text-warning">Contact</a></h6>
              </div>
              <!--Grid column-->
            </div>
            <!--Grid row-->
            <!--Grid row-->
            <div class="row d-flex text-center justify-content-center mb-md-0">
              <!--Grid column-->
              <div class="col-md-8 col-12">
                <p style="plain line-height: 1.7rem">Whatever your construction project, Heavy Equipment Rental Services will provide aid to get things done as planned and right. Rent your desired heavy equipment now and start working!</p>
              </div>
              <!--Grid column-->
            </div>
            <!--Grid row-->
            <!--Copyright-->
            <div class="footer-copyright text-center py-3">
                <div class="container-fluid">
                    © 2022 Copyright: <a href="index.php" class="text-warning">RENTAL</a>
                </div>
            </div>
            <!--/Copyright-->
          </div>
          <!-- Grid column -->
        </footer>
        <!--/Footer-->                  
      </div>
      <!-- Grid column -->
    </section>
    <!-- Grid row -->
    
  </main>

  <?php include('./layout/scripts.php') ?>

</body>
</html>