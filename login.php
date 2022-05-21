<?php

  session_start();

  include_once("functions.php");
  $functions = new Functions();
  $errors = array();

  if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = md5($password);

    $login = $functions->login($email, $password);
    $row = mysqli_fetch_assoc($login);

    if (mysqli_num_rows($login) === 1) {
      if ($email == $row['email'] && $password == $row['password']) {
        if ($row['user_type'] == 0) {
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['first_name'] = $row['first_name'];
          $_SESSION['last_name'] = $row['last_name'];
          header('Location: ./admin/index.php');
        } else {
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['first_name'] = $row['first_name'];
          $_SESSION['last_name'] = $row['last_name'];
          header('Location: index.php');
        }
      } else {
        array_push($errors, "Incorrect email or password!");
      } 
    } else {
      array_push($errors, "No account yet!");
    } 
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rental | Login</title>

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
  <form action="login.php" class="form-signin" method="post">
    <div class="site-logo">
      <a href="index.php" class="text-warning">Rental</a>
    </div>
    <h1 class="h3 mb-3 font-weight-normal text-white">Login</h1>
    <!-- Email Address -->
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
    <!-- Password -->
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>

    <button class="btn btn-lg btn-warning btn-block my-3" type="submit" name="login_btn">Login</button>
    <p>Don't have an account? <a href="register.php">Register Now!</a></p>
  </form>
</body>
</html>