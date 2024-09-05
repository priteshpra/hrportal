</div>
</div>
<!-- START FOOTER -->
<!--  <footer class="page-footer m-t-0">
   <div class="footer-copyright">
     <div class="container">
       <span>Copyright © 2015 <a class="grey-text text-lighten-4" href="#">Masters</a> All rights reserved.</span>
       </div>
   </div>
 </footer> -->
<!-- END FOOTER -->



<!-- ================================================
Scripts
================================================ -->

<!-- jQuery Library -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>    
<!--materialize js-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.clockpicker.js"></script>
<!--prism-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/prism.js"></script>
<!--scrollbar-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!-- chartist -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartist-js/chartist.min.js"></script>  
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartjs/chart.min.js"></script>
<!-- sparkline -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/sparkline-script.js"></script>

<!-- google map api -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>
<!-- morris -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/morris-chart/morris.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins.js"></script>

<!-- aleryfy.min.js - Some Specific JS codes for Plugin Settings -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/alertify.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/drag-arrange.js"></script>

<!-- common.js -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/example.js?v=<?= date('YmW'); ?>"></script>

<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/common_js.js?v=<?= date('YmW'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        var wrapper = $('.profile-page-cyan');
        wrapper.height(window.innerHeight - 114);
        $(window).resize(function (event) {
            wrapper.height(window.innerHeight - 114);
        });

    });
</script>
<script>
  $(document).on('click','#DeleteAccount',function(){
    alertify.confirm('Are you sure, Would you like to delete this account?', function(e){ 

      if(e){
        var CurrentUserID = $("#CurrentUserID").val();
        var jsonData = '{"method":"deleteUser","body":{"UserID":"'+ CurrentUserID+'"}}';
        $.ajax({
            type:"post",
            url: base_url + "api/service",
            data:jsonData,
            dataType: "json",
            success:function(data){
              if(data.deleteUser.Error == 200){
                  alertify.success(data.deleteUser.Message);
                  setTimeout(function(){ window.location = base_url +"company-logout" }, 2000);
              }else{
                  alertify.error(data.deleteUser.Message);
              }
            },
        });
      }else{
       
      } 
    });
  });
    //$("[rel^='lightbox']").prettyPhoto();

//For date picker 
   $('.datepicker').pickadate({
        format : 'mm/dd/yyyy',
		formatSubmit: 'mm/dd/yyyy'
    })
     $('.datetime').clockpicker({
      placement: 'bottom',
      align: 'left',
      darktheme: false,
      twelvehour: false
    });
//For select 2
   $('select.select2_class').select2();

    var base_url = "<?php echo $this->config->item('base_url'); ?>";
    var active_status_icon_class = "active_status_icon";
    var inactive_status_icon_class = "inactive_status_icon";
    var loading_status_icon_class = "loading_status_icon";

    $(document).ready(function () {
        // Tooltip only Text
        $('.masterTooltip').hover(function () {
            // Hover over code
            var title = $(this).attr('title');
            $(this).data('tipText', title).removeAttr('title');
            $('<p class="tooltip"></p>')
                    .text(title)
                    .appendTo('body')
                    .fadeIn('slow');
        }, function () {
            // Hover out code
            $(this).attr('title', $(this).data('tipText'));
            $('.tooltip').remove();
        }).mousemove(function (e) {
            var mousex = e.pageX + 20; //Get X coordinates
            var mousey = e.pageY + 10; //Get Y coordinates
            $('.tooltip')
                    .css({top: mousey, left: mousex})
        });
    });

</script>

<script type="text/javascript">
    $(function () {
        $('.draggable-element').arrangeable();
        $('li').arrangeable({dragSelector: '.drag-area'});
    });
</script>
 <script type="text/javascript">
    $('#input_endtime').clockpicker({
      placement: 'bottom',
      align: 'left',
      darktheme: false,
      twelvehour: false
    });
  </script>

    <script type="text/javascript">
    $('#input_outtime').clockpicker({
      placement: 'bottom',
      align: 'left',
      darktheme: false,
      twelvehour: false
    });
  </script>

<?php echo @$page_level_js; ?>
<?php echo @$change_level_js; ?>
<?php echo @$page_level_pending_js; ?>

</body>
</html>