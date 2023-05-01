<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
   
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
    if(isset($_POST["signup"]))
    {
      $name=$_POST["name"] ;
      $email=$_POST["email"]; 
      $password=$_POST["password"];
      $repeatedpassword=$_POST["repeated-password"]; 
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($name) OR empty($email) OR empty($password) OR empty($repeatedpassword)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$repeatedpassword) {
            array_push($errors,"Password does not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $signup = "INSERT INTO users (name, email,password ) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$signup);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$name, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header("Location:index1.php");
            }else{
                die("Something went wrong");
            }
           }
    }
    ?>
    <div class="wrapper">
      <div class="title">SIGN UP</div>
      <form action="signup.php" method="post">
        <div class="field">
            <input type="text" name="name" required>
            <label>Name</label>
        </div>
        <div class="field">
          <input type="text" name="email" required>
          <label>Email Address</label>
        </div>
        <div class="field">
          <input type="password" name="password" required>
          <label>Password</label>
        </div>
        <div class="field">
            <input type="password" name="repeated-password" required>
            <label> Confirm Password</label>
        </div>
        <div class="field">
          <input type="submit" value="Sign UP" name="signup">
        </div>
        <div class="signup-link"> a member? <a href="login.php">login now</a></div>
      </form>
    </div>
  </body>
</html>
