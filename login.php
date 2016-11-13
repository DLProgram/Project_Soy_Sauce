<?php
    include("connect.php");
    session_start();
    $error = '';
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(empty($username) && empty($password)){
            $error="Please enter a username and a password!!";
        }elseif (empty($username)) {
            $error = "Please enter a username!!";
        }elseif (empty($password)) {
            $error = "Please enter a password!!";
        }else{
            $result = $conn->query("SELECT * FROM user WHERE username='$username' AND password='$password'");
            if(!$result){
                die(mysqli_error($conn));
            }
            $count = mysqli_num_rows($result);
            $row=mysqli_fetch_assoc($result);
            if($count==1)
            {
                $_SESSION['login_user']=$username;
                $_SESSION['color']=$row['color'];
                header("location: index.php");
            }
            else
            {
                $error="Your username or password is invalid!!";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php 
        if(!empty($error)){
            echo"
            <div class='row'>
                <div class='alert callout' style='margin-top: 50px;' data-closable>
                    <h5>{$error}<h5>
                    <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            </div>";
        }
    ?>
    
    <div class="row" style="margin-top: 50px;">
      <div class="medium-6 medium-centered large-4 large-centered columns">
        <form method="post">
          <div class="row column log-in-form" style="border: 1px solid #cacaca;padding: 1rem;border-radius: 3px;">
            <h4 class="text-center">Log in </h4>
            <label>Username
              <input type="text" placeholder="Username" name="username">
            </label>
            <label>Password
              <input type="password" placeholder="Password" name="password">
            </label>
            
            <input type="submit" class="button expanded" name="submit" value="Login"></input>
          </div>
        </form>
      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>