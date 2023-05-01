<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css" type="text/css">
    <title>Edit Expense</title>
</head>

<body>


      <?php
            session_start();
            require_once ("database.php");
            if (!$conn) {
                 die("Something went wrong.");
                       }
           if(isset($_POST["enter"]))
           { 
           $date=$_POST["date"];
           $category=$_POST["key"]; 
           $usr=$_SESSION["id"];
           $query="SELECT * FROM expenses WHERE date='$date' AND user_ID='$usr' AND category='$category'"; 
           $result=mysqli_query($conn,$query);
           $num=mysqli_num_rows($result);
           if($num==1)
           {
           $query="DELETE FROM expenses WHERE date='$date' AND category='$category' AND user_ID='$usr'";
           mysqli_query($conn,$query);
           }
           else
           {
              echo "Sorry, we cant drop this expense. PLease try again and reneter the information according to what is shown in the homepage.";
           }
           
        }
      ?>
      
    <div class="container">
        <h1>edit expense<h1><br>
        <form action="edit_expense.php" method="post">
            <label for="category">Select category:</label><br>
            <select id="category" name="key" required>;
            
                <?php 
                  $query="SELECT Category FROM category "; 
                  $result=mysqli_query($conn,$query);
                  while($row=mysqli_fetch_row($result))
                  {
                ?><option value="<?php echo $row[0] ?>" ><?php echo $row[0] ?></option>
                <?php
                  }
                ?>
            </select><br><br><br>
            <label for="date">Enter Date: </label><br>
            <input type="text" id="date" name="date" placeholder="Copy the date shown in the home page." required><br><br>
            <input type="submit" value="Enter" name="enter">
        </form>
    </div>
    <a href="index1.php" id="A">Go Back</a>
</body>
</html>
