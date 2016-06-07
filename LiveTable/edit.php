<?php  
$connect = mysqli_connect("localhost","root","root","tickets");
$id = $_POST['id'];
$text = $_POST['text'];
$column_name = $_POST["column_name"];

$qry = "UPDATE events SET $column_name = '$text' WHERE id = $id";
$result = mysqli_query($connect,$qry);
echo $id . "\n";
echo $column_name;
if(!$result){
	mysqli_error($connect);
}
?>