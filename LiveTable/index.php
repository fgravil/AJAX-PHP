<!DOCTYPE html>
<html>
<head>
	<title>Live Table</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	
</head>
<body>
	<div  class="container">
		<br><br><br>
		<!-- <div class="table-responsive">
			<h3 align="center">Live Table Edit</h3>
			<div id="live_data"></div>
		</div> -->
		<table id="myTable">
		<thead>
			<tr>
					<th>Selected</th>
					<th>Date</th>
					<th>Id</th>
					<th>Event</th>
					<th>Notes</th>
				</tr>
		</thead>
		<tfoot>
			<tr>
					<th >Selected</th>
					<th >Date</th>
					<th >Id</th>
					<th>Event</th>
					<th>Notes</th>
				</tr>
		</tfoot>

		<tbody>
			
		</tbody>
		</table>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		function fetch_data(){
			$.ajax({
				url:"select.php",
				method:"POST",
				success: function(data){
					$("tbody").html(data);
				}
			});
		}
		function edit_data(id,text,column_name){
			$.ajax({
				url:"edit.php",
				method:"POST",
				data: {id:id, text:text, column_name:column_name},
				dataType:"text",
				success:function(data){
					alert(data);
				}
			});
		}

		$(document).on('blur','.event_select',function(){
			  var id = $(this).data("id1");
			  var selected = $(this).text();
			  edit_data(id,selected,"selected");
		});
		
		$(document).on('blur','.event_notes',function(){
			  var id = $(this).data("id2");
			  var notes = $(this).text();
			  edit_data(id,notes,"notes");
		});

		fetch_data();
		$("#myTable").DataTable({});

	});
</script>