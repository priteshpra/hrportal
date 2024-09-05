<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/motivationalquotes');?>"><strong><?php echo label('msg_lbl_motivationalquote')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/motivationalquotes/<?php echo $page_name; ?>">
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_motivationalquote');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="Message" id="Message" maxlength="500" class="materialize-textarea empty_validation_class"><?=@$data->Message?></textarea>
                            <label for="Message"><?php echo label('msg_lbl_motivationalquote')?></label>
                        </div>
                    </div>                      
                    <div class="row">
                        <div class="input-field col s6 right">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit')?></button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo base_url('admin/masters/motivationalquotes'); ?>" class="right close-button"><?php echo label('msg_lbl_cancel')?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>