
<?php 
session_start();

$round_number = 1;
$next_question = 'common_sense';

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
  echo '<script> alert("Something is fishy. Terminating Everything. Contact WebQuest Team. '.$_SESSION['username'].'") </script>';
} 
$questions_completed = 0;
while ( $row = mysqli_fetch_assoc($val_result)){
  $questions_completed = $row['round1_questions_complete'];
}
if ( $questions_completed < $round_number-1 ){
  echo '<script>alert(" You are not allowed here. '.$questions_completed.' - '. $round_number . ' "); </script>';
  echo '<script> window.location = "story.php"; </script>';
}

if (isset($_POST['submit'])){

    $db_query = 'select answer from wq2019_answers where question='.$round_number.' and round=1';

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


<html lang="en">
 <head>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    <meta charset="utf-8"> 
    <title>Question 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.jpeg">


<style>

 html {
  height: 100%;
}
body{
   background-image: url("images/alphabg.png");
  background-repeat: no-repeat;
    background-size: 100% 100%;
}
.bg{
  margin-top: 15%;
}
.caption {
  width: 100%;
  padding : 10px;
  text-align: center;
  color: #000;
}

.caption span.border {
  background-color: #111;
  color: #fff;
  font-size: 70px;
  letter-spacing: 10px;
}  
<style type="text/css">
 .topcorner{
   position:absolute;
   top:0;
   right:0;
  }
</style>

</style>
</head>
<body>
  <div class="topcorner">
  <a href="leader_board.php" target="_blank" >Leader Board</a>
</div>
<div class="bg">
<div class="caption">
    <span class="border">珠  线</span><br>
    
</div>

  <div class="row">
      <div class="col-md-2">  </div>
      <div class="col-md-8">  
        <form action="" method="POST" style="text-align: center;">
           <div class="form-group">
               <input style="max-width: 30%" name="answer" type="text" >
           </div>
            <button type="submit" name="submit" class="btn btn-primary active">Submit</button>
          </form>
        </div>

</div>
</body>
</html>
