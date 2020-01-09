
                                            <?php if(!empty($trainerList)){ foreach($trainerList as $value){?>
                                            <tr>
                                                <td class="text-truncate align-middle">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willis Barstow" class="avatar avatar-sm width-cstm pull-up">
                                                            <?php if(!empty($value->profileImage)){ ?>
                                                            <img class="media-object rounded-circle" src="<?php echo base_url(TRAINER_PROFILE_THUMB).$value->profileImage;?>" alt="Avatar">
                                                            <?php } else {?>
                                                             <img class="media-object rounded-circle" src="<?php echo base_url(DEFAULT_IMAGE);?>" alt="Avatar">
                                                            <?php }?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate align-middle">
                                                    <a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo encoding($value->id);?>"><?php sanitize_output_text(custom_echo( ucfirst($value->fullName),20));?></a>
                                                </td>                                                
                                                <td class="text-truncate align-middle">
                                                    <span><?php sanitize_output_text(custom_echo ($value->email,25));?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <p><?php if(sanitize_output_text($value->promote)=='0'){
                                                        echo 'No'; }else{
                                                        echo 'Yes'; }
                                                        ?>  
                                                    </p>
                                                </td>
                                                <td class="align-middle eye-style">
                                                   <!--  <?php echo base_url()?>admin/trainers/trainerDetails/<?php echo encoding($value->id);?> -->
                                                    <a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>
                                                      <a href="<?php echo base_url()?>admin/trainers/updateTrainer/<?php echo encoding($value->id);?>"><i class="ft-edit-2 clr2"></i></a>
                                                    
                                                    <a ><i class="ft-trash-2 clr2" onclick="deletefn('<?php echo $value->id ?>','<?php echo get_csrf_token()['hash'];?>')"></i></a>

                                                   
                                                </td>
                                            </tr>                                
                                        
                                        <?php } }else{
                                            echo "Trainer Not Found.";
                                        } ?>

                                       
                                   <tr>
                                    <td colspan="5">
                                    <?php echo $pagination; ?>
                                </td>
                                   </tr>

