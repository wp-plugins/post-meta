<?php
global $pluginCore;

$field_type_data    = $pluginCore->getFields('key');


if(!$field['title']){$field['title']='Untitled Field';}
$field_type = isset($field_type) ? $field_type : $field['type'] ;

$style=($toggle)?"block":"none";


$fielsTitle = $pluginCore->create_input("group[$group_id][field][$id][title]","text", array( 
                                        "value"     => $field['title'], 
                                        "label"     => "Field Label", 
                                        "id"        => "mo_title_$id",
                                        "class"     => "mo_input mo_field_label validate[required]",
                                        "onclick"     => "moChangeFieldTitle(this)",
                                        "onkeyup"     => "moChangeFieldTitle(this)",
                                        "onmouseout"  =>  "moChangeFieldTitle(this)",
                                        //"after"     => "<div>(Title that will be shown on frontend)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ));
$fieldMetaKey = $pluginCore->create_input("group[$group_id][field][$id][meta_key]","text", array( 
                                        "value"     => isset($field['meta_key'])?$field['meta_key']:$post_type."_".$group_id."_".$id,
                                        "label"     => "Meta Key", 
                                        "id"        => "mo_metakey_$id",
                                        "class"     => "mo_input mo_field_meta_key ",
                                        "onkeyup"     => "moChangeFieldMetaKey(this)",
                                        "after"     => "<div class='mo_note mo_required'>Must be unique and have no space</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ));
$fieldId = $pluginCore->create_input("group[$group_id][field][$id][id]","hidden", array( 
                                        "value"     => $post_type."_".$group_id."_".$id
                                     ));
$fieldType = $pluginCore->create_input("group[$group_id][field][$id][type]","select", array( 
                                        "value"     => isset($field['type']) ? $field['type'] : null, 
                                        "label"     => "Field Type", 
                                        "id"        => "mo_type_$id",
                                        "class"     => "mo_input mo_field_type",
                                        "by_key"    => true,
                                        "onchange"  => "moChangeField(this, $id ,$group_id)",
                                        //"after"     => "<div>(Title that will be shown on frontend)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ),$field_type_data);//array('text'=>'text','textarea'=>'textarea'));
$fieldDescription = $pluginCore->create_input("group[$group_id][field][$id][desc]","textarea", array( 
                                        "value"     => $field['desc'], 
                                        "label"     => "Field Help Text", 
                                        "id"        => "mo_desc_$id",
                                        "class"     => "mo_input",
                                        //"onkeyup"     => "moChangeFieldTitle(this)",
                                        //"after"     => "<div>(Title that will be shown on frontend)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ));
$fieldOptions = $pluginCore->create_input( "group[$group_id][field][$id][options]", "textarea", array( 
                                        "value"     => isset($field['options']) ? $field['options'] : null,
                                        "label"     => "Field Options",
                                        "id"        => "mo_opt_$id", 
                                        "class"     => "mo_input",
                                        "after"     => "<div class='mo_note'><span class='mo_required'>Required Field.</span> (e.g itm1, itm2) for Key Value: itm1=Item 1, itm2=Item 2</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) );  
                                     
$fieldDefaultValue = $pluginCore->create_input( "group[$group_id][field][$id][default_value]", "textarea", array( 
                                        "value"     => isset($field['default_value']) ? $field['default_value'] : null,
                                        "label"     => "Default Value", 
                                        "id"        => "mo_deflt_$id",
                                        "class"     => "mo_input",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) );


 
$fieldRequired = $pluginCore->create_input( "group[$group_id][field][$id][required]", "checkbox", array( 
                                        "value"     => isset($field['required']) ? $field['required'] : null,
                                        "after"     => " Required <br />",
                                     ) ); 

$fieldAlignment = $pluginCore->create_input( "group[$group_id][field][$id][alignment]", "radio", array( 
                                        "value"     => isset($field['alignment']) ? $field['alignment'] : "vertical",
                                        "after"     =>  "<br />",
                                        "by_key"            =>true
                                     ),array('vertical'=>'Vertical','horizontal'=>'Horizontal'));
                                     
                                     
$fieldRichText = $pluginCore->create_input( "group[$group_id][field][$id][rich_text]", "checkbox", array( 
                                        "value"     => isset($field['rich_text']) ? $field['rich_text'] : null,
                                        "after"     => " Use Rich Text <br />", 
                                     ) );

$fieldAdminOnly = $pluginCore->create_input( "group[$group_id][field][$id][admin_only]", "checkbox", array( 
                                        "value"     => isset($field['admin_only']) ? $field['admin_only'] : null,
                                        "after"     => " Admin Only <br />",
                                     ) );     
 
$fieldReadOnly = $pluginCore->create_input( "group[$group_id][field][$id][read_only]", "checkbox", array( 
                                        "value"     => isset($field['read_only']) ? $field['read_only'] : null,
                                        "after"     => " Read Only for all user<br />",
                                     ) ); 
 
$fieldReadOnly .= $pluginCore->create_input( "group[$group_id][field][$id][read_only_non_admin]", "checkbox", array( 
                                        "value"     => isset($field['read_only_non_admin']) ? $field['read_only_non_admin'] : null,
                                        "after"     => " Read Only for non admin <br />",
                                     ) );   
 
$fieldUnique = $pluginCore->create_input( "group[$group_id][field][$id][unique]", "checkbox", array( 
                                        "value"     => isset($field['unique']) ? $field['unique'] : null,
                                        "after"     => " Unique <br />",
                                     ) );  
 
$fieldNonAdminOnly = $pluginCore->create_input( "group[$group_id][field][$id][non_admin_only]", "checkbox", array( 
                                        "value"     => isset($field['non_admin_only']) ? $field['non_admin_only'] : null,
                                        "after"     => " Non-Admin Only <br />",
                                     ) );  
 
$fieldRegistrationOnly = $pluginCore->create_input( "group[$group_id][field][$id][registration_only]", "checkbox", array( 
                                        "value"     => isset($field['registration_only']) ? $field['registration_only'] : null,
                                        "after"     => " Only On Registration Page <br />",
                                     ) );    
 
$fieldTitlePosition = $pluginCore->create_input( "group[$group_id][field][$id][title_position]", "select", array( 
                                        "value"     => isset($field['title_position']) ? $field['title_position'] : null,
                                        "label"     => "Title Position",
                                        "id"        => "mo_title_position_$id", 
                                        "class"     => "mo_input",
                                        "enclose"   => "div class='mo_field_segment'",
                                        "by_key"    => true,
                                     ), array( 'top'=>'Top', 'hidden'=>'Hidden' ) );
$fieldCssClass = $pluginCore->create_input("group[$group_id][field][$id][css_class]","text", array( 
                                        "value"     => $field['class'], 
                                        "label"     => "Field Class", 
                                        "id"        => "mo_css_class_$id",
                                        "class"     => "mo_input",
                                        //"onkeyup"     => "moChangeFieldTitle(this)",
                                        //"after"     => "<div>(Title that will be shown on frontend)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ));
$fieldCssStyle = $pluginCore->create_input( "group[$group_id][field][$id][css_style]", "textarea", array( 
                                        "value"     => isset($field['css_style']) ? $field['css_style'] : null,
                                        "label"     => "CSS Style",
                                        "id"        => "mo_css_style_$id",
                                        "class"     => "mo_input",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) ); 
 
$fieldSize = $pluginCore->create_input( "group[$group_id][field][$id][size]", "text", array( 
                                        "value"     => isset($field['size']) ? $field['size'] : null,
                                        "label"     => "Field Size",
                                        "id"        => "mo_field_size_$id", 
                                        "class"     => "mo_input ",
                                        "after"     => "<div class='mo_note'>(e.g. 200px;)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) ); 
 
$fieldMaxChar = $pluginCore->create_input( "group[$group_id][field][$id][max_char]", "text", array( 
                                        "value"     => isset($field['max_char']) ? $field['max_char'] : null,
                                        "label"     => "Max Char", 
                                        "id"        => "mo_max_char_$id",
                                        "class"     => "mo_input",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) ); 
$fieldHeight = $pluginCore->create_input( "group[$group_id][field][$id][height]", "text", array( 
                                        "value"     => isset($field['height']) ? $field['height'] : null,
                                        "label"     => "Height", 
                                        "id"        => "mo_height_$id",
                                        "class"     => "mo_input",
                                        "after"     => "<div class='mo_note'>(e.g. 200px;)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) ); 
$fieldNimNumber = $pluginCore->create_input( "group[$group_id][field][$id][min_nimber]", "text", array( 
                                        "value"     => isset($field['min_nimber']) ? $field['min_nimber'] : null,
                                        "label"     => "Minimum Number",
                                        "id"        => "mo_minnumber_$id", 
                                        "class"     => "mo_input ",
                                        "after"     => "<div class='mo_note'>(e.g. 5;)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) ); 
$fieldMaxNumber = $pluginCore->create_input( "group[$group_id][field][$id][max_number]", "text", array( 
                                        "value"     => isset($field['max_number']) ? $field['max_number'] : null,
                                        "label"     => "Maximum Number", 
                                        "id"        => "mo_maxnumber_$id",
                                        "class"     => "mo_input",
                                        "after"     => "<div class='mo_note'>(e.g. 40;)</div>",
                                        "enclose"   => "div class='mo_field_segment'",
                                     ) );                                      

$output = "$fielsTitle $fieldType $fieldMetaKey $fieldDescription $fieldId $fieldSize";
$output .= "<div class='mo_field_segment'>";
$output .= "$fieldRequired";
    
    if($field['type'] == 'checkbox' || $field['type'] == 'radio'){
        $output .= "$fieldAlignment";
    }
//$output .= "$fieldAdminOnly $fieldReadOnly";
    if($field['type']=='textarea'){
        $output .="$fieldRichText ";
    }
    
$output .= "</div>";
    if($field['type'] == 'select' || $field['type'] == 'select' || $field['type'] == 'radio' || $field['type'] == 'checkbox'){
        $output .="$fieldOptions $fieldDefaultValue";
    }
    
    if($field['type']=='textarea'){
        $output .="$fieldWidth $fieldHeight ";
    }
    
    if($field['type'] == 'text' || $field['type'] == 'textarea'){
        $output .= "$fieldMaxChar";
    }
    
    if($field['type'] == 'number'){
        $output .= "$fieldNimNumber $fieldMaxNumber";
    }    

$output .= "$fieldCssClass $fieldCssStyle"; 

    if($field['type'] == 'hidden'){
        $output = " $fieldType $fieldMetaKey $fieldId";
    }
 
$output .= "<div class='mo_note'><p>By default, <b>Required</b> and <b>Unique</b> validation will be set with this field. <b>Read Only</b> will be set conditionaly.</p></div>";   

                              
                        $html ='';
                                  //<span class='mo_metakey_handl'>Meta Key ( <span class='mo_meta_key'>$meta_key</span> ) </span>               
                        $html .=  "<div id='side-sortables' class='meta-box-sortables meta-field'>
                                    <div id='$field[title]' class='postbox box fieldbox'>
                                        <div class='mo_trash' title='Click to Romove' onclick='meta_option_remove_field(this);'></div>
                                        <div class='handlediv' title='Click to toggle'  onclick='meta_option_toggole_field(this);'><br/></div>
                                        <h3 class='hndle'><span class='mo_admin_field_title'> $field[title] </span> <span class ='mo_admin_field_type'>( $field_type )</span> ID : $id  </h3> 
                                        <div class='inside' style='display:$style'>
                                        <div id='field$group_id$id' class='field-holder'>";
                                        $html .= "$output";
                                        
                                $html .="</div> 
                                        </div>
                                    </div>
                                    <input type='hidden' class='field_count_$group_id' value='$id' />
                                 </div>";
            
            echo $html;

?>