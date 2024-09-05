<script>
	window.RoleName = '';
    window.Status = -1
    window.current_page_size = 10;
    window.total_page = 1;
    var rolid = $('.txt-underline').attr('id');
    /* Past Booking Start*/
	function common_ajax_role(page_size, page,rolid) {
        $.ajax({
            type: "post",
            url: base_url + "admin/role/ajax_roles/" + page_size + "/" + page,
            data:{
                    RoleName : rolid
            },success: function (data){
                var obj = JSON.parse(data);                
                $('#rolemap_table_body').html(obj.a);
                $('#table_paging_div').html(obj.b);
            },error: function (data){
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    $(document).ready(function () {
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_role');?>");
        common_ajax_role(current_page_size, total_page,rolid);
    })
    $('#button_rolemap_submit').on('click', function () {
        $('#data-table-simple_info').hide();
        $("#model_title").html('<?php echo label('msg_lbl_role');?>');
        common_ajax_role(current_page_size, total_page,rolid);
    })
    $('#button_rolemap_submit').on('click', function () {
        RoleName = $('#RoleName').val();
        Status = $('input[name="Status_search"]:checked').val()
        var temp = $('#select-dropdown').val();
        common_ajax_role(temp, total_page,rolid);

    })

    $('#select-dropdown').on('change', function () {
        var temp = $('#select-dropdown').val();
        common_ajax_role(temp, total_page,rolid);

    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        
        common_ajax_role(temp, page,rolid);
    })
    
	
    $("#rolemap_table_body").on('click', '.info', function () { //$(".info").on('click', function () {
        var id = $(this).attr('data-id');
        var table_name = "ssh_roles";
        var field_name = "RoleID";
        $.ajax({
            type: "post",
            url: base_url + "admin/role/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            {
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

</script>