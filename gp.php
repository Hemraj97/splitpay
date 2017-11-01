<?php

session_start();
$mysqli = new mysqli('localhost', 'hemraj', 'root','login table');
if(!empty($_POST["egroupname"])&&!empty($_POST["epassword"]))
{
   $groupname = $mysqli->escape_string($_POST['egroupname']);
   $password = $mysqli->escape_string($_POST['epassword']);
   $res=$mysqli->query("SELECT * FROM grouplist WHERE groupname='$groupname'&& password='$password'");
   if ($res->num_rows == 0){
   echo "<script type=\"text/javascript\">";
   echo "alert (\"Group does not exist\")";
    echo "</script>";
     }
     else
     {
       $_SESSION['message1']= $groupname;
       header("location:expenselist.php");
     }
} 
if(!empty($_POST["ngroupname"])&& !empty($_POST["npassword"])&& !empty($_POST["ncpassword"]) &&!empty($_POST["noofuser"]))
{
  $groupname=$mysqli->escape_string($_POST['ngroupname']);
  $password1=$mysqli->escape_string($_POST['npassword']);
  $password2=$mysqli->escape_string($_POST['ncpassword']);
  $noofuser=$mysqli->escape_string($_POST['noofuser']);
  if($password1==$password2 && $noofuser<=6)
  {
    $_SESSION['message'] =$noofuser;
     $_SESSION['message1']= $groupname;
     $_SESSION['message2']= $password1;
     
 header("location:noofuser.php");
  }
  else
  {
     echo "<script type=\"text/javascript\">";
   echo "alert (\"Passwords don't match or invalid number of users\")";
    echo "</script>";
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ml-auto">
<div class="container-fluid">
  <a class="navbar-brand" href=#><i class="fa fa-money" aria-hidden="true"></i>   S P L I T P A Y</a>
  </div>
   <li class="nav-item ">
        <a class="nav-link" href="logout.php"> LOGOUT </a>
     </li>
</nav>
<div class="jumbotron">
<h3>Get Started!</h3><br>
 <p class="lead">Create a group among your friends and manage all expenses.</p>
   <hr class="my-4">
   <p>Create a new group or login to an already existing group.</p><br>
   <center><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal1" style="margin-left: 15px">New Group</button>
    <div class="modal hide" id="myModal1" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enter details</h4>
            <button type="button" class="close" data-dismiss="modal">x</button>
        </div>
        <div class="modal-body">
          <form  method="POST">
          <div class="container">
          <div class="form-group">
        <label for="exampleInputEmail1">Group Name</label>
        <input type="text" class="form-control" name="ngroupname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" required>
        </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="npassword" id="exampleInputPassword1" placeholder="Password" required>
     <label for="exampleInputPassword2"> Confirm Password</label>
    <input type="password" class="form-control" name="ncpassword" id="exampleInputPassword2" placeholder="Re-enter Password" required>
  </div>
   <div class="form-group">
     <label for="exampleInputPassword2">Enter number of memebers</label>
    <input type="text" class="form-control" name="noofuser" id="exampleInputPassword2" placeholder="Between 2-6 users" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
   </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
   <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-left: 15px">Already Existing?</button></center>
   <div class="modal hide" id="myModal" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enter details</h4>
            <button type="button" class="close" data-dismiss="modal">x</button>
        </div>
        <div class="modal-body">
          <form  method="POST">
          <div class="container">
          <div class="form-group">
        <label for="exampleInputEmail1">Group Name</label>
        <input type="text" class="form-control" name="egroupname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" required>
        </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="epassword" id="exampleInputPassword1" placeholder="Password" required>
    </div>
   
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</div>
</body>
</html>