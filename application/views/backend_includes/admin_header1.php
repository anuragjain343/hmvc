
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>My Vegan Trainer | <?php if($title){
        switch ($title){
        case "Dashboard":
        echo "Admin - Dashboard";break;

        case "TrinerDashboard":
        echo "Trainer - Dashboard";break;

        case "Trainer":
        echo "Admin - Trainers List";break;

        case "Customers":
        echo "Trainer - Customers List";break;

        case "Add Trainer":
        echo "Admin - Add Trainer";break;

        case "Forum List":
        echo "Admin - Forum List";break;

        case "User Details":
        echo "Admin - User Details";break;

        case "Users":
        echo "Admin - Users";break;
        
        case "Infomational Video":
        echo "Admin - Infomational Video";break;

        case "Update Video":
        echo "Admin - Update Infomational Video";break;

        case "Trainer Update Video":
        echo "Trainer - Update Infomational Video";break;

        case "Customers":
         echo "Trainer - Customers";break;

         case "Training Video trainer":
         echo "Trainer - Training Video";break;

         case "Training Video":
         echo "Admin - Training Video";break;

        case "Infomational Video trainer":
        echo "Trainer - Infomational Video";break;

        case "AddInfomationalVideoTrainer":
        echo "Trainer - Add Infomational Video";break;

        case "AddInfomationalVideoAdmin":
        echo "Admin - Add Infomational Video";break;

        case "TrainerArticleList":
        echo "Trainer - Trainer Article List";break;

        case "AdminArticleList":
        echo "Admin - Article List";break;

        case "trainerAddArticle":
        echo "Trainer - Add Article";break;

        case "AdminAddArticle":
        echo "Admin - Add Article";break;

        case "TrainerDetail":
        echo "Trainer - Article Detail";break; 

        case "AdminDetail":
        echo "Admin - Article Detail";break;

        case "TrainerEdit":
        echo "Trainer - Edit Article";break;

        case "AdminEdit":
        echo "Admin - Edit Article";break;

        case "Admin Profile":
        echo "Admin - Admin Profile";break;

        case "Trainer  Details":
        echo "Admin - Trainer  Details";break;

        case "Forum Details":
        echo "Admin - Forum Details";break;

        case "TrainerRecepieList":
        echo "Trainer - Recepie List";break;

        case "AdminRecepieList":
        echo "Admin - Recepie List";break;

        case "trainerAddRecepie":
        echo "Trainer - Add Recepie ";break;

        case "AdminAddRecepie":
        echo "Admin - Add Recepie ";break;

        case "Update Trainer":
        echo "Admin - Update Trainer";break;

       
        } } ?> </title>
    <?php $backend = base_url()."backend_assets/";?>

    <link rel="shortcut icon" type="image/png" href="<?php echo $backend;?>img/fav.png">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,600,700,700i,800,900" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/chat-application.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/style-dash.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/my-responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>js/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>custom/css/admin_custom.css">
    <?php  if(!empty($back_css)) { load_css($back_css);}?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
 <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
            $path = DEFAULT_IMAGE;

        }else{
            $path = TRAINER_PROFILE_THUMB;  
        } 
 ?>
