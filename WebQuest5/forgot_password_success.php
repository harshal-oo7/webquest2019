<?php
    
    if( isset( $_POST['submit'] )){
        include_once('server_data.php');

        $conn = new mysqli($host, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
      }

      $player_username = $_GET['username'];
      $player_password_1 = $_POST['password'];
      $player_password_2 = $_POST['password_2'];

      $player_password_1 = md5($player_password_1);

      $db_query = "update  wq2019_players set password='".$player_password_1."' where username='".$player_username."'";

      $result = $conn->query($db_query);

      if($result){
          header('Location: login.php?reset=true');
      }
      else {
        echo '<script> alert("SOmething went wrong"); </script>';
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

 
    <h1 style="font-size: 5em; text-align: center;">Please enter new password</h1>
  <form method="post" action="" class="login">
    <p>
      <label for="login">Password:</label>
      <input type="password" name="password" id="login" placeholder="">
    </p>
    <p>
      <label for="login">Confirm Password:</label>
      <input type="password" name="password_2" id="login" placeholder="">
    </p>
 

    <p class="login-submit">
      <button type="submit" name="submit" class="login-button">Login</button>
    </p>

    
  </form>

 
</body>
</html>
