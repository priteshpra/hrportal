<script>
    window.current_page_size = 10;
    window.total_page = 1;
    window.upcomingpage = 1;
    window.ID = <?php echo $ID;?>;
    window.JobPostType = 'View';
    window.Skill = '';
    window.mydiv = '<?php echo $DivType;?>';
    function common_ajax (current_page_size, total_page,JobPostType) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/company/ajax_jobdetails/" + current_page_size + "/" + total_page,
            data: {
                    ID:ID,
                    Skill:Skill,
                    JobPostType:JobPostType
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#'+mydiv+' .table_body').html(obj.a);
                $('#'+mydiv+' .table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function () {
       $('#data-table-simple_info').hide();
       $("#model_title").html("<?php echo label('msg_lbl_company');?>");
       mydiv = '<?php echo $DivType;?>';
       
       if(mydiv == "view_job"){
        var type = "View"; 
       }else{
        var type = "Applied"; 
       }

       Skill =  $('#Skill').val(); 
       common_ajax(current_page_size, total_page,type);
    })
    $('.all_active_inactive').on('click', function () {
       
        mydiv = $(this).attr('data-div');
        Skill = $('#'+mydiv+' .search_action #Skill').val(); 
        var type = $(this).attr('data-type');
        var total_page = $('#select-dropdown').val();      
        common_ajax(total_page, upcomingpage,type);
 
    })
     $('.tabclick').on('click', function () {
        mydiv = $(this).attr('data-div');   
        var type = $(this).attr('data-type');
        var total_page = $('#'+mydiv+' #select-dropdown').val();
        common_ajax(total_page, upcomingpage,type);    
    })
    $('.select-dropdown').on('change', function () {
        mydiv = $(this).attr('data-div');   
        var type = $(this).attr('data-type');
        var total_page = $('#'+mydiv+' #select-dropdown').val();
        common_ajax(total_page, upcomingpage,type);
    })
    $('.table_paging_div').on('click', '.pagination_buttons', function(){
        mydiv = $(this).attr('data-div');        
        var type = $(this).attr('data-type');
        var total_page = $('#'+mydiv+' #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(total_page, upcomingpage,type);
    })

    $(document).on("click",".changeFilter",function(){
            var filter_option = $(this).val();
            var mydiv = $(this).attr('data-div');
            if(filter_option == "Filter"){ 
                setTimeout(function(){
                    $("#" + mydiv + " .search_action.card-panel input").first().focus();
                }, 500);
                $("#" + mydiv + " .search_action").show();
                $("#" + mydiv + " #display_action").removeClass("mdi-hardware-keyboard-arrow-down" )
                $("#" + mydiv + " #display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
            }else{
                $("#" + mydiv + " .search_action").find("input[type=text], textarea").val("");
                $("#" + mydiv + " .search_action").find("select").val('').material_select();
                $('input[name="Status_search"][value="-1"]').prop("checked", true);
                $("#" + mydiv + " .search_action").hide();
                $("#" + mydiv + " button[type='button']").click();
                $("#" + mydiv + ' #display_action').removeClass("mdi-hardware-keyboard-arrow-up" )
                $("#" + mydiv + " #display_action").addClass( "mdi-hardware-keyboard-arrow-down" );
            }     
        });
    $(document).on("click",".filtercls",function(){
        var mydiv = $(this).attr('data-div');
        if($('#' + mydiv + ' #display_action').hasClass('mdi-hardware-keyboard-arrow-down')){
            $("#" + mydiv + " input[value='Filter']").click();
        }else{
            $("#" + mydiv + " input[value='All']").click();
        }
    });
    $(document).on("click",".clear-all",function(){
            var mydiv = $(this).attr('data-div');
            $("#" + mydiv + " .search_action").find("input[type=text],input[type=email],input[type=number],textarea").val("");
            $("#" + mydiv + " .search_action").find("select").val('').material_select();
            $("#" + mydiv + " input[value='All']").click();
        });
    $(document).on("click","#change_password_button",function(){
            var error = checkValidations();
            var newp = $('#new_password').val();
            var confirm = $("#confirm_password").val();
             if (error === 'yes')
                {
                    alertify.error("<?php echo label('required_field'); ?>");
                    return false;
                }
                if(newp != confirm){
                    alertify.error("<?php echo label('password_conf_not_macth');?>");    
                    return false;
                }
                var flag = isPassword($('#new_password').val());
                if(flag == 1){
                    alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit');?>");
                    return false;
                }
             $.ajax({
                    type:"post",
                    url: "<?php echo base_url();?>admin/masters/company/changepassword",
                    data:{ new_password:newp,CompanyID:<?php echo $ID;?>,confirm_password:confirm},
                    success:function(data){
                        var response = JSON.parse(data);
                        if(response.Status == "Success"){
                            alertify.success(response.Message);
                            $('#submit_button').addClass('hide');
                            $('#button_submit_loading').removeClass('hide');
                            $('#new_password').val('');
                            $('#confirm_password').val('');
                        }else{  
                            alertify.error(response.Message);
                        }
                    }

                });
            return false;
        });
</script>
