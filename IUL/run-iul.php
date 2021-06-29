<?php 

include 'header.php';
include 'formula/calculate-nper.php';
$c_code = $_GET['cc'];

?>





<?php 

@session_start();

if(!empty($_POST)){

	$_SESSION['calc_data'] = $_POST;

}

// print_r($_SESSION);

?>



<script src="formula/calculate-cumipmt.js"></script>

<script src="formula/caluulate-cumprinc.js"></script>

<script src="formula/caluulate-abs-sum-nper.js"></script>



<style type="text/css">

.table thead th {   

    font-size: 12.5px;

}

 

tr.infotbl td{

    padding: 5px;

    font-weight: bold;

    font-style: italic;

    font-size: 12.5px;



}



.table td, .table th {

    padding: 4px;

    vertical-align: top;

    border-top: 1px solid #dee2e6;

    font-size: 15px;

    font-style: italic;

}



</style>

<section class="InnerBanner">







	<img src="assets/images/banner3.jpg" alt="Banner Image" />



	<div class="OnBannerText">



		<div class="container">



			<div class="BannerText">



				<h3>IUL Illustration </h3>



			</div>



		</div>



	</div>



</section>







<section class="Breadcrumb">



	<div class="container"> 			



		<ul>



			<li><a href="#"> Home </a></li>



			<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>



			<li><a href="#"> Input Debt </a></li>



			<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>



			<li class="active"> IUL Illustration </li>



		</ul>



	</div>



</section>







