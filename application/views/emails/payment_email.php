
<body>
<div style="width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; font-family: sans-serif;">
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
                    <td style="text-align: center; padding: 20px;"><a href="<?php echo base_url();?>" target="_blank"><img style="width: 100%; max-width: 150px; margin: 0 auto;" src="<?php echo base_url().APP_ADMIN_ASSETS_IMG;?>logo.png"></a></td>
        </tr>
        <tr>
            <td style="padding: 0 20px 20px;">
                <h2 style="font-size: 26px; font-family: sans-serif; text-align: center; margin: 0;"><span style="color: #5dbbf2;">Thanks for Subscribing</span></h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 20px;">
                <p style="font-size: 18px; margin-bottom: 0px;">Hello, <b> <?php echo $userName; ?></b>,</p>
                    <p style="color: #828282; line-height: 26px; font-size: 16px; margin-bottom: 0;     margin-top: 12px;">
                       Your payment for <?php echo $userPlan; ?> on My Vegan Trainer was successfully done. Please find the details of Plan below:<br>
                       </p>
            </td>
        </tr>
        <?php if(!empty($fullName)){?>
        <tr>
            <td style="padding: 0 20px 20px;">
                <h3 style="margin: 0; font-size: 20px; color: #333;">Trainer Details</h3>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 0px;">
                <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:12%;">
                            <?php if(!empty($profileImage)){?>
                            <img src="<?php echo base_url().'uploads/profile/thumb/'.$profileImage;?>" style="height: 60px;width: 60px;border-radius:50%;">
                        <?php }else{?>
                            <img src="<?php echo base_url().'backend_assets/img/deafault.jpg';?>" style="height: 60px;width: 60px;border-radius:50%;">
                        <?php }?>
                        </td>
                        <td style="width:88%; font-size: 15px;"><b>
                            <?php echo $fullName;?></b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td style="padding: 0 20px 20px;">
                <h6 style="font-size: 20px; color: #363535;padding: 12px;margin:0px;text-align: center;border-bottom: 1px solid #e4e5ec;">Plan Details</h6>
                <h6 style="font-size: 16px; color: #464855;text-align: left;padding: 12px;margin:0px;border-bottom: 1px solid #e4e5ec;">Plan <span style="color:#5dbbf2;float: right;"> <?php echo $userPlan;?> /<?php echo $duration;?></span></h6>

                <h6 style="font-size: 16px; color: #464855;text-align: left;padding: 12px;margin:0px;border-bottom: 1px solid #e4e5ec;">Amount <span style="color:#5dbbf2;float: right;"> <?php echo '£'.$actualPrice;?></span></h6>

                <h6 style="font-size: 16px; color: #464855;text-align: left;padding: 12px;margin:0px;border-bottom: 1px solid #e4e5ec;">Discount <span style="color:#5dbbf2;float: right;"> <?php echo $couponDiscount.'%';?></span></h6>


                <h6 style="font-size: 16px; color: #464855;text-align: left;padding: 12px;margin:0px;border-bottom: 1px solid #e4e5ec;">Paid Amount <span style="color:#5dbbf2;float: right;"> <?php echo '£'.$price;?></span></h6>
                <h6 style="font-size: 16px; color: #464855;text-align: left;padding: 12px;margin:0px;border-bottom: 1px solid #e4e5ec;">Purchase Date <span style="color:#5dbbf2;float: right;"> <?php echo $startDate; ?></span></h6>
                <h6 style="font-size: 16px; color: #464855;text-align: left;padding: 12px;margin:0px;border-bottom: 1px solid #e4e5ec;">End Date <span style="color:#5dbbf2;float: right;"> <?php echo $endDate; ?></span></h6>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 30px; text-align: center;">
                <p style="color: #828282; line-height: 26px; font-size: 16px;margin-bottom: 10px;margin-top: 0;">Click on Link below or copy paste the link in browser address bar to login in your account.</p>
                <a style="color: #5dbbf2; font-size: 15px;" target="_blank" href="<?php echo base_url();?>"><?php echo base_url();?></a>                              
            </td>
        </tr>
      
            <tr>
            <td style="padding: 10px 20px 10px; text-align: center; background: #000;">
                <p style="color: #fff; line-height: 26px; font-size: 16px;margin-bottom: 0px;margin-top: 0;"><?php echo COPYRIGHT; ?> <a style="color: #5dbbf2; text-decoration: none;" href="<?php echo base_url();?>"> MyVeganTrainer</a></p>
            </td>
        </tr>
    </table>
</div>
</body>
