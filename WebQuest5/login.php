<?php

  session_start();

  if (isset($_POST['submit'])) {
    // include_once('./server_data.php');
    $host="";
    $username="";
    $password="" ;
    $dbname="";



    $conn = new mysqli($host, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
      }

      $player_username = $_POST['username'];
      $player_password = $_POST['password'];

      $player_password = md5($player_password);

      $db_query = 'select password from wq2019_players where username="'.$player_username.'"'  ;

      $result = $conn->query($db_query);

      if (!$result || mysqli_num_rows($result) == 0){
        echo '<script> alert(" Invalid Username") </script>';
        
      }

      if ( mysqli_num_rows($result) > 1){
        echo '<script> Something is fishy. Terminating Everything. Contact WebQuest Team. </script>';
       
      }
      while ( $row = mysqli_fetch_assoc($result)){
        $retrived_pass = $row['password'];
        if ($retrived_pass != $player_password){
          session_destroy();
          echo "<script>window.location = 'login.php?login=true';</script>";
        }
        $_SESSION['username'] = $player_username;
        echo "<script>window.location = 'round1/story.php';</script>";
      }
  }
?>

 <html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Dark Login Form</title>
  <link rel="stylesheet" href="css/login_2019.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <style>
    body{
      padding-top: 10% ;
      padding-bottom: 10%;
    }
  </style>
</head>
<body>

  <script>

      if (<?php 
      if($_GET['login'] ){
        echo 'true';
      } else {
        echo 'false';
      }
      
      ?>){
        alert('Incorrect Password');
      }

       if (<?php 
      if($_GET['reset'] ){
        echo 'true';
      } else {
        echo 'false';
      }
      
      ?>){
        alert('Password reset successful');
      }

    </script>
    <h1 style="font-size: 5em; text-align: center;">WebQuest 5.0</h1>
  <form method="post" action="" class="login">
    <p>
      <label for="login">Username</label>
      <input type="text" name="username" id="login" placeholder="Anonymous">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" placeholder="1234">
    </p>

    <p class="login-submit">
      <button type="submit" name="submit" class="login-button">Login</button>
    </p>

    <p class="forgot-password"><a href="forgot_password.php">Forgot your password?</a></p>
    <p class="forgot-password"><a href="registration.php">Register</a></p>
  </form>

 
</body>
</html>
