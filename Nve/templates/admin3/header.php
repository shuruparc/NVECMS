<?php
if (!isset($_SESSION['username'])) {
    $redirectUrl=ADMIN_URL.'index.php';
    echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8">
  <title>NVE CMS</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="NVE is a Content Management System" name="description" />
  <meta content="NVE" name="author" />
  <meta name="keywords" content="CMS, NVE, Teachers, Teaching, Resources">
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
    type="text/css">
  <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">

  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL STYLES -->

  <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css" />
  <link rel="stylesheet" type="text/css"
    href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.css" />
  <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-multi-select/css/multi-select.css" />

  <!-- END PAGE LEVEL STYLES -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="script/bootbox.min.js"></script>
  <script type="text/javascript" src="script/deleteRecords.js"></script>
  <script type="text/javascript" src="script/deleteLRecords.js"></script>
  <script type="text/javascript" src="script/deleteUserRecords.js"></script>
  <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

  <link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
  <link href="../../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">

  <!-- END PAGE LEVEL PLUGIN STYLES -->

  <!-- BEGIN PAGE STYLES -->

  <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css" />

  <!-- END PAGE STYLES -->

  <!-- BEGIN THEME STYLES -->

  <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->

  <link href="../../assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
  <link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css">
  <link href="../../assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
  <link href="../../assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
  <link href="../../assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">

  <!-- END THEME STYLES -->


  <meta name="theme-color" content="#ffffff">


</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->

<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->

<body>

  <!-- BEGIN HEADER -->

  <div class="page-header">

    <!-- BEGIN HEADER TOP -->

    <div class="page-header-top">
      <div class="container-fluid">

        <!-- BEGIN LOGO -->
        <?php if ($_SESSION['role']==1 || $_SESSION['role']==3) { ?>
        <div class="page-logo"> <a href="<?php echo ADMIN_URL; ?>dashboard.php"><img
              src="../../assets/admin/layout3/img/nve-logo-sm.png" alt="logo" class="logo-default"></a> </div>
        <?php } ?>
        <?php if ($_SESSION['role']==2) { ?>
        <div class="page-logo"> <a href="<?php echo ADMIN_URL; ?>my_lesson.php"><img
              src="../../assets/admin/layout3/img/nve-logo-sm.png" alt="logo" class="logo-default"></a> </div>
        <?php }?>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->

        <a href="javascript:;" class="menu-toggler"></a>

        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->

        <div class="top-menu">
          <ul class="nav navbar-nav pull-right">

            <!-- BEGIN USER LOGIN DROPDOWN -->

            <li class="dropdown dropdown-user dropdown-dark"> <a href="javascript:;" class="dropdown-toggle"
                data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <img alt="" class="img-circle"
                  src="../../assets/admin/layout3/img/814068_face_512x512.png"> <span
                  class="username username-hide-mobile">
                  <?php echo $_SESSION['username'];?>
                </span> </a>
              <ul class="dropdown-menu dropdown-menu-default">
                <li> <a href="logout.php"> <i class="icon-key"></i> Log Out </a> </li>
              </ul>
            </li>

            <!-- END USER LOGIN DROPDOWN -->

          </ul>
        </div>

        <!-- END TOP NAVIGATION MENU -->

      </div>
    </div>

    <!-- END HEADER TOP -->

    <!-- BEGIN HEADER MENU -->

    <div class="page-header-menu">
      <div class="container-fluid">

        <!-- BEGIN MEGA MENU -->

        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->

        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->

        <!--Header For Admin Teacher and Editor As Per Roll-->
        
        <?php if ($_SESSION['role']==1) {?>
        <div class="hor-menu ">
          <ul class="nav navbar-nav">
            <li class="active"> <a href="<?php echo ADMIN_URL; ?>dashboard.php"><img alt="" class="img-circle"
                  src="../../assets/admin/layout3/img/home-512.png"></a> </li>
            <li class="menu-dropdown mega-menu-dropdown "> <a data-hover="megamenu-dropdown" data-close-others="true"
                data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"> Admin <i
                  class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="mega-menu-content">
                    <div class="row">
                      <div class="col-md-12">
                        <ul class="mega-menu-submenu" style="min-width:169px">
                          <li> <a href="<?php echo ADMIN_URL; ?>user_master.php" class="iconify"> <i
                                class="fa fa-angle-right"></i> Users</a> </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="menu-dropdown mega-menu-dropdown "> <a href="resource_hub.php" class="dropdown-toggle">Resource
                Hub </a>
            </li>
            <li class="menu-dropdown mega-menu-dropdown "> <a data-hover="megamenu-dropdown" data-close-others="true"
                data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"> Systems <i
                  class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="mega-menu-content">
                    <div class="row">
                      <div class="col-md-12">
                        <ul class="mega-menu-submenu" style="min-width:169px">
                          <li> <a href="<?php echo ADMIN_URL; ?>../../../system_checker.php" class="iconify"> <i
                                class="fa fa-angle-right"></i> Systems Checker</a></li>
                          <li> <a href="<?php echo ADMIN_URL; ?>system_checker.php" class="iconify"> <i
                                class="fa fa-angle-right"></i> Systems Checker Database</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="menu-dropdown mega-menu-dropdown "> <a data-hover="megamenu-dropdown" data-close-others="true"
                data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"> Settings <i
                  class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="mega-menu-content">
                    <ul class="mega-menu-submenu">
                      <li> <a href="<?php echo ADMIN_URL; ?>my_account.php" class="iconify"> <i
                            class="fa fa-angle-right"></i> My Account</a></li>
                      <li> <a href="<?php echo ADMIN_URL; ?>update_password.php" class="iconify"> <i
                            class="fa fa-angle-right"></i> Change Password</a> </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <?php } ?>
        <?php if ($_SESSION['role']==2) {?>
        <div class="hor-menu ">
          <ul class="nav navbar-nav">
            <li class="active"> <a href="<?php echo ADMIN_URL; ?>my_lesson.php"><img alt="" class="img-circle"
                  src="../../assets/admin/layout3/img/home-512.png"></a> </li>
            <li class="menu-dropdown mega-menu-dropdown "><a href="my_lesson.php" class="dropdown-toggle">My Lessons </a>
            </li>
            <li class="menu-dropdown mega-menu-dropdown "> <a href="resource_hub.php" class="dropdown-toggle">Resource Hub </a>
            </li>
            <li class="menu-dropdown mega-menu-dropdown "> <a data-hover="megamenu-dropdown" data-close-others="true"
                data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"> Settings <i
                  class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="mega-menu-content">
                    <ul class="mega-menu-submenu">
                      <li> <a href="<?php echo ADMIN_URL; ?>my_account.php" class="iconify"> <i
                            class="fa fa-angle-right"></i> My Account</a></li>
                      <li> <a href="<?php echo ADMIN_URL; ?>update_password.php" class="iconify"> <i
                            class="fa fa-angle-right"></i> Change Password</a> </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <?php } ?>
        <?php if ($_SESSION['role']==3) {?>
        <div class="hor-menu ">
          <ul class="nav navbar-nav">
            <li class="active"> <a href="<?php echo ADMIN_URL; ?>dashboard.php"><img alt="" class="img-circle"
                  src="../../assets/admin/layout3/img/home-512.png"></a> </li>
            <li class="menu-dropdown mega-menu-dropdown "> <a href="resource_hub.php" class="dropdown-toggle">Resource
                Hub </a></li>
            <li class="menu-dropdown mega-menu-dropdown "> <a data-hover="megamenu-dropdown" data-close-others="true"
                data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"> Settings <i
                  class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="mega-menu-content">
                    <ul class="mega-menu-submenu">
                      <li> <a href="<?php echo ADMIN_URL; ?>my_account.php" class="iconify"> <i
                            class="fa fa-angle-right"></i> My Account</a></li>
                      <li> <a href="<?php echo ADMIN_URL; ?>update_password.php" class="iconify"> <i
                            class="fa fa-angle-right"></i> Change Password</a> </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <?php } ?>
        <!-- END MEGA MENU -->

      </div>
    </div>

    <!-- END HEADER MENU -->

  </div>

  <!-- END HEADER -->