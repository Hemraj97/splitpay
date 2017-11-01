<?php

session_start();
$mysqli = new mysqli('localhost', 'hemraj', 'root','login table');
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
   <li class="nav-item ">
        <a class="nav-link" href="logout.php"> LOGOUT </a>
     </li>
  </div>
</nav>
</body><div class="jumbotron">
</div>
</html>