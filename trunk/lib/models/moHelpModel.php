<?php
if( !class_exists( 'moHelpModel' ) ) :

class moHelpModel {
    
    
    /**
     * @ This function will retuen All Custom meta key which is created ny Meta Optopn plugin 
     */
    
     function getMetaKeyList(){
        global $postMeta,$pluginCore;
        
            $posttypes=$pluginCore->meta_option_get_post_types();
            $html = '';
            
            $html .= "<div class='mo_meta_key_list'>";
                  foreach($posttypes as  $pt):
            
                        $data = get_option($postMeta->options[$pt->name]);
                       $html .="<h4>Meta Key For $pt->name </h4>";
                       
                        if($data['group']){
                           foreach($data['group'] as $group){
                                if($group['field']){
                                        foreach($group['field'] as $field){
                                            $html .="<ul>"; 
                                                $html .="<li>{$field['meta_key']}</li>";
                                            $html .="</ul>"; 
                                        }
                                    }else{$html .= "No Custom Field Found";}
                            } 
                        }else{ $html .= "No Custom Group Found";}
                          
                    endforeach;
                    
            $html .="</div>";
            return $html;
    }
    
    function getMetaKeyUse(){
        
        $html ="";
        
        $html .= '< ?php $meta_values = get _post_meta($post_id, <b>$meta_key</b>, $single); ?>  ';
        $html .= '<br /> <br />OR <br /> <br />< ?php $meta_values = get _post_meta($post->ID, <b>$meta_key</b>, $single); ?>  ';
        
        $html .='
                <p>
                <h4>$post_id</h4>
                    (integer) (required) The ID of the post from which you want the data. Use $post->ID to get a post\'s ID.
                
                        Default: None
                </p>
                <p>
                <h4>$key</h4>
                    (string) (optional) A string containing the name of the meta value you want.
                
                        Default: empty string
                <p>
                </p>
                <h4>$singlem</h4>
                    (boolean) (optional) If set to true then the function will return a single result, as a string. If false, or not set, then the function returns an array of the custom fields. This may not be intuitive in the context of serialized arrays. If you fetch a serialized array with this method you want $single to be true to actually get an unserialized array back. If you pass in false, or leave it out, you will have an array of one, and the value at index 0 will be the serialized string.
                
                        Default: false
                </p>';
                
        return $html;
        
    }
    
    function manageType($type=null){
        global $pluginCore;
        $html ="";
        if($type=="post_type"):
        /*
        <div class='mo_type_manage'>
                                <div class='mo_edit'></div>
                                <div class='mo_delete'></div>
                            </div>
        */
             //$html .= "<span post_type='$pt->label' class='button add-new-h2 mo_add_button' onclick='moNewGroup(this);' >Add New</span>";
              $posttypes=$pluginCore->meta_option_get_post_types();
              foreach($posttypes as  $pt):
              $html .="<div class='mo_type_manage_option'>
                            
                            <div class='mo_type_option'>
                                <b>$pt->label</b><small>({$pt->labels->menu_name})</small>
                                <span class='mo_edit_link'>
                                    <a href='admin.php?page=meta_option&section=form_custom_group&type=$pt->name' rel='$pt->name' onclick='manageGroup(this); return false;' >Manage Group/Fields</a>
                                </span>
                            </div>
                        </div>";
             endforeach;
             
            
       elseif($type=="taxonomy"):
              $posttypes=$pluginCore->meta_option_get_post_types();
              foreach($posttypes as  $pt):
              $html .="<div class='mo_type_manage_option'>
                            <div class='mo_type_option'>
                                <b>$pt->label</b><small>({$pt->labels->menu_name})</small>
                                <span class='mo_edit_link'>
                                    <a href='admin.php?page=meta_option&section=form_custom_group&type=$pt->name' rel='$pt->name' onclick='manageGroup(this); return false;' >Manage</a>
                                </span>
                            </div>
                        </div>";
             endforeach;
      endif; 
              
         return $html;
    }
    
    function featuredData(){
        $html ='';
        $html .='<h4>Current Feature:</h4>
                    <ul>
                        <li>1. Fully jQuery and ajax based Management</li>
                        <li>2. Group and Field</li>
                        <li>3. Sorting group and field by dragging</li>
                        <li>4. It build for All user(Developer and user)</li>
                    </ul>
                ';
        $html .='<h4>Coming Feature:</h4>
                    <ul>
                        <li>1. Manage Custom Post type and Taxonomy</li>
                        <li>2. Will add more custom field</li>
                        <li>3. Will add more custom feature for both(Developer and user)user</li>
                    </ul>
                ';
                
                
        $html .='<div style="padding:10px"><i><b>Please help me to develop a useful plugin by giving me advice and guideline</b></i></div>';
         return $html;
        
    }
}

endif;
?>