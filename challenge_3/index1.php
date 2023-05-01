
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index1.css">
    <title>Expance tracker</title>
</head>
<body>
    <div class="navbar">
        <div class="elements">
        <ul>
            <li><a href=""><span>My profile</span></a></li>
            <li><a href="logout.php"><span>Log Out</span></a></li>
        </ul>
        </div>
        <div class="logo">

        </div>
    </div>
    <div class="content">
       
       <div class="side-bar-menu">
           <details>
              <summary>Expense</summary>
              <li><a href="add_expense.php"><span>New Expense</span></a></li>
              <li><a href="delete_expense.php"><span>Remove an expense</span></a></li>
              <li><a href=""><span>Edit an Expense</span></a></li>
           </details>
           <details>
              <summary>Revenue</summary>
              <details>
              <summary>
                      Add revenue
             </summary>
                  <form method="post" action="index1.php">
                  <label for="amount2">Amount:</label><br>
                  <input id="amount2" name="key1" type="number" required><br><br>
                  <input type="submit" value="confirm" name="revenue1"><br>
                  </form>
                  <?php 
                       session_start();
                       require_once("database.php");
                       $usr=$_SESSION["id"]; 
                       if(isset($_POST["revenu1"]))
                         {  
                           $amount=$_POST["key1"];
                           $check="SELECT balance FROM revenues WHERE user_ID='$usr'";
                           $result=mysqli_query($conn,$check);
                           $_row_num=mysqli_num_rows($result);
                           if($_row_num==0)
                           {
                           $query="INSERT INTO revenues (user_ID, balance) VALUES ('$usr','$amount')";
                            mysqli_query($conn,$query);
                           }
                           else
                           {
                            $query="UPDATE revenues SET balance='$amount' WHERE user_ID='$usr'";
                            mysqli_query($conn,$query);
                           }
                        }
                         ?>
              </details>
              <details>
              <summary>
                      Edit revenue
             </summary>
                  <form action="index1.php" method="post">
                  <label for="amount1">Amount:</label><br>
                  <input id="amount1" name="key2" type="number" required><br><br>
                  <input type="submit" value="confirm" name="revenue2"><br>
                  </form>
                  <?php 
                    if(isset($_POST["revenue2"]))
                    {  
                       $amount=$_POST["key2"];
                       $query="UPDATE revenues SET balance='$amount' WHERE user_ID='$usr'";
                       mysqli_query($conn,$query);
                    }
                    ?>
              </details>
              <details>
              <summary>
                      Remove revenue
             </summary>
                  <form action="index1.php" method="post">
                  <input type="submit" value="confirm" name="revenue3"><br>
                  </form>
                  <?php
                  if(isset($_POST["revenue3"]))
                   {  
                     $query="UPDATE revenues SET balance=0  WHERE user_ID='$usr'";
                     mysqli_query($conn,$query);
                   }
                ?>
              </details>
           </details>

           <details>
               <summary>Category</summary>
               <details>
                  <summary>
                      Add Category
                  </summary>
                  <form action="index1.php" method="post">
                  <label for="key1">Category name:</label><br>
                  <input id="key1" name="key1" type="text" required><br><br>
                  <input type="submit" value="confirm" name="category1"><br>
                  </form>
                  <?php
                  if(isset($_POST["category1"]))
                    {   $cat=$_POST["key1"];
                        $check="SELECT Category FROM category WHERE Category='$cat'";
                        $result=mysqli_query($conn,$check);
                        $_row_num=mysqli_num_rows($result);
                        if($_row_num==0)
                        {
                         $query="INSERT INTO category (user_ID, Category) VALUES ('$usr','$cat')";
                         mysqli_query($conn,$query);
                        }
                        else
                         {
                           echo '<p style="color:black;">This category already exists</p>';
                         }
                    }
                    ?>
                </details>
                <details>
                  <summary>
                      Edit Category
                  </summary>
                  <form action="index1.php" method="post">
                  <label for="key22">Category name:</label><br>
                  <input id="key22" name="key_2" type="text" required><br><br>
                  <label for="key2">Category new name:</label><br>
                  <input id="key2" name="key2" type="text" required><br><br>
                  <input type="submit" value="confirm" name="category2"><br>
                  </form>
                  <?php
                  if(isset($_POST["category2"]))
                    {  
                    $cat=$_POST["key_2"];
                    $catt=$_POST["key2"];
                    $check="SELECT * FROM category WHERE Category='$catt'";
                    $result=mysqli_query($conn,$check);
                    $_row_num=mysqli_num_rows($result);
                    if($_row_num==0)
                    {
                     mysqli_query($conn, "SET foreign_key_checks = 0");
                     $query="UPDATE category SET Category='$catt' WHERE Category='$cat'";
                      mysqli_query($conn,$query);
                      $query="UPDATE expenses SET category='$catt' WHERE category='$cat'";
                      mysqli_query($conn,$query);
                      mysqli_query($conn, "SET foreign_key_checks = 1");
                    }
                    else
                     {
                      echo "This category already exists";
                     }
                    }
                    ?>
                </details>
                <details>
                  <summary>
                      Delete Category
                  </summary>
                  <form action="index1.php" method="post">
                  <label for="key3">Category name:</label><br>
                  <input id="key3" name="key3" type="text"required><br><br>
                  <input type="submit" value="confirm" name="category3"><br>
                  </form>
                  <?php
                  if(isset($_POST["category3"]))
                  { 
                    $cat=$_POST["key3"];
                    $check="SELECT Category FROM category WHERE Category='$cat'";
                    $result=mysqli_query($conn,$check);
                    $_row_num=mysqli_num_rows($result);
                    if($_row_num==1)
                    {
                    mysqli_query($conn, "SET foreign_key_checks = 0");
                    $query="DELETE FROM category WHERE user_ID='$usr' AND Category='$cat'";
                    mysqli_query($conn,$query);
                    $query="DELETE FROM expenses WHERE user_ID='$usr' AND category='$cat'";
                    mysqli_query($conn,$query);
                    mysqli_query($conn, "SET foreign_key_checks = 1");
                    }
                    else
                     {
                      echo "this category does not exist";
                     }
                    }
                    ?>
                  
                </details>
           </details>
           <details>
            <summary>Balance</summary>
              <details>
                  <summary>
                      Add Balance
                  </summary>
                  <form action="index1.php" method="post">
                  <label for="user">User email:</label><br>
                  <input id="user" name="usr-eml" type="email" required><br><br>
                  <label for="amount"> Amount :</label><br>
                  <input id="amount" name="amount" type="number"required><br><br>
                  <input type="submit" value="confirm" name="balance1"><br>
                  </form>
                  <?php 
                  if(isset($_POST["balance1"]))
                  {
                    $email=$_POST["usr-eml"];
                    $amount=$_POST["amount"]; 
                    $query="SELECT user_ID FROM users WHERE email='$email'";
                    $result=mysqli_query($conn,$query); 
                    $row_num=mysqli_num_rows($result); 
                    $fetch=mysqli_fetch_row($result);
                    $query_2="SELECT * FROM revenues WHERE user_ID='$fetch[0]'";
                    $result_2=mysqli_query($conn,$query_2); //to know if this user has already a balance value
                    $row_num2=mysqli_num_rows($result_2); 
                    if($row_num==1 && $amount>=0)
                    {
                        if($row_num2==0)
                        {
                        $query="INSERT INTO revenues (user_ID, balance) VALUES ('$usr','$amount')";
                        mysqli_query($conn,$query);
                        }
                        else
                        {
                          echo "Thi user has already a balance value, please try to edit it instead of adding.";
                        }
                    }
                    else
                    {
                      echo "This user does not exist"; 
                    }
                  }
                  ?>
              </details>
              <details>
                  <summary>
                      Edit Balance
                  </summary>
                  <form action="index1.php" method="post">
                  <label for="user">User email:</label><br>
                  <input id="user" name="usr-email" type="email" required><br><br>
                  <label for="amount"> Amount :</label><br>
                  <input id="amount" name="amount" type="number" required><br><br>
                  <input type="submit" value="confirm" name="balance2"><br>
                  </form>
                  <?php 
                  if(isset($_POST["balance2"]))
                  {
                    $email=$_POST["usr-email"];
                    $amount=$_POST["amount"]; 
                    $query="SELECT * FROM users WHERE email='$email'";
                    $result=mysqli_query($conn,$query); 
                    $row_num=mysqli_num_rows($result); 
                    if($row_num==1 && $amount>=0)
                    {
                        $query="UPDATE revenues SET balance='$amount' WHERE user_ID='$usr'";
                        mysqli_query($conn,$query);
                    }
                    else
                    {
                      echo "This user does not exist"; 
                    }
                  }
                  ?>
              </details>
              <details>
                  <summary>
                      Delete balance
                  </summary>
                  <form action="index1.php" method="post">
                    <label for="user">User email:</label><br>
                    <input id="user" name="user-email" type="email" required><br><br>
                    <input type="submit" value="confirm" name="balance3"><br>
                  </form>
                  <?php 
                  if(isset($_POST["balance3"]))
                  {
                    $email=$_POST["user-email"];
                    $query="SELECT * FROM users WHERE email='$email'";
                    $result=mysqli_query($conn,$query); 
                    $row_num=mysqli_num_rows($result); 
                    if($row_num==1)
                    {
                        $query="UPDATE revenues SET balance=0 WHERE user_ID='$usr'";
                        mysqli_query($conn,$query);
                    }
                    else
                    {
                      echo "This user does not exist"; 
                    }
                  }
                  ?>
              </details>
           </details>
           <details>
            <summary>Sub-Users</summary>
            <li><a href="add_subuser.html" ><span>Add Sub-Users</span></a></li>
            <li><a href="edit_subuser.html"><span>Edit Sub-Users</span></a></li>
            <li><a href="delete_subuser.html"><span>Delete Sub-Users</span></a></li>
           </details>
       </div>
       <div class="main-content">
                
       <div class="balance">
                <details>
                    <summary>
                        Your Balance
                    </summary>
                    <?php 
                    $query="SELECT balance FROM revenues WHERE user_ID='$usr'"; 
                    $result=mysqli_query($conn,$query);
                    $result_1=mysqli_fetch_row($result);
                    ?>
                    <?php
                    echo $result_1[0];
                    ?>
                </details>
                 
        </div>
        <div class="contnt">
            <?php 
            require_once "database.php"; 
            $query="SELECT title, date,amount,description FROM expenses";
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
               echo "Date :".$row[1];
                ?>
                <br><br>
                <?php 
               echo "Cost :".$row[2];
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
    </div>
    
    <footer>

    </footer>
</body>
</html>