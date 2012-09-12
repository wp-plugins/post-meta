
(function($){
        $(document).ready(function(){
            
            
            
            jQuery("#publish").live('click',function(){
                jQuery("#post").validationEngine();
                if( !jQuery("#post").validationEngine("validate")) {
                                    $('.pc_error').remove();
                                    $('#publishing-action #ajax-loading').hide();
                                    $('#publishing-action #publish').removeClass("button-primary-disabled");
                                    $('#major-publishing-actions').append( $('<div class="pc_error">Sorry, some required fields are missing. Please Fill Required field first</div>') );
                                    return false;
                                }
                                else{
                                    $('.pc_error').remove();
                                    $('#publishing-action #ajax-loading').show();
                                    return true;
                                }
                
            });
            
            
            
              $('#save-post').click(function(){
                //bypass the validation calling directly the submit action from the dom
                $('#post')[0].submit();
            
                //hiding the error messages
                //this messages  will be printed no matter if the validation was bypassed
                $('.formError').hide();
              });
            
           /* umPageNavi( 1, false );
            
            $(".um_rich_text").wysiwyg({initialContent:""});  
            
            $(".um_datetime").datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss' });
            $(".um_date").datepicker({ dateFormat: 'yy-mm-dd' });   
            $(".um_time").timepicker({timeFormat: 'hh:mm:ss'});  
            
            $(".pass_strength").password_strength();    
            
            umFileUploader( '<?php  echo $userMeta->pluginUrl . '/framework/helper/uploader.php' ?>' ); */
               
                      
        });      
    })(jQuery)

/*
jQuery(document).ready(function(){
    
      jQuery('.mf_message_error .error_magicfields').hide();
  jQuery.metadata.setType("attr", "validate");
    
    jQuery("#post").validate({
                ignore:'',
                errorClass: "pc_error",
                errorElement:"div",
            invalidHandler: function(form, validator) { 
              var errors = validator.numberOfInvalids();
              if (errors) {
                jQuery('.pc_error').remove();
                jQuery('#publishing-action #ajax-loading').hide();
                jQuery('#publishing-action #publish').removeClass("button-primary-disabled");
                jQuery('#major-publishing-actions').append( jQuery('<div class="pc_error">jjjjjjjjjjjjjjjjj</div>') ); 
              }
            },
            
            submitHandler: function(form) {
              jQuery('.pc_error').remove();
                form.submit();
              }
      });
  });
*/