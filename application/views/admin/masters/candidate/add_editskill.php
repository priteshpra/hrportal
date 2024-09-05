<?php //print_r($ID);exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/candidate/details/'. $CandidateID . "#skill");?>"><strong><?php echo label('msg_lbl_title_skill')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/<?php echo $page_name; ?>/<?php echo $CandidateID;?>/<?php echo @$ID;?>" enctype= "multipart/form-data">
				 <input id="UserSkillID" name="UserSkillID" value="<?php echo isset($skilluser->UserSkillID)?$skilluser->UserSkillID:0; ?>" type="hidden"  /> 
                 <input id="UserID" name="UserID" value="<?php echo $CandidateID; ?>" type="hidden" /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <?= @$skill;?>
                        </div>
                  </div>   
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($skilluser->Status) && @$skilluser->Status == INACTIVE) {
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
                            <a  href="<?php echo base_url('admin/masters/candidate/details/'.$CandidateID); ?>#skill" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>