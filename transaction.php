<?php
session_start();
$conn=mysqli_connect("localhost","root","","challenge_db"); 
$one=$_POST["title"]; 
$two=$_POST["amount"]; 
$three=$_POST['key']; 
$four=$_POST["desc"];

$query="INSERT INTO transactions (title,amount,category,description) VALUES ('$one', '$two','$three' ,'$four') ";

mysqli_query($conn,$query);
/*echo "Inserted to the database successfully";*/?>

<a href="new-transaction.html" style="border:1xp solid balck; border-radius:15px;text-decoration:none; justify-content:center">Go Back</a>
<?php
die();



?>