<section class="Overview">

	<div class="container">

		<div class="OverviewButton">			

			<form id="printPDF" action="../TCPDF-main/examples/print-insurance-file.php" method="POST">

				<input type="hidden" name="pdfContent" id="pdfContent">

				<button type="button" class="btn">Presentation</button>

				<button type="button" class="btn" onclick="printInsurancePDF();">Print</button>

				<button type="button" class="btn" onclick="sendInsuranceEmail();">Email</button>

			</form>

		</div>



		<div class="data-show"><br>



			<div id="dispmsg"></div>



			<div class="table-responsive">

				<table class="table table-striped table-condensed" id="mytable">

					<thead>

						<tr border="1">

							<th>#</th>

							<th>Company</th>

							<th>Balance</th>

							<th>Interest</th>

							<th>Min Payment</th>

							<th>Year Fund afailable for Payoff</th>

							<th>Years To Payoff</th>

							<th>Interest Saved</th>

							<th>Principal Paid off until payoff</th>

							<th>Principal Remaining at payoff</th>

							<th>Years Remaining at payoff</th>

							<th>Total Interest on Loan if no Term</th>

						</tr>

					</thead>

					<tbody>

						<?php 
							
					 

						$xl_accumulation = 0;
						$xl_surrender = 0;
						$xl_net_death = 0;

						if(!empty($_SESSION['calc_data'])){


							$csvDataSql = "SELECT * FROM csv_data WHERE company_code='$company_code' ORDER BY created_on DESC LIMIT 1";
							$csvDataQuery = mysqli_query($con,$csvDataSql);
							$csvDataRow = mysqli_fetch_assoc($csvDataQuery);
							$csv_data = json_decode($csvDataRow['data']);

							$i = 1;
							$array1 = [];
							$array5 = [];
							foreach ($csv_data as $csv_value) { 			
								foreach ($csv_value as $value) {
									if($i == 3){
										array_push($array1, $value);
									}
									if($i == 7){
										array_push($array5, $value);
									}
								}
								$i++;
							}

							$mydata = 0;
							// print_r($array1);
							// print_r($array5);
							if(!empty($array5)){
								$mydata = $array5[2] == 0 ? 0 : $array5[2]/12;
							}
							else if(!empty($array1)){
								$mydata = $array1[2] == 0 ? 0 : $array1[2]/12;
							}



							$count = 0;
							for($i = 1; $i<= $_SESSION['calc_data']['newrow']; $i++) {

								$amount = $_SESSION['calc_data']['balance'.$i]; //loan as amount
								$min_amount = $_SESSION['calc_data']['min_payment'.$i]; //min amount as payment
								$interest = $_SESSION['calc_data']['interest_rate'.$i]; //interest
								
								

								$csv_data = json_decode($csvDataRow['data']);
								$row = 1;
								$xlyr_fnd_payoff = 0;
								

								foreach ($csv_data as $csv_value) { 

									$tarray = [];		
									foreach ($csv_value as $value) {										
										if($row >= 3){
											array_push($tarray, $value);
										}
									}

									// print_r($tarray);
									// echo "<br/>";

									if($tarray[7] >= $amount){
										$xlyr_fnd_payoff = $tarray[0];
										$xl_accumulation = $tarray[7];
										$xl_surrender = $tarray[8];
										$xl_net_death = $tarray[9];
										break;
									}
									$row++;
									// break;
								}
								$yr_fnd_payoff = $xlyr_fnd_payoff;
								$yrs_to_payoff = calculate_nper($interest, $min_amount, $amount);
								$yrs_remaining_payoff = $yrs_to_payoff - $yr_fnd_payoff;
						?>

						<tr>
							<td ><?php echo ++$count; ?></td>
							<td id="cmp<?php echo $count ?>" data-attr="<?php echo $_SESSION['calc_data']['company_name'.$i]; ?>"><?php echo $_SESSION['calc_data']['company_name'.$i]; ?></td>
							<td id="amt<?php echo $count ?>" data-attr="<?php echo $amount; ?>">$<?php echo $amount; ?></td>
							<td id="int<?php echo $count ?>" data-attr="<?php echo $interest; ?>"><?php echo $interest; ?>%</td>
							<td id="min<?php echo $count ?>" data-attr="<?php echo $min_amount; ?>">$<?php echo $min_amount; ?></td>
							<td id="yr_fnd_payoff<?php echo $count ?>" data-attr="<?php echo $yr_fnd_payoff; ?>"><?php echo $yr_fnd_payoff; ?></td>
							<td id="yrs_to_payoff<?php echo $count ?>" data-attr="<?php echo $yrs_to_payoff; ?>"><?php echo $yrs_to_payoff; ?></td>
							<td id="int_saved<?php echo $count ?>" >$ 0</td>						
							<!-- 02 -->
							<td id="principle_paidoff<?php echo $count ?>"  >$ 0</td> 
							<!-- 01 -->
							<td id="principle_remaining<?php echo $count ?>"  >$ 0</td>
							<td id="remaining_payoff<?php echo $count ?>" data-attr="<?php echo $yrs_remaining_payoff; ?>"><?php echo $yrs_remaining_payoff; ?></td>
							<td id="interest_total<?php echo $count ?>" data-attr="" ></td>
						</tr>

						<?php
							}
						}
 
						?>
					</tbody>
				</table>
			</div>
		</div>

		 
		
		<input type="hidden" id="myCsvData" name="myCsvData" value="<?php echo $mydata ?>">
		<div class="col-md-12">
			<div class="Heading">
				<h4>Your Overview <!-- <img style=" height: 40px;" src="assets/images/down-arrow.png" class="InlineArrow" alt="Angle"/> --></h4>
			</div>
			<hr>
		</div>


		<div class="row">
			<div class="col-md-4">
				<div class="OverviewGraph">
					<div class="OverviewHeading">
						<h5 class="text-center">Interest Paid </h5>
					</div>
					<canvas id="interesrpaid" style="width:100%"></canvas>
				</div>
			</div>
			<div class="col-md-4">

				<div class="OverviewGraph">
					<div class="OverviewHeading">
						<h5 class="text-center">Monthly Payment </h5>
					</div>
					<canvas id="monthlypayment" style="width:100%"></canvas>
				</div>

				
			</div>
			<div class="col-md-4">

				<div class="OverviewGraph">
					<div class="OverviewHeading">
						<h5 class="text-center">Payoff Years </h5>
					</div>
					<canvas id="payoffyears" style="width:100%"></canvas>
				</div> 
			</div> 
		</div>



