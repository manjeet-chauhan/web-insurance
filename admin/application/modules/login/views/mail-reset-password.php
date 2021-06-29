
<!DOCTYPE html>
<html>
<head>
	<title>Memoirs Password</title>
	<style>
	*{
		margin:0;
		padding:0;
	}

	.email_templet{
		width:100%;
		height:100vh;
		/*background-color:#889CA4;*/
		display:flex;
		align-items: center;
		justify-content: center;
	}

	.email_templet_main{
		width:50%;
		height:90vh;
		background-color:#fff;
	}

	.email_templet_logo{
		width:100%;
		height:20vh;
		display:flex;
		align-items: center;
		justify-content: center;
		background-color: #000;
	}

	.email_templet_logo img{
		width:50px;
	}

	.email_templet_content{
		width:100%;
		height:70vh;
		text-align: center;
		background-color: #039BC9;
	}

	.email_templet_content h1{
		font-weight: bold;
		font-weight: 999;
		color:#fff;
		padding-top:90px;
		font-size:36px;
	}

	.email_templet_content p{
		color:#fff;
		padding-top:25px;
		width:80%;
		margin:0 auto;
		font-size:17px;
	}

	.email_templet_content a{
		margin-top:25px;
		padding:10px 20px 10px 20px;
		font-weight: bold;
		font-weight: 999;
		border-radius: 10px;
		outline: none;
		border:none;
		background-color:#fff;
	}

	.email_templet_content a{
		line-height: 30px;
		color:#00A3E4;
	}

	.email_templet_content h3{
		color:#fff;
		padding-top: 10px;
		font-size:24px;
	}
</style>
</head>
<body>
	<section class="email_templet">
		<div class="email_templet_main">
			<div class="email_templet_logo">
				<img src="http://homeofbulldogs.com/dev/memoirs/assets/frontend/images/logo.png" style="width: 200px;height: 100px;" >
			</div>
			<div class="email_templet_content">
				<h1>Hi,<?php echo $name ?>!</h1>
				<p>Click on Reset  password button  to  reset your password.</p>
				<p></p>
				<a href="<?php echo $reset_link ?>">RESET PASSWORD</a>
				<p></p>
				<!-- <a href="http://homeofbulldogs.com/dev/uneedwat/"> UNEEDWAT | HOME </a> -->
				<h3>Thanks and welcome!</h3>
			</div>
		</div>
	</section>
</body>
</html>