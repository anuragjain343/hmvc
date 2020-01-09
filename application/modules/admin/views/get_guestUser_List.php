
                                            <?php if(!empty($userList)){ $tot=1; foreach($userList as $value){?>
                                            <tr>
                                             
                                                <td class="text-truncate align-middle"><?php echo $tot;?></td>                                               
                                                <td class="text-truncate align-middle">
                                                    <span><?php sanitize_output_text(custom_echo ($value->email,30));?></span>
                                                </td>
                                             
                                            </tr>
                                              <?php $tot++; } }else{?>
                                             
                                            <tr>
                                              <td class="text-center" colspan="4"><h5>No Guste user Found.</h5></td>
                                            </tr>                                
                                        
                                        <?php } ?>
                                             <?php echo $pagination; ?>                           
        
