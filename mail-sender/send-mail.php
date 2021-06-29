<?php

include('emailHelper.php');
$message = $_POST['tabledata'];
$client_code = $_POST['clent_code'];


// $csvDataSql = "SELECT * FROM csv_data WHERE company_code='$client_code' ORDER BY created_on DESC LIMIT 1";
// $csvDataQuery = mysqli_query($con,$csvDataSql);
// $csvDataRow = mysqli_fetch_assoc($csvDataQuery);
		
$to = 'kr.manjeet319@gmail.com';
$type = 'Insurance Data';
$msg = sendMail($to,$message, $type);

if($msg){
	echo 'success';
	exit();
}

echo 'error';

?>
