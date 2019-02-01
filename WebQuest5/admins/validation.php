<?php

  session_start();

  if (isset($_POST['submit'])) {
    // include_once('./server_data.php');
     $host="";
    $username="";
    $password="" ;
    $dbname="";



    $conn = new mysqli($host, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
      }

      $player_username = $_POST['username'];


      $db_query = 'update  wq2019_players set payment=1 where username="'.$player_username.'"'  ;

      $result = $conn->query($db_query);

      if (!$result || mysqli_num_rows($result) == 0){
        echo '<script> alert(" Invalid Username"); </script>';
        
      }

    else{
        echo '<script> Payment Success </script>';
    }
      
     
  }
?>



<html lang="en">

<head>
    <title>Question 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/favicon.jpeg">
    <style>
        p {
            text-align: center;
            font-size: 3em;
            margin-top: 0px;
        }

        * {
            margin-left: auto;
            margin-right: auto;
        }

        .b {
            margin-left: auto;
            min-width: 50px;
            margin-right: auto;
        }

        .container {
            margin-top: 10%;
        }

        form,
        .container {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <form action="" method="POST">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" id="answer" aria-describedby="answerHelp" placeholder="User name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>
    <!--    </div>-->

</body>

</html>
