<?php
    include('connect.php');
    session_start();
    $user_check=$_SESSION['login_user'];
    $color = $_SESSION['color'];
    
    $result = $conn->query("SELECT username FROM user WHERE username='$user_check'");
     
    $row = mysqli_fetch_assoc($result);
     
    $login_session=$row['username'];
    
    if((!isset($login_session)) || (!isset($color))){
        header("Location: login.php");
    }
?>