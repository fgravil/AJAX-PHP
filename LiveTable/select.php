<?php 
$connect = mysqli_connect("localhost","root","root","tickets") or die(mysql_error($connect));

$output = "";
$sql = "SELECT * FROM events ";
$result = mysqli_query($connect, $sql);
if(!$result){
	echo "query error";
}

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$output .= '<tr><td class="event_select" data-id1="'.$row["id"].'" contenteditable>' . $row["selected"] . '</td>
				    <td>' . $row["date"] . '</td>
				    <td>' . $row["id"] . '</td>
				    <td>' . $row["event_name"] . '</td>
				    <td class="event_notes" data-id2="'. $row["id"].'" contenteditable>' . $row["notes"] . '</td></tr>
				    <tr><td class="event_select" data-id1="'.$row["id"].'" contenteditable>' . $row["selected"] . '</td>
				    <td>' . $row["date"] . '</td>
				    <td>' . $row["id"] . '</td>
				    <td>' . $row["event_name"] . '</td>
				    <td class="event_notes" data-id2="'. $row["id"].'" contenteditable>' . $row["notes"] . '</td></tr>
				    <tr><td class="event_select" data-id1="'.$row["id"].'" contenteditable>' . $row["selected"] . '</td>
				    <td>' . $row["date"] . '</td>
				    <td>' . $row["id"] . '</td>
				    <td>' . $row["event_name"] . '</td>
				    <td class="event_notes" data-id2="'. $row["id"].'" contenteditable>' . $row["notes"] . '</td></tr>'
				    ;
	}
}
else{
	$output .= '<tr>
					<td colspan="4">Data Not Found</td>
				</tr>';
}

echo $output;
?>