<script>
    $(document).ready(function () {
        <?php if($page == 'add'){?>
            setTimeout(function(){ $('.select2_class .select-dropdown').first().click(); }, 1100);
        <?php }
        if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    });

    /*Function For Buutoon click event */

    $('#button_rolemapping_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo SUCCESS_REQUIRED_MESSEGE; ?>");
            return false;
        } else
        {
            $('#button_rolemapping_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("Please wait....");
            $('form').submit();
        }
    });
    $(":checkbox").on("click", function () {
        var name = $(this).attr("value");
        var str = $(this).attr("id");
        var flag, disabled;
        if ($("#" + str).is(':checked')) {
            flag = true;
            disabled = false;
        } else {
            flag = false;
            disabled = true;
        }
        if (str.indexOf("c_all") > 0) {
            child_all(name, flag)
        } else if (str.indexOf("m_") == 0) {
            child_checked(str, flag, disabled);
        } else if (str.indexOf("master_") == 0) {
            master_checked(name, flag, disabled);
        } else {
            if (str.indexOf("m_all") > 0) {
                master_all(name, flag, disabled);
            }
        }
    });

    function master_checked(str, flag, disabled) {
        $('#' + str).find(':checkbox').each(function () {
            if (!$(this).attr("disabled")) {
                var id = $(this).attr("id");
                if (id.indexOf("insert") > 0 || id.indexOf("edit") > 0 || id.indexOf("status") > 0 || id.indexOf("export") > 0 || id.indexOf("c_all") > 0) {
                } else {
                    $("#" + id).prop('checked', flag);
                    child_checked(id, flag, disabled);
                }
            }
        });
    }
    function child_checked(str, flag, disabled) {
        var divid = $("#" + str).attr('value');
        if (flag) {
            $("#master_" + divid).prop('checked', flag);
        }
       $("#" + str + "view").prop('checked', flag);
        $("#" + str + "insert").prop("disabled", disabled)
        $("#" + str + "edit").prop("disabled", disabled)
        $("#" + str + "status").prop("disabled", disabled)
        $("#" + str + "export").prop("disabled", disabled)
        $("#" + str + "c_all").prop("disabled", disabled)
        if (!flag) {
            $("#" + str + "c_all").prop("checked", flag)
            child_all(str, flag);
        }
    }
    function child_all(name, flag) {
       // $("#" + name + "view").prop('checked', flag);
        $("#" + name + "insert").prop('checked', flag);
        $("#" + name + "edit").prop('checked', flag);
        $("#" + name + "status").prop('checked', flag);
        $("#" + name + "export").prop('checked', flag);
    }
    function master_all(str, flag, disabled) {
        $('#' + str).find(':checkbox').each(function () {
            var id = $(this).attr("id");
            if (id.indexOf("c_all") > 0) {
                $("#" + id).prop('checked', flag);
                child_all(id, flag);
            } else {
                $("#" + id).prop('checked', flag);
                child_checked(id, flag, disabled);

            }
        });
        if (disabled == true) {
            var id = str.replace("div", "");
            $("#master_" + id).prop("checked", false);
        }
    }
</script>