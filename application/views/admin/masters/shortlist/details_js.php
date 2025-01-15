<script>

    window.current_page_size = 10;
    window.total_page = 1;
    window.appliedtotal_page = 1;
    window.savedtotal_page = 1;
    window.DesignationID = '-1';
    window.MinSalary = '-1';
    window.MaxSalary = '-1';
    window.UserID = '-1';
    window.hasTag = '';
    window.tabdiv = '';
    window.invited_type = '';
    $('#basic_details_button').on('click',function(){
        var EmailID = $('#EmailID').val();
        var mob = $('#MobileNo').val();
        var pincode = $('#Pincode').val();
        var uid = $('#cUserID').val();
        var count = (mob.match(/0/g) || []).length;
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        else{
            if(pincode.length < 6 || pincode.length > 6){
                    alertify.error("<?php echo label('pincode_error');?>");
                    return false;
            }
            if(mob.length < 10 || mob.length > 13){
                    alertify.error("<?php echo label('cellphone_error');?>");
                    return false;
            }
            if(count == 10){
                alertify.error("<?php echo label('cellphone_error');?>");
                return false;
            }   
            
            $.ajax({
            type:"post",
            url: "<?php echo base_url();?>admin/masters/company/emailmobileexist",
            data:{ email:EmailID,contact_no:mob,id:uid},
                    success:function(data)
                    {
                        if (data == 1) 
                        {  
                             $.ajax({
                                type: "post",
                                url: base_url + "admin/masters/candidate/editBasicDetails",
                                data: $('#editbasicForm').serialize(),
                                success: function (data)
                                {
                                    alertify.success("Basic details updated");    
                                    return false;
                                },
                                error: function (data)
                                {
                                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                                }
                            })
                        }
                        else 
                        {
                            alertify.error(data);
                            return false;
                        }  
                    }
                });
            return false;
        }
    });

    $('#other_details_button').on('click',function(){
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        else{
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/editOtherDetails",
            data: $('#editotherForm').serialize(),
            success: function (data)
            {
                alertify.success("Other details updated");    
                return false;
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
     }
    });

    function applied_jobs (current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_appliedjobs/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>,
                    DesignationID: DesignationID,
                    MinSalary:MinSalary,
                    MaxSalary:MaxSalary
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#appliedjobs_table_body').html(obj.a);

                $('#appliedjobs_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function saved_jobs (current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_savedjobs/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>,
                    DesignationID: DesignationID,
                    MinSalary:MinSalary,
                    MaxSalary:MaxSalary
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#savedjobs_table_body').html(obj.a);

                $('#savedjobs_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function follow_companies (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_followcompanies/" + current_page_size + "/" + total_page,
            data: {
                    DesignationID: DesignationID,
                    UserID:<?php echo $details->UserID?>
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#followjobs_table_body').html(obj.a);

                $('#followjobs_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function skill (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_skill/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#skill_table_body').html(obj.a);

                $('#skill_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function employment (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_employment/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#employment_table_body').html(obj.a);

                $('#employment_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function project (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_project/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#project_table_body').html(obj.a);

                $('#project_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function certificate (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_certificate/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#certificate_table_body').html(obj.a);

                $('#certificate_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function language (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_language/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#language_table_body').html(obj.a);

                $('#language_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function qualification (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_qualification/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#qualification_table_body').html(obj.a);

                $('#qualification_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function invited(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_invited/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $details->UserID?>,
                    Type:invited_type,
                    Action:$('#' + tabdiv + ' input[type=radio]:checked').val(),
                },
            success: function (data){
                var obj = JSON.parse(data);
                $('#' + tabdiv + ' #table_body').html(obj.a);
                $('#' + tabdiv + ' #table_paging_div').html(obj.b);
            },error: function (data){
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function () {
        $('#data-table-simple_info').hide();
        var exp_val = $('#IsExperience').val();
        if(exp_val == 'Experience'){
            $('#IfExperience').css('display','block');
        }
        if(exp_val == 'Fresher'){
            $('#IfExperience').css('display','none');
        }
       employment(current_page_size,total_page); 
       project(current_page_size,total_page); 
       qualification(current_page_size,total_page);
       applied_jobs(current_page_size,total_page); 
       saved_jobs(current_page_size,total_page);
       follow_companies(current_page_size,total_page);
       skill(current_page_size,total_page);
       certificate(current_page_size,total_page);
       language(current_page_size,total_page);
       // invited(current_page_size,total_page);

    })
    $(document).on('click','.appliedjobs',function(){
        $('#data-table-simple_info').hide();
        current_page_size = $("#applied_job #select-dropdown").val();
        total_page = 1;
        applied_jobs(current_page_size,total_page);
    });
    $(document).on('click','.interview_radio',function(){
        invited(current_page_size,total_page);
    });
    
    $(document).on('click','.savedjobs',function(){
        $('#data-table-simple_info').hide();
        current_page_size = $("#saved_job #select-dropdown").val();
        saved_jobs(current_page_size,total_page);
    });
    $(document).on('click','.followcompany',function(){
        $('#data-table-simple_info').hide();
        current_page_size = $("#follow_company #select-dropdown").val();
        follow_companies(current_page_size,total_page);
    });
    $(document).on('click','.skilltab',function(){
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_skill');?>");
        current_page_size = $("#skill #select-dropdown").val();
        skill(current_page_size,total_page);
    });
    $(document).on('click','.employmenttab',function(){
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_employment');?>");
        current_page_size = $("#employment #select-dropdown").val();
        employment(current_page_size,total_page);
    });
    $(document).on('click','.projecttab',function(){
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_project');?>");
        current_page_size = $("#project #select-dropdown").val();
        project(current_page_size,total_page);
    });
    $(document).on('click','.certificatetab',function(){
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_certificate');?>");
        current_page_size = $("#certificate #select-dropdown").val();
        certificate(current_page_size,total_page);
    });
    $(document).on('click','.languagetab',function(){
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_language');?>");
        hasTag = $(this).attr('href');
        current_page_size = $("#language #select-dropdown").val();
        language(current_page_size,total_page);
    });
    $(document).on('click','.qualificationtab',function(){
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_qualification');?>");
        current_page_size = $("#qualification #select-dropdown").val();
        qualification(current_page_size,total_page);
    });
    $(document).on('click','.directinteview',function(){
        tabdiv = "direct_inteview";
        invited_type = "Company";
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_directinteview');?>");
        current_page_size = $("#direct_inteview #select-dropdown").val();
        invited(current_page_size,total_page);
    });
    $(document).on('click','.jobpostinteview',function(){
        tabdiv = "jobpost_inteview";
        invited_type = "JobPost";
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_jobpostinteview');?>");
        current_page_size = $("#jobpost_inteview #select-dropdown").val();
        invited(current_page_size,total_page);
    });
    $("#skill_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/candidate/changeEmploymentStatus",
            data:{id:id,status:status,type:'Skill'},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
                     
            }
        })
    })

    $("#skill_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ssc_userskill";
        var field_name = "UserSkillID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })
    $("#employment_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/candidate/changeEmploymentStatus",
            data:{id:id,status:status,type:'Employment'},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
                     
            }
        })
    })

    $("#employment_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ssc_useremployement";
        var field_name = "UserEmployementID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $("#language_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/candidate/changeEmploymentStatus",
            data:{id:id,status:status,type:'Language'},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
                     
            }
        })
    })

    $("#language_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ssc_userlanguage";
        var field_name = "UserLanguageID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $("#qualification_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/candidate/changeEmploymentStatus",
            data:{id:id,status:status,type:'Qualification'},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
                     
            }
        })
    })

    $("#qualification_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ssc_userqualification";
        var field_name = "UserQualificationID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $("#project_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/candidate/changeEmploymentStatus",
            data:{id:id,status:status,type:'Project'},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
                     
            }
        })
    })

    $("#project_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ssc_userproject";
        var field_name = "UserProjectID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $("#certificate_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/candidate/changeEmploymentStatus",
            data:{id:id,status:status,type:'Certificate'},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
                     
            }
        })
    })

    $("#certificate_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ssc_usercertificate";
        var field_name = "UserCertificateID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })
    

    $(document).on("click","#change_password_button",function(){
        var newp = $('#new_password').val();
        var confirm = $("#confirm_password").val();
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
                url: "<?php echo base_url();?>admin/masters/candidate/changepassword",
                data:{ new_password:newp,UserID:<?php echo $details->UserID;?>,confirm_password:confirm},
                success:function(data){
                    var response = JSON.parse(data);
                    if(response.Status == "Success"){
                        alertify.success(response.Message);
                        $('#new_password').val('');
                        $('#confirm_password').val('');
                    }else{  
                        alertify.error(response.Message);
                    }
                }

            });
        return false;
    });

    /*$('#button_submit').on('click', function () {
       UserID =  $('#UserID').val(); 
       MaxSalary =  $('#MaxSalary').val(); 
       MinSalary =  $('#MinSalary').val(); 
       DesignationID =  $('#DesignationID').val(); 
       CompanyID =  $('#CompanyID').val(); 
       //JobStatus = $('input[name="JobStatus"]:checked').val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);

    })
*/
    /*$('#select-dropdown').on('change', function () {
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);

    })*/

    /*$('input[name=IsExperience]').on('change',function(){
        if($(this).val() == 'Experience'){
            $('#IfExperience').css('display','block');
            $('#Experience_id').val('');
            $('#Salary').val('');
        }
        else{
            $('#IfExperience').css('display','none');
            //$('#IfSalary').css('display','none');
        }
    });*/
    $(document).on("click",".changeFilter",function(){
            var filter_option = $(this).val();
            var mydiv = $(this).attr('data-div');
            if(filter_option == "Filter"){ 
                setTimeout(function(){
                    $("#" + mydiv + " .search_action.card-panel input").first().focus();
                    //$("#" + mydiv + ' .search_action #PageID').first().select2('open');
                }, 500);
                $("#" + mydiv + " .search_action").show();
                $("#" + mydiv + " #display_action").removeClass("mdi-hardware-keyboard-arrow-down" )
                $("#" + mydiv + " #display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
            }else{
                $("#" + mydiv + " .search_action").find("input[type=text], textarea").val("");
                $("#" + mydiv + " .search_action").find("select").val('').trigger('change');
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
        $("#" + mydiv + " .search_action").find("select").val('').trigger('change');
        $("#" + mydiv + " input[value='All']").click();
    });

        $('#appliedjobs_submit').on('click', function () {
            DesignationID = $('#applied_job .search_action #DesignationID').val();
            var current_page_size = $('#applied_job #select-dropdown').val();
            applied_jobs(current_page_size, total_page);
        })

        $('#direct_inteview #select-dropdown,#jobpost_inteview #select-dropdown').on('change', function () {
            current_page_size = $(this).val();
            total_page = 1;
            invited(current_page_size,total_page);
        })
        $('#applied_job #select-dropdown').on('change', function () {
            current_page_size = $('#applied_job #select-dropdown').val();
            applied_jobs(current_page_size,total_page);
        })
        $('#appliedjobs_table_body').on('click', '#applied_job .pagination_buttons', function(){
            current_page_size = $('#applied_job #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            applied_jobs(current_page_size,page);
        })
        $('#direct_inteview #select-dropdown').on('change', function () {
            current_page_size = $('#direct_inteview #select-dropdown').val();
            invited(current_page_size,total_page);
        })
        $('#direct_inteview').on('click', '.pagination_buttons', function(){
            current_page_size = $('#direct_inteview #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            invited(current_page_size,page);
        })
        $('#jobpost_inteview #select-dropdown').on('change', function () {
            current_page_size = $('#jobpost_inteview #select-dropdown').val();
            invited(current_page_size,total_page);
        })
        $('#jobpost_inteview').on('click', '.pagination_buttons', function(){
            current_page_size = $('#jobpost_inteview #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            invited(current_page_size,total_page);
        })

        $('#savedjobs_submit').on('click', function () {
            DesignationID = $('#saved_job .search_action #DesignationID').val();
            var current_page_size = $('#saved_job #select-dropdown').val();
            saved_jobs(current_page_size, total_page);
        })

        $('#saved_job #select-dropdown').on('change', function () {
            var current_page_size = $('#saved_job #select-dropdown').val();
            saved_jobs(current_page_size,total_page);
        })
        $('#savedjobs_table_paging_div').on('click', '.pagination_buttons', function(){
            current_page_size = $('#saved_job #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            saved_jobs(current_page_size,page);
        })
        $('#follow_submit').on('click', function () {
            DesignationID = $('#follow_company .search_action #DesignationID').val();
            current_page_size = $('#follow_company #select-dropdown').val();
            follow_companies(current_page_size, total_page);
        })

        $('#follow_company #select-dropdown').on('change', function () {
            current_page_size = $('#follow_company #select-dropdown').val();
            follow_companies(current_page_size,total_page);
        })

        $('#followjobs_table_paging_div').on('click', '.pagination_buttons', function () {
            current_page_size = $('#follow_company #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            follow_companies(current_page_size,page);
        })
        $('#skill #select-dropdown').on('change', function () {
            current_page_size = $('#skill #select-dropdown').val();
            skill(current_page_size,total_page);
        })
        
        
        $('#skill_table_paging_div').on('click', '.pagination_buttons', function () {
            current_page_size = $('#skill #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            skill(current_page_size,page);
        })
        $('#employment #select-dropdown').on('change', function () {
            current_page_size = $('#employment #select-dropdown').val();
            employment(current_page_size,total_page);

        })
        $('#employment_table_paging_div').on('click', '.pagination_buttons', function () {
            current_page_size = $('#employment #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            employment(current_page_size,page);
        })
        $('#project #select-dropdown').on('change', function () {
            current_page_size = $('#project #select-dropdown').val();
            project(current_page_size,total_page);

        })
        $('#project_table_paging_div').on('click', '.pagination_buttons', function () {
            current_page_size = $('#project #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            project(current_page_size,page);
        })
        $('#qualification #select-dropdown').on('change', function () {
            current_page_size = $('#qualification #select-dropdown').val();
            qualification(current_page_size,total_page);

        })
        $('#qualification_table_paging_div').on('click', '.pagination_buttons', function () {
            current_page_size = $('#qualification #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            qualification(current_page_size,page);
        })
        $('#certificate #select-dropdown').on('change', function () {
            current_page_size = $('#certificate #select-dropdown').val();
            certificate(current_page_size,total_page);

        })
        $('#certificate_table_paging_div').on('click', '.pagination_buttons', function () {
            current_page_size = $('#certificate #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            certificate(current_page_size,page);
        })
        $('#language #select-dropdown').on('change', function () {
            var current_page_size = $('#language #select-dropdown').val();
            language(current_page_size,total_page);

        })
        $('#language_table_paging_div').on('click', '.pagination_buttons', function () {
            current_page_size = $('#language #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            language(current_page_size,page);
        })
        $('#jobpost_inteview').on('click', '.pagination_buttons', function () {
            current_page_size = $('#jobpost_inteview #select-dropdown').val();
            var page = $(this).attr('data-page-number');
            invited(current_page_size, page)
        })
</script>
