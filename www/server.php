<?php
session_start();

// initializing variables
$username = "";
$email = "";
$errors = array();

// connect to the database
$db = mysqli_connect('172.21.0.2', 'root', 'tiger', 'registration');

// REGISTER USER
if (isset($_POST['reg_user']))
{
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filles ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) {array_push($errors, "Email is required"); }
  if (empty($password_1)) {array_push($errors, "Password is required"); }
  if (empty($password_2)) {array_push($errors, "The two passwords do not match"); }

  // first check the database to make sure
  // a user does not already exist with the same username and or email
  $user_check_query = "SELECT * FROM users WHERE username='$username'
    OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user){
    if($user['unsername'] === $username){
      array_push($errors, "User already exists");
    }
    if ($user['email'] === $email){
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if(count($errors) == 0){
    $password = md5($password_1);

    $query = "INSERT INTO users (username, email, password)
      VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if(empty($username)) {
    array_push($errors, "Username is required");
  }
  if(empty($password)){
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0){
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND
      password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1){
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

// ADD NEW DATA
if (isset($_POST['add_data']))
{
  // receive all input values from the form
  $fuel = mysqli_real_escape_string($db, $_POST['fuel']);
  $distance = mysqli_real_escape_string($db, $_POST['distance']);

  $username = $_SESSION['username'];
  $query_get = "SELECT id FROM users WHERE username='$username'";
  $result_get = mysqli_query($db, $query_get);
  if (mysqli_num_rows($result_get) == 1){
    $user_array = mysqli_fetch_assoc($result_get);
    $user_id = $user_array['id'];
  }

  // form validation
  if (empty($fuel)){array_push($errors, "Fuel is required"); }
  if (empty($distance)){array_push($errors, "Distance is required"); }

  // add date and Combustion
  $combustion = $fuel / $distance * 100;

  // add data to the dadtabase
  if(count($errors) == 0){
    $query_insert = "INSERT INTO data (user_id, fuel, distance, date, combustion)
      VALUES('$user_id', '$fuel', '$distance', now(), $combustion)";
    mysqli_query($db, $query_insert);
    $_SESSION['added'] = "You added new data";
    header('location: data_add.php');
  }
}


?>
