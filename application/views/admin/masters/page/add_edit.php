<?php //pr($page); die();     ?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/page"><strong>Page</strong></a>
            </h4>
            <form class="col s12" id="edit_page_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/page/<?php echo $page_name; ?>">
                <div class="row">            
                    <div class="input-field col s12">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter page name, Maximum length is 50"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                        <input id="PageName" name="PageName" value="<?php echo @$page->PageName; ?>" type="text"  maxlength="50" class="empty_validation_class"  />
                        <label for="PageName">Page Name</label>
                    </div>   
                </div>
                <div class="input-field col s6">     
                    <input   type="checkbox" class="" name="Status" id="Status" <?php
                    if (isset($page->Status) && $page->Status == INACTIVE) {
                        echo "";
                    } else {
                        echo "checked='checked'";
                    }
                    ?>  />
                    <label for="Status">Status</label>
                </div>                   
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light right" type="submit" id="button_page_submit" name="button_page_submit" >Submit
                        </button>
                        <?php echo $loading_button; ?>
                        <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/page" class="right close-button">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>