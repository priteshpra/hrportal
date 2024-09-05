(function(){
   function loadStateBasedCities()
    {
        var state = $('#StateID').val();

        $.ajax({
            type: "POST",
            url: site_url + "",
            data: "state_id=" + $('#StateID').val(),
            success: function (result)
            {
                console.log(state);
                $('#city_info_icon').show();
                $('#city_combo_box').html(result);
                $('#city_combo_box').show();
                //$('#StateID').select2();
            },
            error: function (result)
            {
                console.log("error" + result);
            }
        });
        $('#StateID').on('change', function ()
        {
            $('#city_info_icon').show();
        })

    } 
});