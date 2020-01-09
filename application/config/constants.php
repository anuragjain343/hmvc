<?php

/* Application specific constants */

//keys (session, third party API keys like google, stripe etc)
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
/* Firebase API key for notifications */
define('NOTIFICATION_KEY','AAAARhoraBA:APA91bF60FScjvb-3LkAo5zyMMn24xfNRIPLA1Pc0rYI-ijRz0a1ITij6keKaz37SjVP1D5qq9Kl5FXwXaHj2fXs1qo9wkDEA4NjyXxApXFcQkqrQ7n1luy-HUElSOYTJZ8LU8w_1Vlz');

/* session keys */
define('USER_SESS_KEY', 'app_user_sess'); 
define('ADMIN_USER_SESS_KEY', 'app_admin_user_sess');
define('TRAINER_USER_SESS_KEY', 'app_trainer_user_sess');
define('FAIL', 'fail');

//DB tables
define('USERS', 'users');
define('TRAINERMETA', 'trainerMeta');
define('CONTENT', 'homeContent');
define('NURRITIONGUIDANCE', 'nutritionguidance');
define('NURRITIONGUIDANCECATEGORY', 'nutritionguidanceCategories');
define('FOURM', 'forum');
define('FOURMANSWER', 'forumAnswer');
define('RECEPIELIKE', 'recepieLike');
define('FOURMLIKE', 'forumLike');
define('ANSWERLIKE', 'answerLike');
define('FOURMVIEW', 'forumView');
define('RECEPIEVIEW', 'recepieView');
define('ARTICLE', 'article');
define('ARTICLELIKE', 'articleLike');
define('ARTICLEVIEW', 'articleView');
define('ARTICLEANSWER', 'articleAnswer');
define('ARTICLEANSWERLIKE', 'articleAnswerLike');
define('RECEPIE', 'recepie');
define('RECEPIE_CATEGORY', 'recepieCategory');
define('RECEPIE_CATEGORY_MAP', 'recepieCategoryMap');
define('INFORMATIONALVIDEO', 'informationalVideo');
define('TRAININGVIDEO','trainingVideo');
define('NOTIFICATIONS', 'notifications');
define('RECOMMENDEDPRODUCTSCATEGORIES', 'recommendedProductsCategories');
define('RECOMMENDEDPRODUCTS', 'recommendedProducts');
define('TBL_PLAN', 'plans');
define('TBL_COUPON', 'coupons');
define('PAYMENT', 'payment');
define('USERSUBSCRIPTION','userSubscription');
//uploads path
define('USER_AVATAR_PATH', 'uploads/user_avatar/'); //user avatar
define('USER_DEFAULT_AVATAR', 'uploads/user_avatar/user_placeholder.png'); //user placeholder image

define('TRAINER_PROFILE_THUMB','uploads/profile/thumb/');
define('BANNER_IMAGE','uploads/banner/large/');
define('USER_PROFILE_THUMB','uploads/userProfile/thumb/');
define('ADMIN_PROFILE_THUMB','backend_assets/img/deafault.jpg');
define('BANNER_DEFAULT','backend_assets/img/banner_default.jpg');

define('RECEPIE_THUMB','uploads/recepie/thumb/');
define('RECEPIE_VIDEO','uploads/video_recepie/');
define('USER_PROFILE','uploads/userProfile/');
define('ADMIN_PROFILE','uploads/profile/');
define('DEFAULT_IMAGE','backend_assets/img/deafault.jpg');
define('DEFAULT_RECEPIE_IMAGE','backend_assets/img/deafault_recepie.jpeg');
define('DEFAULT_VIDEO_IMAGE','backend_assets/img/No-Video.gif');
define('INFORMATIONAL_VIDEO','uploads/informationalVideo/');
define('INFORMATIONAL_VIDEO_THUMB','uploads/video_thumb/');
define('ABOUT_IMAGE','uploads/about/medium/');
define('RECEPIE_VIDEO_THUMB','uploads/recepie_video_thumb/');

define('TRAINING_VIDEO','uploads/trainingVideo/');
define('TRAINING_VIDEO_THUMB','uploads/video_thumb/');

define('NURRITIONGUIDANCE_MEDIUM', 'uploads/NutritionGuidance/medium/');
define('NURRITIONGUIDANCE_THUMB', 'uploads/NutritionGuidance/thumb/');
define('NURRITIONGUIDANCE_VIDEO', 'uploads/NutritionGuidanceVideo/');
define('NURRITIONGUIDANCE_VIDEO_THUMB', 'uploads/NutritionGuidanceVideo_thumb/');
define('NURRITIONGUIDANCE_PDF', 'uploads/NutritionGuidancePdf/');
define('TRAINING_THUMB','uploads/Training/thumb/');

define('RECOMMENDEDPRODUCTS_MEDIUM', 'uploads/RecommendedProducts/medium/');
define('RECOMMENDEDPRODUCTS_THUMB', 'uploads/RecommendedProducts/thumb/');



define('RECOMMENDEDPRODUCTS_VIDEO', 'uploads/RecommendedProducts_video/');
define('RECOMMENDEDPRODUCTS_VIDEO_THUMB', 'uploads/RecommendedProducts_video_thumb/');
define('RECOMMENDEDPRODUCTS_PDF', 'uploads/RecommendedProducts_pdf/');




//Title, Site name, Copyright etc
define('SITE_NAME','MyVeganTrainer'); //your project name
define('COPYRIGHT', date('Y').'&copy; Copyright &nbsp;');

//common messages
define('UNKNOWN_ERR', 'Something went wrong. Please try again');

//Asset path (In place of "APP_" you can use your own project specific prefix)
/* Frontend */
define('APP_ASSETS_JS', 'frontend_assets/js/');
define('APP_ASSETS_CSS', 'frontend_assets/css/');
define('APP_ASSETS_PLUGIN', 'frontend_assets/plugins/');
define('APP_ASSETS_IMG', 'frontend_assets/img/');

/* Admin */
define('APP_ADMIN_ASSETS_JS', 'backend_assets/js/');
define('APP_ADMIN_ASSETS_CSS', 'backend_assets/css/');
define('APP_ADMIN_ASSETS_PLUGIN', 'backend_assets/plugins/');
define('APP_ADMIN_ASSETS_IMG', 'backend_assets/img/');
define('ADMIN','admin');


define('TRAINING_MEDIUM','uploads/Training/medium/');		
define('TC_PDF','uploads/Training_pdf/');		
define('TC_PDFS','uploads/RecommendedProducts_pdf/');		
define('TRAINING_CATEGORY_VIDEO','uploads/Training_video/');
define('TRAINING_CATEGORY_THUMB','uploads/Training_video_thumb/thumb/');

define('TRAINING', 'training');		
define('TRAINING_CATEGORY', 'trainigCategories');
define('JSV0', 'Javascript:void(0)');
/*code by sunil start*/
//define('STRIPE_SECRET_KEY','sk_test_82UMhsygkviBYxQmikCW9Oa1');
define('STRIPE_SECRET_KEY','sk_test_nPgwBwdC9yIAWXuptZBvu6n500L57Abp0k');
//define('STRIPE_PUBLISABLE_KEY','pk_test_g1InT1K0MoCW5lhkc6uf3UW3');
define('STRIPE_PUBLISABLE_KEY','pk_test_JZLxP425xMTJBSNi1aAMOsiI00FqWjoNaF');
define('COUPON_DATA','1ipQ4cyY');
define('COUPON_DISCOUNT','3');


/*end*/
