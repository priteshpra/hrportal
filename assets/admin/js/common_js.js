 /**
 * Purpose : For checking the validations like Empty field validation , Email validation , Mobile phone validation.
 **
 */
 //array for file upload validation'
var images = ["png", "jpg", "jpeg"];
var ImagesValidation = "Upload only .jpeg, .png, .jpg formats";
var videos = ["mp4"];
var VideosValidation = "Upload only .mp4 formats";
var cvfiles = ['png','jpeg','jpg' ,'doc','docx','xls','pdf'];
var CVfilesValidation = "Upload only .jpeg, .png, .jpg, .doc, .docx, .xls, .pdf formats";
var lastValue = '';
window.prevemailid = "";
function readURL(input,id = 'ImagePreivew1') {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('.input_starttime').clockpicker({
    placement: 'bottom',
    align: 'left',
    twelvehour: true
});
$('.input_endtime').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: true,
    twelvehour: false
});
//$('.datepicker').pickadate();
function checkValidations(pre_id = ''){
    var is_error = 'no';
    $(pre_id + ' .empty_validation_class').each(function (){
        if($(this).attr('type') == "checkbox"){
          var name = $(this).attr('name');
          var len = $("input[name='" + name + "']:checked").length;
          if(len == 0){
              is_error = 'yes'; 
              if(!$(this).parent().hasClass('invalid_chk')){
                $(this).parent().addClass('invalid_chk');
              }
          }else{
            $(this).parent().removeClass('invalid_chk');
          }
        }else{
          if ($.trim($(this).val()).length == 0) {
              $(this).addClass("invalid");
              is_error = 'yes';
          } else {
              $(this).removeClass("invalid");
          }

        }
    });
    $(pre_id + ' .MobileNo').each(function (){
        if($(this).val() != ""){
          if($(this).val().length < 10){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    $(pre_id + ' .FixedLength').each(function (){
        if($(this).val() != ""){
          var flength = $(this).attr('fixedlength');
          if($(this).val().length != flength){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    $(pre_id + ' .CustomLength').each(function (){
      if($(this).val() != ""){
          var min = $(this).attr('min');
          var max = $(this).attr('max');
          var len = $(this).val().length;
          if(len < min || max < len){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
      }else{
        if(!$(this).hasClass('empty_validation_class')){
          $(this).removeClass("invalid");
        }
      }
    });

    $(pre_id + ' .WebsiteURL').each(function (){
      if($(this).val() != ""){
      var flag = isWebsiteURL($(this).val());
      if(!flag){
        $(this).addClass("invalid");
        is_error = 'yes';
      }else{
        $(this).removeClass("invalid");
      }
      }else{
        if(!$(this).hasClass('empty_validation_class')){
          $(this).removeClass("invalid");
        }
      } 
    });

    $(pre_id + ' :input[type="email"]').each(function (){
        if($(this).val() != ""){
          var email = isEmail($(this).val());
          if(!email){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    return is_error;
}

    /**
     * Purpose : combo box check empty validation.
     * 
     * Developer : Nilay
     */
function checkComboBox(field_ids = []){
    var is_error = 'no';
    var field_ids_array_length = field_ids.length;
    for (var i = 0; i < field_ids_array_length; i++) {
        var field_value = $('#' + field_ids[i]).val();
        if (field_value === "")
        {
            $("#" + field_ids[i]).parent().find("input").addClass("invalid");
            $("#select2-"+field_ids[i]+"-container").parent().css({
                        "border-bottom":"1px solid red",
                        "border-radius":"3px",
                        "height":"26px"
                    
                    });
            is_error = 'yes';

        } else
        {
            $("#select2-"+field_ids[i]+"-container").parent().css({
                        "border-bottom":"1px solid #9e9e9e",
                        "border-radius":"3px",
                        "height":"26px"
                    });
            $("#" + field_ids[i]).parent().find("input").removeClass("invalid");
        }
    }
    return is_error;
}
/*
Developer Name :Nilay
used for email validation on keypress 
*/
$(":input[type='email']").on("keypress" ,function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    } 
    if ((charCode < 48 && charCode > 32) || (charCode < 64 && charCode > 57) || (charCode < 97 && charCode > 90) || (charCode < 127 && charCode > 122)){      
      if(charCode == 46 || charCode == 95){
          if(charCode == 46 && prevemailid == 46){
            return false;
          }
          prevemailid = charCode;
          return true
      }
      event.preventDefault(); 
      return false;
    }else{
      if(charCode == 64 && $(this).val().indexOf('@') > -1){
          return false;
      }
    prevemailid = charCode;
    return true;
    }
  });
  /*
  Developer Name :Nilay
  used : take only letters
  */
  $(document).on("keypress" ,".LetterOnly",function (event){
  var charCode = event.which;
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      } 
      if ((charCode < 65 && charCode > 32) || (charCode < 97 && charCode > 90) || (charCode > 122 && charCode < 127)){      
          event.preventDefault(); 
          return false;
      }else{
      return true;
      }
  });
  /*
  Developer Name :Nilay
  used : take only Numbers
  */
  $(document).on("keypress" ,".NumberOnly",function (event){
  var charCode = event.which;
    // this condition for tab,Enter,Esc,shift,backspace
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      }
      if(charCode == 0 || charCode == 8 || charCode == 13){
          return true
      } 
        if (charCode > 31 && (charCode < 48 || charCode > 57)){      
         if (charCode == 32) { 
            event.preventDefault();   
         }
        return false;
      }else{
      
    return true;
  }
  });
  /*
  Developer Name :Nilay
  used : take Numbers,Letter
  */
  $(document).on("keypress" ,".NumberLetter",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      }
    if (charCode < 48 || (charCode > 57 && charCode < 65) || (charCode < 97 && charCode > 90) || (charCode > 122 && charCode < 127)){      
        if(charCode == 0 || charCode == 8 || charCode == 13){
          return true
        }      
        event.preventDefault(); 
        return false;
    }else{
    return true;
    }
  });
  /*
  Developer Name :Nilay
  used : take Numbers,Letter
  */
  $(document).on("keypress" ,".NumberLetterSpace",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace,Space
      if(charCode == 0 || charCode == 8 || charCode == 13 || charCode == 32){
              return true;
      }
    if (charCode < 48 || (charCode > 57 && charCode < 65) || (charCode < 97 && charCode > 90) || (charCode > 122 && charCode < 127)){      
        if(charCode == 0 || charCode == 8 || charCode == 13 || charCode == 32){
          return true
        }      
        event.preventDefault(); 
        return false;
    }else{
    return true;
    }
  });
  /*
  Developer Name :Nilay
  used : take year Format
  */
  $(document).on("keypress" ,".YearOnly",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)){      
      if(charCode == 0 || charCode == 8 || charCode == 13){
        return true
      }
      if(charCode === 45 && $(this).val().indexOf('-') == -1){
        return true;
      }
        return false;
    }else{
      return true;
    }
});
  /*
  Developer Name :Nilay
  used : take Numbers and dot(.)
  */
  $(document).on("keypress" ,".AmountOnly",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){      
         if (charCode == 32) { 
            event.preventDefault();   
         }
        return false;
      }else{
        if(charCode == 46 && $(this).val().indexOf('.') > -1){
        return false;
      }
      
    lastValue = $(this).val();
    return true;
  }
  });
    $(document).on("keyup" ,".AmountOnly,.NumberOnly",function (event){
    var attr = $(this).attr('max');
    var decimal = parseInt($(this).attr('decimal-length'));
      if(typeof decimal !== typeof undefined && decimal !== false){
        window.intOnly = 'false';
        decimal += 1;
      }else{
        window.intOnly = 'true';
        decimal = 3;
      }
      if(typeof attr !== typeof undefined && attr !== false){
        
        var thisJ = $(this);
        var max = thisJ.attr("max") * 1;
        var min = 0;
        window.intOnly = String(window.intOnly).toLowerCase() == "true";
            var test = function (str) {
              var returnflag = true;
              if(str.substring(str.indexOf('.')).length > decimal){
                returnflag=false;
                return false;
              }
              console.log(window.intOnly);
            return str == "" || returnflag ||  (window.intOnly && str == ".") ||  ($.isNumeric(str) && str * 1 <= max && str * 1 >= min && (!intOnly || str.indexOf(".") == -1) && str.match(/^0\d/) == null);
            // commented out code would allow entries like ".7"
        };
            thisJ.keydown(function () {
                var str = thisJ.val();
                if (test(str)) 
                    thisJ.data("dwnval", str);
            });
            thisJ.keyup(function () {
                var str = thisJ.val();
                if (!test(str)) 
                    thisJ.val(thisJ.data("dwnval"));
            });
      }
  });
  

// Start Advance Search Functions 
    function changeFilter(filter_option =""){
        
          if(filter_option == "Filter")
          { 
        setTimeout(function(){$(".search_action.card-panel input").first().focus();
        }, 500);
            $(".ScrollStyle").show();
            $(".search_action").show();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
          } 
        else{
            $(".search_action").find("input[type=text], textarea").not(".select-wrapper input").val("");
            $(".search_action").find("select.select_materialize").val('').material_select();
            $(".search_action").find("select.select2_class").val('').trigger('change');
            $('.search_action input[type="radio"][value="-1"]').prop("checked", true);
            $(".ScrollStyle").hide();
            $(".search_action").hide();
            $(".search_action button[type='button']").click();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-down" );
        }         
    }
   
    function clearAllFilter(){
          $(".search_action").find("input[type=text],input[type=email],input[type=number],textarea").not(".select-wrapper input").val("");
          $(".search_action").find(".select_materialize").val('').material_select();
          $(".search_action").find(".select2_class").val('').trigger('change');
          $("input[name=IsExperience]").prop("checked", false);
          $("#All").prop("checked", true);
          $("#All").prop("checked", true);
          changeFilter('All');
    }

    function field_display(){
        var display_class = ($('#display_action').attr('class'));
         if($('#display_action').hasClass('mdi-hardware-keyboard-arrow-down')){
            setTimeout(function(){
              $(".search_action.card-panel input").first().focus();
            }, 500);
            $("#Filter").prop("checked", true);
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
        }else{
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-down" );
            clearAllFilter();
            return;
        }
        $(".ScrollStyle").toggle();
        $(".search_action").toggle();
    }
// End Advance Search Functions
// Start Image upload Chnages 
$("input.fileuploading[type='file']").on("change" ,function (event){
  var cross = $(this).attr('data-cross');
  var img = $(this).attr('data-img');
  var edit = $(this).attr('data-edit');
  var type = $(this).attr('data-type');
  if(typeof type != "undefined"){
    if(type == "Video"){
      var extensionArray = videos;
      var validationString = VideosValidation;
    }else if(type == "CVFiles"){
      var extensionArray = cvfiles;
      var validationString = CVfilesValidation;
    }else{
      var extensionArray = images;
      var validationString = ImagesValidation;
    }
  }else{
    var extensionArray = images;
    var validationString = ImagesValidation;
  }
  if($(this).val() != ""){
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext,extensionArray) == -1) {
        alertify.error(validationString);
        if($.inArray(ext,extensionArray) == -1){
          $(this).val('');
          $('#'+cross).addClass('hide');
          $('#'+edit).val('');
          var path = base_url+"assets/admin/img/noimage.gif";
          $('#'+img).attr("src",path);
          return false;
        }
    }else{
        if($.inArray(ext,ImagesValidation) == -1){
          $('#'+cross).removeClass('hide');
          readURL(this,img);
        }
    }
  }
});
$(".cross1").click(function() {
  var img = $(this).attr('data-img');
  var file = $(this).attr('data-file');
  var edit = $(this).attr('data-edit');

  var path = base_url+"assets/admin/img/noimage.gif";
  $('#'+file).val('');
  $('#'+edit).val('');
  $('#'+img).attr("src",path);
  $(this).addClass('hide');
  });
  $(".cross2").click(function() {
  var img = $(this).attr('data-img');
  var file = $(this).attr('data-file');
  var edit = $(this).attr('data-edit');

  var path = base_url+"assets/admin/img/noimage.gif";
  $('#'+file).val('');
  $('#'+edit).val('');
  $('#'+img).attr("src",path);
  $(this).addClass('hide');
  });
