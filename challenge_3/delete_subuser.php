<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge_db"); 
$one=$_POST["email"];
$id=$_SESSION["id"];

$query= "DELETE FROM subusers WHERE `subusers`.`email` = '$one'";
$run = mysqli_query($conn,$query); 
if($run==true)
{
  echo "this subuser does not exist";
}
?>

<a href="delete_subuser.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center">Go Back</a>

<?php
die();

?>