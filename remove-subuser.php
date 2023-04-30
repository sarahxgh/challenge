
<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge3"); 
$one=$_POST["email"];
$id=$_SESSION["user_id"];
$query= "DELETE FROM subusers WHERE `subusers`.`email` = '$one'";
$run = mysqli_query($conn,$query);



?>
<a href="remove-subuser.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center">Go Back</a>

         
<?php
die();



?>