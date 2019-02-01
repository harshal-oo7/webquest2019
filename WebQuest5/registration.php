
<?php

    if(isset($_POST["submit"]))
    {
      $playername=$_POST["name"];
      $college=$_POST["college"];
      $mobile=$_POST["mobile"];
      $email=$_POST["email"];
      $username_player=$_POST["username"];
      $password_player=$_POST["password"];

      $password_player = md5($password_player);

       $host="";
    $username="";
    $password="" ;
    $dbname="";


      $conn = new mysqli($host, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed:".$conn->connect_error);
        echo "<script>alert('Connection failed with the database!');</script>";
      }
      $db_query = "insert into wq2019_players ( ID, name,mobile_number,email,college,username,password, payment, round1_questions_complete, round2_questions_complete) values (0, '".$playername."','".$mobile."','".$email."','".$college."','".$username_player."','".$password_player."', 0, 0, 0 )";
      echo '<script> console.log("'. $db_query .' ")  </script>';
      $result = $conn->query($db_query);
      if($result){
        //header("location: regsuccess.html");
        echo"<script>window.location= 'login.php'</script>";
      }
      else{
        echo "<script>alert('Username already taken or you have already registered with this mobile number.')</script>";
      }
    }
?>




<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>WebQuest 5.0 Registration</title>



    <!-- Favicon -->
        <link rel="shortcut icon" href="images/favicon.jpeg">

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <style type="text/css">
        body {
                background-image:    url(images/regiback.jpg);
                background-size:     cover;                      /* <------ */
                background-repeat:   no-repeat;
                background-position: center center;              /* optional, center the image */
            }
    </style>
    <!-- Main CSS-->
    <link href="css/registration.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">WebQuest 5.0</h2>
                    <p class="tagline">The nearer you get, the farther you are.</p>
                    <br>
                    <br>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="NAME" name="name" required>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="email" placeholder="EMAIL" name="email" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="number" placeholder="MOBILE" name="mobile" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="COLLEGE" name="college" required>
                        </div>


                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="USERNAME" name="username" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="password" placeholder="PASSWORD" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="p-t-20" style="margin-left: 40%;">
                            <button class="btn btn--radius btn--green" name="submit" type="submit">Register!</button>
                        </div>
                        <div class="p-t-20" style="margin-left: 40%;">
                        <a  href="login.php" class="btn btn--radius btn--green" >Login</>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->
