<?php
require_once("../config/config.php");
require_once("verify_logins.php");
//$page = basename($_SERVER['REQUEST_URI'],'.php');
$page = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?=base_url?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?=base_url?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=base_url?>plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url?>plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link href="<?=base_url?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
<!-- Main Header -->
<header class="main-header">
  <!-- Logo -->
  <a href="javascript:void();" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>Admin</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Admin</b></span> </a>
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation </span> </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Tasks Menu -->
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="logout.php" >
          <!-- The user image in the navbar-->
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">Sign out</span> </a> </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>
  </nav>
	</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- <li class="header">Menu</li>-->
      <!-- Optionally, you can add icons to the links -->
      <li class="<?=($page=='dashboard') ? 'active' : '' ?>"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
     

      <li class="treeview <?=($page=='list_homebanner' || $page=='list_video' ||$page=='list_image' ||$page=='add_video' ||$page=='add_image'|| $page=='add_homebanner' ||  $page=='add_homebanner' || $page=='list_signup' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-home'></i> <span>Manage Home</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_homebanner') ? 'active' : '' ?>"><a href="list_homebanner.php">List Home Banner</a></li>
          <li class="<?=($page=='add_homebanner') ? 'active' : '' ?>"><a href="add_homebanner.php">Add Home Banner</a></li>
        </ul>
		
		<ul class="treeview-menu">
          <li class="<?=($page=='list_image') ? 'active' : '' ?>"><a href="list_image.php">List Astral Image</a></li>

        </ul>
		<ul class="treeview-menu">
          <li class="<?=($page=='list_video') ? 'active' : '' ?>"><a href="list_video.php">List Astral Video</a></li>

        </ul>
		 <ul class="treeview-menu">
          <li class="<?=($page=='list_signup') ? 'active' : '' ?>"><a href="list_signup.php">Newsletter Subscription</a></li>

        </ul>
      </li>

      <li class="treeview <?=($page=='list_pages' || $page=='add_page' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-file-text-o'></i> <span>Manage Content</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_pages') ? 'active' : '' ?>"><a href="list_pages.php">List Pages</a></li>
          <li class="<?=($page=='add_page') ? 'active' : '' ?>"><a href="add_page.php">Add Page</a></li>
        </ul>
      </li>
	  
      
       <li class="treeview <?=($page=='list_enquiry_records' || $page=='list_contact_records'  ) ? 'active' : '' ?>">
      	<a href="#"><i class='fa fa-tasks'></i> <span>Manage Records</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
        	 <li class="<?=($page=='list_contact_records') ? 'active' : '' ?>"><a href="list_contact_records.php">List Contact Records</a></li>
            <li class="<?=($page=='list_enquiry_records') ? 'active' : '' ?>"><a href="list_enquiry_records.php">List Enquiry Records</a></li>
        
        </ul>
      </li>
      
      
      <li class="treeview <?=($page=='list_categories' || $page=='add_categories' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-list-ul'></i> <span>Manage Categories</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_categories') ? 'active' : '' ?>"><a href="list_categories.php">List Categories</a></li>
          <li class="<?=($page=='add_categories') ? 'active' : '' ?>"><a href="add_categories.php">Add Categories</a></li>
        </ul>
      </li>
	  <li class="treeview <?=($page=='list_brand' || $page=='add_brand' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-file-text-o'></i> <span>Manage Brands</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_brand') ? 'active' : '' ?>"><a href="list_brand.php">List Brands</a></li>
          <li class="<?=($page=='add_brand') ? 'active' : '' ?>"><a href="add_brand.php">Add Brands</a></li>
        </ul>
      </li>
      <li class="treeview <?=($page=='list_product' || $page=='add_product' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage Products</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_product') ? 'active' : '' ?>"><a href="list_product.php">List Product</a></li>
          <li class="<?=($page=='add_product') ? 'active' : '' ?>"><a href="add_product.php">Add Product</a></li>
        </ul>
      </li>
     
	  
	  
	  <li class="treeview <?=( $page=='list_pressrelease'  || $page=='add_pressrelease') ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage Press</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
        
		  
		    <li class="<?=($page=='list_pressrelease') ? 'active' : '' ?>"><a href="list_pressrelease.php">List Pressrelease</a></li>
          <li class="<?=($page=='add_pressrelease') ? 'active' : '' ?>"><a href="add_pressrelease.php">Add Pressrelease</a></li>
		  
        </ul>
		
      </li>
	  <li class="treeview <?=($page=='add_event' || $page=='list_event' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage Event</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_event') ? 'active' : '' ?>"><a href="list_event.php">List Event</a></li>
          <li class="<?=($page=='add_event') ? 'active' : '' ?>"><a href="add_event.php">Add Event</a></li>
		  	</ul>
		
      </li>
	  <li class="treeview <?=($page=='list_testimonial' || $page=='add_testimonial' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage Testimonial</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_testimonial') ? 'active' : '' ?>"><a href="list_testimonial.php">List Testimonial</a></li>
          <li class="<?=($page=='add_testimonial') ? 'active' : '' ?>"><a href="add_testimonial.php">Add Testimonial</a></li>
		  	</ul>
		
      </li>
	  <li class="treeview <?=($page=='add_faq' || $page=='list_faq' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage FAQ</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_faq') ? 'active' : '' ?>"><a href="list_faq.php">List FAQ</a></li>
          <li class="<?=($page=='add_faq') ? 'active' : '' ?>"><a href="add_faq.php">Add FAQ</a></li>
		  
		    </ul>
		
      </li>
      <li class="treeview <?=($page=='add_milestone' || $page=='list_milestone' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage Milestone</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_milestone') ? 'active' : '' ?>"><a href="list_milestone.php">List Milestone</a></li>
          <li class="<?=($page=='add_milestone') ? 'active' : '' ?>"><a href="add_milestone.php">Add Milestone</a></li>
      
        </ul>
    
      </li>
        <li class="treeview <?=($page=='add_newsletter' || $page=='list_newsletter' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage Download</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_newsletter') ? 'active' : '' ?>"><a href="list_newsletter.php">List Download</a></li>
          <li class="<?=($page=='add_newsletter') ? 'active' : '' ?>"><a href="add_newsletter.php">Add Download</a></li>
      
    </ul>
    
      </li>
      
      <li class="treeview <?=($page=='list_career' || $page=='add_career' || $page=='list_career_applay' || $page=='list_future_job_applicants' || $page=='list_applied_users' ) ? 'active' : '' ?>">
      <a href="#"><i class='fa fa-tasks'></i> <span>Manage Careers</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="<?=($page=='list_career') ? 'active' : '' ?>"><a href="list_career.php">List Careers</a></li>
          <li class="<?=($page=='add_career') ? 'active' : '' ?>"><a href="add_career.php">Add Careers</a></li>
          <li class="<?=($page=='list_career_applay') ? 'active' : '' ?>"><a href="list_applied_users.php">List Career Apply</a></li>
		   <li class="<?=($page=='list_career_applay') ? 'active' : '' ?>"><a href="list_future_job_applicants.php">List Future Job Apply</a></li>
        </ul>
      </li>
      
     <!-- <li class="<?=($page=='quick_connect') ? 'active' : '' ?>"><a href="quick_connect.php"><i class="fa fa-cog"></i> <span>Manage Quick Connect</span> </a></li>-->
      
      <li class="<?=($page=='changepassword') ? 'active' : '' ?>"><a href="changepassword.php"><i class="fa fa-cog"></i> <span>Change Password</span> </a></li>
      <li class="<?=($page=='logout') ? 'active' : '' ?>"><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Sign out</span> </a></li>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
