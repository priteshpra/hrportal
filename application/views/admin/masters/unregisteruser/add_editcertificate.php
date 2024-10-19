<?php //echo $page_name.$certificate->CandidateID;exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/candidate/'. $CandidateID."#certificate");?>"><strong><?php echo label('msg_lbl_title_certificate')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/<?php echo $page_name; ?>/<?php echo $CandidateID;?>/<?php echo @$ID;?>" enctype= "multipart/form-data">
				 <input id="cuid" name="cuid" value="<?php echo isset($CandidateID)?$CandidateID:0; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_certificatename');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="Description" id="Description" maxlength="500" class="empty_validation_class" value="<?php echo @$certificate->Description; ?>" />
                            <label for="Description"><?php echo label('msg_lbl_certificatename')?></label>
                         </div>
                        <div class="input-field col s6">
                            <?php echo $Year;?>
                        </div>
                    </div> 
                   
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($certificate->Status) && @$certificate->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo base_url('admin/masters/candidate/details/'.$CandidateID."#certificate"); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>