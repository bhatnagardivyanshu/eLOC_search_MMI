$(document).ready(function(){
	
	$("#upload_btn").click(function(e){
		e.preventDefault();
		$("#upload_file").click();
	});

	$("#download_btn").click(function(){
		csv_ready("eLoc data.csv")
	});

	upload_search_file();

	file_name();

	handle_admin_modal();
	
	upload_btn();

	make_changes();

});

function upload_search_file(){
		$("form#search_form").submit(function(e){
			// e.preventDefault();
			$("#result tbody").empty();
			var formData = new FormData(this);
			$.ajax({
			        url: "show_result.php",
			        type: 'POST',
			        data: formData,
			        dataType: 'json',
			        success: function(result) {
			        	if(!$.isEmptyObject(result)){
			        		$("#download_btn").fadeIn(200);
			        		$("#resultError h2").hide();
				            $("#result").show();
			        		
			        		/*Center to left*/
			        		$("#search_box").hide().removeClass("col-xs-offset-4 col-xs-4");
			        		$("#search_box").addClass("col-xs-2").fadeIn(300);
			        		// $("#search_box").css('padding', '2em');
			        		$("#main_row").removeClass("box_ctr");
			        		$("#result_col").show(350);


							$.each(result, function(index, value){
								console.log(typeof(result));
								var id = this['_id'];
								var name = this['name'];
								var stt_id = this['stt_id'];
								var eloc = this['eloc'];
								var typ = this['type'];
								var poi_typ = this['poi_type'];
								var pty_srch = this['pty_srch'];
								var pty_lbl = this['pty_lbl'];
								var keyw = this['keyword'];
								var rem = this['remarks'];
								var output =  '   <tr>  '  + 
	 								'<td>'+id+'</td>  '  + 
	 								'<td>'+name+'</td>  '  + 
	 								'<td>'+stt_id+'</td>  '  + 
	 								'<td>'+eloc+'</td>  '  + 
	 								'<td>'+typ+'</td>  '  + 
	 								'<td>'+poi_typ+'</td>  '  + 
	 								'<td>'+pty_srch+'</td>  '  + 
	 								'<td>'+pty_lbl+'</td>  '  + 
	 								'<td>'+keyw+'</td>  '  + 
	 								'<td>'+rem+'</td>  '  + 
									'</tr>  ' ;
								$("#result tbody").append(output);
				        	})
			        	}
			        	else{
			        		$("#resultError h2").show();
			        		$("#result").hide();
			        		$("#download_btn").fadeOut(200);
			        		/* Center to left */
			        		$("#search_box").hide().removeClass("col-xs-offset-4 col-xs-4");
			        		$("#search_box").addClass("col-xs-2").fadeIn(300);
			        		// $("#search_box").css('padding', '2em');
			        		$("#main_row").removeClass("box_ctr");
			        		$("#result_col").show(350);

			        	}
		            },
			        cache: false,
			        contentType: false,
			        processData: false
			    });

			    return false;
		})
}

function make_changes(){
	
	$("#submit_form").click(function(){
		
		//if 1st form is filled
		if($("#ins_file")[0].files.length){
			var form1 = $("#ins_file").parent()[0];
			var form_data = new FormData(form1);
			$.ajax({
				url:'file_upload.php',
				type: 'POST',
				data : form_data,
				// dataType: 'json',
				success: function(data){
					alert(data);
					console.log(data);
					$("#admin_modal").modal("hide");
					$(".modal form").eq(0)[0].reset();
					$(".modal form").eq(1)[0].reset();
					$(".upload_filename").hide();
				},
				error: function(data){
					alert('data');
				},
				contentType: false,
				processData: false,
				cache: false


			})
			
		} else if ($("#upd_file")[0].files.length){
			var form2 = $("#upd_file").parent()[0];
			var form_data = new FormData(form2);
			$.ajax({
				url:'file_upload.php',
				type: 'POST',
				data : form_data,
				// dataType: 'json',
				success: function(data){
					alert(data);
					console.log(data);
					$("#admin_modal").modal("hide");
					$(".modal form").eq(0)[0].reset();
					$(".modal form").eq(1)[0].reset();
					$(".upload_filename").hide();
				},
				error: function(data){
					alert('data');
				},
				contentType: false,
				processData: false,
				cache: false


			})
		}
	 	else if($($("#ins_file")[0].files.length) && $("#upd_file")[0].files.length){
	 		alert("Please select one option at a time!");
	 	}
		else {
			alert("Please upload a file!");
		}

		return false;
	})
}

function file_name(){
	$("#upload_file").change(function(){
		// alert();
		if(this.files.length){
			$("#search_keyword").val("");
			$("#search_filename").html(this.files[0].name + " uploaded");
			$("#search_filename").show();
		}
		else{
			$("#search_filename").hide();
		}
	});

	$("#ins_file, #upd_file").change(function(){
		if(this.files.length){
			$(this).next().show().html(this.files[0].name+" uploaded");
		}
	});
}

function downloadCSV(csv, filename){
	var csvFile;
	var downloadLink;


	// CSV file
	csvFile = new Blob([csv], {type: "text/csv"});

	// Download link
	downloadLink = document.createElement("a");

	// File name
	downloadLink.download = filename;

	// Create a link to the file
	downloadLink.href = window.URL.createObjectURL(csvFile);

	// Hide download link
	downloadLink.style.display = "none";

	// Add the link to DOM
	document.body.appendChild(downloadLink);

	// Click download link
	downloadLink.click();
}

function csv_ready(filename){
	var csv = [];
	var rows = $("#result tr");
	csv.push("eLoc Report");

	for (var i = 0; i < rows.length; i++) {
		var row = [];
		var cols = (i==0)? $(rows[i]).find("th"):$(rows[i]).find("td"); 
	
		for (var j = 0; j < cols.length; j++) {
			row.push(cols[j].innerText);
		}
		csv.push(row.join(","));
	}

	downloadCSV(csv.join("\n"), filename);
}

function handle_admin_modal(){
	$("#admin_modal_btn").click(function(){
		$("#admin_modal").modal("show");
	})
}

function upload_btn(){
	$("#ins_file_btn, #upd_file_btn").click(function(){
		$(this).next().click();
	})
}
