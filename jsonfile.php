<?php 

Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST'); //method allowed
Header("Content-Security-Policy: default-src 'self'");

// $con = mysqli_connect('localhost', 'homeofbu_csv_dat', 'Slideb@12345','homeofbu_csv_data');
$con = mysqli_connect('localhost', 'homeofbu_insur', 'Csv@12345','homeofbu_insurance');

if(!empty($_POST['listdata']) && $_POST['listdata'] != "[]"){
$jsondata = json_decode($_POST['listdata']);
	 $company_code = $_POST['company_code'];

// exit();

 $pass = 'none';
$uploade_data_format = [];
  foreach($jsondata[0] as $key=>$user_company_data){
        array_push($uploade_data_format,$key);    
  }

 $sqll="SELECT * FROM csv_company_format WHERE company_code='$company_code'";
    
     $query_data = mysqli_query($con,$sqll);
       
         if (mysqli_num_rows($query_data) > 0) {
            while($row = mysqli_fetch_assoc($query_data)) {
                $company_format = json_decode($row['csv_format']);
                // print_r($company_format);
                // print_r($uploade_data_format);
               if(empty(array_diff($uploade_data_format,$company_format))){
                  $pass = 'match'; 
               }
                
            }
         }  
         
         
         if($pass == 'none'){
                echo "Sorry, You have no CSV format for this document.";
                die();
         }
     
    

	$text = json_encode($jsondata);
 	$date = date('Y-m-d H:i:s');
 
	$sql = "INSERT INTO csv_data(company_code,data,created_on) VALUES('$company_code','$text', '$date')";
	$query = mysqli_query($con, $sql);
	
	// $_SESSION['company_code'] = $company_code;
	 
   echo true;

}



/*$jsondata = json_decode($_POST['listdata']);
echo "<pre>";print_r($jsondata);*/
/*
 <!-- CSV format and current data format check  (if matched insert else wrong format selected)  -->
 <!-- Admin comapany  -->
 <!-- Admin CSV format column  -->
 <!-- Admin CSV data  -->*/

?>

