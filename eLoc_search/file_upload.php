<?php 
	
	require 'includes/connection.php';

	$error = array();

		if(isset($_POST['ins_set'])){
			if($_FILES['ins_file_inp'] && $_FILES['ins_file_inp']['error'] == 0){
		
				$fyl = fopen($_FILES['ins_file_inp']['tmp_name'], 'r');

				$count = 0;
				$common_error = 0;
				while(!feof($fyl)){

					$row = fgetcsv($fyl);
					
					if(sizeof($row) == 10 ){
						$query = "INSERT INTO eloc_info(_id, name, stt_id, eloc, type, poi_type, pty_srch, pty_lbl, keyword, remarks) VALUES('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]')";
						// print_r($query);die;
						
						$result = mysqli_query($conn, $query);
						
						if(!$result){
							$error[] = mysqli_error($conn)."\n";
							// die;
						}else{
							++$count;
						}
						
					}
				}
				print_r("Records Inserted : $count \n");
				print_r("Total Errors : ".count($error) . "\n\n");
				if(!empty($error)){
					foreach ($error as $key => $value) {
						if($key == 0){
							print_r($value);
						}
						else if($key > 0 && !(preg_match('/Duplicate entry/', $value))){
							print_r($value);
						}
						else{
							++$common_error;
						}						
					}
					print_r("Found  other ".$common_error." Duplicate entries");
				}
			}
		}

	// else 
	if(isset($_POST['upd_set'])){
		if($_FILES['upd_file_inp'] && $_FILES['upd_file_inp']['error'] == 0){

			$fyl = fopen($_FILES['upd_file_inp']['tmp_name'], 'r');
			$count = 0; 
			$common_error = 0;
			while(!feof($fyl)){

				$row = fgetcsv($fyl);
				if(count($row) == 10){

					$query = "UPDATE eloc_info SET _id='$row[0]', name='$row[1]', stt_id='$row[2]', eloc='$row[3]', type='$row[4]', poi_type='$row[5]', pty_srch='$row[6]', pty_lbl='$row[7]', keyword='$row[8]', remarks='$row[9]' WHERE eloc like '$row[3]' ";
					// print_r($query); echo "\n";
					$result = mysqli_query($conn, $query);
					if(!$result){
						$error[] = mysqli_error($conn) . "\n";
					}else{
						++$count;
					}

				}

			}
			print_r("Records Updated : $count  \n");
			print_r("Total Errors : ".count($error) . "\n\n");
			if(!empty($error)){
				foreach ($error as $key => $value) {
					print_r($value);
				}
			}
		}
	}

 ?>