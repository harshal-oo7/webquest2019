<?php

session_start();

$round_number = 4;
$next_question = 'birth';

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
	<title>Question - 6</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			opacity: 0.8;
 			background: url(images/bg.jpg) no-repeat center center fixed; 
			-webkit-background-size:  100% 100%;
			-moz-background-size:  100% 100%;
			-o-background-size:  100% 100%;
			background-size:  100% 100%;
  
	}
	</style>
</head>
<body>
	<div class="container">

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
    
		<div class="jumbotron">
				<p>HongKong, Valentines day 2016.<br> 
					<br>
					   Dear folks it gives us an immense pleasure to announce that the call for proposals is open for the 
				following topics as listed below and It will be held right after 50 expressions - south by southwest festival.
				 	You need to submit your papers before mid march 2016 in order to get them reviewed by our peers. 
				The reviews and the result of acceptance will be relesed on October 2017. The event is scheduled to be held in Austin,
				Texas, United States in November 2017. <br><br>
				<b>FEE:</b><br> 
					<br>For people with US and GB citizenships - 50euros   
					<br>Others				       - 50$
				<br>
				<br><b>Topics-</b>  
				<br> 
				<br>1. Visual data processing and recognition
				<br>2. facial expressions recognition 
				<br>3. voice recognition 
				<br>4. social skills 
				<br>5. natural language subsystems 
				<br>6. chatbots 
				<br>7. cloud computing
				<br>8. blockchain technology 
				<br>9. healthcare and bioinformatics
				<br>10. human therapy 
				<br>11. literacy 
				<br><br>
				Regards,<br>
				<blockquote>
					Jaco Cillers <br>	
					<footer>
						UNDP Asia Pacific Chief of Policy and Program. <br>
					</footer>
				</blockquote>


				<form action="" style="text-align: center;" method="post">
			 		<div class="form-group">
			   		 
			   		<input name="answer" style="max-width: 30%" type="text">
			 		</div>
					<button name="submit" type="Submit" class="btn btn-primary active">Submit</button>
				</form>


			</p>
		</div>
	</div>
</body>
</html>