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
  <title>Rental | Home</title>

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

  <div id="site-hero">
    <h1 class="text-center">Bringing the best <br> heavy equipment rental</h1>
  </div>

  <main>
    <section id="section-units">
      <div class="container">
        <h1 class="text-uppercase py-3">Units</h1>
        <div class="row">
          <?php
            $fetchUnits = $functions->fetchUnits();
            while($row = mysqli_fetch_array($fetchUnits)) {

              $unitImage = $row["unit_image"];
              $unitModel = $row['unit_model'];
              $unitCost = $row['unit_cost'];
          ?>
            <div class="col-lg-4">
              <?php if ($userId == 0) { ?>
                <a href="#!" data-toggle="modal" data-target="#loginRequiredModal">
                  <div class="feature-model">
                    <img src="<?= $row["unit_image"]?>"class="w-100 unit-image" alt="<?= $row['unit_model']; ?>">
                    <div class="card-description">
                      <strong><?= $row['unit_model']; ?></strong>
                      <p class="lead">&#8369;<?= $row['unit_cost']; ?> / Day</p>
                    </div>
                    <div class="feature-text text-uppercase">Rent Unit</div>
                  </div>
                </a>
              <?php } else { ?>
                <a href="#" data-toggle="modal" data-target="#rentUnitModal">
                  <div class="feature-model">
                    <img src="<?= $row["unit_image"]?>"class="w-100 unit-image" alt="<?= $row['unit_model']; ?>">
                    <div class="card-description">
                      <strong><?= $row['unit_model']; ?></strong>
                      <p class="lead">&#8369;<?= number_format($row['unit_cost'],2); ?> / Day</p>
                    </div>
                    <div class="feature-text text-uppercase">Rent Unit</div>
                  </div>
                </a>
              <?php } ?>
            </div>
          <?php } ?>
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

  <!-- Login Required Modal-->
	<div class="modal fade" id="loginRequiredModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login Required</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
          <div class="modal-body">
            You can't rent this unit. Please login first.
          </div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a href="login.php" class="btn btn-warning">Login</a>
					</div>
			</div>
		</div>
	</div>

  <!-- Rent Unit Modal-->
	<div class="modal fade" id="rentUnitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Rent Unit</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
        <form action="place-rent.php" method="post">
          <!-- Hidden value to be sent in place-rent.php -->
          <input type="hidden" name="unit_image" value="<?= $unitImage ?>">
          <input type="hidden" name="unit_model" value="<?= $unitModel ?>">
          <input type="hidden" name="unit_cost" value="<?= $unitCost ?>">
          <div class="modal-body">
            <div class="d-flex mb-1">
              <div class="col-lg-6 p-0 pr-1">
                <p class="m-0">Start Rent</p>
                <input type="date" class="form-control" name="start_rent" required>
              </div>
              <div class="col-lg-6 p-0">
                <p class="m-0">End Rent</p>
                <input type="date" class="form-control" name="end_rent" required>
              </div>
            </div>
            <!-- Destination -->
            <label for="inputAddress" class="sr-only">Address</label>
            <input type="text" id="inputAddress" class="form-control" name="address" placeholder="Address" required>
          </div>
					<div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning" name="place_rent_btn">Place Rent</button>
					</div>
        </form>
			</div>
		</div>
	</div>

  <?php include('./layout/scripts.php') ?>

</body>
</html>