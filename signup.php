<?php

session_start();
  $_SESSION['message'] ='started';
$mysqli = new mysqli('localhost', 'hemraj', 'root','login table');
// $_SESSION['email'] = $user['email'];
// $_SESSION['first_name'] = $user['first_name'];
// $_SESSION['last_name'] = $user['last_name'];
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $username= $mysqli->escape_string($_POST['username']);
    $email = $mysqli->escape_string($_POST['email']);
    $password = $mysqli->escape_string($_POST['password']);

    // Check if user with that email already exists

    $result = $mysqli->query("SELECT * FROM login WHERE email='$email'") ;
    // or die($mysqli->error());

    if ( $result->num_rows > 0 ) {

        echo "<script type=\"text/javascript\">";
       echo "alert (\"User with that username already exists!\")";
      echo "</script>";
        //header("location: error.php");

      }
      else
      { // Email doesn't already exist in a database, proceed...

        // active is 0 by DEFAULT (no need to include it here)
        $sql = "INSERT INTO login (username, email, password) VALUES ('$username','$email','$password')";
                $mysqli->query($sql);
                 header("location:gp.php");
              }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>SplitPay</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
body{
    background-color: #383838
}
</style>
</head>
<body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" </script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ml-auto">
<div class="container-fluid">
  <a class="navbar-brand" href="homepage.html"><i class="fa fa-money" aria-hidden="true"></i>   S P L I T P A Y</a>
  
     <ul class="nav navbar-nav navbar-right">
     <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> SIGN UP</a>
     </li>
     <li class="nav-item  ">
        <a class="nav-link" href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN </a>
     </li>
     </ul>

  </div>
</nav>
</body><div class="jumbotron">
<form action="signup.php" method="POST">
<div class="container">
<div class="form-group">
    <label for="exampletext">User Name</label>
    <input type="text" class="form-control" name="username" id="exampletext"  placeholder="Enter Name"><br>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  
  </div>
</body>
</html>
