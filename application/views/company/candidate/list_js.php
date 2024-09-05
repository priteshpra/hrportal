<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        min: new Date(),
    })
    $('.timep').clockpicker({
        placement: 'bottom',
        align: 'left',
        darktheme: false,
        autoclose: true,
        twelvehour: false
    });
    $('.timep').on('change', function() {
        $('.timeplabel').addClass('active');
    });
    window.current_page_size = 10;
    window.total_page = 1;
    window.Skills = "";
    window.Salary = "-1~-1";
    window.InterviewType = 'Invited';
    window.DesignationID = '';
    window.Location = '';
    window.SortBy = 'Name';
    window.SortByOrder = 'ASC';
    window.DesignationID = '';
    window.mydiv = 'allcandidate';
    window.submitflag = 1;
    function common_ajax(current_page_size, total_page,SearchType) {
        $.ajax({
            type: "post",
            url: base_url + "company/candidate/ajax_listing/" + current_page_size + "/" + total_page,                                
            data: {
                    Skills:Skills,
                    Salary:Salary,
                    InterviewType:InterviewType,
                    DesignationID:DesignationID,
                    Type:SearchType,
                    Location:Location,
                    SortBy:SortBy,
                    SortByOrder:SortByOrder,
            },success: function (data){   
                var obj = JSON.parse(data);
                $('#'+mydiv+' #table_body').html(obj.a);
                $('#'+mydiv+' #table_paging_div').html(obj.b);
            },error: function (data){
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function () {
        common_ajax(current_page_size,total_page, "All");
    })

    $('.tabclick').on('click', function () {
        mydiv = $(this).attr('data-div');
        type = $(this).attr('data-type');
        current_page_size = $('#'+mydiv+' #select-dropdown').val();
        common_ajax(current_page_size,total_page,type);    
    })

    $('.select-dropdown').on('change', function () {
        mydiv = $(this).attr('data-div');
        type = $(this).attr('data-type');
        current_page_size = $('#'+mydiv+' #select-dropdown').val();
        common_ajax(current_page_size,total_page,type);
        
    })
    $('.table_paging_div').on('click', '.pagination_buttons', function(){
        type = $(this).parents("#table_paging_div").attr('data-type');
        var page = $(this).attr('data-page-number');
        common_ajax(current_page_size,page,type);
    })
    $('.search_action').on('click', '.button_submit', function(){
        mydiv = $(this).attr('data-div');
        type = $(this).attr('data-type');
        Skills= $("#" + mydiv + " #Skills").val();
        Salary= $("#" + mydiv + " #Salary").val();
        DesignationID= $("#" + mydiv + " #DesignationID").val();
        Location= $("#" + mydiv + " #Location").val();
        InterviewType= $("#" + mydiv + " input[name=InterviewType]:checked").val();
        SearchType=type;
        common_ajax(current_page_size,total_page,type);
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
            $("#" + mydiv + " .search_action").find("select.select_materialize").val('').material_select();
            $("#" + mydiv + " .search_action").find("select.select2_class").val('').select2();
            $("#" + mydiv + " input[value='Invited']").prop("checked",true);
            $("#" + mydiv + " input[value='All']").click();
        });

    $('.filter').on('click', function () {
        SortBy = $(this).attr('data-filter');
        $('.filter').removeClass('active');
        if($(this).find('.up').hasClass('hide')){
            $(this).find('.up').removeClass('hide');
            $(this).find('.down').addClass('hide');
            SortByOrder = "ASC";
        }else{
            $(this).find('.down').removeClass('hide');
            $(this).find('.up').addClass('hide');
            SortByOrder = "DESC";
        }
        $(this).addClass('active');
        common_ajax(current_page_size,total_page);
    });
    $(document).on('click',".interview_action",function(){
        var id = $(this).attr('data-id');
        $("#CandidateID").val(id);

        $('#interview_model').openModal();
    })
    $(document).on("click","#inte_button_submit",function(){
        var error = checkValidations('#interview_model');
        var field_ids = ['JobPostID'];
        var combo_box_error = "no";
        var jobpostid = '';
        var time = $("#InterviewTime").val() + ":00";
        var userDate = $("#InterviewDate").val();
        var from = userDate.split("-");
        var usertime = time.split(":");
        var DD = new Date();
        if($('#Inte_JobPost').prop('checked')){
            combo_box_error = checkComboBox(field_ids);
            jobpostid = $("#JobPostID").val();
        }
        if (error === 'yes' || combo_box_error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(submitflag == 0){
                return false;
            }
            submitflag = 0;
            var convdate = from[2]+'-'+from[1]+'-'+from[0];
            var selecdate = new Date(from[2],(from[1]-1),from[0],usertime[0],usertime[1]);
            if(selecdate < DD){
                alertify.error('Please select future datetime');
                return false;
            }
            var jsonData = '{"method":"addCandidateInvitedByCompnay","body":{"CandidateUserID":"' + $("#CandidateID").val() +'","UserID":"'+ $("#UserID").val() +'","JobPostID":"'+ jobpostid +'","InterviewScheduledTime":"'+time+'","InterviewScheduledDate":"'+convdate+'"}}';
            $.ajax({
                type:"post",
                url: base_url + "api/service",
                data:jsonData,
                dataType: "json",
                success:function(data){
                    submitflag = 1;
                    if(data.addCandidateInvitedByCompnay.Error == 200){
                        alertify.success(data.addCandidateInvitedByCompnay.Message);
                        $("#interview_model .modal-close").click();
                        $("#InterviewTime").val('');
                        $("#InterviewDate").val('');
                        $("#Inte_Direct").click();
                        $("#JobPostID").val('').trigger('change');
                    }else{
                        alertify.error(data.addCandidateInvitedByCompnay.Message);
                    }
                },
            });
        }
        return false;
    })
    $(document).on("change","input[name='InterviewType']",function(){
        if($("#Inte_JobPost").prop("checked")){
            $("#jobpost_div").removeClass('hide');
        }else{
            $("#jobpost_div").addClass('hide');
        }
    });
    $(document).on("click",".reject_action",function(){
        var id = $(this).attr('data-id');
        var action = $(this).attr('data-action');
        $("#CompanyJobActionID").val(id);
        $("#Action").val(action);
        $("#reject_model").openModal();        
    });

    $(document).on("click","#reject_button_submit",function(){
        var error = checkValidations('#reject_model');
        combo_box_error = checkComboBox(['Reason']);
        var ActionID = $("#reject_model #CompanyJobActionID").val();
        var UserID = $("#reject_model #UserID").val();
        var Action = $("#reject_model #Action").val();
        var Reason = $("#reject_model #Reason").val();
        if(Reason == 0) {
            Reason = $("#reject_model #OtherReason").val();
        }
        if (error === 'yes' || combo_box_error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            var jsonData = '{"method":"companyJobAction","body":{"CompanyJobActionID":"'+ActionID+'","UserID":"'+ UserID +'","Action":"'+Action+'","CurrentState":"6","Reason":"'+Reason+'"}}';
            $.ajax({
                type:"post",
                url: base_url + "api/service",
                data:jsonData,
                dataType: "json",
                success:function(data){
                    submitflag = 1;
                    if(data.companyJobAction.Error == 200){
                        alertify.success(data.companyJobAction.Message);
                        $("#reject_model .modal-close").click();
                        $("#reject_model #Reason").val().trigger('change');;
                        $("#reject_model #OtherReason").val('');
                    }else{
                        alertify.error(data.companyJobAction.Message);
                    }
                },
            });
        }

    return false;
    });
    $(document).on("change","#Reason",function(){
        var val = $(this).val();
        if(val == "0"){
            $("#otherreason_div").removeClass('hide');
            $("#OtherReason").addClass('empty_validation_class');

        }else{
            $("#otherreason_div").addClass('hide');
            $("#OtherReason").removeClass('empty_validation_class');
        }
    });
</script>


