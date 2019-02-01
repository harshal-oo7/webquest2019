
<?php 
session_start();

$round_number = 5;
$next_question = 'dublin_lamp_post';

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

      <title>Question 5</title>
      
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
     <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     
 <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
      <link rel="shortcut icon" href="images/favicon.jpeg">


<style>
.row{
	margin: 3%;
}
html {
    height: 100%
}
body{
	 background-image: url("images/stackbg.png");
	background-repeat: no-repeat;
    background-size: 100% 100%;
}
.container{
	margin-top : 5%;
}
ul{
	font-size : 200%;
	text-align : center;

}
#one{
	width : 35%;
	background-color : #F6CDE6;
	margin-left : 32.5%;
}
#two{
	width : 42%;
	background-color : #FFE5BC;
	margin-left : 29%;
}
#three{
	width : 49%;
	background-color : #DDF909;
	margin-left : 25.5%;
}
#four{
	width : 56%;
	background-color : #ADD9F9;
	margin-left : 22%;
}
.topleft , .bottomleft{
	font-size: 24px;
	float: left;
}
.topright , .bottomright{
	float: right;
}

.tooltiptext1 , .tooltiptext2, .tooltiptext3, .tooltiptext4{
  visibility: hidden;
  width: 120px;
  color: black;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  /*position: absolute;*/
  z-index: 1;
  top: -5px;
  right: 105%;
}

</style>
 </head>

   <body>
  
   <div class = "container">
  
    <ul class = "nav nav-tabs nav-stacked" role = "tablist">
  
          <li  id="one"><a href = "https://en.wikipedia.org/wiki/1,500">
          	<span class="o">T.S.M. Rao</span> 
          	<span class="tooltiptext1">2005</span>
          </a></li>
            
     
       <li id="two"><a href = "https://en.wikipedia.org/wiki/10,000" >
       	<span class="tw">
       		R. P. Deshpande
       </span>
         <span class="tooltiptext2">2012</span>
         </a></li>
     

       <li id="three"><a href = "https://en.wikipedia.org/wiki/20,000" >
       	<span class="th">Sōgo Okamura</span>
         <span class="tooltiptext3">1994</span>
         </a></li>
         
   <li id="four"><a href = "https://en.wikipedia.org/wiki/70,000">
   	<span class="f">Ward Leonard Electric Company</span>
          <span class="tooltiptext4">1959</span>
          </a></li>

 </ul>
  
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

    <script type="text/javascript">
    	
    	$('document').ready(function(){
    		$('#one').mouseover( function(e){
    			$('.tooltiptext1').css('visibility', 'visible');
    		});
    		$('#one').mouseleave( function(e){
    			$('.tooltiptext1').css('visibility', 'hidden');

    		});

    		$('#two').mouseover( function(e){
    			$('.tooltiptext2').css('visibility', 'visible');
    		});
    		$('#two').mouseleave( function(e){
    			$('.tooltiptext2').css('visibility', 'hidden');
    		});

    		$('#three').mouseover( function(e){
    			$('.tooltiptext3').css('visibility', 'visible');
    		});
    		$('#three').mouseleave( function(e){
    			$('.tooltiptext3').css('visibility', 'hidden');
    		});

    		$('#four').mouseover( function(e){
    			$('.tooltiptext4').css('visibility', 'visible');
    		});
    		$('#four').mouseleave( function(e){
    			$('.tooltiptext4').css('visibility', 'hidden');
    		});
    	});

    </script>
  
 </body>

</html>