<body id="mybody" class="iframe-container vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light"> 
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                      <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                      <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                    </ul>

                    <ul class="nav navbar-nav float-right"> 
                                <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="javascript:void(0);" data-toggle="dropdown"  onclick ="notificationList();"><i class="ficon ft-bell bell-shake" id="notification-navbar-link" ></i><span class="badge badge-pill badge-sm badge-danger badge-default badge-up badge-glow notifyCount"></span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <div class="arrow_box_right">
                    <li class="dropdown-menu-header">
                      <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
                    </li>
                    <li class="scrollable-container media-list w-100">
                        <a href="" id="anotificationList">
                        
                        </a>
                     </li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item info text-right pr-1" href="javascript:void(0)">Read all</a></li>
                  </div>
                </ul>
              </li>
                        <li class="dropdown dropdown-user nav-item">
                            <?php if(empty($_SESSION[ADMIN_USER_SESS_KEY]['image'])){ ?>
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                         <span class="avatar avatar-online">
                            <img src="<?php echo base_url(DEFAULT_IMAGE);?>" alt="avatar" ></span></a>
                            <?php }else{?>
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                         <span class="avatar avatar-online">
                            <img src="<?php echo base_url($path).$_SESSION[ADMIN_USER_SESS_KEY]['image'];?>" alt="avatar" ></span></a>
                            <?php } ?>

                        <div class="dropdown-menu dropdown-menu-right cstm-drpdwn-menu">
                            <div class="arrow_box_right">
                               <?php if(empty($_SESSION[ADMIN_USER_SESS_KEY]['image'])){ ?>
                                <a class="dropdown-item" href="#"><span class="noti-span avatar avatar-online adminProfile">
                                    <img src="<?php echo base_url(DEFAULT_IMAGE);?>" alt="avatar"><span class="user-name text-bold-700 noti-span ml-1 adminName"><?php echo $_SESSION[ADMIN_USER_SESS_KEY]['name'];?>
                                        <?php if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin')){ ?>
                                        <span class="adminTitle">Admin</span>
                                        <?php }else{  ?>
                                        <span class="adminTitle">Trainer</span>
                                        <?php } ?>
                                    </span></span></a>

                                <?php } else{ ?>
                                <a class="dropdown-item" href="#"><span class="noti-span avatar avatar-online adminProfile">
                                    <img src="<?php echo base_url($path).$_SESSION[ADMIN_USER_SESS_KEY]['image'];?>" alt="avatar"><span class="user-name text-bold-700 noti-span ml-1 adminName"><?php echo $_SESSION[ADMIN_USER_SESS_KEY]['name'];?> 
                                     <?php if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin')){ ?>
                                        <span class="adminTitle">Admin</span>
                                        <?php }else{  ?>
                                        <span class="adminTitle">Trainer</span>
                                        <?php } ?>
                                </span></span></a>
                                <?php }?>
                                <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){ $link =  base_url('admin/trainers/editTrainerProfile'); } ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo $link;?>"><i class="ft-user"></i> Edit Profile</a><a class="dropdown-item" href="<?php echo $link;?>"><i class="ft-settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="<?php echo base_url().'admin/adminLogout'?>"><i class="ft-power"></i> Logout</a>

                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="<?php echo $backend; ?>img/">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
            <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url().'admin';?>"><img class="brand-logo" alt="Chameleon admin logo" src="<?php echo $backend; ?>img/logo.png"/><img class="brand-logo-fav" alt="Chameleon admin logo" src="<?php echo $backend; ?>img/fav.png"/>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content" id="mynav">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          
           <!--  <li class=" nav-item"><a href="#"><i class="ft-users"></i><span class="menu-title">Users</span></a></li> -->
            <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
              <li class=" nav-item"><a href="<?php echo base_url().'admin/dashboard';?>"><i class="ft-home"></i><span class="menu-title">Dashboard</span></a></li>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/users';?>"><i class="ft-users"></i><span class="menu-title">Users</span></a></li>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/trainers';?>"><i class="ft-life-buoy"></i><span class="menu-title">Trainers</span></a></li>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/forum';?>"><i class="ft-list"></i><span class="menu-title">Forum</span></a></li>
            <?php }else{ ?>
              <li class=" nav-item"><a href="<?php echo base_url().'admin/trainers/dashboard';?>"><i class="ft-home"></i><span class="menu-title">Dashboard</span></a></li>
             <li class=" nav-item"><a href="<?php echo base_url().'admin/trainers/customers';?>"><i class="ft-users"></i><span class="menu-title">Customers</span></a></li>
             <li class=" nav-item"><a href="<?php echo base_url().'admin/forum';?>"><i class="ft-list"></i><span class="menu-title">Forum</span></a></li>
            <?php } ?>
             
             <li class=" nav-item"><a href="<?php echo base_url().'admin/recepie'?>"><i class="ft-book"></i><span class="menu-title">Recipes</span></a></li>
            <li class=" nav-item"><a href="#"><i class="ft-video"></i><span class="menu-title">Videos</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="<?php echo base_url().'admin/video'?>">Informational Videos</a></li>
                  <li><a class="menu-item" href="<?php echo base_url().'admin/video/trainingVideo'?>">Training Videos</a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="ft-clipboard"></i><span class="menu-title">Nutrition Guidance</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="#">How Does MyVegan Trainer Diet Works</a></li>
                  <li><a class="menu-item" href="#">Which Diet Style</a></li>
                  <li><a class="menu-item" href="#">Supplements</a></li>
                  <li><a class="menu-item" href="#">Macro Tracking</a></li>
                  <li><a class="menu-item" href="#">Digestive Disorders</a></li>
                  <li><a class="menu-item" href="#">Special Dietary Requirements</a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/article'?>"><i class="ft-file-text"></i><span class="menu-title">Weekly Articles</span></a></li>
            <li class=" nav-item"><a href="#"><i class="ft-users"></i><span class="menu-title">Membership</span></a></li>        
        </ul>
    </div>
    <div class="navigation-background"></div>
</div>