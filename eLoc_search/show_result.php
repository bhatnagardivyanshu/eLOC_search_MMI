<?php 
	
	require 'includes/connection.php';

	$eloc_types = array();
	$query = "SELECT type, att from eloc_type; ";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die("Query execution failed! " . mysqli_error($conn));
	}
	else{
		while($res = mysqli_fetch_assoc($result)){
			$eloc_types[$res['type']] = $res['att']; 
		}
	}



	if(isset($_POST['search_for']) and $_POST['search_for'] != ""){
		$words = rtrim($_POST['search_for'], ';');
		$words = explode(";", $words);

		$query1 = "SELECT * FROM eloc_info WHERE eloc in (";

		foreach ($words as $key => $value) {
			$query1 .= '"'.trim($value).'"';
			if($value != end($words)){
				$query1 .= ", ";
			}
		}

		$query1 .= ")";

		// print_r($query1);
		
		$result1 = mysqli_query($conn, $query1);
		if(!$result1){
			echo "query1 not executed!<br>".$query1."<br/><b>".mysqli_error($conn)."</b>";
		}
		$rows = array();

		while ($row = mysqli_fetch_assoc($result1)) {
			$typ = $eloc_types[$row['type']];
			$row['type'] = $typ;
			$rows[] = $row;
			// print_r($row);
		}
		mysqli_free_result($result1);	
		// die;
	}
	else if(($_FILES['csv_upload'] && $_FILES['csv_upload']['error'] == 0)){


		$file = fopen($_FILES['csv_upload']['tmp_name'],'r');
		$tasks = array();
		$size = count(fgetcsv($file));
		// var_dump($size);
		rewind($file);
		while(!feof($file)){
			if($size==1){
				$current = fgetcsv($file)[0];
			}
			else{
				$current = fgetcsv($file)[1];
			}
			if(!empty($current)){
				if(!array_key_exists($current, $tasks)){
					$tasks[] = $current;
				}
			}
		}
		// var_dump($tasks);

		$query1 = "SELECT * FROM eloc_info WHERE eloc in (";
		foreach ($tasks as $key => $value) {
			$query1 .= '"'.trim($value).'"';
			if($value != end($tasks)){
				$query1 .= ", ";
			}
		}

		$query1 .= ")";

		// print_r($query1);
		
		$result1 = mysqli_query($conn, $query1);
		if(!$result1){
			echo "query1 not executed!<br>".$query1."<br/><b>".mysqli_error($conn)."</b>";
		}

		$rows = array();

		while ($row = mysqli_fetch_assoc($result1)) {
			$typ = $eloc_types[$row['type']];
			$row['type'] = $typ;
			$rows[] = $row;
		}

		mysqli_free_result($result1);	
		
	}
	else{
		$rows = "";
		$eloc_types = "";
	}

	print_r(json_encode($rows));
	// var_dump(json_encode($rows));

	
 ?>