
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.css" rel="stylesheet" media="screen,projection">
		<link href="css/bootstrap-theme.css" rel="stylesheet" media="screen,projection">

		<style type="text/css">
			
			body { background-color: #fafafa; }

			div#first{
				background-color: #37aed2;
			}

			.form-signin
			{
			    max-width: 330px;
			    padding: 15px;
			    margin: 0 auto;
			}
			.form-signin .form-signin-heading, .form-signin .checkbox
			{
			    margin-bottom: 10px;
			}
			.form-signin .checkbox
			{
			    font-weight: normal;
			}
			.form-signin .form-control
			{
			    position: relative;
			    font-size: 16px;
			    height: auto;
			    padding: 10px;
			    -webkit-box-sizing: border-box;
			    -moz-box-sizing: border-box;
			    box-sizing: border-box;
			}
			.form-signin .form-control:focus
			{
			    z-index: 2;
			}
			.form-signin input[type="text"]
			{
			    margin-bottom: 1em;
			    border-bottom-left-radius: 0;
			    border-bottom-right-radius: 0;
			}
			.form-signin input[type="password"]
			{
			    margin-bottom: 10px;
			    border-top-left-radius: 0;
			    border-top-right-radius: 0;
			}
			.account-wall
			{
			    margin-top: 20px;
			    padding: 40px 0px 20px 0px;
			    background-color: #f7f7f7;
			    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			}
			.login-title
			{
			    color: #555;
			    font-size: 18px;
			    font-weight: 400;
			    display: block;
			}
			.profile-img
			{
			    width: 96px;
			    height: 96px;
			    margin: 0 auto 10px;
			    display: block;
			    -moz-border-radius: 50%;
			    -webkit-border-radius: 50%;
			    border-radius: 50%;
			}
			.need-help
			{
			    margin-top: 10px;
			}
			.new-account
			{
			    display: block;
			    margin-top: 10px;
			}

		</style>

	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius: 10px; width: 95%; margin: auto; margin-top: 0.2em;">
	 		<div class="container-fluid">
		 		<div class="navbar-header">
		 			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation_bar">
		 				<span class="icon-bar"></span>
		 				<span class="icon-bar"></span>
		 				<span class="icon-bar"></span>
		 			</button>
		 			<a href="#" class="navbar-brand"><img src="img/logo.png" style="height: 30px;"></a>
		 		</div>

		 		<div class="collapse navbar-collapse" id="navigation_bar">
		 			<ul class="nav navbar-nav navbar-right action_buttons" >
		 				<li class="text-primary">
							<a id = "add1" href="http://10.1.1.66:8080/mmiportal/index.jsp?a=<?php echo $_SESSION['id']; ?>"> Portal</a></li>
	 				</ul>
		 		</div>

	 		</div>
	 	</nav>

	 	<div class="container">
	 		<div class="row" style="margin-top: 10em;">
	 			<div class="col-xs-4 col-xs-offset-4">
	 				<div id="form_div">
		 				<div style="background-color: #2988a5; padding: 2em 0; border-radius: 10%">
		 					<img src="img/user.png" class="center-block" style="width: 40%; border-radius: 50%">
			 				<form class="form-signin" action="index.php" method="GET">
			 					<div>
			 						<input type="text" class="form-control" name="id" placeholder="Enter User ID" required autofocus>
			 					</div>
			 					<div>
			 					    <input type="password" class="form-control" name="password" placeholder="Enter password" required autofocus>
			 					</div>
			 					<div>
			 						<input class="btn btn-lg btn-default btn-block" type="submit" name="submit" value="Log In">
			 					</div>   
			 				</form>
		 				</div>
	 				</div>
	 			</div>
	 		</div>
	 	</div>
			





		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
	</body>
</html>