// End 
function isEmail(Email){
    var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var flag = re.test(Email);
	return flag;
}
function isPassword(Password){
  var digitcount = Password.replace(/[^0-9]/g,"").length;
  var alphacount = Password.replace(/[^a-zA-Z]/g,"").length;
  var specialcount = (Password.match(/[@#$%^&*~`()_+\-=\[\]{};':"\\|,.<>\/?]/g) || []).length;
  if(Password.length < 8){
    return 1;
  }
  if(Password.length > 32){
    return 1;
  }
  if(digitcount == 0 || alphacount == 0 || specialcount == 0){
    return 1;
  }
  return 0;
}

function isUrlValid(url) {
    var re = /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
	var flag = re.test(url);
	return flag;
}

/*
Developer Name :Nilay
used for mobile on keypress 
*/
$(".MobileNo").on("keypress" ,function (event){
  var charCode = event.which;
    // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
    if(charCode == 43 ){
    var cnt = $(this).val().length;
      if(cnt == 0){
        return true;  
      }
    } 
    if (charCode > 31 && (charCode < 48 || charCode > 57)){      
     if (charCode == 32) { 
        event.preventDefault();   
     }
      return false;
    }else{
      return true;
    }
  });

/*
Developer Name :Gopi
Convert small Letter into Capital on keyup 
*/
$(document).on("keyup" ,".InputCapital",function (event){
   $(this).val($(this).val().toUpperCase());
 });

/*
Developer Name :Gopi
Salary with Comma
*/
$(document).on("keyup" ,".SalaryComma",function (event){

var formatter = new Intl.NumberFormat('en-US', {
  style: 'decimal',
  currency: 'EUR',
  minimumFractionDigits: 0,
});
 var num = $(this).val();
if(num != ""){
  num = num.replace(/,/g, "");
  var d = formatter.format(num);
  $(this).val(d);
  
}
});

function isWebsiteURL(website){
 var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
 flag = urlregex.test(website);
  return flag;
}