
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

        case "Trainer Add Fourm":
        echo "Trainer - Add Fourm";break;

         case "Add Fourm":
        echo "Admin - Add Fourm";break;

        case "TrainerForumList":
        echo "Trainer - Forum List";break;

        case "User Details":
        echo "Admin - User Details";break;

        case "inactiveUsers":
        echo "Admin - Inactive Users";break;
        
        case "Update Training Video":
        echo "Admin - Update Training Video";break;

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

        case "Trainer Forum Details":
        echo "Trainer - Forum Details";break;

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

        case "ContentPage":
        echo "Admin - Content";break;

        case "What Can I Eat":
        echo "Admin - What Can I Eat";break;
       
        case "Protein":
        echo "Admin - Add Protein";
        break;

        case "fluids":
        echo "Admin - fluids";
        break;

        case "Admin - Add fluids":
        echo "Admin - Add fluids";
        break;


        case "Admin-Supplementation & Food":
        echo "Admin -Supplementation & Food";
        break;

        case "Add MacroTracking":
        echo "Admin - Add MacroTracking";
        break;

        case "Add Digestive Disorders":
        echo "Admin - Add Digestive Disorders";
        break;

        case "Add Special Dietary Requirements":
        echo "Add Special Dietary Requirements";
        break;

        case "Which Diet Style":
        echo "Which Diet Style";
        break;

        case "Supplementation & Food":
        echo "Supplementation & Food";
        break;

        case "Macro Tracking":
        echo "Macro Tracking";
        break;

        case "Digestive Disorders":
        echo "Digestive Disorders";
        break;

        case "Special Dietary Requirements":
        echo "Special Dietary Requirements";
        break;

        case "NutritionGuidance Detail":
        echo "NutritionGuidance Details";
        break;

        case "Trainer-NutritionGuidance Edit":
        echo "Trainer-NutritionGuidance Edit";
        break;

        case "Admin-NutritionGuidance Edit":
        echo "Admin-NutritionGuidance Edit";
        break;

        case "exercise instrunction List":
        echo "exercise instrunction List";
        break;

        case "Substituting Exercises List":
        echo "Substituting Exercises List";
        break;

        case "Abdominal Work List":
        echo "Abdominal Work List";
        break;

        case "Sets Reps & Timing Guidance List":
        echo "Sets Reps & Timing Guidance List";
        break;

        case "Types of Grip List":
        echo "Types of Grip List";
        break;

        case "Stretching List":
        echo "Stretching List";
        break;

        case "Glute Activation List":
        echo "Glute Activation List";
        break;

        case "Common Postural Problems List":
        echo "Common Postural Problems List";
        break;

        case "Training List":
        echo "Training List";
        break;

        case "Add exercise instrunction":
        echo "Add exercise instrunction";
        break;

        case "Add Substituting Exercises":
        echo "Add Substituting Exercises";
        break;

        case "Add Abdominal Work":
        echo "Add Abdominal Work";
        break;

        case "Add Sets Reps & Timing Guidance":
        echo "Add Sets Reps & Timing Guidance";
        break;


        case "Add Types of Grip":
        echo "Add Types of Grip";
        break;

        case "Add Glute Activation":
        echo "Add Glute Activation";
        break;

        case "Add Common Postural Problems":
        echo "Add Common Postural Problems";
        break;

        case "Add Training":
        echo "Add Training";
        break;

        case "Edit exercise instrunction":
        echo "Edit exercise instrunction";
        break;

        case "Edit Substituting Exercises":
        echo "Edit Substituting Exercises";
        break;

        case "Edit Abdominal Work":
        echo "Edit Abdominal Work";
        break;

        case "Edit Sets Reps & Timing Guidance":
        echo "Edit Sets Reps & Timing Guidance";
        break;

        case "Edit Types of Grip":
        echo "Edit Types of Grip";
        break;

        case "Edit Stretching":
        echo "Edit Stretching";
        break;

        case "Edit Glute Activation":
        echo "Edit Glute Activation";
        break;

        case "Edit Common Postural Problems":
        echo "Edit Common Postural Problems";
        break;

        case "Edit Training":
        echo "Edit Training";
        break;
        

        case "Trainer-Preferred Suppliers":
        echo "Trainer-Preferred Suppliers";
        break; 

        case "Trainer-Discounts":
        echo "Trainer-Discounts";
        break;

        case "Admin-Preferred Suppliers":
        echo "Admin-Preferred Suppliers";
        break; 

        case "Admin-Discounts & offers":
        echo "Admin-Discounts & offers";
        break; 

        case "Trainer-Add Supplementation & Food":
        echo "Trainer-Add Supplementation & Food";
        break; 

        case "Trainer-Add Discounts":
        echo "Trainer-Add Discounts";
        break; 

        case "Admin-Add Supplementation & Food":
        echo "Admin-Add Supplementation & Food";
        break; 

        case "Admin-Add Discounts & offers":
        echo "Admin-Add Discounts & offers";
        break; 
        
        case "Trainer-Recommended Products Details";
        echo "Trainer-Recommended Products Details";
        break;

        
        case "Admin-Recommended Products Details";  
        echo "Admin-Recommended Products Details";
        break;

        case  "Trainer-Edit Recommended Products";
        echo  "Trainer-Edit Recommended Products";
        break;

        case  "Admin-Edit Recommended Products";
        echo  "Admin-Edit Recommended Products";
        break;

        case "Membership";
        echo "Membership Plan";
        break;

        case "addMembership";
        echo "Add Plan";
        break;

         case "editMembership";
        echo "Edit Plan";
        break;

        case "Coupon";
        echo "Coupon";
        break;

        case "addCoupon";
        echo "Add Coupon";
        break;

         case "editCoupon";
        echo "Edit Coupon";
        break;
        case "Report";
        echo "Report";
        break;

        case "User Report";
        echo "User Report";
        break;

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
 <!-- MULTISELECCR -->

