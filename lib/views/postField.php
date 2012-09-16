<?php
        global $pluginCore;
        global $post;
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['meta_key'], true);
        
        
        $fieldType      = 'text';
        $class          = 'mo_post_input ';
        $divClass       = null;
        $divStyle       = null;
        $fieldOptions   = null;
        $html           = null;
        $validation     = null;
        $maxlength      = null;
        $option_after   = null;
        $by_key         = false;
        $label_class    = null;
        $fieldTitle     = null;
        $fieldID        = "um_field_{$field['id']}";
        $showInputField = true;   
        
        
        if( isset( $field['required'] ) ){
            
            $validation .= 'required,';
           
        }
         if($field['type']=="url"){
                $validation .= "custom[url],";
            }
        if($field['type']=="email"){
            $validation .= "custom[email],";
        }
        if($field['type']=="phone"){
            $validation .= "custom[phone],";
        }       

        
        if( isset( $field['css_class'] ) ){
            $divClass .= "{$field['css_class']} ";
        }
        $field['type']=isset($field['type'])?$field['type']:"text";
        
        
        
        if( isset( $field['css_style'] ) ){
            $divStyle .= "{$field['css_style']} ";
        }
        $divStyle = $divStyle ? "style='$divStyle'" : null;
        
        $style = null;
         if($field['width']){
            $style .= "width:{$field['width']} ";
         }
         if($field['height']){
            $style .= "height:{$field['height']} ";
         }
         
         if($field['rich_text']){
            $class .='pm_rich_text ';
        }
         
         
         
        if($field['type']=='textarea'){
            
            $style ="$style 'cols='60' rows='4";
         }
         
         if($field['type']=='checkbox'){
            if( isset( $field['required'] ) ) :
                $validation .= 'minCheckbox[1],';  
            endif; 
            if($field['alignment']=='horizontal'){
                $option_after = "<br />";
            }
            $combind        = true;
         }
         
         if($field['type']=='radio'){
            if($field['alignment']=='horizontal'){
                $option_after = "<br />";
            }
         }
         
         if( $field['max_char'] ){
                $maxlength = $field['max_char'];
            }
         
        if(  $field['options']  ){
                $temp = explode( ",", $field['options'] );
                foreach( $temp as $val ){
                    $option     = explode( "=", $val );
                    $optionKey  = trim($option[0]);
                    $optionVal  = isset($option[1]) ? trim($option[1]) : $optionKey;
                    $fieldOptions[$optionKey] = $optionVal;
                }
                $by_key = true;
            }
        if($field['type'] == "email" || $field['type'] == "url" || $field['type'] == "phone") $field['type']="text";
         if($field['type']=='text' || $field['type']=='textarea'){
            $placeholder = $field['title'];
         }
        // begin a table row with  
        $required = ($field['required'])?"<span class='required_label'>*</span>":"";
        $label_extra = "<em style='display: none; '>(<span class='mo_field_count'>1</span>)</em>$required";
        
        if($field['type']=='image_media'){
            $class .='pc_uploaded_url ';
        }
        if( $field['type'] == 'rich_text' ){  
            $field['type'] = 'textarea';
            $class    .= "pm_rich_text ";
          }
          

if( $field['type'] == 'number' ){  
    $validation     .= "custom[integer],";
    if( isset( $field['min_number'] ) ) :
        $validation .= "min[{$field['min_number']}],";
    endif;
    if( isset( $field['max_number'] ) ) :
        $validation .= "max[{$field['max_number']}],";
    endif;     
}
  

if( $field['type'] == 'datetime' ){ 
    if( $field['datetime_selection'] == 'date' ) :
        $validation .= "custom[date],";
        $class      .= "pm_date ";
    elseif( $field['datetime_selection'] == 'time' ) :
        $validation .= "custom[time],";
        $class      .= "pm_time ";  
    elseif( $field['datetime_selection'] == 'datetime' ) :
        $validation .= "custom[datetime],";
        $class      .= "pm_datetime ";                
    endif;
}











        if( $validation ) $class .= "validate[" . rtrim( $validation, ',') . "]";
                        $html .= $pluginCore->create_input("mofields[{$field['meta_key']}]",$field['type'], array( 
                                        "value"             =>isset($meta)?$meta: null,
                                        "label"             => "<span class='name'>$field[title]</span>",
                                        "label_class"     => "mo_field_title",
                                        "label_extra"       =>$label_extra,
                                        "id"                => "mo_field_$field[id]",
                                        "class"             =>  $class,
                                        "after"             => "<span class='mo_note'>{$field['desc']}</span>",
                                        "option_after" =>   isset($option_after)  ? $option_after : null,
                                        "placeholder"       =>  isset($placeholder)?$placeholder:null,
                                        "style"             =>  isset($style)?$style:null, 
                                        "field_enclose"     =>  "div class='mo_field_item'",
                                        "maxlength"         => isset($maxlength)?$maxlength:null,
                                        "enclose"           =>  "div class='mo_field $divClass' $divStyle ",
                                        
                                        "onblur"    => isset($onBlur)           ? $onBlur : null,
                                        "combind"   => isset($combind)          ? $combind : false,
                                        "by_key"            =>$by_key
                                     ),$fieldOptions); 
                                     
                                     
        $html = "<div class='mo_group'>$html
        </div>";

?>