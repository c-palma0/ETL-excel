<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'etl');
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $usuario = mysqli_real_escape_string($db, $_POST['usuario']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password= mysqli_real_escape_string($db, $_POST['password']);
  $puesto= mysqli_real_escape_string($db, $_POST['puesto']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE user='$usuario' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['usuario'] === $name) {
      array_push($errors, "El usuario ya existe");
    }

    if ($user['email'] === $email) {
      array_push($errors, "El correo ya existe");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (name, email, password, puesto, user) 
  			  VALUES('$name', '$email', '$password', '$puesto','$usuario')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Has sido registrado";
  	header('location: login.php');
  }
}

if (isset($_POST['login_user'])) {
  $usuario = mysqli_real_escape_string($db, $_POST['usuario']);
  $password = mysqli_real_escape_string($db, $_POST['password']);


  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM user WHERE user='$usuario' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {

     if($row =  mysqli_fetch_array($results)) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['puesto'] = $row['puesto'];
        $_SESSION['id'] = $row['id'];
    }
  	  header('location:view/inicio.php');
  	}else {
  		array_push($errors, "Ocurrio un error intente de nuevo");
  	}
  }
}

?>