
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
        </ul>
        </div>
        <div class="logo">

        </div>
    </div>
    <div class="content">
       <div class="side-bar-menu">
           <ul>
              <li><a href="new-transaction.html"><span>New Expense</span></a></li>
              <li><a href="delete-transaction.php"><span>Remove an expense</span></a></li>
              <!--oumaima here put an php code to check which user is connected, dont show all of these options to subusers-->
              <li><a href=""><span>Edit an Expense</span></a></li>
              <li><a href=""><span>Add Revenue</span></a></li>
              <li><a href=""><span>Remove Revenue</span></a></li>
              <li><a><span>Edit Revenue</span></a></li>
              <li><a href=""><span>Add category</span></a></li>
              <li><a href=""><span>Remove Category</span></a></li>
              <li><a href=""><span>Edit Category</span></a></li>
            </ul>
       </div>
       <div class="main-content">
                
            <?php 
            session_start();
            $conn=mysqli_connect("localhost","root","","challenge_db"); 
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