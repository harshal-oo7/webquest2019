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
    $condition_query = "select round2_start_time from wq2019_players where username='". $player_username ."'";
    $condition_result = $conn->query($condition_query);

    if (!$condition_result || mysqli_num_rows($condition_result) == 0 ||  mysqli_num_rows($condition_result) > 1){
		echo '<script> alert("Something is fishy. Terminating Everything. Contact WebQuest Team.") </script>';
        
      }    
      $row  = mysqli_fetch_assoc($condition_result);
      if( $row['round2_start_time'] ){
        header('Location: searching_together.php');
      }
      else{
      $ut = time();
      
      $db_query = "update wq2019_players set round2_start_time=FROM_UNIXTIME(". $ut .") where username='". $player_username ."'" ;

      $result = $conn->query($db_query);

      if ( $result ){
        header('Location: searching_together.php');
      }
      else{
        echo "<script>alert('Something Went Wrong, shame on us.')</script>";
      }
    }
    }

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lets Begin</title>


    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
    
    body{
    background: brown;
    overflow: hidden;
}

div#topDiv{
    width:100%;
    height:0%;
    opacity:0.9;
    background:black;
    position:absolute;
    top: 0%;
}
div#bottomDiv{
    width:100%;
    height:0%;
    opacity:0.9;
    background:black;
    position:absolute;
    bottom: 0%;
}
div#centerDiv{
    position:absolute;
    height: 1px;
    top: 50%;
    width:100%;
    background: white;
    display:none;
    z-index:1;
}
.page-header{
    text-align: center;
    margin-top: 4%;
    text-transform: uppercase;
}


.story-text{
    font-size: 2em;
}
#content{
    color: beige;
}
.button-container{
    text-align: center;
    margin-left: 40%;
    color: brown;
}
.villian{
    position: absolute;
    left: 30%;
    top: 40%;
    font-size: 5em;
    visibility: hidden;
}
    </style>

</head>
<body>
        <div id="topDiv"></div>
        <div id="centerDiv"></div>
        <div id="bottomDiv"></div>
        <div class="container" id="content">
            <div class="row">
                <div class="col-md-12 page-header">
                    <h1>Round 2 begins here...</h1>
                </div>
                
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <h3>Location: Unknown</h3>
                            <h5>Date: 15th March 2014</h5>
                            <div class="story-text">
                                &nbsp;&nbsp;&nbsp; The round you just cleared was just an AI. <br>
                                As the legend says, it was devised as an pet project by a legendary programmer. <br>
                                A programmer whom know one knows is whether real or not. <br>
                                Now that Arthur have conquered that AI, he is curious about meeting that legendary programmar <br>
                                But thats not that easy, as the legend says, the programmer have devised a test <br>
                                so that only the worthy shall meet him.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ########## BUTTON ########### -->
                <div class="col-md-4"></div>
                <div class="col-md-4">             
                    <form method="POST" action=""> 
                      <button id="adrak" name="submit" class="btn button-container" style="z-index: 500;">Begin the Quest!</button>
                      </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div class="villian" >Adrakusate lassanium</div>
       
        
        
        <script>
            $('document').ready(function(){
                $('#adrak').click(function(e){
                    $('div#topDiv').animate({
                    //51% for chrome
                    height: "50%"
                    ,opacity: 1
                }, 400);
                $('div#bottomDiv').animate({
                    //51% for chrome
                    height: "50%"
                    ,opacity: 1
                }, 400, function(){
                        $('div#centerDiv').css({display: "block"}).animate({
                                width: "0%",
                                left: "50%"
                            }, 300);
                        }
                );
                     $('#content').css('visibility', 'hidden');
                     var delay_for_name = 1000; //1 second
                     var delay_for_name_vanish = 1500;
                     var delay_for_screen_change = 1800;

                    setTimeout(function() {
                    //your code to be executed after 1 second
                        $('.villian').css('visibility', 'visible');
                    }, delay_for_name);

                    setTimeout(function() {
                    //your code to be executed after 1 second
                        $('.villian').css('visibility', 'hidden');
                    }, delay_for_name_vanish);

                    // setTimeout(function() {
                    // //your code to be executed after 1 second
                    //     window.location = 'question1.php'   
                    // }, delay_for_name_vanish);

                });
                
            });

        </script>

</body>
</html>