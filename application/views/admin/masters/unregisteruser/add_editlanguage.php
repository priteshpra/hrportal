<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/candidate/details/'. $CandidateID."#language");?>"><strong><?php echo label('msg_lbl_title_language')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/<?php echo $page_name; ?>/<?php echo $CandidateID;?>/<?php echo @$ID;?>" enctype= "multipart/form-data">
				 <input id="cuid" name="cuid" value="<?php echo isset($CandidateID)?$CandidateID:0; ?>" type="hidden"  /> 
                 <input id="ULid" name="ULid" value="<?php echo isset($ID)? $ID:0; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                           <?= @$languageid;?>
                         </div>
    
                        <div class="switch checkbox_in_iuput col s6">
                            <label class="cyan-text">
                                Basic
                                <input type="checkbox" name="Proficiency" id="Proficiency"
                                    <?php
                                        if (isset($language->Proficiency) && @$language->Proficiency == "Basic") {
                                            echo "";
                                        } 
                                        else {
                                            echo "checked='checked'";
                                        }
                                    ?>
                                >
                                <span class="lever"></span> Fluent
                            </label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($language->Status) && @$language->Status == INACTIVE) {
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
                            <a  href="<?php echo base_url('admin/masters/candidate/details/'.$CandidateID."#language"); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>