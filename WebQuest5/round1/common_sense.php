
<?php 
session_start();

$round_number = 2;
$next_question = 'award';

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
    <title>Question 2</title>
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

        * {
            /*            border: 1px solid black;*/
        }

    </style>
</head>

<body>



    <div class="container center-box">
        <div class="row">
            <div class="col vertically-center">
                <img src="./images/wlkrefblk.png" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col vertically-center">
                <img src="./images/wlkbwwkl.gif" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col vertically-center">
                <img src="./images/fxxvhfhe.jpg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col vertically-center">
                <form method="POST" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="answer" aria-describedby="answerHelp" placeholder="Enter your answer here.">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>
