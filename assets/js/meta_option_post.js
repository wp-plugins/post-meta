
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


//load button for image media
jQuery(document).ready(function() {
    jQuery('.pc_media_upload_button').click(function() {
         targetfield = jQuery(this).prev('.pc_uploaded_url');
         tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
         return false;
    });
    window.send_to_editor = function(html) {
         imgurl = jQuery('img',html).attr('src');
         alert(imgurl);
         thumUrl= getThum(imgurl);
         tb_remove();
         jQuery(targetfield).val(imgurl);
         
             data='action=pm_media_upload&imgurl='+imgurl;
    
            	jQuery.ajax({
        		type: "post",
                url: ajaxurl,
                data: data,
        	//	beforeSend: function() { jQuery("<span class='mo_loading'></span>").insertAfter(element); },
        		success: function( data ){
                     jQuery('.file_preview_thum').html(data);
        		}
        	});
         
         
        
    }
    
});

function getThum(imgurl){
    
    data='action=pm_media_upload&imgurl='+imgurl;
    
    	jQuery.ajax({
		type: "post",
        url: ajaxurl,
        data: data,
	//	beforeSend: function() { jQuery("<span class='mo_loading'></span>").insertAfter(element); },
		success: function( data ){
            return data;
		}
	});
}