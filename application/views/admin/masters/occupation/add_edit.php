<?php //pr($occupation->Name); die();    ?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/occupation"><strong>Occupation</strong></a>
            </h4>
            <form class="col s12" id="edit_occupation_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/occupation/<?php echo $page; ?>">
                <div class="row">            
                    <div class="input-field col s12">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter occupation name, Maximum length is 50"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                        <input id="Name" name="Name" value="<?php echo @$occupation->Name; ?>" type="text"  maxlength="50" class="empty_validation_class"  />
                        <label for="Name">Name</label>
                    </div>   
                </div>


                <div class="input-field col s6">     
                    <input   type="checkbox" class="" name="Status" id="Status" <?php
                    if (isset($occupation->Status) && $occupation->Status == INACTIVE) {
                        echo "";
                    } else {
                        echo "checked='checked'";
                    }
                    ?>  />
                    <label for="Status">Status</label>
                </div>                   
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light right" type="submit" id="button_occupation_submit" name="button_occupation_submit" >Submit
                        </button>
                        <?php echo $loading_button; ?>
                        <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/occupation" class="right close-button">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>