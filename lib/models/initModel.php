<?php

if( !class_exists( 'initModel' ) ) :

class initModel {
    
       /**

     * Generate nonce field

     */
    function controllersOrder(){
        return array(
            'moManageController',
            'moPostController',
            'moHelpController',
            'moSettingsController'        
        );
    }
    function loadControllers(){
        global $pluginCore;
                                 
        $classes = array();
        foreach( scandir( $pluginCore->controllersPath ) as $file ) {
            if( preg_match( "/.php$/i" , $file ) )
                $classes[ str_replace( ".php", "", $file ) ] = $pluginCore->controllersPath . $file;            
        }          
        
        $pluginCore->isPro = true;
        if( @$pluginCore->isPro ){
            $proDir = $pluginCore->controllersPath . 'pro/';
            if( file_exists( $proDir ) ){
                foreach( scandir( $proDir ) as $file ) {
                    if( preg_match( "/.php$/i" , $file ) )
                        $classes[ str_replace( ".php", "", $file ) ] = $proDir . $file; 
                }                  
            }          
        }
        
        foreach( $classes as $classPath )
            require_once( $classPath );
            
        /*foreach( $classes as $className => $classPath ){
            require_once( $classPath );     
            $instance[] = new $className;   
        }*/

                
        $controllersOrder = $pluginCore->controllersOrder();
        foreach( $controllersOrder as $className ){
            if( class_exists( $className ) )
                $instance[] = new $className;
        }
        
        
        return $instance;        
    }
    
    function loadUi($uis=array()){
        global $metaOption;
        if($uis){
            foreach($uis as $ui){
            wp_register_style( 'pluginCore-style-'.$ui, $metaOption->assetsUrl.'css/ui/jquery.ui.'.$ui.'.css' );
            wp_register_style('pluginCore-style-'.$ui);
            wp_register_script( 'pluginCore-script-'.$ui, $metaOption->assetsUrl.'js/ui/jquery.ui.'.$ui.'.js'); 
            wp_enqueue_script('pluginCore-script-'.$ui);
            } 
        }
        
    }
    
        /**
         * Render view file
         * @param string $viewName: name of view file without extension
         */
        function render( $viewName, $parameter = array() ){
            global $pluginCore;
            if( $parameter ) extract($parameter);            
            include( $pluginCore->viewsPath . $viewName . '.php' );
            if( isset($html) ) return $html;
        }
        
