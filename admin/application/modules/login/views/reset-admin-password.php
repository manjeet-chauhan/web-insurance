
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Memoirs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url('assets/frontend/images/fav-icon.png')?>" type="image/gif" > 
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/responsive.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/plugin/bootstrap.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/plugin/font-awesome/css/font-awesome.min.css')?>">
  <script src="<?php echo base_url('assets/frontend/js/script.js')?>"></script>
  <script src="<?php echo base_url('assets/frontend/plugin/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/frontend/plugin/popper.min.js')?>"></script>
  <script src="<?php echo base_url('assets/frontend/plugin/bootstrap.min.js')?>"></script>
</head>
<body>

<!-- Start Login -->
<section class="LoginSection">
  <div class="container">
    <div class="row">
      <div class="col-md-7"></div>
      <div class="col-md-3">
        <div class="LoginCenter">
          <div class="Login">
            <div class="UserIcon">
              <img src="<?php echo base_url('assets/frontend/images/login-user-icon.png'); ?>" alt="User Icon" />

            </div>
            <div class="WelcomeText">
              <h5 style="text-align: center;">Reset Password</h5>
            </div>
            <div class="LoginForm"> 
                <div id="loginadminmsg"></div>  

     

             
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
</section>
<!-- End Login -->

<!-- Start Footer -->
  <script type="text/javascript">


    $(function(){

       $("#submitBtn").click(function(){   

        login_admin();
        
    });

    });

function login_admin(){

      $('#loginadminmsg').removeClass(' alert alert-info');
        $('#loginadminmsg').removeClass(' alert alert-success');
        $('#loginadminmsg').removeClass(' alert alert-danger');


      var username = $('#txtuseremailid').val();
      
      if(username == ""){
        $('#loginadminmsg').html('Enter your Username (email)');
            $('#loginadminmsg').show().delay(3000).slideUp(1000);
            $('#loginadminmsg').addClass(' alert alert-danger');
            $('#txtadminusername').focus();
            return false;
      }

        $.ajax({
            url: '<?php echo base_url('request-reset') ?>',
            type: "POST",
             data: {
                username: username
            },
            success: function (data) { 
               
              data = data.trim();

                if(data == "no"){
                    $('#loginadminmsg').html('Your email is not register with us.');
                    $('#loginadminmsg').show().delay(5000).slideUp(4000);
                    $('#loginadminmsg').addClass(' alert alert-danger');
                   
                    return false;
                }
                if(data == "error" || data == ""){ 

                    $('#loginadminmsg').html('Error to validate email');
                    $('#loginadminmsg').show().delay(5000).slideUp(4000);
                    $('#loginadminmsg').addClass(' alert alert-danger');
                   
                    return false;
                }
                else if(data == "success"){
                    $('#loginadminmsg').html('Mail sent on your registered email. Please click on link to reset your password');
                    $('#loginadminmsg').show().delay(5000).slideUp(4000);
                    $('#loginadminmsg').addClass(' alert alert-info');
                   
                    $('#reset').hide();
                    $('#resend').show();
                    return true;
                }
            }
        });
    }




  </script>



