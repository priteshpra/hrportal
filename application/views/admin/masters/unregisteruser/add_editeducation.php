<?php //print_r($qualification);die();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/candidate/details/'. $CandidateID);?>#qualification"><strong><?php echo label('msg_lbl_title_qualification')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/<?php echo $page_name; ?>/<?php echo $CandidateID;?>/<?php echo @$ID;?>" enctype= "multipart/form-data">
                 <input style="display: none;" type="password" />
				 <input id="cuid" name="cuid" value="<?php echo isset($CandidateID)?$CandidateID:0; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                           <?= @$qualificationid;?>
                         </div>
                         <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_university');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="University" name="University" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$qualification->University; ?>"  maxlength="200" />
                            <label for="University"><?php echo label('msg_lbl_university')?></label>
                            
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s6">
                            <a id="CourseTip" class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo 'Please Enter Course';?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="Course" class="empty_validation_class" id="Course" value="<?php echo @$qualification->Course; ?>"/>
                            <label id="Courselabel" for="Course"><?php echo 'Course' ?></label>
                        </div>
                        
                        <div class="input-field col s6">
                            <?php echo $Year;?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                           <?= @$grade;?>
                        </div>

                        <div class="input-field col s6 right">
                            <a id="OtherToolTip" class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo 'Please Enter Other Grade';?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="OtherGrade" class="empty_validation_class" id="OtherGrade" value="<?php echo @$qualification->OtherGrade; ?>"/>
                            <label id="OtherLabel" for="OtherGrade"><?php echo 'Other Grade' ?></label>
                        </div>

                    </div> 
                   
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($qualification->Status) && @$qualification->Status == INACTIVE) {
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
                            <a  href="<?php echo base_url('admin/masters/candidate/details/'.$CandidateID); ?>#qualification" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>

<script>
    $(function(){
        if($('#Grade').find('option:selected').val() == "Other"){
              $("#OtherGrade").show();
              $('#OtherGrade').addClass("empty_validation_class");
              $("#OtherToolTip").show();
              $("#OtherLabel").show();
        }else{
            $('#OtherGrade').removeClass("empty_validation_class");
            $('#OtherGrade').val('');
            $("#OtherGrade").hide();
            $("#OtherToolTip").hide();
            $("#OtherLabel").hide();
        }
        $('#Grade').change(function() {
            if($(this).find('option:selected').val() == "Other"){
              $("#OtherGrade").show();
              $('#OtherGrade').addClass("empty_validation_class");
              $("#OtherToolTip").show();
              $("#OtherLabel").show();
            }else{
              $('#OtherGrade').removeClass("empty_validation_class");
              $('#OtherGrade').val('');
              $("#OtherGrade").hide();
              $("#OtherToolTip").hide();
              $("#OtherLabel").hide();
            }
        });    
    });
</script>