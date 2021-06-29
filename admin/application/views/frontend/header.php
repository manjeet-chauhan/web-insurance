<?php 

// print_r($this->session->userdata()); 
$login_data = [];
 
if(!empty($this->session->userdata())){
    $login_data = $this->session->userdata('user');

}

$activepg = $this->uri->segment(1);
 //print_r($login_data['name']);
 
$pgsettings = get_page_settings(); 
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/font/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/responsive.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="<?php echo base_url('assets/frontend/js/script.js'); ?>"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script src="ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="paging.js"></script> 
</head>


<!-- Start Navigation  -->

<?php if(!empty($login_data)) { ?>
  <section class="Header">
    <div class="container">
      <div class="row">
        <div class="Logo">
          <img src="<?php echo base_url('assets/frontend/images/logo.png');?>" alt="Logo" />
        </div>
        <div class="Navigation">
          <div class="NavigationLink">
            <ul>

             <!--  class="Active" -->
            
              <li <?php   if($this->uri->segment(1) == 'write-memoir') { ?> class="Active" <?php } ?>  ><a href="<?php echo base_url('write-memoir');?>">Write Memoir</a></li>
              <li<?php   if($this->uri->segment(1) == 'archive') { ?> class="Active" <?php } ?>  ><a href="<?php echo base_url('archive');?>">Memoir Archive</a></li>
              <li <?php   if($this->uri->segment(1) == 'home') { ?> class="Active" <?php } ?>><a href="<?php echo base_url('home');?>">My Memoir Books</a></li>
              <li <?php   if($this->uri->segment(1) == 'upgrade') { ?> class="Active" <?php } ?>><a href="<?php echo base_url('upgrade');?>">Memoir Upgrade</a></li>
              <li <?php   if($this->uri->segment(1) == 'collections') { ?> class="Active" <?php } ?>><a href="<?php echo base_url('collections');?>">Collections</a></li>
              <li <?php   if($this->uri->segment(1) == 'upcoming') { ?> class="Active" <?php } ?>  ><a href="<?php echo base_url('upcoming');?>">Coming Soon</a></li>
            </ul>
          </div>
        </div>
        <div class="Search">        
              <div class="searchbar">
                  <input class="search_input" type="text" name="" placeholder="Search...">
                  <a href="#" class="search_icon" id="SerchIcon"><i class="fa fa-search"></i></a>
              </div>
        </div>
        <div class="Profile">
          <div class="row">
            <div class="ProfileImage">
              <img src="<?php echo base_url('assets/frontend/images/2.jpg');?>" alt="Profile Image" />
            </div>
            <div class="UserDetail">
              <div class="UserName">
                <h4><?php echo $login_data['name'];?></h4>
              </div>
              <div class="UserEmail">
                <p><?php echo $login_data['email'];?></p>
              </div>
              <div class="UserEmail">
                <a href="<?php echo base_url('logout'); ?>">logout</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php } ?>
