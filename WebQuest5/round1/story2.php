<?php
    session_start();
    // echo  "<script>alert('Something ". $_SESSION['username']  ."')</script>";

    if (!isset($_SESSION['username'])){
        echo "<script>window.location = 'login.php';</script>";
    }

    if (isset($_POST["submit"])){
        include_once('../server_data.php');

        $conn = new mysqli($host, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
        echo "<script>alert('Connection failed with the database. Shame on us.');</script>";
      }
      $player_username = $_SESSION['username'];
    $condition_query = "select round1_start_time from wq2019_players where username='". $player_username ."'";
    $condition_result = $conn->query($condition_query);

    if (!$condition_result || mysqli_num_rows($condition_result) == 0 ||  mysqli_num_rows($condition_result) > 1){
		echo '<script> alert("Something is fishy. Terminating Everything. Contact WebQuest Team.") </script>';
        
      }    
      $row  = mysqli_fetch_assoc($condition_result);
      if( $row['round1_start_time'] ){
        header('Location: alpha.php');
      }
      else{
      $ut = time();
      
      $db_query = "update wq2019_players set round1_start_time=FROM_UNIXTIME(". $ut .") where username='". $player_username ."'" ;

      $result = $conn->query($db_query);

      if ( $result ){
        header('Location: alpha.php');
      }
      else{
        echo "<script>alert('Something Went Wrong, shame on us.')</script>";
      }
    }
    }

?>

<html lang="en">
<head>
    <title>Story</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/favicon.jpeg">
    <style type="text/css">
        .center-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        .vertically-center {
            margin-top: auto;
            margin-bottom: auto;
        }

        .letter {
            margin-top: 10%;
            padding: 5%;
            width: 70%;
            background: white;
        }

        body {
            background-image: url('images/bg.jpg');

        }

        * {
            /*            border: 1px solid black;*/
        }
    </style>
</head>

<body>
    <div class="container center-box">
        <div class="container letter">
            <div class="row">
            <h3>Location: SharkSafe Securties</h3>
	<h3>Date: 3rd March 2014.</h3>

	<p>Arthur Brownrigg</p>

	<br>

	<p>"Arthur, come here fast, boss wants you in his office ASAP." just went into Arthur Brownrigg's ears. Arthur brownrigg is the best hacker known to everyone there. "Arthur, check the servers, someone did a DDOS attack on us" said the boss, "Nobody here is understanding anythng, all the mitigations services are down.". It was one magnificent attack, 10's of terrabyte of data packets were thrown at the servers. It was too a heavy attack, arthur had no choice but a complete shutdown. 
	</p>
	<br>

	<p> All went home but Arthur stayed, looking for a slightest clue of the hacker that had done the attack. </p><br>
  <p>Deep in the logs, arthur came upon a readme.txt. Arthur opened the readme, <code>cat readme.txt</code></p><br>
  <p>Nothing was there except "Hello Arthur Brownrigg!"</p> <br>
</div>

            <div class="row">
                <form method="POST" action="">
                    <button type="submit" name="submit" class="btn btn-primary">Let's Start!</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>