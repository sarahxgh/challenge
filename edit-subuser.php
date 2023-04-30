<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge3"); 
$one=$_POST["email"];
$id=$_SESSION["user_id"]; 
$two=$_POST["name"];
$query="UPDATE `subusers` SET name='$two' WHERE email  ='$one' ";
$run = mysqli_query($conn,$query);
/*echo "Inserted to the database successfully";*/?>
<a href="edit-subuser.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center">Go Back</a>
<?php
die();



?>