<!-- <!DOCTYPE html> -->

<?php 
// print_r($this->session->userdata('admin')['image']);   

$profile_img = base_url('assets/admin/images/admin-profile.png');
if($this->session->userdata('admin')['image'] != "") {
  $profile_img = base_url('assets/admin/images/').$this->session->userdata('admin')['image'];
}

$active = $this->uri->segment(2);  

?>

<style type="text/css">
  .submenu a{
    color: #fff;
  }

  .submenu.active{
    display: block;
  }
  .submenu{
    display: none;
  }
  .sidebar .user-panel>.image>img {
    width: 50px !important;
    max-width: 89px;
    height: 45px !important;
}
.btn-primary {
    color: #fff;
    background-color: #337ab7 !important;
    border-color: #2e6da4 !important;
}

.page_search{
    float: right;
    margin-top: -29px;

}
</style>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href=" logo.png" type="image/x-icon">
    <!-- CSS-->

    <title>INSURANCE | ADMIN </title>


    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/main.css'); ?>">
    <script src="<?php echo base_url('assets/admin/js/jquery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/plugins/pace.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/main.js'); ?>"></script>
     <script src="https://www.viralpatel.net/demo/jquery/jquery.shorten.1.0.js"></script>
     
    <style>
        .logoTitle{
            font-size: 25px;
            text-align: center;
        }
    </style>
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
    <header class="main-header hidden-print"><a class="logo text-uppercase" href="#"> INSURANCE
   </a>
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
    <!-- Navbar Right Menu-->
    <div class="navbar-custom-menu">
      <ul class="top-nav">
        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu">
            <!-- <li><a href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li> -->
            <li><a href="<?php echo base_url('admin/logout') ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Side-Nav-->
<aside class="main-sidebar hidden-print">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
          <img class="img-circle" src="<?php echo $profile_img; ?>" alt="User Image">
          <!--<div class="logoTitle">GEEV</div>-->
        </div>
      <div class="pull-left info">
        <p>SUPER ADMIN</p>
        <p class="designation text-uppercase">INSURANCE </p>
      </div>
    </div>
    <!-- Sidebar Menu-->
    <ul class="sidebar-menu">

      <li class="<?php if($active == 'dashboard'){ echo 'active'; } ?> "><a href="<?php echo base_url('admin/dashboard') ?>">
        <i class="fa fa-dashboard"></i><span>Company</span></a>
      </li>
      
      <li class="<?php if($active == 'CSV-Format'){ echo 'active'; } ?> "><a href="<?php echo base_url('admin/CSV-Format') ?>">
        <i class="fa fa-dashboard"></i><span>CSV Format</span></a>
      </li>
      
      <li class="<?php if($active == 'CSV-Data'){ echo 'active'; } ?> "><a href="<?php echo base_url('admin/CSV-Data') ?>">
        <i class="fa fa-dashboard"></i><span>CSV Data</span></a>
      </li>

      <li class="<?php if($active == 'Landing-page-setting'){ echo 'active'; } ?> "><a href="<?php echo base_url('admin/Landing-page-setting')?>">
        <i class="fa fa-dashboard"></i><span>Landing Page Setting</span></a>
      </li>
      
      

     
       
    </ul>
  </section> 
</aside>

<script type="text/javascript">
  $(function(){
      $('.mainmenu').click(function(){
          $('.submenu').removeClass(' active').slideUp();
          $(this).find('ul.submenu').addClass(' active').slideToggle();
      })
  })
</script>