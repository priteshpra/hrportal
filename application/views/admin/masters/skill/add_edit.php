<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/skill"><strong><?php echo label('msg_lbl_title_skill')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addskillForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/skill/<?php echo $page_name; ?>">
                      <input id="SkillID" name="SkillID" value="<?php echo @$skill->SkillID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s4">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_SkillName');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="SkillName" name="SkillName" type="text" class="empty_validation_class" value="<?php echo @$skill->SkillName; ?>"  maxlength="100" />
                            <label for="SkillName"><?php echo label('msg_lbl_SkillName')?></label>
                        </div>
                        

                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($skill->Status) && @$skill->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/skill" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>