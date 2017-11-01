<?php

session_start();
$mysqli = new mysqli('localhost', 'hemraj', 'root','login table');
$gp=$_SESSION['message1'];
ini_set('max_execution_time', 300);
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
<style type="text/css">
  table{
    background-color: white;
     width: 80%;
  }
tr:nth-child(even) {background-color: #f2f2f2} 
  th{
    background-color:  #383838;
    color: white;
  }

th,td,tr{
 text-align: center;
     text-align: left;
} 

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ml-auto">
<div class="container-fluid">
  <a class="navbar-brand" href="homepage.html"><i class="fa fa-money" aria-hidden="true"></i>   S P L I T P A Y</a>
   <li class="nav-item ">
        <a class="nav-link" href="logout.php"> LOGOUT </a>
     </li>
  </div>
</nav>
</body><div class="jumbotron">
<?php
 $result = $mysqli->query("SELECT username,item,cost FROM expenselist WHERE groupname='$gp'");
    echo "<center><table>";
    echo"<th> Username</th><th>Item Name</th><th>Item Price</th>";
    while($row = $result->fetch_assoc())
      {
        echo"<tr>";
      echo"<td>". $row['username'] ."</td>";
      echo"<td>". $row['item'] ."</td>";
        echo"<td>". $row['cost'] ."</td>";
       echo"</tr>"; 
      }
 echo "</center></table><br>";
?>
 <center><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal1" style="margin-left: 30px">Add Item</button>
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
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" name="user" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" required>
        </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Item Name</label>
    <input type="text" class="form-control" name="item" id="exampleInputPassword1" placeholder="Enter Item" required>
     <label for="exampleInputPassword2"> Cost</label>
    <input type="text" class="form-control" name="cost" id="exampleInputPassword2" placeholder="Enter in ruppees" required>
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
  <a href="final.php"><button type="submit"  class="btn btn-primary" style="margin-left: 30px">View Expense Table</button></a>

</div>
</html>
<?php
if(!empty($_POST["item"])&&!empty($_POST["cost"])&&!empty($_POST["user"]))
{
   $user = $mysqli->escape_string($_POST['user']);
   $item = $mysqli->escape_string($_POST['item']);
    $cost = $mysqli->escape_string($_POST['cost']);
  $result = $mysqli->query("SELECT * FROM grouplist WHERE groupname='$gp' AND username='$user'   ");
   if ($result->num_rows == 0){
   echo "<script type=\"text/javascript\">";
   echo "alert (\"Invalid username\")";
    echo "</script>";
     }
     else
     {
       $res=$mysqli->query("INSERT INTO expenselist (groupname,username, item, cost) VALUES ('$gp','$user','$item','$cost')");
        $res= $mysqli->query("SELECT id FROM grouplist WHERE username='$user'");
       $result=$mysqli->query("SELECT noofuser FROM grouplist WHERE username='$user'");
       $idn = $res->fetch_assoc();               
       $id = $idn['id'] ;

      $count = $result->fetch_assoc();               
      $c = $count['noofuser'] ;

        $cost=(int)$cost/(int)$c;
       while((int)$c>0)
       {
        if($c==$id)
        {
         $c=(int)$c-1;
         if((int)$c<=0)
          break;
        }
        $result=$mysqli->query("SELECT username FROM grouplist WHERE id='$c' and groupname='$gp'");
         $usr=$result->fetch_assoc(); 
         $user1 = $usr['username'];
          $res=$mysqli->query("INSERT INTO final (groupname ,username1,username2 ,amount) VALUES ('$gp','$user','$user1','$cost')");
          $cost=$cost*(-1);
           $res=$mysqli->query("INSERT INTO final (groupname ,username1,username2 ,amount) VALUES ('$gp','$user1','$user','$cost')");
          $c--;
           $cost=$cost*(-1);
       }
     }
    }
?>