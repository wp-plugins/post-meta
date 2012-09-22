/*jQuery(function() {
                jQuery('.meta-group-holder').sortable();
                jQuery('.metabox-fields-holder').sortable();
                
                if( !jQuery('#group_form').validationEngine("validate")) return false;
                //jQuery(toggleIcon).parents('.postbox').children('.inside').toggle();
                //jQuery('.postbox').children('.inside').toggle(); 


});
/*
jQuery(document).ready(function(){
                    jQuery('#toplevel_page_meta_option').hover(function () {
                                                               var src = jQuery(this).children('.wp-menu-image').children('a').children('img').attr('src');
                                                               new_src = src.replace("icon_gray", "icon");
                                                             },
                                                             function () {
                                                                jQuery(this).children('.wp-menu-image').children('a').children('img').attr('src',new_src);
                                                             }
                                                             );
});*/
jQuery('.mo_field_meta_key').click(function(){
        
        label=jQuery(this).parents('.inside').children('.mo_field_segment').children('.mo_field_label');
        group_meta_key=jQuery(this).parents('.inside').parents('.inside').children('.meta_box_info').children('.mo_segment').children('.mo_group_meta_key').val();
        //alert(group_meta_key);
          if (label.val().length > 0 && jQuery(this).val() == '') {
            label.stringToSlug({
              space:'_',
              getPut:jQuery(this), 
              prefix:group_meta_key + " ",
              replace:/\s?\([^\)]*\)/gi
            });
          }
        
    });
    jQuery('.mo_field_label').click(function(){
        
        meta_key=jQuery(this).parents('.inside').children('.mo_field_segment').children('.mo_field_meta_key');
        group_meta_key=jQuery(this).parents('.inside').parents('.inside').children('.meta_box_info').children('.mo_segment').children('.mo_group_meta_key').val();
        alert(jQuery(this).val());
          if (jQuery(this).val().length > 0) {
            jQuery(this).stringToSlug({
              space:'_',
              getPut:meta_key, 
              prefix:group_meta_key + " ",
              replace:/\s?\([^\)]*\)/gi
            });
          }
        
    });

 function meta_option_toggole_field(toggleIcon){
    jQuery(toggleIcon).parents('.box').children('.inside').toggle();
 }
 function meta_option_toggole(toggleIcon){
    jQuery(toggleIcon).parents('.postbox').children('.inside').toggle();
 }
 
function meta_option_remove_field( removeIcon ){
    if( confirm('Confirm to remove?') ){
        jQuery(removeIcon).parents('.postbox').parents('.meta-field').remove();
    }    
}
function meta_option_remove_meta_box( removeIcon ){
    if( confirm('Confirm to remove?') ){
        jQuery(removeIcon).parents('.postbox').parents('.meta-box-sortables').remove();
    }    
}

function moNewGroup( element ){
    
        jQuery('#not-found').remove();
        newGroupID = parseInt( jQuery('#last_group_id').val() ) + 1;
        arg = 'id=' + newGroupID + '&toggle='+ true + '&post_type=' + jQuery(element).attr('post_type');
        AjaxCall( element, 'mo_add_group', arg, function(data){
        jQuery("#mo_group_container").append( data );
        jQuery('#last_group_id').val( newGroupID );
        });
    //newID = parseInt( jQuery("#last_id").val() ) + 1;
    //arg = 'field_type=' + jQuery(element).attr('field_type');
    //alert(arg);
    /*
    pfAjaxCall( element, 'um_add_field', arg, function(data){
        jQuery("#um_fields_container").append( data );        
        jQuery("#last_id").val( newID );
    });*/
}


function manageGroup( element ){
        arg = "post_type="+jQuery(element).attr('rel');
        
    AjaxCall( element, 'mo_manage_group', arg, function(data){
        jQuery("#mo_loading_area").html( data ); 
    });
}

function moNewField( element ){ 
    group_id = jQuery(element).attr('group_id');
    post_type= jQuery(element).attr('post_type');
    field_type= jQuery(element).attr('field_type');
    last_field_id =jQuery("#last_"+group_id+"_field_id").val();//jQuery(".field_count_"+group_id+":last").val();
    newFieldID = parseInt( last_field_id ) + 1;
    arg = "group_id="+group_id+"&post_type="+post_type+"&field_type="+field_type+"&field_id="+newFieldID;
    //alert(field_type);
    AjaxCall( element, 'mo_add_field', arg, function(data){
        jQuery('#not-found').remove();
        jQuery(element).parents('.metabox-option-list').children(".metabox-fields-holder").append( data );
        jQuery("#last_"+group_id+"_field_id").val(newFieldID);   
    });
}

