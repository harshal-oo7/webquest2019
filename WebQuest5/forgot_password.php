<?php
    
    if( isset( $_POST['submit'] )){
        include_once('server_data.php');

        $conn = new mysqli($host, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
      }

      $player_username = $_POST['username'];
      $mobile = $_POST['mobile'];

      $db_query = "select mobile_number from wq2019_players where username='". $player_username ."'";

      $result = $conn->query($db_query);

      if (!$result || mysqli_num_rows($result) == 0){
        echo '<script> alert( "Invalid Username" ); </script>'; 
      }
      if ( mysqli_num_rows($result) > 1){
        echo '<script> slert("Something is fishy. Terminating Everything. Contact WebQuest Team." );</script>';
       
      }

      while ( $row = mysqli_fetch_assoc($result)){
        $retrieved_mobile = $row['mobile_number'];
        if ( $retrieved_mobile == $mobile){
            header('Location: forgot_password_success.php?username='. $player_username);
        }
        else{
            echo '<script> alert("Mobile NUmber does not exists."); </script>';
        }
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

 
    <h1 style="font-size: 5em; text-align: center;">Forgot Password</h1>
  <form method="post" action="" class="login">
    <p>
      <label for="login">Username:</label>
      <input type="text" name="username" id="login" placeholder="">
    </p>
    <p>
      <label for="mobile">Mobile Number:</label>
      <input type="text" name="mobile" id="password" placeholder="">
    </p>
 

    <p class="login-submit">
      <button type="submit" name="submit" class="login-button">Login</button>
    </p>

 
  </form>

 
</body>
</html>
