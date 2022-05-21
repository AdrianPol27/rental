<?php

  session_start();

  include_once("functions.php");
  $functions = new Functions();
  $errors = array();

  $userId = ''; // Default user id

  if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Set user id if user has login
  }
  if (isset($_SESSION['first_name'])) {
    $firstName = $_SESSION['first_name']; // Set first name if user has login
  }
  if (isset($_SESSION['last_name'])) {
    $lastName = $_SESSION['last_name']; // Set last name if user has login
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
    <h1 class="text-center">My Rents</h1>
  </div>

  <main>
    <section id="section-units">
      <div class="container">
        <div class="col-lg-12 d-flex align-items-center justify-content-between">
          <div class="card w-100">
            <div class="card-header">My Rents</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-center">
                    <th>Unit Model</th>
                    <th>Unit Cost</th>
                    <th>Start Rent</th>
                    <th>End Rent</th>
                    <th>Days</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                      $fetchRentsByUserId = $functions->fetchRentsByUserId($userId);

                      if ($fetchRentsByUserId -> num_rows > 0) {
                        while ($rents = $fetchRentsByUserId -> fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?= $rents['unit_model'] ?></td>
                      <td><?= $rents['unit_cost'] ?></td>
                      <td><?= $rents['start_rent'] ?></td>
                      <td><?= $rents['end_rent'] ?></td>
                      <td><?= $rents['days'] ?></td>
                      <td><?= $rents['total'] ?></td>
                      <td><?= $rents['status'] ?></td>
                      <td>
                        <?php
                          if ($rents['status'] == 'Pending') { ?>
                            <a href="cancel-rent.php?rent_id=<?= $rents['rent_id'] ?>" class="btn btn-danger btn-sm w-100">Cancel</a>
                        <?php } else {
                          echo '<p class="text-success">Accepted</p>';
                        } ?>
                      </td>
                    </tr>
                      
                    <?php } } ?>
                  </tbody>
                </table>
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