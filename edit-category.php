<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge3"); 
$one=$_POST["name"];
$id=$_SESSION["user_id"]; 
$query="SELECT * FROM `category` WHERE id  ='$two' ";
$run = mysqli_query($conn,$query);
$query="UPDATE `category` SET Category='$one' WHERE id  ='$two' ";
$run = mysqli_query($conn,$query);
/*echo "Inserted to the database successfully";*/?>
<a href="edit-subuser.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center">Go Back</a>
<?php
die();



?>