function moChangeGroupTitle( element ){
    title = jQuery(element).val();
    if( !title ){ title = 'Untitled Group'; }
    jQuery(element).parents(".postbox").children("h3").text(title);
}
function moChangeFieldTitle( element ){
  
    title = jQuery(element).val();
    if( !title ){ title = 'Untitled Field'; }
    jQuery(element).parents(".fieldbox").children("h3").children(".mo_admin_field_title").text(title);
            meta_key=jQuery(element).parents('.field-holder').children('.mo_field_segment').children('.mo_field_meta_key');
            jQuery(element).parents(".fieldbox").children("h3").children(".mo_metakey_handl").children('.mo_meta_key').text(meta_key.val());
        group_meta_key=jQuery(element).parents('.inside').parents('.inside').children('.meta_box_info').children('.mo_segment').children('.mo_group_meta_key').val();
            jQuery(element).stringToSlug({
              space:'_',
              getPut: meta_key, 
              prefix: group_meta_key + " ",
              replace:/\s?\([^\)]*\)/gi
            });
}

function moChangeFieldMetaKey( element ){
    metakey = jQuery(element).val();
    jQuery(element).parents(".fieldbox").children("h3").children('.mo_metakey_handl').children(".mo_meta_key").text(metakey);
}

function meta_option_group_save( element ){
    
    jQuery(element).validationEngine();
    if( jQuery(element).validationEngine("validate") ){
                    //jQuery(".inside").css('display','none');
                    jQuery('.pc_error').remove(); 
                    jQuery('.pc_success').remove();               
                    bindElement = jQuery("#submit");
                    mo_post_type = jQuery("#mo_post_type").val();
                    arg = jQuery( element ).serialize()+"&post_type="+mo_post_type;
                    //alert(arg);
                    AjaxCall( bindElement, 'meta_option_group_save', arg, function(data){
                        jQuery('#msg').children(".pc_error").remove();
                        jQuery('#msg').html(data);
                    });
    }else{
        jQuery(".inside").css('display','block');
        jQuery('.pc_success').remove();
        jQuery('#msg').html('<div class="pc_error"> Some Required field need to fill </div>');
                    return false; 
    }
    /*if (!jQuery(element).validate({
                ignore:'',
                errorClass: "pc_error",
                errorElement:"div"}).form())
                {
                    jQuery('.pc_success').remove();
                    return false; //doesn't validate
                }else
                {
                    jQuery('.pc_error').remove(); 
                    jQuery('.pc_success').remove();               
                    bindElement = jQuery("#submit");
                    mo_post_type = jQuery("#mo_post_type").val();
                    arg = jQuery( element ).serialize()+"&post_type="+mo_post_type;
                    //alert(arg);
                    AjaxCall( bindElement, 'meta_option_group_save', arg, function(data){
                        bindElement.parent().children(".mo_ajax").remove();
                        bindElement.after("<div class='mo_ajax'>"+data+"</div>");
                    });
                }

       /* if(!jQuery(element).validate({
                ignore:'',
                errorClass: "pc_error",
                errorElement:"div",
            invalidHandler: function(form, validator) { 
              var errors = validator.numberOfInvalids();
              if (errors) {
                jQuery('.pc_success').remove();
                return false;
                    
              }
            }
      }))return;
      alert('hi');
      /*
      jQuery('.pc_error').remove(); 
                 jQuery('.pc_success').remove();               
                bindElement = jQuery("#submit");
                mo_post_type = jQuery("#mo_post_type").val();
                arg = jQuery( element ).serialize()+"&post_type="+mo_post_type;
                //alert(arg);
               AjaxCall( bindElement, 'meta_option_group_save', arg, function(data){
                    bindElement.parent().children(".mo_ajax").remove();
                    bindElement.after("<div class='mo_ajax'>"+data+"</div>");
                });*/
}
function moChangeField(element ,fieldID, groupID){
    arg = jQuery('#field' + groupID + fieldID + ' * ').serialize();
    AjaxCall( element, "mo_change_field", arg, function(data){
        jQuery(element).parents(".meta-field").replaceWith(data);
    });
}


function AjaxCall( element, action, arg, handle){
    if(action) data = "action=" + action;
    if(arg)    data = arg + "&action=" + action;
    if(arg && !action) data = arg;
    data = data ;
    //data = data + "&pf_nonce=" + pf_nonce + "&is_ajax=true";
    //alert(data);
    //if( typeof(ajaxurl) == 'undefined' ) ajaxurl = front.ajaxurl;

	jQuery.ajax({
		type: "post",
        url: ajaxurl,
        data: data,
		beforeSend: function() { jQuery("<span class='mo_loading'></span>").insertAfter(element); },
		success: function( data ){
            jQuery(".mo_loading").remove();
            handle(data);
		}
	});    
}