<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/industrytype"><strong><?php echo label('msg_lbl_title_industrytype')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/industrytype/<?php echo $page_name; ?>">
                    <input id="IndustryTypeID" name="IndustryTypeID" value="<?php echo @$industrytype->IndustryTypeID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_industrytype');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Industrytype" name="Industrytype" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$industrytype->IndustryType; ?>"  maxlength="200" />
                            <label for="Industrytype"><?php echo label('msg_lbl_industrytype')?></label>
                        </div>
                    </div>                       
                    <div class="row">
                        <div class="input-field col s12 m6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($industrytype->Status) && @$industrytype->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                        </div>
                        <div class="input-field col s12 m6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/industrytype" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>