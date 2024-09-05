<script type="text/javascript">
    //---------pagiing and search----------// 
	window.current_page_size = 10;
    window.total_page = 1;   
   window.BannerTitle = '';
    window.SubTitle = '';
    window.Type = '';
    window.Status = '-1';
   $(document).ready(function () {
        
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
})
function common_ajax (current_page_size, total_page) {
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/banner/ajax_listing/" + current_page_size + "/" + total_page,
            data:{
                    BannerTitle:BannerTitle,
                    SubTitle:SubTitle,
                    Type:Type,
                    Status_search:Status
                },
            success:function(data)
            {
                var obj = JSON.parse(data);
                $('#banner_table_body').html(obj.a);
                
                $('#table_paging_div').html(obj.b);
            },
            error:function(data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        });
    }
    $(document).ready(function(){
        //alert('hi');
        $('#data-table-simple_info').hide();
		$("#model_title").html("<?php echo label('msg_lbl_banner');?>");
        common_ajax(current_page_size,total_page);
        
    }) 
    
    $('#button_submit').on('click', function(){
        BannerTitle = $('#BannerTitle').val();
        SubTitle = $('#SubTitle').val();
        Status = $('input[name="Status_search"]:checked').val();
        Type = $('input[name="Type"]:checked').val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);       
    })
    
    $('#select-dropdown').on('change', function(){
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);       
    });
    
    $('#table_paging_div').on('click', '.pagination_buttons',function(){
        var temp = $('#select-dropdown').val();
		var page = $(this).attr('data-page-number');
        common_ajax(temp,page);
    })
//---------/end pagiing and search----------//     

    var field_name = ["BannerTitle","Type"];
     $("#banner_table_body").on('click', '.status_change', function(){
        
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
       
	$('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type:"post",
            url: base_url + "admin/masters/banner/changeStatus",
            data:{id:id,status:status},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if((current_status === 'inactive' && obj.result == "success") || (obj.result == "error" && current_status === 'active'))
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
    
    $("#banner_table_body").on('click', '.info', function(){
    //$(".info").on('click', function () {
        var id = $(this).attr('data-id');
        var table_name = "ssc_banner";
        var field_name = "BannerID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/banner/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            {
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
</script>