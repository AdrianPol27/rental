<?php

  session_start();

  include_once("../functions.php");
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

	if (isset($_POST['add_unit'])) {
		$file = $_FILES['unit_image'];
		$fileName = $_FILES['unit_image']['name'];
		$fileTmpName = $_FILES['unit_image']['tmp_name'];
		$fileSize = $_FILES['unit_image']['size'];
		$fileError = $_FILES['unit_image']['error'];
		$fileType = $_FILES['unit_image']['type'];
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		$allowed = array('jpg', 'jpeg', 'png');

		$unitImage = $_FILES['unit_image']['tmp_name'];
		$unitModel = $_POST['unit_model'];
		$unitCost = $_POST['unit_cost'];
		$unitDescription = $_POST['unit_description'];
		$unitAvailability = $_POST['unit_availability'];

		$ifUnitTaken = $functions->ifUnitTaken($unitModel);
		if (mysqli_num_rows($ifUnitTaken) > 0) {
			array_push($errors, "Unit already exist!");
		} elseif (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize > 5000) {
					$fileNameNew = uniqid('', true) . "." . $fileActualExt;
					$fileDestination = '.././assets/images/units/' . $fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					// Insert Data To Database
					$unitImage = './assets/images/units/' . $fileNameNew;
					$addUnit = $functions->addUnit($unitImage, $unitModel, $unitCost, $unitDescription, $unitAvailability);
					if ($addUnit) {
						array_push($errorSuccess, "Unit added successfully!");
					}
				} else {
					array_push($errors, "File size should not exceed 5MB!");
				}
			} else {
				array_push($errors, "An unknown error occured!");
			}
		} else {
			array_push($errors, "File type is not supported!");
		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Units</title>

  <?php include('.././layout/dashboard-styles.php') ?>

</head>

<style>
	.form input {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;}
</style>
<body>
	<div class="vertical-nav" id="vertical-nav-toggle">
		<div class="site-logo">
      <a href="index.php" class="text-warning">Rental</a>
    </div>
  	<ul class="nav">
		<p class="nav-text">Menu</p>
			<li class="nav-item">
      	<a href="index.php" class="nav-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
						<path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
						<path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
					</svg> Dashboard
        </a>
    	</li>
			<li class="nav-item">
      	<a href="units.php" class="nav-link active">
					<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="ml-n1" version="1.1" viewBox="0 0 700 700" >
						<path d="m219.73 96.266c-1.4492 0.066406-2.8555 0.48438-4.1016 1.2305l-87.5 52.5c-2.6406 1.582-4.2539 4.4297-4.2539 7.5039v68.445c-2.1406 1.3242-4.1875 2.8047-6.0664 4.4961-8.5 7.6445-14.184 19.086-14.184 32.316 0 18.938 11.633 33.879 26.523 40.125 14.891 6.2461 33.676 4.0039 46.945-9.4336 8.207-8.3047-4.25-20.609-12.457-12.305-8.3164 8.4219-18.762 9.3633-27.719 5.6055-8.9609-3.7578-15.789-12.02-15.789-23.992 0-8.3633 3.332-14.742 8.3906-19.293 9.4258-8.4805 24.297-10.055 35.121 0.90625 8.1875 8.6289 20.973-3.9805 12.457-12.289-8.6367-8.7461-19.496-12.711-30.18-12.715-1.8633 0-3.6992 0.26562-5.5352 0.51172v-57.422l23.312-13.98 134.19 73.879v38.625c-1.9766 1.4023-3.2812 3.5625-3.6055 5.9648l-5.0742 38.145c-0.70312 5.25 3.3828 9.918 8.6836 9.9102v35c0 4.832 3.918 8.75 8.75 8.75h43.75v35h-68.906c-4.832 0-8.75 3.918-8.75 8.75v35c0 8.4609 5.2812 15.426 11.844 19.703s14.801 6.5469 23.754 6.5469h241.62c8.9531 0 17.191-2.2656 23.754-6.5469 6.5625-4.2773 11.844-11.246 11.844-19.703v-35c0-4.832-3.918-8.75-8.75-8.75h-68.906v-35.016h8.6641c0.027344 0 0.066406 0.015625 0.097656 0.015625h43.75c4.832 0 8.75-3.918 8.75-8.75l-0.011719-35h17.5c4.832 0 8.75-3.918 8.75-8.75v-77.555c0.066407-10.398-9.2812-18.75-19.602-17.5-0.027344 0.003907-0.066406 0.007813-0.097656 0.015626l-33.344-91.703c-1.1953-3.2891-4.2461-5.5508-7.7422-5.7422l-315-17.5c-0.29688-0.015625-0.58203-0.015625-0.875 0zm2.5977 17.621 76.547 4.2539v84.234l-116.81-64.328zm94.047 5.2305 113.9 6.3242v47.852c-0.097657 0.5625-0.16406 1.1328-0.16406 1.7109v87.293c-37.617-0.33203-77.105-2.3398-113.75-2.7695zm131.4 7.2969 81.09 4.4961 30.387 83.551-18.047 3.3828 0.56641-0.097656c-8.7656 1.0586-15.469 8.6797-15.398 17.516v62.223h-78.598zm131.1 102.18v0.066406 68.855h-35v-62.293-0.066406c0.19922-0.027344 0.37891-0.066406 0.5625-0.097656zm-267.29 48.434c37.426 0.29688 78.711 2.543 118.69 2.8555v17.621l-121.41-0.007812zm4.7852 37.973 140-0.003906v26.25h-140zm157.5 0h35v26.234c-11.68-0.027344-23.344 0.015625-35 0.015625zm52.5 0h26.25v26.234h-26.25zm-157.5 43.746h122.5v35h-122.5zm-77.656 52.5h277.81v26.25c0 1.2031-0.74219 2.9844-3.8945 5.043-3.1523 2.0586-8.3281 3.707-14.203 3.707h-241.62c-5.8711 0-11.051-1.6523-14.203-3.707-3.1523-2.0547-3.8945-3.8359-3.8945-5.043z"/>
					</svg> Units
					<div id="loadNumRequestPickup" class="badge bg-warning text-light">
						<?php
							$fetchUnits = $functions->fetchUnits();
							$rowcount = mysqli_num_rows($fetchUnits);
							printf($rowcount);
						?>
					</div>
        </a>
    	</li>
			<li class="nav-item">
      	<a href="rentals.php" class="nav-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-fill" viewBox="0 0 16 16">
						<path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
						<path d="M3.5 1h.585A1.498 1.498 0 0 0 4 1.5V2a1.5 1.5 0 0 0 1.5 1.5h5A1.5 1.5 0 0 0 12 2v-.5c0-.175-.03-.344-.085-.5h.585A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1Z"/>
					</svg> Rentals
					<div id="loadNumRequestPickup" class="badge bg-warning text-light">
						<?php
							$fetchRentsPending = $functions->fetchRentsPending();
							$rowcount = mysqli_num_rows($fetchRentsPending);
							printf($rowcount);
						?>
					</div>
        </a>
    	</li>
    	<li class="nav-item">
      	<a href=".././logout.php" class="nav-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
					</svg> Logout
        </a>
  	 	</li>
  	</ul>
	</div>

	<div id="content" class="content-wrapper p-3">
  	<button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
			</svg>
		</button>
  	<h2 class="display-4 text-dark">Units</h2>
		<?php include('../errors.php'); ?>
		<div class="row">
			<div class="col-12">
				<div class="box-body">
					<table id="myTable" class="table table-bordered display nowrap w-100">
						<thead>
							<tr>
								<th>ID</th>
								<th>Unit Image</th>
								<th>Unit Model</th>
								<th>Unit Cost</th>
								<th>Unit Description</th>
								<th>Unit Availability</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$cnt = 1;
								$fetchUnits = $functions->fetchUnits();
								while($row = mysqli_fetch_array($fetchUnits)) {
							?>
							<tr>
								<td><?= $cnt; ?></td>
								<td><img src="../<?= $row["unit_image"]?>"class="w-100" alt="<?= $row['unit_model']; ?>" style="height: 30px;"></td>
								<td><?= $row['unit_model']; ?></td>
								<td><?= '&#8369; ' . $row['unit_cost']; ?></</td>
								<td><?= $row['unit_description']; ?></td>
								<td><?= $row['unit_availability']; ?></td>
								<td>
									<a href="delete-unit.php?unit_id=<?= $row["unit_id"]?>&unit_image=<?= '.' . $row["unit_image"]?>" class="btn btn-danger w-100">Delete</a>
								</td>
							</tr>
							<?php $cnt=$cnt+1;} ?>
						</tbody>
						<tfoot>
							<a href="javascipt:void()" class="btn btn-warning mb-1" data-toggle="modal" data-target="#addUnitModal">Add Unit</a>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Add Unit Modal-->
	<div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="units.php" class="form" enctype="multipart/form-data" method="post">
					<div class="modal-body">
						<!-- Unit Image -->
						<div class="form-group">
							<input type="file" name="unit_image" required>
						</div>
						<!-- Unit Name -->
						<input type="text" class="form-control" name="unit_model" placeholder="Unit Model" required>
						<!-- Unit Cost -->
						<input type="number" class="form-control" name="unit_cost" placeholder="Unit Cost" required>
						<!-- Unit Description -->
						<textarea class="form-control w-100" name="unit_description" placeholder="Unit Description" style="height: 150px; resize:none; padding:12px" required></textarea>
						<select class="form-control mt-2" name="unit_availability" required>
							<option value="None">Unit Availability</option>
							<option value="Available">Available</option>
							<option value="Not Available">Not Available</option>
						</select>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<button class="btn btn-warning" type="submit" name="add_unit">Add Unit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include('.././layout/dashboard-footer.php'); ?>

</body>
</html>