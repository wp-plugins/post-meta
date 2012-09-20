/* Post type Manage Page  */

function pmUpdatePostType(element){
    jQuery(element).validationEngine();
    if( !jQuery(element).validationEngine("validate") ) {
                    
                    jQuery('.pc_error').remove(); 
                    jQuery('.pc_success').remove(); 
                    }else{
                        arg=jQuery( element ).serialize();
                        bindElement =jQuery('#submit');
                        jQuery('.pc_error').remove(); 
                        jQuery('.pc_success').remove();
                        
                        AjaxCall( bindElement, 'pm_post_type_update', arg, function(data){
                            jQuery('.msg').children(".pc_error").remove();
                            jQuery('.msg').html(data);
                            //jQuery('#pm_posttype_menu').append("<div class='mo_type_manage_option'><div class='mo_type_option'><b>{$post_type['type']}</b><span class='mo_edit_link'> <a href='#Edit' rel='$key' onclick='editPostType(this); return false;' >Edit</a> | | <a href='#Delete' rel='$key' onclick='deletePostType(this); return false;' >Delete</a></span></div></div>");
                             window.location.reload(true);
                        });
                        
                        /*JsonAjaxCall( jQuery(element), "pm_post_type_update", '', function(data){
                                    jQuery('.msg').children(".pc_error").remove();
                                    jQuery('.msg').html(data.msg);
                                    jQuery('#pm_posttype_menu').append(data.menu);
                        });*/
                        
                        
                    }
    
}


function editPostType(element){
    
    arg = "post_type_key="+jQuery(element).attr('rel');
    AjaxCall( jQuery(element), 'pm_post_type_edit', arg, function(data){
        jQuery("#mo_loading_area").html( data ); 
    });
    
}

function deletePostType(element){
    if( confirm('Confirm to remove?') ){
        arg = "post_type_key="+jQuery(element).attr('rel');
        AjaxCall( jQuery(element), 'pm_post_type_delete', arg, function(data){
            jQuery(element).parents('.mo_edit_link').parents('.mo_type_option').remove(); 
            window.location.reload(true);
        });
    }
}

function addPostType(element){
    AjaxCall( jQuery(element), 'pm_post_type_add','', function(data){
        jQuery("#mo_loading_area").html( data ); 
    });
}

/*  End */

/* Taxonomy manage page */
function pmUpdateTaxonomy(element){
    jQuery(element).validationEngine();
                    if( !jQuery(element).validationEngine("validate") ) {
                    
                        jQuery('.pc_error').remove(); 
                        jQuery('.pc_success').remove(); 
                    }else{
                        arg=jQuery( element ).serialize();
                        bindElement = jQuery('#submit');
                        jQuery('.pc_error').remove(); 
                        jQuery('.pc_success').remove();
                        
                        AjaxCall( bindElement, 'pm_taxonomy_update', arg, function(data){
                            jQuery('.msg').children(".pc_error").remove();
                            jQuery('.msg').html(data);
                            //jQuery('#pm_posttype_menu').append("<div class='mo_type_manage_option'><div class='mo_type_option'><b>{$post_type['type']}</b><span class='mo_edit_link'> <a href='#Edit' rel='$key' onclick='editPostType(this); return false;' >Edit</a> | | <a href='#Delete' rel='$key' onclick='deletePostType(this); return false;' >Delete</a></span></div></div>");
                             window.location.reload(true);
                        });
                        
                        /*JsonAjaxCall( jQuery(element), "pm_post_type_update", '', function(data){
                                    jQuery('.msg').children(".pc_error").remove();
                                    jQuery('.msg').html(data.msg);
                                    jQuery('#pm_posttype_menu').append(data.menu);
                        });*/
                        
                        
                    }
    
}

function editTaxonomy(element){
    
    arg = "taxonomy_key="+jQuery(element).attr('rel');
    AjaxCall( jQuery(element), 'pm_taxonomy_edit', arg, function(data){
        jQuery("#mo_loading_area").html( data ); 
    });
    
}

function deleteTaxonomy(element){
    if( confirm('Confirm to remove?') ){
        arg = "taxonomy_key="+jQuery(element).attr('rel');
        AjaxCall( jQuery(element), 'pm_taxonomy_delete', arg, function(data){
            jQuery(element).parents('.mo_edit_link').parents('.mo_type_option').remove(); 
        });
    }
}

function addTaxonomy(element){
    AjaxCall( jQuery(element), 'pm_taxonomy_add', '', function(data){
        jQuery("#mo_loading_area").html( data ); 
    });
}


function pmTaxonomySuggetion(element){
    jQuery('#advanced-label input[name*=pm_taxonomy]:text').each(function(index,value) {
              rel = jQuery(this).attr('rel');
              label = jQuery('#pm_taxonomy_name').val();
              if(!rel){
                rel =label;
              }else{
                if(rel=='Search'){
                    rel='Search '+label;
                }else if(rel=='Add New'){
                    rel='Add New '+label;
                }else if(rel=='Popular'){
                    rel='Popular '+label;
                }else if(rel=='All'){
                    rel='All '+label;
                }else if(rel=='Parent'){
                    rel='Parent '+label;
                }else if(rel=='Parent:'){
                    rel='Parent '+label+':';
                }else if(rel=='Edit'){
                    rel='Edit '+label;
                }else if(rel=='Update'){
                    rel='Update '+label;
                }else if(rel=='New Name'){
                    rel='New '+label+' Name';
                }else if(rel=='Separate  with commas'){
                    rel='Separate '+label+' with commas';
                }else if(rel=='Choose from the most used'){
                    rel='Choose from the most used '+label;
                }else{
                    rel=jQuery(this).attr('rel')+label;
                }
                
              }
              jQuery(this).val(rel);
            });
            jQuery('#pm_taxonomy_label').val(jQuery(element).val()+'s');
    
}

/* End Taxonomy */
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

function pmSuggetion(element){
    jQuery('#advanced-label input[name*=pm_posttype]:text').each(function(index,value) {
              rel = jQuery(this).attr('rel');
              label = jQuery('#pm_posttype_labal').val();
              //rel = str_replace('%s',label,rel);//
              rel=rel.replace('%s',label);
             // rel=jQuery(this).attr('rel')+label;
              jQuery(this).val(rel);
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


function JsonAjaxCall( element, action, arg, handle){
	jQuery.ajax({
		type: "post",
        url: ajaxurl,
        data: {
            'action':action
            },
        dataType:'JSON',            
		beforeSend: function() { jQuery("<span class='mo_loading'></span>").insertAfter(element); },
        success:function(data){
                    jQuery(".mo_loading").remove();
                        handle(data);
                             },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }
	});    
}

