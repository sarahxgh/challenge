<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style3.css">
    <title>Delete Expense</title>
</head>
<body>
<div class="main-content">
                
            <?php 
            $conn=mysqli_connect("localhost","root","","challenge_db");
            session_start(); 
            $query="SELECT title, amount,description FROM transactions";
            $result=mysqli_query($conn,$query); 

                while($row=mysqli_fetch_row($result))
                {
                    ?>
        <details>
            <summary>
                <?php
                echo $row[0];
                
                ?>
            </summary>
               <?php 
               echo "Amount :".$row[1];
                ?>
                <br><br>
                
                <?php
                echo "Description: ".$row[2];
                ?>
        </details><br><br>
                 <?php
                 }
                   ?>
            

       </div>
    </div>