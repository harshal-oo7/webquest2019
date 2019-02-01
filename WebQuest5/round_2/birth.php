<?php

session_start();

$round_number = 5;
$next_question = 'congratulations';

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
      header('Location: '.$next_question.'.html');
      }
      else{
        echo '<script>alert("'. $player_answer. ' is wrong answer"); </script>';
      }
    }   
}
?>


<html lang="en">
 <head>

  <!-- 100 BC -->

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    <meta charset="utf-8"> 
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("images/rome2.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.bg{
  position: relative;
  
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

}


.caption {
  position: absolute;
  left: 0;
  top: 20%;
  width: 100%;
  text-align: center;
  color: #000;
}

.caption span.border {
  background-color: #111;
  color: #fff;
  padding: 18px;
  font-size: 20px;
  letter-spacing: 10px;
}
.cl{
	position: absolute;
  left: 0;
  top: 55%;
  width: 100%;
  text-align: center;
  color: #000;
  

}

.cl2{
  position: absolute;
  left: 0;
  top: 65%;
  width: 100%;
  text-align: center;
  color: #000;
}

.btt{
	position: absolute;
  left: 0;
  top: 60%;
  width: 100%;
  text-align: center;
  color: #000;
}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 1px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}

  

</style>
</head>
<body>



<div class="bg">
  
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

<div class="caption">
    <span class="border">"CINEAOCIEAOSYRBUOSRBNAOTERNATAFBUALBFBARIERIIEIRIRDLSNE<br><br> LDINIEIETFIEDTCNELYIENGYACFFINFCEIDEICSYSECSE"</span><br>
    
</div>
<div class="cl">
	<form action="" method="POST">
		<input name="answer" type="text">


</div>

<div class='btt'>
    <button name="submit" type="Submit" class="button button1">submit</button>
</div>
</form>

</div>


 


</body>
</html>