        function create_input($name='', $type='text', $attr=array(), $options=array()){
            $name   = trim($name);
            $name   = $name ? "name=\"$name\"" : '';      
            
            if( isset($attr['value']) ){
                if( is_string( $attr['value'] ) ) $attr['value'] = esc_attr( trim( $attr['value'] ) );
            }                           
            $value  = isset( $attr['value'] ) ? $attr['value'] : null;           
            
            //filter attr for add
            $excludeAttr = array( 'before', 'after', 'enclose', 'field_enclose','label', 'by_key', 'label_class', 'label_enclose', 'label_extra', 'combind', 'option_before', 'option_after' );      
            $excludeType = array( 'select', 'radio', 'label', 'checkbox' );  //exclude adding value                          
            if(in_array( $type, $excludeType )) $excludeAttr[] = 'value';   
            $include = null;                  
            if($attr){
                foreach( $attr as $key => $val){
                    if( !in_array( $key, $excludeAttr ) ){
                        $include .= $val ? "$key='$val' " : "";
                    }                        
                }
            }
            
            $option_before  = isset( $attr['option_before'] )  ? $attr['option_before'] : null;
            $option_after   = isset( $attr['option_after'] )   ? $attr['option_after']  : null;    
            $by_key         = isset( $attr['by_key'] )         ? $attr['by_key']        : null;    
            $label_class    = isset( $attr['label_class'] )    ? $attr['label_class']   : null;  
            $label_extra    = isset( $attr['label_extra'] )    ? $attr['label_extra']   : null; 
            $field_enclose    = isset( $attr['field_enclose'] )    ? $attr['field_enclose']   : null;
            
            $html = '';          
            if( $type == 'select' ){
                $html .= "<select $name $include>";
                if(isset($options)){                    
                    foreach($options as $key => $val){
                        if( !$by_key ) $key = $val;         
                        $key = is_string($key) ? trim($key) : $key;                                                                    
                        $selected = ($key == $value) ? "selected='selected'" : ""; 
                        $html .= "<option value='$key' $selected>$val</option>";
                    }                    
                }else{ $html .= "No option set yet"; }
                $html .= "</select>";
            }elseif($type == 'radio'){
                if(isset($options)){
                    foreach($options as $key => $val){
                        if( !$by_key ) $key = $val; 
                        $key = is_string($key) ? trim($key) : $key;
                        $checked = ($key == $value) ? "checked='checked'" : "";
                        $html .= "$option_before<input type='$type' $name $include value='$key' $checked /> $val $option_after";
                    }                    
                } else{ $html .= "No option set yet"; }
            }elseif($type == 'checkbox'){ //print_r($options);
                $attr['combind'] = isset($attr['combind']) ? $attr['combind'] : false;
                if( $attr['combind'] ){
                    $name = rtrim( $name, "\"") . "[]\"";
                    if(isset($options)){
                        foreach($options as $key => $val){
                            if( !$by_key ) $key = $val; 
                            $key = is_string($key) ? trim($key) : $key;
                            if( is_array($value) )
                                $checked = in_array( $key, $value ) ? "checked='checked'" : "";
                            else
                                $checked = ($key == $value) ? "checked='checked'" : "";
                            $html .= "$option_before<input type='$type' {$name} $include value='$key' $checked /> $val $option_after";
                        }     
                    }else{ $html .= "No option set yet"; }          
                }else{             
                    $checked = $value ? "checked='checked'" : "";                
                    $html .= "<input type='$type' $name $include $checked />";
                }
            }elseif($type == 'textarea'){
                $html .= "<textarea $name $include>$value</textarea>";
            }elseif($type == 'file'){
                $html .= "<input type='$type' $name $include />";
                //$form_name = isset($config['form_name']) ? $config['form_name'] : '';                
            	/*?><script type="text/javascript">
            		var form = document.getElementById($form_name);
            		form.encoding = 'multipart/form-data';
            		form.setAttribute('enctype', 'multipart/form-data');
            	</script><?php  */        
            }elseif( $type == 'label' ){        
                $for   = isset($attr['for']) ? "for='{$attr['for']}'" : '';
                $html .= "<label $for $include>$value</label>";
            }elseif( $type == 'hidden'){
                $html .= "<input type='$type' $name $include />";
                
            }elseif($type == 'image_media'){
                $html .= "<div id='upload_response_{$attr['id']}'></div>";
                $html .="<a class='button thickbox update_field_media_upload' id='thumb_{$attr['id']}' href='media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=1&amp;width=640&amp;height=255'>Set Image</a>";
                
            }else{
                $html .= "<input type='$type' $name $include />";
            }
            
            
            $before  = isset( $attr['before'] )  ? $attr['before'] : null;
            $after   = isset( $attr['after'] )   ? $attr['after']  : null;            
            $html = $before . $html . $after;
            
            //Enclose by html tag only input field with out label
            if( isset($attr['field_enclose']) ){
                $enclose = $attr['field_enclose'];
                $encloseTag = explode( ' ', trim($enclose) );
                $encloseTag = $encloseTag[0];
                //$output = "<$enclose>$label_html $html</$encloseTag>";
                $html = "<$enclose>$html</$encloseTag>";
            }
            
            //Add lebel if required
            $label_class =  $label_class ? $label_class : 'mo_label';            
            if( isset($attr['label']) ){
                $for   = isset($attr['id']) ? "for='{$attr['id']}'" : '';
                $label_html = "<label class='$label_class' $for>{$attr['label']} {$label_extra}</label>";
                if(isset($attr['label_enclose'])){
                                $enclose = $attr['label_enclose'];
                                $encloseTag = explode( ' ', trim($enclose) );
                                $encloseTag = $encloseTag[0];
                                $label_html = "<$enclose>$label_html</$encloseTag>";                    
                                } 
                //$html = "<label class='$label_class' $for>{$attr['label']}</label>" . $html;
            }
                                                             
            //Enclose by other html element
            if( isset($attr['enclose']) ){
                $enclose = $attr['enclose'];
                $encloseTag = explode( ' ', trim($enclose) );
                $encloseTag = $encloseTag[0];
                //$output = "<$enclose>$label_html $html</$encloseTag>";
                $html = "<$enclose>$label_html $html</$encloseTag>";
            }
                 
            
            return $html;  
            
        }
        /**
         * $message : Message content 
         * $class : success error info warning validation
         * $inAdmin : Which area
         */
        function showMessage($message, $class='success', $inAdmin=false ){
            $class = 'pc_'.$class;
            $html ='';
            $html  .= $inAdmin ? "<div class='updated'><p>$message</p></div>" : "<div class='$class'>$message</div>";
            
            return $html;
        }    
    
}
    
    
    
endif;


?>