<!-- 
		<div class="row mb-5">

			<div class="col-md-6 Center">

				<div class="Center">

					<div class="OverviewHeading">

						<h4>INTEREST SAVED </h4>

						<h5>$10,638.87</h5>

					</div>

				</div>

			</div>

			<div class="col-md-6">

				<div class="OverviewGraph">

					<div class="OverviewHeading">

						<h4 class="text-center">Interest Paid </h4>

					</div>

					<img src="assets/images/graph1.png" alt="Graph" />

				</div>

			</div>

		</div>



		<div class="row mb-5">

			<div class="col-md-6 Center">

				<div class="Center">

					<div class="OverviewHeading">

						<h4>TIME SAVED </h4>

						<h5>$10,638.87</h5>

					</div>

				</div>

			</div>



			<div class="col-md-6">

				<div class="OverviewGraph">

					<div class="OverviewHeading">

						<h4 class="text-center">Payoff Years</h4>

					</div>

					<img src="assets/images/graph2.png" alt="Graph" />

				</div>

			</div>

		</div>



		<div class="row">

			<div class="col-md-6 Center">

				<div class="Center">

					<div class="OverviewHeading">

						<h4>MONTHLY AMOUNT</h4>

						<h5>$10,638.87</h5>

					</div>

				</div>

			</div>



			<div class="col-md-6">

				<div class="OverviewGraph">

					<div class="OverviewHeading">

						<h4 class="text-center">Monthly Amount</h4>

					</div>

					<img src="assets/images/graph3.png" alt="Graph" />

				</div>

			</div>

		</div>

	</div>-->

</section> 







<section class="Amount">

	<div class="container">

		<div class="row">

			<div class="col-md-4">

				<div class="SingleAmount">

					<h4>$732,570.00</h4>

					<p>Death benefit protecting your family even with loans out.</p>

				</div>

			</div>

			<div class="col-md-4">

				<div class="SingleAmount">

					<h4>$7,225.00</h4>

					<p>Cash value remaining after total loans in year eight.</p>

				</div>

			</div>



			<div class="col-md-4">

				<div class="SingleAmount">

					<h4>$90,925.87</h4>

					<p>Amount earning interest in investment, even with loans. </p>

				</div>

			</div>

		</div>

	</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jstat@1.9.2/dist/jstat.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/formulajs/formulajs@2.6.9/dist/formula.min.js"></script>

