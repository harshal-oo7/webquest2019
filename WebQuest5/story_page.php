<?php
    session_start();
    // echo  "<script>alert('Something ". $_SESSION['username']  ."')</script>";

    if (!isset($_SESSION['username'])){
        echo "<script>window.location = 'login.php';</script>";
    }

    if (isset($_POST["submit"])){
        include_once('./server_data.php');

        $conn = new mysqli($host, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
        echo "<script>alert('Connection failed with the database. Shame on us.');</script>";
      }
      $player_username = $_SESSION['username'];
    $condition_query = "select round1_start_time from wq2019_players where username='". $player_username ."'";
    $condition_result = $conn->query($condition_query);

    if (!$condition_result || mysqli_num_rows($condition_result) == 0 ||  mysqli_num_rows($condition_result) > 1){
        echo '<script> Something is fishy. Terminating Everything. Contact WebQuest Team. </script>';
        
      }    
      $row  = mysqli_fetch_assoc($condition_result);
      if( $row['round1_start_time'] ){
        header('Location: round1/one/china.php');
      }
      else{
      $ut = time();
      
      $db_query = "update wq2019_players set round1_start_time=FROM_UNIXTIME(". $ut .") where username='". $player_username ."'" ;

      $result = $conn->query($db_query);

      if ( $result ){
        header('Location: round1/one/china.php');
      }
      else{
        echo "<script>alert('Something Went Wrong, shame on us.')</script>";
      }
    }
    }

?>

<html>
    <head>
        <title>Adrak</title>
    </head>
    <body>
    And they lived happily ever after.
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            <button type="submit" name="submit">Okay</button>
        </form>
    </body>

</html>