<!-- END MULTISELCF -->
  </head>
 <?php 
 // if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
 //            $path = DEFAULT_IMAGE;

 //        }else{
 //            $path = TRAINER_PROFILE_THUMB;  
 //        } 
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
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="<?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){echo base_url('admin/adminProfile') ; }else{echo '#'; } ?>" data-toggle="dropdown">
                         <span class="avatar avatar-online">
                            <img src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="avatar" ></span></a>
                            <?php }else{?>
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="<?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){echo base_url('admin/adminProfile');}else{echo '#'; } ?>" data-toggle="dropdown">
                         <span class="avatar avatar-online">
                            <img src="<?php echo base_url().TRAINER_PROFILE_THUMB.$_SESSION[ADMIN_USER_SESS_KEY]['image'];?>" alt="avatar" ></span></a>
                            <?php } ?>

                        <div class="dropdown-menu dropdown-menu-right cstm-drpdwn-menu">
                            <div class="arrow_box_right">
                               <?php if(empty($_SESSION[ADMIN_USER_SESS_KEY]['image'])){ ?>
                                <a class="dropdown-item" href="<?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){echo base_url('admin/adminProfile');}else{echo '#'; } ?>"><span class="noti-span avatar avatar-online adminProfile">
                                    <img src="<?php echo base_url(DEFAULT_IMAGE);?>" alt="avatar"><span class="user-name text-bold-700 noti-span ml-1 adminName"><?php echo $_SESSION[ADMIN_USER_SESS_KEY]['name'];?>
                                        <?php if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin')){ ?>
                                        <?php }else{  ?>
                                        <span class="adminTitle">Trainer</span>
                                        <?php } ?>
                                    </span></span></a>

                                <?php } else{ ?>
                                <a class="dropdown-item" href="<?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){echo base_url('admin/adminProfile');}else{echo '#'; } ?>"><span class="noti-span avatar avatar-online adminProfile">
                                    <img src="<?php echo base_url().TRAINER_PROFILE_THUMB.$_SESSION[ADMIN_USER_SESS_KEY]['image'];?>" alt="avatar"><span class="user-name text-bold-700 noti-span ml-1 adminName"><?php echo $_SESSION[ADMIN_USER_SESS_KEY]['name'];?> 
                                     <?php if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin')){ ?>
                                        <?php }else{  ?>
                                        <span class="adminTitle">Trainer</span>
                                        <?php } ?>
                                </span></span></a>
                                <?php }?>
                                <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){ $link =  base_url('admin/trainers/editTrainerProfile'); }else{$link =  '#';} ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){echo base_url('admin/adminProfile');}else{echo $link; } ?>"><i class="ft-user"></i> Edit Profile</a><a class="dropdown-item" href="<?php echo $link;?>"><i class="ft-settings"></i> Settings</a>
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
              <li class="nav-item"><a href="<?php echo base_url().'admin/dashboard';?>"><i class="ft-home"></i><span class="menu-title">Dashboard</span></a></li>

                <li class="nav-item"><a href="<?php echo base_url().'admin/report/UserReport';?>"><i class="ft-file"></i><span class="menu-title">Report</span></a></li>

               <li class=" nav-item"><a href="#"><i class="ft-users"></i><span class="menu-title">Users</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="<?php echo base_url().'admin/users'?>">All Users</a></li>
                  <li><a class="menu-item" href="<?php echo base_url().'admin/users/inactiveUsers'?>">Inactive Users</a></li>
                   <li><a class="menu-item" href="<?php echo base_url().'admin/users/guestUser'?>">Guest Users</a></li>
                </ul>
                </li>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/trainers';?>"><i class="ft-life-buoy"></i><span class="menu-title">Trainers</span></a></li>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/forum';?>"><i class="ft-list"></i><span class="menu-title">Forums</span></a></li>
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
             <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
            <li class="nav-item"><a href="#"><i class="ft-clipboard"></i><span class="menu-title">Nutrition Guidance</span></a>
                <ul class="menu-content">   
                  <li><a class="menu-item" href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(1);?>">What Can I Eat?</a></li>
                  <li><a class="menu-item" href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(2);?>">Protein</a></li>
                  <li><a class="menu-item" href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(3);?>">Supplements</a></li>
                  <li><a class="menu-item" href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(4);?>">Macro Tracking</a></li>
                  <li><a class="menu-item" href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(5);?>">Digestive Disorders</a></li>
                  <li><a class="menu-item" href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(6);?>">Special Dietary Requirements</a></li> 
                   <li><a class="menu-item" href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(7);?>">Fluids</a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="ft-anchor"></i><span class="menu-title">Training</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(1);?>">Exercise Instruction</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(2);?>">Substituting Exercises</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(3);?>">Abdominal Work</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(4);?>">Sets Reps & Timing Guidance</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(5);?>">Types of Grip</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(6);?>">Stretching</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(7);?>">Glute Activation</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(8);?>">Common Postural Problems</a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="ft-check-square"></i><span class="menu-title">Recommended Products </span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/recommendedProducts/edit_recommendedProducts?id=<?php echo encoding(1);?>">Supplementation & Food</a></li>
                  <li><a class="menu-item" href="<?php echo base_url()?>admin/recommendedProducts/edit_recommendedProducts?id=<?php echo encoding(2);?>">Discounts & offers</a></li>

                </ul>
            </li>
        <?php } ?>
            <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
            <li class=" nav-item"><a href="#"><i class="fa fa-newspaper-o"></i><span class="menu-title">Content</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="<?php echo base_url().'admin/content'?>">Home Page Content</a></li>
                </ul>
            </li>
             <li class=" nav-item"><a href="<?php echo base_url().'admin/coupon';?>"><i class="ft-bookmark"></i><span class="menu-title">Coupons</span></a></li> 
        <?php }?>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/article'?>"><i class="ft-file-text"></i><span class="menu-title">Weekly Articles</span></a></li>
          <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']!='user'){ ?>
            <li class=" nav-item"><a href="<?php echo base_url().'admin/membership';?>"><i class="ft-users"></i><span class="menu-title">Membership</span></a>
            </li> 
            <?php }?>  
             <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){ ?>
             <li class=" nav-item"><a href="<?php echo base_url().'admin/report'?>"><i class="ft-file-text"></i><span class="menu-title">Report</span></a></li> 
             <?php }?>    
        </ul>
    </div>
    <div class="navigation-background"></div>
</div>