<script type="text/javascript">



	$(function(){



		// var tdata = ROUND(SUM(ABS(NPER(18/1200,100*-1,10000*-1,0,1))/12),2);

		// alert(tdata);



		// var mydata = CUMPRINC(22/1200, 4.23*12, 8000, 1, 2*12, 1);

		// alert(mydata);



		// var mydata2 = CUMIPMT(22/1200, 2.23*12, 5021.48, 1, 2.23*12, 1);

		// alert(mydata2);



		var total_balance = 0;

		var total_min_pay = 0;

		var total_int_save = 0;

		var max_yr_for = [];

		var max_yr_to = [];

		var total_int_sum = 0;

		var total_row = 0;

		$('table tbody tr').each(function(index){
			total_row = index;

			var inc = index  + 1;

			var interest = $(this).find('td#int'+inc).attr('data-attr');

			var min_pay =  $(this).find('td#min'+inc).attr('data-attr');

			total_min_pay = total_min_pay + parseFloat(min_pay);

			// var yrs_to = $(this).find('td#yrs_to_payoff'+inc).attr('data-attr');

			var amount = $(this).find('td#amt'+inc).attr('data-attr');

			total_balance = total_balance + parseFloat(amount);  
			var yr_payoff = $(this).find('td#yr_fnd_payoff'+inc).attr('data-attr');  
			var nper = ROUND(SUM(ABS(NPER(interest / 1200, min_pay * -1, amount * -1, 0, 1))/12),2); 
			nper = nper.toFixed(2); 
			// alert(nper); 

			var cumprinc = ABS(CUMPRINC(interest / 1200, nper * 12, amount, 1, yr_payoff * 12, 1));

			cumprinc = cumprinc.toFixed(2);

			// alert(cumprinc);



			// CUMIPMT(22/1200, 2.23*12, 5021.48, 1, 2.23*12, 0);



			var remaining_payoff = nper-yr_payoff;

			remaining_payoff = remaining_payoff.toFixed(2);

			var principal_remaining_payoff = amount - cumprinc;



			var int_save = ABS(CUMIPMT(interest / 1200, remaining_payoff * 12, principal_remaining_payoff, 1, remaining_payoff * 12, 1));

			int_save = int_save.toFixed(2);

			total_int_save = total_int_save + parseFloat(int_save);



			// CUMPRINC(interest / 1200, nper * 12, amount, 1, yr_payoff * 12, 1);

			// alert(int_save);


			var  loan_on_interest = ABS(parseFloat(CUMIPMT(interest / 1200, remaining_payoff * 12, amount, 1, remaining_payoff * 12, 1)));
			loan_on_interest = loan_on_interest.toFixed(2);

			total_int_sum = total_int_sum + parseFloat(loan_on_interest);


			// alert(loan_on_interest);



			$(this).find('td#yrs_to_payoff'+inc).attr('data-attr', nper);

			$(this).find('td#yrs_to_payoff'+inc).html(nper);



			$(this).find('td#int_saved'+inc).attr('data-attr', int_save);

			$(this).find('td#int_saved'+inc).html('$'+int_save);



			$(this).find('td#principle_paidoff'+inc).attr('data-attr', cumprinc);

			$(this).find('td#principle_paidoff'+inc).html('$'+cumprinc);



			$(this).find('td#principle_remaining'+inc).attr('data-attr', principal_remaining_payoff);

			$(this).find('td#principle_remaining'+inc).html('$'+principal_remaining_payoff);



			$(this).find('td#remaining_payoff'+inc).attr('data-attr', remaining_payoff);

			$(this).find('td#remaining_payoff'+inc).html(remaining_payoff);


			$(this).find('td#interest_total'+inc).attr('data-attr', loan_on_interest);
			$(this).find('td#interest_total'+inc).html(loan_on_interest);





			max_yr_for.push(yr_payoff);

			max_yr_to.push(nper);

			 

			// var trdata = $(this).html();

			// console.log(trdata);

			// alert(trdata);

		});

		 

		var max1 = Math.max(...max_yr_for);
		var max2 = Math.max(...max_yr_to);
		total_int_sum = total_int_sum.toFixed(2);

		var new_monthly_payment = $('#myCsvData').val();
		new_monthly_payment = parseFloat(new_monthly_payment).toFixed(2);

		var net_death = '<?php echo $xl_net_death ?>';
		if(net_death != ''){
			net_death = parseFloat(net_death);
			net_death.toFixed(2);
		}

		var accumulation = '<?php echo $xl_accumulation ?>';
		if(accumulation != ''){
			accumulation = parseFloat(accumulation);
			accumulation.toFixed(2);
		}

		var surrender = '<?php echo $xl_surrender ?>';
		if(surrender != ''){
			surrender = parseFloat(surrender);
			surrender.toFixed(2);
		}


		var cash_value = ABS(accumulation - total_balance);

		if(total_row > 0){
			var str = '<tr class="infotbl"> <td></td> <td></td> <td>$'+ total_balance +'</td> <td>New</td> <td> Old </td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';

			str += '<tr class="infotbl"> <td></td> <td colspan="2">Monthly Payment</td> <td>'+ new_monthly_payment +'</td> <td> $' + total_min_pay + ' </td> <td></td> <td></td> <td> $' + total_int_save + '</td> <td></td> <td></td> <td></td> <td></td></tr>';



			str += '<tr class="infotbl"> <td></td> <td colspan="2">Payoff Years</td> <td> ' + max1 + ' </td> <td> ' + max2 + ' </td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';

			

			str += '<tr class="infotbl"> <td></td> <td colspan="2">Interest Paid</td> <td> $' + total_int_sum + ' </td> <td> $' + (total_int_sum - total_int_save).toFixed(2) + ' </td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';



			str += '<tr class="infotbl"> <td></td> <td colspan="2">Death Benefit</td> <td>$ '+ net_death.toFixed(2) +' </td> <td> 0 </td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';



			str += '<tr class="infotbl"> <td></td> <td colspan="2">Cash Value</td> <td> $'+ cash_value.toFixed(2)  +' </td> <td> 0 </td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';

			

			str += '<tr class="infotbl"> <td></td> <td colspan="2">Investment Earning Interest</td> <td>$'+ surrender.toFixed(2)+' </td> <td> 0 </td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';

			$('table tbody').append(str);		 


			interestPaid(total_int_sum, (total_int_sum - total_int_save).toFixed(2));		
			monthlyPayment(new_monthly_payment, total_min_pay);
			payoffYears(max1, max2);
		}
	})

	function printInsurancePDF(){

		var tabledata = $('#mytable').html();

		// alert(tabledata);

		$('#pdfContent').val(tabledata); 

		console.log(tabledata);

		$('#printPDF').submit()

	}



	function sendInsuranceEmail(){

		var tabledata = $('#mytable').html();

		if(tabledata != ''){

			tabledata = '<table border="1" style="border:1px solid #e1e1e1; width:100%; ">' + tabledata + '</table>';

		}



		$('#dispmsg').removeClass(' alert alert-info');

	    $('#dispmsg').removeClass(' alert alert-success');

	    $('#dispmsg').removeClass(' alert alert-danger');



	    $('#dispmsg').html('Please wait');

	    $('#dispmsg').show().delay(5000).fadeOut();

	    $('#dispmsg').addClass(' alert alert-info'); 



	    $.ajax({



	        url: '../mail-sender/send-mail.php',

	        type: "POST",

	        data:{

	        	tabledata : tabledata,

	        	clent_code : '<?php echo $c_code; ?>'

	        },

	        success: function (data) { 



	            $('#dispmsg').removeClass(' alert alert-info');

	            if(data == "success"){

	                $('#dispmsg').html('Successfully sent on your email.');

	                $('#dispmsg').show().delay(5000).fadeOut();

	                $('#dispmsg').addClass(' alert alert-success');

	                return true; 

	            } 

	            if(data == "error"){

	                $('#dispmsg').html('Error to submit your request, retry');

	                $('#dispmsg').show().delay(5000).fadeOut();

	                $('#dispmsg').addClass(' alert alert-danger');

	                return false;

	            }

	            $('#dispmsg').html(data);

	            $('#dispmsg').show().delay(5000).fadeOut();

	            $('#dispmsg').addClass(' alert alert-danger');

	        }

	    });

	}




