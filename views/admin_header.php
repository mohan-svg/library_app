<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online | Library</title>
  <link rel="icon" href="<?php echo base_url('images/logo-icon/favicon-54.png'); ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
 
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
  <!--Select 2-->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style type="text/css">
  .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #2f3562;
}

.skin-blue .main-header .navbar {
    background-color: #c4191f;
}

.skin-blue .main-header .navbar .sidebar-toggle:hover {
    background-color: #c4191f;
}

.btn-primary{
  background-color: #2f3562!important;
  border-color: #2f3562!important;
}

.skin-blue .main-header .logo {
  background-color: #2f3562;
}

.skin-blue .main-header .logo:hover {
  background-color: #2f3562;
}

@media screen and (min-width:640px){
  label, li>a{
  font-size: 16px;
}
}

@media screen and (max-width:640px){
  label, li>a{
  font-size: 14px;
}
}

.main-header .logo {

  overflow: unset;
  }

  .d-block{
  display: block;
}

.invaleed-feedback {
    display: block;
    width: 100%;
    margin-top: .25rem;
    /*font-size: 80%;*/
    color: #dc3545;
}

.is-invalid{
  border-color: #dc3545;
}

.modalHeader{
    color: #fff;
    background: #2f3562!important;
}

.red{
      color: red;
  }

  .modalBody{
    background: #f4f6ff;
    color:#2f3562!important;
  }

  .close{
    font-size: 40px;
    color: #c4191f;
    opacity: 0.8;
  }

</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img class="img-responsive" src="<?php echo base_url('images/logo-icon/favicon-54.png')?>"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="margin-top:15px;"><img class="img-responsive" src="<?php echo base_url('images/logo-icon/shahoverseas.png')?>"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
         <!--  <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
               
                <ul class="menu">
                 
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> -->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
                                
            </ul>
          </li> -->
          <li> <div><a href="<?php echo site_url('admin_logout'); ?>" class="btn btn-warning" style="color: white; background-color:green; margin-top: 10px; margin-left: 10px; margin-right:20px; ">Log Out</a> </div> </li>
                                     
        </ul>
      </div>
    </nav>
  </header>