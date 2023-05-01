<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css" type="text/css">
    <title>New Expense</title>
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
           $five=$_POST["title"]; 
           $two=$_POST["amount"]; 
           $one=$_POST["key"]; 
           $four=$_POST["desc"];
           $usr=$_SESSION["id"];
           $query="SELECT balance FROM revenues WHERE user_ID='$usr'";
           $result=mysqli_query($conn,$query); 
           $num=mysqli_fetch_row($result); 
           $nbalance=$num[0]; 
           $nbalance-=$two; 
           if($nbalance>=0)
           {
           $query="INSERT INTO expenses (user_ID,category,amount,description,date,title) VALUES ('$usr','$one', '$two' ,'$four',NOW(),'$five')";
           mysqli_query($conn,$query);
           $query="UPDATE revenues SET balance=$nbalance where user_ID='$usr'";
           mysqli_query($conn,$query);
           }
           else
           {
              echo "Your balance is not enough to add this expense";
           }
           
        }
      ?>
      
    <div class="container">
        <form action="add_expense.php" method="post">
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
            <label for="title">Enter Title: </label><br>
            <input type="text" id="title" name="title" placeholder="Title" required><br><br><br>
            <label for="amount">Enter amount :</label><br>
            <input type="text" id="amount" name="amount" placeholder="Amount" required><br><br><br>
            <label for="desc">Enter description : (optional)</label><br>
            <input type="text" id="desc" name="desc" placeholder="Description" required> <br><br><br>
            <input type="submit" value="Enter" name="enter">
        </form>
    </div>
    <a href="index1.php" id="A">Go Back</a>
</body>
</html>
