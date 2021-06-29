 <?php
 session_start();
 $con = mysqli_connect('localhost', 'homeofbu_insur', 'Csv@12345','homeofbu_insurance');
 $base_url = 'http://homeofbulldogs.com/dev/insurance-csv/admin/assets/admin/images/';
			

			if(isset($_GET['cc'])){
				
			 	$company_code = $_GET['cc'];
				
				}else{

				if(!isset($_SESSION['company_code'])){
						 
						echo '<div style="background: black;height: 100vh"><h1 style="text-align: center;font-size: 350px;background: black;text-shadow: 5px 4px 14px white;">404</h1></div>';
						die(); 
				}else{
					$company_code = $_SESSION['company_code'];
				}
			}


	// $company_code = $_GET['cc'];
	$sql1 = "SELECT * FROM csv_company WHERE company_code='$company_code'";
	$query1 = mysqli_query($con,$sql1);
	$row = mysqli_fetch_assoc($query1);

		if(!empty($row)){
			$_SESSION['company_code']  = $company_code;
		}else{
			echo '<div style="background: black;height: 100vh"><h1 style="text-align: center;font-size: 350px;background: black;text-shadow: 5px 4px 14px white;">404</h1></div>';
			die(); 
		}



	
	$pageDetailsSql = "SELECT * FROM csv_landing_page_setting";
	$pageDetailsQuery = mysqli_query($con,$pageDetailsSql);
	$pageDetailsRow = mysqli_fetch_assoc($pageDetailsQuery);
	


 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<title>INSURANCE</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 	<link rel="stylesheet" href="assets/css/style.css">
 	<link rel="stylesheet" href="assets/css/normal.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
 <body>

 	<section class="Header">
 		<div class="container">
 			<div class="row">
 				<div class="Logo">
 					<img src="<?php echo $base_url.$row['company_logo'];?>" alt="Logo" />
 				</div>
 				<div class="Navigation">
 					<div class="NavLink">
 						<ul>
 							<li><a href="index.php?cc=<?=$company_code?>">Home</a></li>
 							<li class="SupportButton"><a href="tel:<?php echo $row['company_phone'];?>">24/7 SUPPORT</a></li>
 						</ul>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>