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

    function skill (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "company/candidate/ajax_skill/" + current_page_size + "/" + total_page,
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
            url: base_url + "company/candidate/ajax_employment/" + current_page_size + "/" + total_page,
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
            url: base_url + "company/candidate/ajax_project/" + current_page_size + "/" + total_page,
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
            url: base_url + "company/candidate/ajax_certificate/" + current_page_size + "/" + total_page,
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
            url: base_url + "company/candidate/ajax_language/" + current_page_size + "/" + total_page,
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
            url: base_url + "company/candidate/ajax_qualification/" + current_page_size + "/" + total_page,
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


    //---------pagiing and search----------//     
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
        alert(mydiv);
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
</script>
