<?php

session_start();
$mysqli = new mysqli('localhost', 'hemraj', 'root','login table');
$n= $_SESSION['message'];
$gp=$_SESSION['message1'];
$m=1;
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
  </div>
   <li class="nav-item ">
        <a class="nav-link" href="logout.php"> LOGOUT </a>
     </li>
      <li class="nav-item ">
        <a class="nav-link" href="expenselist.php">NEXT</a>
     </li>
</nav>
<div class="jumbotron">
<form  method="POST">
<?php
 while($m<=$n)
 {
 	echo"<div class=\"form-group\">
    <label for=\"exampleInputEmail1\">User Name ".$m."</label>
    <input type=\"text\" class=\"form-control\" name=\"username".$m."\"  placeholder=\"Enter username\" required>
    </div><br>";
    $m=$m+1;
 
 }
 echo " <center><button type=\"submit\" class=\"btn btn-primary\">Submit</button></center>";
 ?>
 
 <?php
 $i=0;
 $m=1;
 while($m<=$n)
 {
  if($_SERVER['REQUEST_METHOD']=='POST')
  $username = $mysqli->escape_string($_POST["username".$m]);
   $id=$m;
  $noofuser = $_SESSION['message'];
  $groupname = $_SESSION['message1'];
 $password1 = $_SESSION['message2'];
  if(!empty($username))
  {
  $sql=  "INSERT INTO grouplist ( groupname, password,noofuser,id,username) VALUES 
  ('$groupname','$password1','$noofuser','$id','$username')";
                $mysqli->query($sql);
   }
 $m++;
 $i++;
 }
?>
</form>
</div>
</body>
</html>