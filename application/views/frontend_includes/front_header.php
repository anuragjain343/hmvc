<?php $frontend_assets = base_url()."frontend_assets/";?>
<?php 
/*if(!empty($_COOKIE['reffralId'])){

  $getDataCookies=  $_COOKIE['reffralId'];
}*/
//pr($_COOKIE['reffralId']);

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <!-- meta tag -->
   
  <meta charset="utf-8">
  <title>
    My Vegan Trainer | <?php if($title){
        switch ($title){
        case "Home":
        echo "Home";break;  
        case "Forum":
        echo "Forum";break;
        case "Forum Detail":
        echo "Forum Detail";break;
        case "Select Trainer":
        echo "Online Coaching";break;
        case "Join Our membership":
        echo "Join Our membership";break;
        case "Payment":
        echo "Payment";break;
        case "informational video":
        echo "Informational video";break;
        case "training video":
        echo "Training video";break;
        case "Article":
        echo "Weekly Articles";break;
        case "Recipe":
        echo "Recipes";break;
        case "Article Details":
        echo "Article Details";break;
        case "NutritionGuidance Details":
        echo "NutritionGuidance Details";break;
        case "Recommended Products Details":
        echo "Recommended Products Details";break;
        case "Training Details":
        echo "Training Details";break;
        case "User Profile":
        echo "User Profile";break;
        case "Trainer Detail":
        echo "Trainer Profile";break;
        case "My Trainer Detail":
        echo "My Trainer Profile";break;
        case 'payment status':
        echo "Payment Status";break;
        } } ?> 

      </title>
  <meta name="description" content="">
  <!-- responsive tag -->
  <meta http-equiv="X-UA-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon -->
   <link rel="shortcut icon" type="image/x-icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo $frontend_assets;?>css/owl.carousel.min.css"> 
     <link rel="stylesheet" type="text/css" href="<?php echo $frontend_assets;?>css/owl.theme.default.min.css"> 
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $frontend_assets;?>img/fav.png">
  <!-- bootstrap v4 -->
  <link rel="stylesheet" type="text/css" href="<?php echo $frontend_assets;?>css/bootstrap.min.css"> 

  <!-- font-awesome css -->
   <link rel="stylesheet" type="text/css" href="<?php echo $frontend_assets;?>css/fontawesome-all.min.css">
  <!-- animate css -->
  <link rel="stylesheet" type="text/css" href="<?php echo $frontend_assets;?>css/animate.min.css">
  <!-- owl.carousel css -->
 
  

   <link rel="stylesheet" type="text/css" href="<?php echo $frontend_assets;?>css/style.css">
 <?php if(!empty($front_styles)) { load_css($front_styles); }?>
 <link rel="stylesheet" type="text/css" href="<?php echo $frontend_assets;?>css/responsive.css"> 
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $frontend_assets;?>img/fav.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="home1">
   <div class=preloader>
    <!-- <div class=spinner></div> -->
     <div class="loadinner">
      <img src="<?php echo $frontend_assets;?>img/Spinner-1s-100px.apng">
    </div> 
  </div>
  <header class="Header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo $frontend_assets;?>img/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <div class="animated-icon3"><span></span><span></span><span></span><span></span></div>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mainMenu">
            <li class="nav-item <?php if($title=='Home'){ echo 'active';}?>">
              <a class="nav-link" href="<?php echo base_url();?>">Home
              </a>
            </li>
                        
            <li class="nav-item <?php if($title=='Forum'){ echo 'active';}?>">
              <a class="nav-link" href="javaScript:void(0)" onclick="isRegisterLogin('','<?php echo base_url();?>home/forum')">Forum</a>
            </li>
                     
                <li class="nav-item <?php if($title=='Select Trainer'){ echo 'active';}?>">
                    <a class="nav-link" href="<?php echo base_url();?>home/trainers">Online Coaching</a>
                </li>
              
                <!-- condition for when cookeis set and user login -->

            
              <li class="nav-item dropdown">
              <a class="nav-link" >Videos <span class="mobileDrop"><i class="fas fa-caret-down"></i></span></a>
              <span class="mobileSubmenu"><i></i></span>
              <ul class="dropdown-menu subMenu">
                <li><a  href="javaScript:void(0)" onclick="isRegisterLogin('','<?php echo base_url();?>home/video/informationalVideo')">Informational Videos</a></li>
                <li><a href="javaScript:void(0)" onclick="isRegisterLogin('','<?php echo base_url();?>home/video/trainingVideo')">Training Videos</a></li>
              </ul>
            </li>
           
            <li class="nav-item <?php if($title=='Recipe'){ echo 'active';}?>">
              <a class="nav-link"  href="javaScript:void(0)" onclick="isRegisterLogin('','<?php echo base_url();?>home/recipes')">Recipes</a>
            </li>
         
            <li class="nav-item dropdown">
              <a class="nav-link" >Nutrition Guidance <span class="mobileDrop"><i class="fas fa-caret-down"></i></span></a>
              <span class="mobileSubmenu"><i></i></span>
              <ul class="dropdown-menu subMenu">
                <li><a href="<?php echo base_url()?>home/NutritionGuidance?id=<?php echo encoding(1); ?>">What Can I Eat?</a></li>
                <li><a href="<?php echo base_url()?>home/NutritionGuidance?id=<?php echo encoding(2); ?>">Protein</a></li>
                <li><a href="<?php echo base_url()?>home/NutritionGuidance?id=<?php echo encoding(3); ?>">Supplements</a></li>
                <li><a href="<?php echo base_url()?>home/NutritionGuidance?id=<?php echo encoding(4); ?>">Macro Tracking</a></li>
                <li><a href="<?php echo base_url()?>home/NutritionGuidance?id=<?php echo encoding(5); ?>">Digestive Disorders</a></li>
                <li><a href="<?php echo base_url()?>home/NutritionGuidance?id=<?php echo encoding(6); ?>">Special Dietary Requirements</a></li>
                 <li><a href="<?php echo base_url()?>home/NutritionGuidance?id=<?php echo encoding(7); ?>">fluids</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link">Recommended Products <span class="mobileDrop"><i class="fas fa-caret-down"></i></span></a>
              <span class="mobileSubmenu"><i></i></span>
              <ul class="dropdown-menu subMenu">
                <li><a href="<?php echo base_url()?>home/RecommendedProducts?id=<?php echo encoding(1);?>">Supplementation & Food</a></li>
                <li><a href="<?php echo base_url()?>home/RecommendedProducts?id=<?php echo encoding(2);?>">Discounts & offers</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link">Training <span class="mobileDrop"><i class="fas fa-caret-down"></i></span></a>
              <span class="mobileSubmenu"><i></i></span>
              <ul class="dropdown-menu subMenu">
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(1);?>">Exercise Instruction</a></li>
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(2);?>">Substituting Exercises</a></li>
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(3);?>">Abdominal Work</a></li>
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(4);?>">Sets Reps & Timing Guidance</a></li>
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(5);?>">Types of Grip</a></li>
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(6);?>">Stretching</a></li>
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(7);?>">Glute Activation</a></li>
                <li><a href="<?php echo base_url()?>home/Training?catid=<?php echo encoding(8);?>">Common Postural Problems</a></li>
              </ul>
            </li>
            
            <li class="nav-item <?php if($title=='Article'){ echo 'active';}?>">
              <a class="nav-link" href="<?php echo base_url();?>home/article">Weekly Articles</a>
            </li>   
                
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Support Groups</a>
            </li> -->     
            <li class="nav-item <?php if($title=='Join Our membership'){ echo 'active';}?>">
              <a class="nav-link" href="<?php echo base_url();?>home/membership">Membership</a>
  <!--               <span class="mobileSubmenu"><i></i></span>
              <ul class="dropdown-menu subMenu">
                <li><a href="">Weekly Videos</a></li>
              </ul> -->
            </li>
        
            <li class="nav-item dropdown profileMenu">
              <?php if(empty($_SESSION[USER_SESS_KEY])){ ?>
                <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
              <?php }else{ ?>
                <a class="nav-link" href="#">
                <?php if(!empty(get_user_session_data()['image'])) { ?>
                  <img src="<?php echo base_url().USER_PROFILE_THUMB.get_user_session_data()['image']; ?>">
                <?php }else{ ?>
                  <img src="<?php echo base_url().DEFAULT_IMAGE; ?>">
                <?php } ?>
                </a>
                <span class="mobileSubmenu"><i></i></span>
                <ul class="dropdown-menu subMenu">
                  <li><a href="<?php echo base_url('home/users/userProfile'); ?>">My Profile</a></li>
                  <li><a href="<?php echo base_url();?>home/userLogout">Logout</a></li>
                </ul>
              <?php } ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>