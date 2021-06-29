<?php include 'header.php' ?>

<section class="Banner">

	<div id="demo" class="carousel slide" data-ride="carousel">



		<!-- Indicators -->

		<!-- <ul class="carousel-indicators">

			<li data-target="#demo" data-slide-to="0" class="active"></li>

			<li data-target="#demo" data-slide-to="1"></li>

			<li data-target="#demo" data-slide-to="2"></li>

		</ul> -->



		<!-- The slideshow -->

		<div class="carousel-inner">

			<div class="carousel-item active">

				<img src="<?php echo $base_url.$pageDetailsRow['banner'];?>" alt="Banner Image" />

			</div>

			<!-- <div class="carousel-item">

				<img src="assets/images/banner2.jpg" alt="Banner Image" />

			</div> -->



			<div class="OnBannerText">

				<div class="container">

					<div class="BannerText">

						<h3><?php echo $pageDetailsRow['main_title'];?></h3>

						<div class="row">

							<div class="col-md-4">

								<div class="BannerSingleBox">

									<h2>1</h2>

									<h4><?php echo $pageDetailsRow['title_1'];?></h4>

									<p><?php echo $pageDetailsRow['desc_1'];?></p>

								</div>

							</div>

							<div class="col-md-4">

								<div class="BannerSingleBox">

									<h2>2</h2>

									<h4><?php echo $pageDetailsRow['title_2'];?></h4>

									<p><?php echo $pageDetailsRow['desc_2'];?></p>

								</div>

							</div>

							<div class="col-md-4">

								<div class="BannerSingleBox">

									<h2>3</h2>

									<h4><?php echo $pageDetailsRow['title_3'];?></h4>

									<p><?php echo $pageDetailsRow['desc_3'];?></p>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>



		<!-- Left and right controls -->

		<!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">

			<span class="carousel-control-prev-icon"></span>

		</a>

		<a class="carousel-control-next" href="#demo" data-slide="next">

			<span class="carousel-control-next-icon"></span>

		</a> -->



	</div>

</section>





<section class="Debt">

	<div class="container">

		<div class="Heading">

			<h4>Enter Each Debt</h4>

			<div class="Angle">

				<img src="assets/images/down-arrow.png" alt="Angle" />

			</div>

		</div>

		<form id="formcalculate" method="POST" action="run-iul.php?cc=<?=$company_code?>">
			<div class="DebtSearch" id="DebtSearch">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="usr">Debit Category</label>
							<input type="text" name="debit_category1" id="debit_category1" class="form-control" placeholder="Debt Type" />
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="usr">Company</label>
							<input type="text" name="company_name1" id="company_name1" class="form-control" placeholder="Company" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="usr">Balance</label>
							<input type="number" step="any" min="1"  name="balance1" id="balance1" class="form-control" placeholder="Balance" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="usr">Interest Rate</label>
							<input type="number" step="any" name="interest_rate1" id="interest_rate1" class="form-control" placeholder="Interest Rate" min="0" value="0" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="usr">Min Payment</label>
							<input type="number" step="any"  name="min_payment1" id="min_payment1" class="form-control" placeholder="Min Payment" min="1" value="0" />
						</div>
					</div>

					<!-- <div class="col-md-2">
						<div class="form-group">
							<label for="usr">Yr Fnd Avai. Payoff</label>
							<input type="number" step="any"  name="yearfundpayoff1" id="yearfundpayoff1" class="form-control" placeholder="Year Funds Available for Payoff"  min="1" value="0" />
						</div>
					</div> -->

					<input type="hidden"  name="newrow" id="newrow"  value="1" />
				</div> 
			</div>

			<div class="DebtSearch">
				<div class="col-md-12 text-center">
					<button type="button" class="btn" onclick="addNewRow();">Add New</button>
					<button type="submit" class="btn">Run Illustration</button>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="Details">

	<div class="container">

		<div class="Heading">

			<h4>Details</h4>

			<div class="Angle">

				<img src="assets/images/down-arrow.png" alt="Angle" />

			</div>

		</div>

		<?php 

		$csvDataSql = "SELECT * FROM csv_data WHERE company_code='$company_code' ORDER BY created_on DESC LIMIT 1";
		$csvDataQuery = mysqli_query($con,$csvDataSql);
		$csvDataRow = mysqli_fetch_assoc($csvDataQuery);
		$CSV_heading = json_decode($csvDataRow['data']);

		?>

		<div class="Table">			

			<table class="table table-bordered">

				<thead>

					<tr>

						<?php

						foreach ($CSV_heading[0] as $key => $value) {

							echo '<th>'.$key.'</th>';	

						}

						?>

			

					</tr>

				</thead>

				<tbody>

					<tr>

						<?php

		

							foreach ($CSV_heading as $csv_value) {

								echo '<tr>';

								foreach ($csv_value as $value) {



							echo '<td>'.$value.'</td>';	

						}

						echo '</tr>';

					}

						?>



						

					</tr>

					

				</tbody>

			</table>

		</div>

	</div>

</section>

<?php include 'footer.php' ?>


<div id="addnewDemo" style="display: none;">
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label for="usr">Debit Category</label>
				<input type="text" name="debit_category@demo@" id="debit_category@demo@" class="form-control" placeholder="Debt Type" />
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label for="usr">Company</label>
				<input type="text" name="company_name@demo@" id="company_name@demo@" class="form-control" placeholder="Company" />
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label for="usr">Balance</label>
				<input type="number" step="any" min="1" name="balance@demo@" id="balance@demo@" class="form-control" placeholder="Balance" />
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label for="usr">Interest Rate</label>
				<input type="number" step="any" name="interest_rate@demo@" id="interest_rate@demo@" class="form-control" placeholder="Interest Rate" min="0" value="0" />
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label for="usr">Min Payment</label>
				<input type="number" step="any"  min="1" name="min_payment@demo@" id="min_payment@demo@" class="form-control" placeholder="Min Payment" value="0" />
			</div>
		</div>
		<!-- <div class="col-md-2">
			<div class="form-group">
				<label for="usr">Yr Fnd Avai. Payoff</label>
				<input type="number" step="any"  min="1" name="yearfundpayoff@demo@" id="yearfundpayoff@demo@" class="form-control" placeholder="Year Funds Available for Payoff" value="0" />
			</div>
		</div> -->

		 
	</div>
</div>

<script type="text/javascript">
	$(function(){

	});
	function addNewRow(){
		var newrowid = $('#newrow').val();
		var createRow = 0;
		if(newrowid != ''){
			createRow = parseInt(newrowid);
			createRow = createRow + 1;
		}

		var htmlText = $('#addnewDemo').html();
		htmlText = htmlText.replaceAll('@demo@', createRow);

		// alert(htmlText);
		$('#DebtSearch').append(htmlText);
		$('#newrow').val(createRow);

	}
</script>