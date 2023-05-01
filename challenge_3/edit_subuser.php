<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge_db"); 
if(isset($_POST["confirm"]))
{
$email=$_POST["email"];
$id=$_SESSION["id"]; 
$q_check="SELECT * FROM subusers WHERE email='$email'"; 
$result=mysqli_query($conn,$q_check); 
$rows_num=mysqli_num_rows($result);
if($rows_num==1)
{
if(isset($_POST["n_email"]))
{
$new_email=$_POST["n_email"];
$query="UPDATE `subusers` SET email='$new_email' WHERE email  ='$email' ";
$run = mysqli_query($conn,$query);
}
if(isset($_POST["name"]))
{
$new_name=$_POST["name"];
$query="UPDATE `subusers` SET name='$new_name' WHERE email  ='$email' ";
$run = mysqli_query($conn,$query);
}
}
else
{
  echo "This subuser does not exit"; 
 
}
}
?>

<a href="edit_subuser.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center; padding:10px; ">Go Back</a>

<?php
die();
?>