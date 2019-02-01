
<?php 
session_start();

$round_number = 4;
$next_question = 'stack';

if (!isset($_SESSION['username'])){
  echo "<script>window.location = 'login.php';</script>";
}
require_once('../server_data.php');

$conn = new mysqli($host, $username, $password, $dbname);
if($conn->connect_error){
  die("Connection failed:".$conn->connect_error);
}

$validation_query = "select round1_questions_complete from wq2019_players where username='". $_SESSION['username']. "'";
$val_result = $conn->query($validation_query);

if (!$val_result || mysqli_num_rows($val_result) == 0 ||  mysqli_num_rows($val_result) > 1){
  echo '<script> Something is fishy. Terminating Everything. Contact WebQuest Team. </script>';
  
} 
$questions_completed = 0;
while ( $row = mysqli_fetch_assoc($val_result)){
  $questions_completed = $row['round1_questions_complete'];
}
if ( $questions_completed < $round_number-1 ){
  echo '<script>alert(" You are not allowed here."); </script>';
  echo '<script> window.location = "story.php"; </script>';
}

if (isset($_POST['submit'])){

	$db_query = 'select answer from wq2019_answers where question='.$round_number.' and round=1';
    $result = $conn->query($db_query);

    if (!$result || mysqli_num_rows($result) == 0 ||  mysqli_num_rows($result) > 1){
		echo '<script> alert("Something is fishy. Terminating Everything. Contact WebQuest Team.") </script>';
      
    }    

    $player_answer = $_POST['answer'];

    while ( $row = mysqli_fetch_assoc($result)){
      $correct_answer = $row['answer'];
      $player_answer = strtolower($player_answer);
	  $player_answer = trim($player_answer);
	  $player_answer = str_replace(" ", "", $player_answer);
	  $player_answer = str_replace("th", "", $player_answer);

      if($player_answer == $correct_answer){

		if ( $questions_completed < $round_number){
            $updation_query = "update wq2019_players set round1_questions_complete=".$round_number." where username='". $_SESSION['username']."'";
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
	<title>Question 4</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

      <link rel="shortcut icon" href="images/favicon.jpeg">


<style type="">
	
	body{
margin-top: 2%;
 background: url(images/poembg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	}
</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2">	</div>
			<div class="col-md-8">	
			<code style="background-color: lightgray; color: black;">
				
				function night() { <br><br>
					
					&nbsp;	&nbsp;	&nbsp;Diam vulputate ut pharetra sit amet aliquam. A pellentesque sit amet <br>	
					&nbsp;	&nbsp;	&nbsp;porttitor eget dolor morbi non. Aliquam faucibus purus in massa <br>
					&nbsp;	&nbsp;	&nbsp;tempor nec. Enim praesent elementum facilisis leo. Tellus rutrum <br><br>
					&nbsp;	&nbsp;	&nbsp;tellus pellentesque eu tincidunt tortor aliquam nulla facilisi. <br>
					&nbsp;	&nbsp;	&nbsp;In cursus turpis massa tincidunt dui ut ornare lectus. <br><br>

					&nbsp;	&nbsp;	&nbsp;The satire created a stir and found general favor with the reviewers.  <br>	
						&nbsp;	&nbsp;	&nbsp;The Gentleman’s Magazine (March 1809) praised the poem as "unquestionably <br>	
						&nbsp;	&nbsp;	&nbsp;an original work," replete with a "mingled genius, good sense, and <br>	
						&nbsp;	&nbsp;	&nbsp;spirited animadversion" unseen in many years. By May English Bards, <br>	
						&nbsp;	&nbsp;	&nbsp;and Scotch Reviewers had gone into a second, revised and enlarged <br>	
						&nbsp;	&nbsp;	&nbsp;edition in which Byron abandoned his anonymity. Third and fourth <br>	
						&nbsp;	&nbsp;	&nbsp;editions followed in 1810. He suppressed a fifth edition in 1812, <br>	
						&nbsp;	&nbsp;	&nbsp;as he had come to know and respect some of his victims and to <br>	
						&nbsp;	&nbsp;	&nbsp;regret many of his critical and personal jabs. <br>	

						
						&nbsp;	&nbsp;	&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br>
						&nbsp;	&nbsp;	&nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br>
						&nbsp;	&nbsp;	&nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br>
						&nbsp;	&nbsp;	&nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br><br>
							

				}
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
			 		
						<button type="submit" name="submit" class="btn btn-primary active">Submit</button>
					</form>
				</div>
			<div class="col-md-2">	</div>
		</div>
	</div>
</body>
</html>