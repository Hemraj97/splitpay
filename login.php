<?php

session_start();
$mysqli = new mysqli('localhost', 'hemraj', 'root','login table');
if($_SERVER['REQUEST_METHOD']=='POST')
{
  $username = $mysqli->escape_string($_POST['username']);
//  $count =  $mysqli->query("SELECT count(email) FROM login_table WHERE email='$email'");
  $result = $mysqli->query("SELECT * FROM login WHERE username='$username'");
   $password = $mysqli->escape_string($_POST['password']);
 
if ($result->num_rows == 0){
   echo "<script type=\"text/javascript\">";
   echo "alert (\"User with that username doesn't exist!\")";
    echo "</script>";
     }
  else
    { // User exists
      $user = $result->fetch_assoc();
   

      if ($password == $user['password'] )
      {

           $_SESSION['username'] = $user['username'];
        
          // print_r($_SESSION);
          header("location:gp.php");
      }
      else
      {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"Incorrect password,try again!\")";
        echo "</script>";
      }

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
     <li class="nav-item">
        <a class="nav-link" href="signup.php"><i class="fa fa-user-plus" aria-hidden="true"></i> SIGN UP</a>
     </li>
     <li class="nav-item active">
        <a class="nav-link" href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN </a>
     </li>
     </ul>
  </div>
</nav>
</body><div class="jumbotron">
<form action="login.php" method="POST">
<div class="container">
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" required>
    </div><br>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
  </div>
</body>
</html>
