<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Expance tracker</title>
</head>
<body>
    <div class="navbar">
        <div class="elements">
        <ul>
            <li><a href=""><span>My profile</span></a></li>
            <li><a href="logout.php"><span>Logout</span></a></li>
            
        </ul>
        </div>
        <div class="logo">

        </div>
    </div>
    <div class="content">
       <div class="side-bar-menu">
           <ul>
           <details>
                    <summary>send funds</summary>
                         <li><a href="new-transaction.html"><span>send </span></a></li>
                </details>
            <?php 
            if($_SESSION["isuser"]==="yes")
            {
            ?>
                <details>
                    <summary>Expenses</summary>
                         <li><a href="new-transaction.html"><span>New Expense</span></a></li>
                        <li><a href="delete-transaction.php"><span>Remove an expense</span></a></li>
                         <!--oumaima here put an php code to check which user is connected, dont show all of these options to subusers-->
                         <li><a href=""><span>Edit an Expense</span></a></li>
                </details>
                <details>
                    <summary>Revenues</summary>
                    <li><a href=""><span>Add Revenue</span></a></li>
                     <li><a href=""><span>Remove Revenue</span></a></li>
                    <li><a><span>Edit Revenue</span></a></li>
                </details>
                <details>
                    <summary>Categories</summary>
                    <li><a href="add-category.html"><span>Add category</span></a></li>
                    <li><a href="remove-category.html"><span>Remove Category</span></a></li>
                    <li><a href="edit-category.html"><span>Edit Category</span></a></li>
                </details>
                <details>
                    <summary>Sub-Users</summary>
                    <li><a href="add-subuser.html"><span>Add Sub-User</span></a></li>
                    <li><a href="remove-subuser.html"><span>Remove Sub-User</span></a></li>
                    <li><a href="edit-subuser.html"><span>Edit Sub-User</span></a></li>
                </details>
               <?php
            }
            ?> 
            </ul>
       </div>
       <div class="main-content">
                
            <?php 
            $conn=mysqli_connect("localhost","root","","challenge3"); 
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
    
    <footer>

    </footer>
</body>
</html>