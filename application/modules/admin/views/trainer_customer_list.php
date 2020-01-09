                            <div id="recent-projects" class="media-list position-relative">
                                <div class="table-responsive">
                                    <table class="table table-padded table-xl mb-0 user-list-tble" id="recent-project-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Profile Pic</th>
                                                <th class="border-top-0">Name</th>                                                
                                                <th class="border-top-0">Email address</th>
                                                <th class="border-top-0">Action</th>
                                             
                                            </tr>
                                               <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                        </thead>
                                        <?php if(!empty($userList)){
        
                                           foreach($userList as $value){?>
                                        <tbody>

                                            <tr>
                                                <td class="text-truncate align-middle">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willis Barstow" class="avatar avatar-sm width-cstm pull-up">
                                                            <?php if(!empty($value->profileImage)){ ?>
                                                            <img class="media-object rounded-circle" src="<?php echo base_url(USER_PROFILE_THUMB).$value->profileImage;?>" alt="Avatar">
                                                            <?php } else {?>
                                                             <img class="media-object rounded-circle" src="<?php echo base_url(DEFAULT_IMAGE);?>" alt="Avatar">
                                                            <?php }?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate align-middle">
                                                    <a href="<?php echo base_url().'admin/users/userDetails/'.encoding($value->id);?>"><?php sanitize_output_text(custom_echo( ucfirst($value->fullName),20));?></a>
                                                </td>                                                
                                                <td class="text-truncate align-middle">
                                                    <span><?php sanitize_output_text(custom_echo ($value->email,25));?></span>
                                                </td>
                                                <td class="align-middle eye-style">
                                                   <!--  <?php echo base_url()?>admin/trainers/trainerDetails/<?php echo encoding($value->id);?> -->
                                                    <a href="<?php echo base_url();?>admin/trainers/customerDetail/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>

                                                    <!-- <a ><i class="ft-trash icon-opacity clr2" onclick="deletefn('<?php echo $value->id ?>','<?php echo get_csrf_token()['hash'];?>')"></i></a> -->
                                                </td>
                                            </tr>                                
                                        </tbody>
                                       
                                <?php } }else{
                                    ?>
                                    <table> <div> Customers not found</div></table>
                                   

                                <?php }?>
                                    </table>
                                        </div>
                                        </div>  
                                <?php echo $pagination;?>
                                 
                                    
        
    
                             

