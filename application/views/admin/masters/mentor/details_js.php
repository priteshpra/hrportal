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
    window.VideoTitle = '';
    window.SearchText='';
    window.Status='-1';

    $('.tabclick').on('click', function () {
        var hr = $(this).attr('href');
        if(hr=="#video_listing_page"){
            $("#model_title").html("<?php echo label('msg_lbl_title_video');?>");
            common_ajax(current_page_size, total_page);    
        }else if(hr=="#video_purchese"){
            ajax_subscription(current_page_size, total_page);
        }else{

        }
    })
    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/video/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    VideoTitle: VideoTitle,
                    UserID: <?php echo $ID;?>,
                    Status_search: Status
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    function ajax_subscription(current_page_size, total_page) {
        SearchText = $('#SearchText').val();
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/mentor/ajax_subscription_listing/" + current_page_size + "/" + total_page,
            data: {
                    UserID:<?php echo $ID?>,
                    SearchText:SearchText
                    // DesignationID: DesignationID,
                    // MinSalary:MinSalary,
                    // MaxSalary:MaxSalary
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#video_purchese_table_body').html(obj.a);

                $('#video_purchese_table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    $(document).ready(function () {
        ajax_subscription(current_page_size, total_page);
        common_ajax(current_page_size, total_page);
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
    $('#video_purchese_submit').on('click', function () { 
        SearchText = $('#video_purchese .search_action #SearchText').val();
        var current_page_size = $('#video_purchese #select-dropdown').val();
        ajax_subscription(current_page_size, total_page);
    })
    $('#video_purchese #select-dropdown').on('change', function () {
        current_page_size = $('#video_purchese #select-dropdown').val();
        ajax_subscription(current_page_size,total_page);
    })
    $('#video_purchese_table_body').on('click', '#video_purchese .pagination_buttons', function(){
        current_page_size = $('#video_purchese #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_subscription(current_page_size,page);
    })
    $('#video_listing_page #button_submit').on('click', function () { 
        VideoTitle = $('#video_listing_page .search_action #VideoTitle').val();
        Status = $('#video_listing_page input[name="Status_search"]:checked').val();
        var current_page_size = $('#video_purchese #select-dropdown').val();
        common_ajax(current_page_size, total_page);
    })
    $('#video_listing_page #select-dropdown').on('change', function () {
        current_page_size = $('#video_listing_page #select-dropdown').val();
        common_ajax(current_page_size,total_page);
    })
    $('#video_listing_page').on('click', '.pagination_buttons', function(){
        current_page_size = $('#video_listing_page #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(current_page_size,page);
    })
    $("#table_body").on('click', '.status_change', function()
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
            url: base_url + "admin/masters/video/changeStatus",
            data:{id:id,status:status},
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

    $("#table_body").on('click', '.info', function(){ //$(".info").on('click', function () {
        var id = $(this).attr('data-id');
        var table_name = "ssc_video";
        var field_name = "VideoID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/video/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
      
</script>
