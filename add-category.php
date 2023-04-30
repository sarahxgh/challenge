
<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge3"); 
$one=$_POST["name"];
$id=$_SESSION["user_id"];
$query= "INSERT INTO `category`(`user_ID`, `Category`) VALUES ('$id' , '$one')";
$run = mysqli_query($conn,$query);



?>
<a href="add-category.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center">Go Back</a>

         
<?php
die();



?>