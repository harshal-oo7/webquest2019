
<?php 
session_start();

$round_number = 3;
$next_question = 'poem';

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
  echo '<script> alert(" You are not allowed here."); </script>';
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
		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <title>Question 3</title>

      <link rel="shortcut icon" href="images/favicon.jpeg">

<style>
.col-container {
  display: flex;
  width: 100%;
}
.row{
  margin-top: 5%;
}
body{
   background-image: url("images/awardbg.jpg");
  background-repeat: no-repeat;
    background-size: 100% 100%;
}
</style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-4">
        <a href="images/21.jpg" target="_blank">
          <img src="images/21.jpg" height="400" alt="Lights" style="width:100%">
        </a>
      
    </div>
    <div class="col-md-4">
        <a href="images/22.jpg" target="_blank">
          <img src="images/22.jpg" height="400" alt="Nature" style="width:100%">
        </a>
    </div>
    <div class="col-md-4">
        <a href="images/23.jpg" target="_blank">
          <img src="images/23.jpg" height="400" alt="Fjords" style="width:100%">
          
        </a>
    </div>
    </div>
  </div>


<div class="row">
      <div class="col-md-2">  </div>
      <div class="col-md-8">  
        <form action="" style="text-align: center;" method="POST">
           <div class="form-group">
               <input style="max-width: 30%" name="answer" type="text" >
           </div>
            <button type="submit" name="submit" class="btn btn-primary active">Submit</button>
          </form>
        </div>

</body>
</html>