
<body>
<div style="width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; font-family: sans-serif;">
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
                    <td style="text-align: center; padding: 20px;"><a href="<?php echo base_url();?>" target="_blank"><img style="width: 100%; max-width: 150px; margin: 0 auto;" src="<?php echo base_url().APP_ADMIN_ASSETS_IMG;?>logo.png"></a></td>
        </tr>
        <tr>
            <td style="padding: 0 20px 20px;">
                <h2 style="font-size: 26px; font-family: sans-serif; text-align: center; margin: 0;">Welcome to <span style="color: #5dbbf2;">My Vegan Trainer</span></h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 20px;">
                <p style="font-size: 18px; margin-bottom: 0px;">Hello <b><?php echo $firstName; ?></b>,</p>
                    <p style="color: #828282; line-height: 26px; font-size: 16px; margin-bottom: 0;     margin-top: 12px;">Your profile as a trainer is created, please find the detail below:</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 20px;">
                <table>
                    <tr>
                        <td style="padding: 8px 0; color: #828282; width: 120px; font-size: 16px;">Name:</td>
                        <td style="padding: 8px 0; font-size:16px;"><?php echo $firstName; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #828282; width: 120px; font-size: 16px; ">Email:</td>
                        <td style="padding: 8px 0; font-size:16px "><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #828282; width: 120px; font-size: 16px;">Password:</td>
                        <td style="padding: 8px 0; font-size:16px;"><?php echo $password; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #828282; width: 120px; font-size: 16px;">Bio:</td>
                        <td style="padding: 8px 0; font-size:16px;"><?php echo $details; ?> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 30px; text-align: center;">
                <p style="color: #828282; line-height: 26px; font-size: 16px;margin-bottom: 10px;margin-top: 0;">To get started, click on link below or copy paste the link in browser address bar and login using email and password given above.</p>
                <a style="color: #5dbbf2; font-size: 15px;" target="_blank" href="<?php echo base_url().'admin';?>"><?php echo base_url().'admin';?></a>
                                
                                <p style="color: #828282; line-height: 26px; font-size: 16px;margin-bottom: 0px; margin-top: 10px;">You can change the password after logging in from profile page.</p>
            </td>
        </tr>
       <tr>
            <?php if(!empty($referralLink)){?>
            <td style="padding: 0 20px 30px; text-align: center;">
                <p style="font-size: 18px; margin-bottom: 0px;"><b>Referral Link</b></p>
             <p style="color: #828282; line-height: 26px; font-size: 15px;margin-bottom: 10px;margin-top: 0;">
                <a style="color: #5dbbf2; text-decoration: none;" href="<?php echo $referralLink; ?>"><?php echo  $referralLink; ?></a>
             </p>
         </td>
        
        </tr>
         <tr>
            <td style="padding: 0 20px 20px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding: 8px ; color: #828282;  font-size: 16px;">No Subscription:</td>
                        <td style="padding: 8px ; font-size:16px;"><?php echo $commissionFree; ?> £</td>
                        
                    </tr>
                    <tr><td style="margin-top: : 4px ; color: #828282; font-size: 16px;"><br></td></tr>
                    <tr>
                         <td style="padding: 8px ; color: #828282; font-size: 16px; ">Commission Level 1:</td>
                        <td style="padding: 8px ; font-size:16px "><?php echo $commissionLevel1; ?>%</td>
                        <td style="padding: 8px ; color: #828282;  font-size: 16px;">Commission Level 2:</td>
                        <td style="padding: 8px ; font-size:16px;"><?php echo $commissionLevel2; ?>%</td>
                        
                    </tr>
                    <tr>
                         <td style="padding: 8px ; color: #828282; font-size: 16px; ">Commission Level 3 same:</td>
                        <td style="padding: 8px ; font-size:16px "><?php echo $commissionLevel3Same; ?>%</td>
                        <td style="padding: 8px ; color: #828282;  font-size: 16px;">Commission Level 3 Other:</td>
                        <td style="padding: 8px ; font-size:16px;"><?php echo $commissionLevel3Other; ?>%</td>
                         
                    </tr>
                    <tr>
                        <td style="padding: 8px ; color: #828282; font-size: 16px; ">Commission Level 4 Same:</td>
                        <td style="padding: 8px ; font-size:16px "><?php echo $commissionLevel4Same; ?>%</td>
                        <td style="padding: 8px ; color: #828282;  font-size: 16px;">Commission Level 4 Other:</td>
                        <td style="padding: 8px ; font-size:16px;"><?php echo $commissionLevel4Other; ?>%</td>
                        
                    </tr>
                   <tr><td style="margin-top: : 8px ; color: #828282; font-size: 16px;"><br></td></tr>
                    <tr>
                        <td style="padding: 8px ; color: #828282;  font-size: 16px;">Discount  Level 1:</td>
                        <td style="padding: 8px ; font-size:16px;"><?php echo $discountLevel1; ?>%</td>
                         <td style="padding: 8px ; color: #828282; font-size: 16px; ">Discount  Level 2:</td>
                        <td style="padding: 8px ; font-size:16px "><?php echo $discountLevel2; ?>%</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px ; color: #828282;  font-size: 16px;">Discount  Level 3 Same:</td>
                        <td style="padding: 8px ; font-size:16px;"><?php echo $discountLevel3Same; ?>%</td>
                         <td style="padding: 8px ; color: #828282; font-size: 16px; ">Discount  Level 3 Other:</td>
                        <td style="padding: 8px ; font-size:16px "><?php echo $discountLevel3Other; ?>%</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px ; color: #828282;  font-size: 16px;">Discount  Level 4 Same:</td>
                        <td style="padding: 8px ; font-size:16px;"><?php echo $discountLevel4Same; ?>%</td>
                        <td style="padding: 8px ; color: #828282; font-size: 16px; ">Discount  Level 4 Other:</td>
                        <td style="padding: 8px ; font-size:16px "><?php echo $discountLevel4Other; ?>%</td>
                        
                    </tr>
                  
                </table>
            </td>
        </tr>
        <?php }?>
            <tr>
            <td style="padding: 10px 20px 10px; text-align: center; background: #000;">
                <p style="color: #fff; line-height: 26px; font-size: 16px;margin-bottom: 0px;margin-top: 0;"><?php echo COPYRIGHT; ?> <a style="color: #5dbbf2; text-decoration: none;" href="<?php echo base_url();?>"> MyVeganTrainer</a></p>
            </td>
        </tr>
    </table>
</div>
</body>
