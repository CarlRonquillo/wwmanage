<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Work & Witness Manage</title>
  <link rel="stylesheet" href="<?php echo base_url("assets/stylesheets/bootstrap.min.css"); ?>"/>
  <link rel="stylesheet" href="<?php echo base_url("assets/stylesheets/mdb.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/stylesheets/datatables.min.css"); ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  
</head>
<body class="fixed-sn white-skin">
        <div id="slide-out" class="side-nav sn-bg-3 fixed">
            <ul class="custom-scrollbar">
            <!-- Logo -->
            <li class="logo-sn waves-effect">
                <div class="text-center">
                    <a href="#" class="pl-0"><img alt="Brand" style="width: 200px;" class="img-responsive" src="<?php echo base_url("assets/images/WW - logo.png"); ?>"></a>
                </div>
            </li>
            <!--/. Logo -->

            <!--Search Form-->
            <li>
                <form class="search-form" role="search">
                    <div class="form-group md-form mt-0 pt-1 waves-light">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            </li>
            <!--/.Search Form-->
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><?php echo anchor("","<i class='fa fa-tachometer-alt'></i> Dashboard",["class" => "collapsible-header waves-effect arrow-r"]); ?>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-legal" aria-hidden="true"></i> Projects<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <?php if($this->session->userdata('Role') == 2 or $this->session->userdata('Role') == 1)
                                { ?>
                                    <li> <?php echo anchor("Project/new","Add Project",["class" => "waves-effect"]); ?> </li>
                                <?php } ?>
                                <li><?php echo anchor("Project/list","View Projects",["class" => "waves-effect"]); ?></li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-group" aria-hidden="true"></i> Teams<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><?php echo anchor("Teams/list","Teams List",["class" => "waves-effect"]); ?>
                                </li>
                                <li><?php echo anchor("Teams/new","Register Team",["class" => "waves-effect"]); ?>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-star" aria-hidden="true"></i> Regional Priorities<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="../css/grid.html" class="waves-effect">Grid system</a>
                                </li>
                                <li><a href="../css/media.html" class="waves-effect">Media object</a>
                                </li>
                                <li><a href="../css/utilities.html" class="waves-effect">Utilities / helpers</a>
                                </li>
                                <li><a href="../css/code.html" class="waves-effect">Code</a>
                                </li>
                                <li><a href="../css/icons.html" class="waves-effect">Icons</a>
                                </li>
                                <li><a href="../css/images.html" class="waves-effect">Images</a>
                                </li>
                                <li><a href="../css/typography.html" class="waves-effect">Typography</a>
                                </li>
                                <li><a href="../css/animations.html" class="waves-effect">Animations</a>
                                </li>
                                <li><a href="../css/colors.html" class="waves-effect">Colors</a>
                                </li>
                                <li><a href="../css/hover.html" class="waves-effect">Hover effects</a>
                                </li>
                                <li><a href="../css/masks.html" class="waves-effect">Masks</a>
                                </li>
                                <li><a href="../css/shadows.html" class="waves-effect">Shadows</a>
                                </li>
                                <li><a href="../css/skins.html" class="waves-effect">Skins</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-pie-chart" aria-hidden="true"></i> Reports<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="../components/buttons.html" class="waves-effect">Buttons</a>
                                </li>
                                <li><a href="../components/cards.html" class="waves-effect">Cards</a>
                                </li>
                                <li><a href="../components/panels.html" class="waves-effect">Panels</a>
                                </li>
                                <li><a href="../components/list.html" class="waves-effect">List group</a>
                                </li>
                                <li><a href="../components/pagination.html" class="waves-effect">Pagination</a>
                                </li>
                                <li><a href="../components/progress.html" class="waves-effect">Progress bars</a>
                                </li>
                                <li><a href="../components/tabs.html" class="waves-effect">Tabs & pills</a>
                                </li>
                                <li><a href="../components/tags.html" class="waves-effect">Tags, labels & badges</a>
                                </li>
                                <li><a href="../components/collapse.html" class="waves-effect">Collapse</a>
                                </li>
                                <li><a href="../components/date.html" class="waves-effect">Date picker</a>
                                </li>
                                <li><a href="../components/time.html" class="waves-effect">Time picker</a>
                                </li>
                                <li><a href="../components/tooltips.html" class="waves-effect">Tooltips</a>
                                </li>
                                <li><a href="../components/popovers.html" class="waves-effect">Popovers</a>
                                </li>
                                <li><a href="../components/stepper.html" class="waves-effect">Stepper</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-user"></i> Users<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><?php echo anchor("Users/New","Add User",["class" => "waves-effect"]); ?></li>
                                <li><?php echo anchor("Users/List","View Users",["class" => "waves-effect"]); ?></li>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Simple link -->
                    <li><a href="../alerts/alerts.html" class="collapsible-header waves-effect"><i class="fa fa-globe" aria-hidden="true"></i> Work & Witness Website</a></li>
                </ul>
            </li>
            <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <?php echo anchor("","<p style='font-size: 22px;'>WORK & WITNESS <strong class='text-warning'>MANAGE</strong></p>"); ?>
            </div>

            <!--Navbar links-->
            <ul class="nav navbar-nav nav-flex-icons ml-auto">

                <!-- Dropdown -->
                <li class="nav-item dropdown notifications-nav">
                    <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="badge red">3</span> <i class="fa fa-bell"></i>
                        <span class="d-none d-md-inline-block">Notifications</span>
                    </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                            <span>Project: <strong>Training Center</strong> approved</span>
                            <span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> 13 min</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                            <span>Project: <strong>Medical Mission</strong> approved</span>
                            <span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> 33 min</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-line-chart mr-2" aria-hidden="true"></i>
                            <span>Your campaign is about to end</span>
                            <span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> 53 min</span>
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect"><i class="fa fa-comments-o"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block"><?php echo $this->session->userdata('GivenName').' '.$this->session->userdata('FamilyName'); ?></span></a>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">My account</a>
                        <?php
                            if($this->session->userdata('Username') == 'admin')
                            {
                                echo anchor("Users/New","Add User",["class" => "dropdown-item"]);
                            }
                        ?>
                        <?php echo anchor("Users/Logout","Log out",["class" => "dropdown-item"]); ?>
                    </div>
                </li>

            </ul>
            <!--/Navbar links-->
        </nav>
        <!-- /.Navbar -->