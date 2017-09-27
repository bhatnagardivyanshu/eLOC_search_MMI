<?php 

	require 'includes/connection.php';
	session_start();

 	if(isset($_GET['id'])){
 		$user_id = $_GET['id'];

 		$admin = false;

		$q = "SELECT * from user_table where user_id like '$user_id'";

		$res = mysqli_query($conn, $q);
		if(mysqli_num_rows($res) == 1){
			$admin = true;
		}

 		$_SESSION['admin'] = $admin;
 		$_SESSION['id'] = $user_id;
		header("Location: index.php");
 	}
 	else {
 		if(isset($_SESSION['admin'])){
 			$admin = $_SESSION['admin'];
 			unset($_SESSION['admin']);
 		}
 		else{
 			$admin = false;
 		}
 	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>eLoc search</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.css" rel="stylesheet" media="screen,projection">
		<link href="css/bootstrap-theme.css" rel="stylesheet" media="screen,projection">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/font-awesome.css">
	</head>
	<body>
	 	<nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius: 10px; p: 1em">
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
		 				<li>
		 					<a href="<?php if(!$admin){ echo 'login.php'; } else{ echo '#'; } ?>" id="admin_modal_btn" >Admin</a>
		 				</li>
		 				<li class="text-primary">
							<a id = "add1" href="http://10.1.1.66:8080/mmiportal/index.jsp?a=<?php echo $_SESSION['id']; ?>"> Portal</a></li>
						<li class="text-primary">
							<a id="add1" href="include/logout.php">Logout</a>
						</li>
	 				</ul>
		 		</div>

	 		</div>
	 	</nav>

		<div class="container-fluid" style="margin-top: 5em;">
		 	<div class="row box_ctr" id="main_row">
		 		<h2 class="text-center" id="main_heading" style="color: #2988a5; margin-bottom: 1.2em; font-weight: 600;"  >SEARCH eLOC</h2>
		 		<div class="col-xs-4 col-xs-offset-4" id="search_box" style="padding: 0; border: 1px solid rgba(0,0,0,0.1); border-radius: 10%; background-color: #fafafa; overflow: hidden; box-shadow: 0px 3px 9px -2px;" >
		 			<div style="background-color: #2988a5; color: white" id="first">
	 					<h3 class="text-uppercase" id="head">Search Records</h3>
	 				</div>
	 				<div id="second">
		 				<form action="show_result.php" method="POST" id="search_form" enctype="multipart/form-data">
			 				<input id="search_keyword" type="text" class="form-control" name="search_for" placeholder="Enter eLoc ( separated by ; or , )" title="Use ; to separate the keywords" >
			 				<h3 id="line"><span>&nbsp;OR&nbsp;</span></h3>
			 				<button  type="button" class="form-control btn-primary" id="upload_btn">UPLOAD CSV</button>
			 				<input type="file" id="upload_file" name="csv_upload" accept=".csv" style="display: none;" />
			 				<h5 id="search_filename" class="text-center text-primary" style="display: none;"></h5>
			 				<button type="submit" name="submit" class="btn btn-success btn-block" style="margin: 01em 0">SEARCH</button>
		 				</form>
	 					<button type="button" id="download_btn" class="btn btn-block btn-warning" style="display: none;">DOWNLOAD CSV</button>
		 			</div>
		 		</div>
		 		<div class="col-sm-10" id="result_col" style="display: none;">
		 			<div id="resultError">
		 				<h2 class="text-center bg-warning" style="display: none;">No Results Found!</h2>
		 			</div>
		 			<table id="result" class="table table-responsive " style="display: none; overflow: auto;">
		 				<thead>
		 					<tr style="background-color: #37aed2; color: white">
		 						<th>ID</th>
		 						<th>Name</th>
		 						<th>State ID</th>
		 						<th>eLoc</th>
		 						<th>Type</th>
		 						<th>POI Type</th>
		 						<th>Pty Search</th>
		 						<th>Pty Label</th>
		 						<th>Keyword</th>
		 						<th>Remarks</th>
		 					</tr>
		 				</thead>
		 				<tbody>
		 					
		 				</tbody>
		 			</table>
		 		</div>
		 	</div>
	 	</div>

	 	<!-- Modal -->
		<div class="modal fade" id="admin_modal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="text-center" style="background-color: #2988a5; color: white; ">Upload a CSV File</h3>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-xs-6" style="padding: 1em; border-right: 1px solid lightgrey">
								<h4 class="text-center">Insert Data</h4><br/>
								<form action="file_upload.php" style="text-align: center;">
									<button type="button" id="ins_file_btn" class="btn btn-default">Click to Upload <i class="fa fa-upload" aria-hidden="true"></i></button>
									<input type="file" name="ins_file_inp" id="ins_file" style="display: none;" accept=".csv">
									<h5 class="text-center text-primary upload_filename" style="display: none;"></h5>
									<input type="hidden" name="ins_set" value="yes">
								</form>
							</div>
							<div class="col-xs-6" style="padding: 1em">
								<h4 class="text-center">Update Data</h4><br/>
								<form action="file_upload.php" style="text-align: center;">
									<button type="button" id="upd_file_btn" class="btn btn-default">Click to Upload <i class="fa fa-upload" aria-hidden="true"></i></button>
									<input type="file" name="upd_file_inp" id="upd_file" style="display: none;" accept=".csv">
									<h5 class="text-center text-primary upload_filename" style="display: none;"></h5>
									<input type="hidden" name="upd_set" value="yes">
								</form>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-info" id="submit_form">Make Changes!</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="make_changes_cancel_btn();">Cancel</button>
					</div>
					
				</div>
			</div>
		</div>

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
	</body>
</html>