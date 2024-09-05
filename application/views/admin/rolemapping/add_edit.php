<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/rolemapping"><strong>Role Mapping</strong></a>
            </h4>
            <form class="col s12" id="edit_rolemapping_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/rolemapping/<?php echo $page; ?>">
                <div class="row">            
                    <div class="input-field col s6">
                        <?php echo $employee; ?>
                    </div>   
                    <div class="input-field col s6">
                        <?php echo $roles; ?>
                    </div>   
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light right" type="button" id="button_rolemapping_submit" name="button_rolemapping_submit" >Submit
                        </button>
                        <?php echo $loading_button; ?>
                        <a  href="<?php echo $this->config->item('base_url'); ?>admin/rolemapping" class="right close-button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