function interestPaid(val1, val2){
	var xValues = ["New", "Old", ""];
	var yValues = [val1, val2, 0];
	var barColors = ["green", "red", "#fff"];

	new Chart("interesrpaid", {
	  type: "bar",
	  data: {
	    labels: xValues,
	    datasets: [{
	      backgroundColor: barColors,
	      data: yValues
	    }]
	  },
	  options: {
	    legend: {display: false},
	    title: {
	      display: true,
	      text: "Interest Paid"
	    }
	  }
	});
}

// monthlypayment payoffyears
function monthlyPayment(val1, val2){
	var xValues = ["New", "Old", ""];
	var yValues = [val1, val2, 0];
	var barColors = ["green", "red", "#fff"];

	new Chart("monthlypayment", {
	  type: "bar",
	  data: {
	    labels: xValues,
	    datasets: [{
	      backgroundColor: barColors,
	      data: yValues
	    }]
	  },
	  options: {
	    legend: {display: false},
	    title: {
	      display: true,
	      text: "Monthly Payment"
	    }
	  }
	});
}

function payoffYears(val1, val2){
	var xValues = ["New", "Old", ""];
	var yValues = [val1, val2, 0];
	var barColors = ["green", "red", "#fff"];

	new Chart("payoffyears", {
	  type: "bar",
	  data: {
	    labels: xValues,
	    datasets: [{
	      backgroundColor: barColors,
	      data: yValues
	    }]
	  },
	  options: {
	    legend: {display: false},
	    title: {
	      display: true,
	      text: "Payoff Years"
	    }
	  }
	});
}
	 



</script>

</section>

<?php include 'footer.php' ?>



