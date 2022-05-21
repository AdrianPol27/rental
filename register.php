<?php

  include('functions.php');

  $functions = new Functions();

  if (isset($_POST['register_btn'])) {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password != $confirmPassword) {
      array_push($errors, "Password does not match!");
    } else {
      $query = $functions->ifEmailTaken($email);
      if (mysqli_num_rows($query) > 0) {
        array_push($errors, "Email already taken try another one!");
      } else {
        $password = md5($password); // Hash password
        $register = $functions->register($firstname, $lastname, $email, $password);
        if ($register) {
          $registerSuccess = array_push($errorSuccess, "Account has been created!");
        }
      }
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rental | Register</title>

  <?php include('./layout/styles.php') ?>

</head>

<style>
  html,
  body {
    height: 100%;
  }
  body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #000;
  }

  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;}
    .form-signin .checkbox {font-weight: 400;}
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;}
    .form-signin .form-control:focus {z-index: 2;}
    .form-signin input {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;}
</style>

<body class="text-center">
  <form action="register.php" class="form-signin" method="post">
    <div class="site-logo">
      <a href="index.php" class="text-warning">Rental</a>
    </div>
    <h1 class="h3 mb-3 font-weight-normal text-white">Register</h1>
    <?php include('errors.php') ?>
    <!-- First Name -->
    <label for="inputFirstName" class="sr-only">First Name</label>
    <input type="text" id="inputFirstName" class="form-control" name="first_name" placeholder="First Name" required autofocus>
    <!-- Last Name -->
    <label for="inputLastName" class="sr-only">Last Name</label>
    <input type="text" id="inputLastName" class="form-control" name="last_name" placeholder="Last Name" required>
    <!-- Email Address -->
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required>
    <!-- Password -->
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
    <!-- Confirm Password -->
    <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
    <input type="password" id="inputConfirmPassword" class="form-control" name="confirm_password" placeholder="Confirm Password" required>

    <button type="submit" class="btn btn-lg btn-warning btn-block my-3" name="register_btn">Register</button>
    <p>Already had an account? <a href="login.php">Login Now!</a></p>
  </form>
</body>
</html>