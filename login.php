<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
   <!----<title>Login Form Design | CodeLab</title>---->
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
    if(isset($_POST["login"]))
    {
      $email=$_POST["email"]; 
      $password=$_POST["password"]; 
      require_once "database.php";
      $login="SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $login);
      $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if ($user) {
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user"] = "yes";
            header("Location: index.php");
            die();
        }else{
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
    }
    ?>

    <div class="wrapper">
      <div class="title">LOGIN</div>
      <form action="login.php" method="post">
        <div class="field">
          <input type="text" name="email" required>
          <label>Email Address</label>
        </div>
        <div class="field">
          <input type="password" name="password" required>
          <label>Password</label>
        </div>
        <div class="field">
          <input type="submit" value="Login" name="login">
        </div>
        <div class="signup-link">Not a member? <a href="signup.php">Signup now</a></div>
      </form>
    </div>
  </body>
</html>
