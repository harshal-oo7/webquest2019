<?php

session_start();

$round_number = 2;
$next_question = 'projections';

if (!isset($_SESSION['username'])){
  echo "<script>window.location = 'login.php';</script>";
}
require_once('../server_data.php');

$conn = new mysqli($host, $username, $password, $dbname);
if($conn->connect_error){
  die("Connection failed:".$conn->connect_error);
}

$validation_query = "select round2_questions_complete from wq2019_players where username='". $_SESSION['username']. "'";
$val_result = $conn->query($validation_query);

if (!$val_result || mysqli_num_rows($val_result) == 0 ||  mysqli_num_rows($val_result) > 1){
  echo '<script> alert("Something is fishy. Terminating Everything. Contact WebQuest Team. '.$_SESSION['username'].'") </script>';
} 
$questions_completed = 0;
while ( $row = mysqli_fetch_assoc($val_result)){
  $questions_completed = $row['round2_questions_complete'];
}
if ( $questions_completed < $round_number-1 ){
  echo '<script>alert(" You are not allowed here. '.$questions_completed.' - '. $round_number . ' "); </script>';
  echo '<script> window.location = "story.php"; </script>';
}

if (isset($_POST['submit'])){

    $db_query = 'select answer from wq2019_answers where question='.$round_number.' and round=2';

    $result = $conn->query($db_query);

    if (!$result || mysqli_num_rows($result) == 0 ||  mysqli_num_rows($result) > 1){
      echo '<script> Something is fishy. Terminating Everything. Contact WebQuest Team. because of answer </script>';
    }    

    $player_answer = $_POST['answer'];

    while ( $row = mysqli_fetch_assoc($result)){
      $correct_answer = $row['answer'];
      $player_answer = strtolower($player_answer);
      $player_answer = trim($player_answer);

      if($player_answer == $correct_answer){

        if ( $questions_completed < $round_number){
          $updation_query = "update wq2019_players set round2_questions_complete=".$round_number." where username='". $_SESSION['username']."'";
          $conn->query($updation_query);
      }
      header('Location: '.$next_question.'.php');
      }
      else{
        echo '<script>alert("'. $player_answer. ' is wrong answer"); </script>';
      }
    }   
}
?>

<html>
<head>
	<title>Question 2</title>
	<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

      <link rel="shortcut icon" href="images/fav_line.jpeg">


<style type="">
	
	body{

 background: url(images/linebg.png) no-repeat center center fixed; 
  -webkit-background-size:  100% 100%;
  -moz-background-size:  100% 100%;
  -o-background-size:  100% 100%;
  background-size:  100% 100%;
  
	}
.b{
	margin-top: 10%;
font-size:18px;
text-align: center;
}
.logoutLblPos{
	margin-top: 2%;
   position:fixed;
   right:10px;
   top:5px;
}
</style>
</head>
<body>
	 
<nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <button type="button" class="btn btn-info" target="_blank" onclick="window.open('leader_board.php','_blank')">Leaderboard</button>
            <button type="button" class="btn btn-light"><div id="demo"></div></button>

            <script>
                <?php
                    $time_query = "select UNIX_TIMESTAMP(round2_start_time) from wq2019_players where username='" .$_SESSION['username']. "'";

                    $result = $conn->query($time_query);

                    // if (!$result || mysqli_num_rows($result) == 0 ||  mysqli_num_rows($result) > 1){
                    //     echo ' Something is fishy. Terminating Everything. Contact WebQuest Team. because of answer </script>';
                        
                    // } 
                    $ut = 0;
                    while ( $row = mysqli_fetch_assoc($result)){
                        $ut = $row['UNIX_TIMESTAMP(round2_start_time)'];
                    }
                    echo "var unix_time = ".$ut. ";";

                ?>

                
                function timeConverter(UNIX_timestamp){
                        var a = new Date(UNIX_timestamp * 1000);
                        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        var year = a.getFullYear();
                        var month = months[a.getMonth()];
                        var date = a.getDate();
                        var hour = a.getHours() + 3;
                        var min = a.getMinutes();
                        var sec = a.getSeconds();
                        var time =  month + ' '+ date + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
                        return time;
                }
                
                

                var countDownDate = new Date(timeConverter(unix_time)).getTime();


                var x = setInterval(function() {

                    var now = new Date().getTime();

                    var distance = countDownDate - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById("demo").innerHTML = hours + " : " +
                        minutes + " : " + seconds;

                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                        window.location = 'logout.php';

                    }
                }, 1000);
            </script>


            <button type="button" class="btn btn-danger" onclick="window.location.href='./logout.php'">LOGOUT</button>
        </div>

    </nav>

	<div class="container b">
		<div class="row">
			<div class="col-md-2">	</div>
			<div class="col-md-8">	
			<code style="background-color: lightgray; color: black;">
									
					&nbsp;	&nbsp;	&nbsp;A computer on Its hard dIsk has twelve folder; <br>	
					&nbsp;	&nbsp;	&nbsp;In every folder there are thIrty fIles, <br>
					&nbsp;	&nbsp;	&nbsp;and In every fIles two movIes, one whIte and one black. <br><br>
				
			</code>
			</div>
			<div class="col-md-2">	</div>
				</div>
				<div class="row">
			<div class="col-md-2">	</div>
			<div class="col-md-8">	
				<form action="" method="POST" style="text-align: center;">
			 		 <div class="form-group">
			   		 
			   		 <input name="answer" style="max-width: 30%" type="text" >
			 		 </div>
			 			<!-- Difference is the answer! -->
						<button name="submit" type="Submit" class="btn btn-primary active">Submit</button>
					</form>
				</div>
			<div class="col-md-2">	</div>
		</div>
	</div>
</body>
</html>