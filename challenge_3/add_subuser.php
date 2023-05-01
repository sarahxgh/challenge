<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge_db"); 
$one=$_POST["email"];
$id=$_SESSION["id"]; 
$two=$_POST["name"];
$three=$_POST["password"];
$query="SELECT * FROM users WHERE email='$one'"; 
$result=mysqli_query($conn,$query); 
$num=mysqli_num_rows($result);
if($num==1)
{
$query="INSERT INTO subusers (user_id , name , email , password ) VALUES (  '$id', '$two', '$one' , '$three') ";
$run = mysqli_query($conn,$query);
}
else
  {
    $query="INSERT INTO users ( name , email , password ) VALUES ( '$two', '$one' , '$three') ";
    $run = mysqli_query($conn,$query);
    $query="INSERT INTO subusers (user_id , name , email , password ) VALUES (  '$id', '$two', '$one' , '$three') ";
    $run = mysqli_query($conn,$query);
  }
/*echo "Inserted to the database successfully";*/?>
<a href="add_subuser.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center">Go Back</a>
<?php
die();



?>