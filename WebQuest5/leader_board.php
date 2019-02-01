<?php

    //  include_once('server_data.php');

     $host="";
    $username="";
    $password="" ;
    $dbname="";

    
   
?>


<html>
<head>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
<div class="row">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Rank</th>
      <th scope="col">PLayer</th>
      <th scope="col">College</th>
      <th scope="col">Score</th>
    </tr>
  </thead>
  <tbody>

    <?php 

    $conn = new mysqli($host, $username, $password, $dbname);
    if($conn->connect_error){
      die("Connection failed:".$conn->connect_error);
    }

    $db_query = 'select name, college, round1_questions_complete, round1_start_time from wq2019_players order by round1_questions_complete DESC, round1_start_time DESC';

    $result = $conn->query($db_query);

    if (!$result || mysqli_num_rows($result) == 0 ){
      echo '<script> alert("Something is fishy. Terminating Everything. Contact WebQuest Team.") </script>';
        
      }   

    $rank = 1;
    while ( $row = mysqli_fetch_assoc($result)){
      echo "<tr>";
      echo '<th scope="row">'.$rank.'</th>';
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['college']."</td>";
      echo "<td>". $row['round1_questions_complete'] ."</td>";
      echo  "</tr>";
      // $rank = $rank + 1;
      $rank++;
    }
    ?>

  </tbody>
</table>
</div>
</div>
</body>
</html>