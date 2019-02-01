<!DOCTYPE html>
<html>
<head>
	<title>Web Quest 4.0 Registration</title>
	<meta charset='UTF-8'>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="Stylesheet" href="./css/login1.css" type="text/css"/>
	<link rel="Stylesheet" href="./css/login2.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="css/regi.css" >
	<link href="https://fonts.googleapis.com/css?family=Almendra" rel="stylesheet">
	<style>
	body{
		font-family: 'Almendra',serif;
		
	}
</style>
<script>
	function preventBack(){window.history.forward();}
	setTimeout("preventBack()", 0);
	window.onunload=function(){null};
</script>

</head>
<body>
	<div class="wrapper">
		<h1 class="quest-head">The Presidian</h1>
		<div class="container-fluid">
			<center>
				<img src="images/symbol2.png" alt="logo" class="img img-responsive logo">
			</center>
		</div>
		<div class="font-area">
			<span class="footLine"></span>
			<p class="slogan">"Seek and ye shall find"</p>
		</div>
	</div>
	<div class="site__container">
		<div class="grid__container">
			<form action="connect.php" method="post" class="form form--login" autocomplete="on">
				<div class="form__field">
					<label><img src="./images/pword.png"><span class="hidden">Name</span></label>
					<input name="login__playername" id="login__playername" type="text" class="form__input" placeholder="Name" required>
				</div>
				<div class="form__field">
					<label><img src="./images/pword.png"><span class="hidden">College</span></label>
					<input name="login__collegename" id="login__collegename" type="text" class="form__input" placeholder="College" required>
				</div>
				<div class="form__field">
					<label><img src="./images/pword.png"><span class="hidden">Mobile</span></label>
					<input name="login__mobile" id="login__mobile" type="tel" class="form__input" maxlength="10" placeholder="Mobile" required>
				</div>
				<div class="form__field">
					<label><img src="./images/pword.png"><span class="hidden">Email</span></label>
					<input name="login__email" id="login__email" type="email" class="form__input" placeholder="Email" required>
				</div>
				<div class="form__field">
					<label><img src="./images/pword.png"><span class="hidden">Username</span></label>
					<input name="login__username" id="login__username" type="text" class="form__input" placeholder="Username" required>
				</div>
				<div class="form__field">
					<label><img src="./images/pword.png"><span class="hidden">Password</span></label>
					<input name="login__password" id="login__password" type="password" class="form__input" placeholder="Password" required>
				</div>
				<div class="form__field">
					<input name="register" id="register" type="submit" value="Register">
				</div>
			</form>
		</div>
	</div>	
</body>
</html>
