<?php
session_start();
$mysqli = new mysqli('localhost', 'hemraj', 'root','login table');
$gp=$_SESSION['message1'];

     
     

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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" </script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ml-auto">
<div class="container-fluid">
  <a class="navbar-brand" href="homepage.html"><i class="fa fa-money" aria-hidden="true"></i>   S P L I T P A Y</a>
  </div>
   <li class="nav-item ">
        <a class="nav-link" href="logout.php"> LOGOUT </a>
     </li>
</nav>
<div class="jumbotron">
<?php
  $res=$mysqli->query("DELETE FROM final1 
WHERE groupname = '$gp' ");
  $result=$mysqli->query("INSERT INTO final1 (groupname,username1,username2 ,amount) SELECT groupname,username1,username2,
        SUM(amount) FROM final 
       WHERE groupname ='$gp'
       GROUP BY username1,username2");
     $result = $mysqli->query("SELECT username1,username2,amount FROM final1 WHERE groupname='$gp' AND amount>=0");
echo "<center><table>";
    echo"<th> Username1(Gets Paid)</th><th>Username2(Has To Pay)</th><th>Amount(In Rs)</th>";

    while($row = $result->fetch_assoc())
      {
    
 echo"<tr>";
      echo"<td>". $row['username1'] ."</td>";
      echo"<td>". $row['username2'] ."</td>";
        echo"<td>". $row['amount'] ."</td>";
       echo"</tr>"; 
      }
 echo "</center></table><br>";
?>
  </div>
</body>
</html>
