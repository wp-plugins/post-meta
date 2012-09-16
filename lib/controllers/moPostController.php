<?php
if( !class_exists( 'moPostController' ) ) :
 class moPostController {
    
        function __construct() {
            
            add_action('add_meta_boxes', array( $this,'add_custom_meta_box'));
            add_action( 'admin_enqueue_scripts', array( $this,'meta_option_script' ));
            add_action( 'wp_ajax_pm_media_upload', array($this, 'pm_media_upload' ) ); 
            add_action('save_post', array($this, 'save_meta_option_data')); 
            }
            
        function meta_option_script(){
                global $post_type;                
                
                if (($_GET['post_type']) || ($post_type)) :
                //wp_enqueue_script('jquery');
                wp_register_style( 'pluginCore-css', PM_ASSECTS_URL.'/css/pluginCore.css' );
                wp_enqueue_style('pluginCore-css' ); 
                wp_register_style( 'meta-option-post-style', PM_ASSECTS_URL.'/css/meta_option_post.css' );
                wp_enqueue_style('meta-option-post-style' );
                //wp_enqueue_script('media-upload');
                //wp_enqueue_script('thickbox');
                wp_register_script( 'meta-option-post-script', PM_ASSECTS_URL.'js/meta_option_post.js',array('jquery','media-upload','thickbox') );
                wp_enqueue_script('meta-option-post-script' );
                
                $data = array(
                            'on_preview'=>PM_ASSECTS_URL.'images/nopreview.gif',       
                    );
                    wp_localize_script( 'jquery', 'pm_jsvar', $data );
                
                wp_register_script( 'postmeta-fileuploader', PM_ASSECTS_URL.'js/jquery/fileuploader.js',array('jquery') );
                wp_enqueue_script('postmeta-fileuploader' );
                wp_register_style( 'postmeta-fileuploader', PM_ASSECTS_URL.'css/jquery/fileuploader.css');
                wp_enqueue_style('postmeta-fileuploader' );
                 
                 /* rich text */
                wp_register_script( 'jquery-wysiwyg', PM_ASSECTS_URL.'js/jquery/jquery.wysiwyg.js',array('jquery') );
                wp_enqueue_script('jquery-wysiwyg' );
                wp_register_style( 'jquery-wysiwyg-css', PM_ASSECTS_URL.'css/jquery/jquery.wysiwyg.css');
                wp_enqueue_style('jquery-wysiwyg-css' );
                wp_register_script( 'wysiwyg-image', PM_ASSECTS_URL.'js/jquery/wysiwyg.image.js',array('jquery') );
                wp_enqueue_script('wysiwyg-image' );
                wp_register_script( 'wysiwyg-link', PM_ASSECTS_URL.'js/jquery/wysiwyg.link.js',array('jquery') );
                wp_enqueue_script('wysiwyg-link' );
                wp_register_script( 'wysiwyg-fullscreen', PM_ASSECTS_URL.'js/jquery/wysiwyg.fullscreen.js',array('jquery') );
                wp_enqueue_script('wysiwyg-fullscreen' );
                wp_register_script( 'wysiwyg-table', PM_ASSECTS_URL.'js/jquery/wysiwyg.table.js',array('jquery') );
                wp_enqueue_script('wysiwyg-table' );
                wp_register_script( 'wysiwyg-cssWrap', PM_ASSECTS_URL.'js/jquery/wysiwyg.cssWrap.js',array('jquery') );
                wp_enqueue_script('wysiwyg-cssWrap' );
                wp_register_script( 'wysiwyg-colorpicker', PM_ASSECTS_URL.'js/jquery/wysiwyg.colorpicker.js',array('jquery') );
                wp_enqueue_script('wysiwyg-colorpicker' );
                wp_register_script( 'jquery-tools-min', PM_ASSECTS_URL.'js/jquery/jquery.tools.min.js',array('jquery') );
                wp_enqueue_script('jquery-tools-min' );
                /* End rich text */
                           
                
                
                
                wp_register_style( 'meta-option-validationEngine-css', PM_ASSECTS_URL.'/css/jquery/validationEngine.css' );
                wp_enqueue_style('meta-option-validationEngine-css' );
                wp_register_script( 'meta-option-validationEngine', PM_ASSECTS_URL.'/js/jquery/validationEngine.js'); 
                wp_enqueue_script('meta-option-validationEngine'); 
                wp_register_script( 'meta-option-validationEngine-en', PM_ASSECTS_URL.'/js/jquery/validationEngine-en.js'); 
                wp_enqueue_script('meta-option-validationEngine-en');
                endif;
            }
            
            function pm_media_upload(){
                global $pluginCore;
                
                echo $pluginCore->render("thumb",array(
                                                        'file'=>$_REQUEST['imgurl'],
                                                        'width'=>150,
                                                        'height'=>150                                                        
                                                        ));
                die();
                
            } 
            
            function add_custom_meta_box(){
                global $postMeta;
                global $pluginCore, $post_type;
                $posttypes=$pluginCore->meta_option_get_post_types();
        
                  foreach($posttypes as  $pt){
                    $meta_boxs=get_option($postMeta->options[$pt->name]);
                        if($meta_boxs){
                            foreach($meta_boxs['group'] as $meta_box){
                                                if($meta_box['field']){
                                                            add_meta_box(  
                                                                        $meta_box['meta_key'], // $id
                                                                        $meta_box['title'], // $title
                                                                        array( $this, 'render_meta_box_content' ), // $callback
                                                                        $pt->name, // $page  
                                                                        $meta_box['context'], // $context
                                                                        $meta_box['priority'],
                                                                        array('fields'=>$meta_box['field'])
                                                                        ); // $priority
                                                        }
                                            } // end of  $meta_boxs['group'] foreach
                                        }
                        }
        
            }

    function render_meta_box_content($post ,$arguments){
        wp_nonce_field( plugin_basename( __FILE__ ), 'mo_nonce' );
        global $pluginCore;
        
       $fields = $arguments['args']['fields'];

      

       if($fields){
            
           foreach($fields as $field){

                    
                  echo $pluginCore->render("postField",array('field'=>$field));

           }

       }
 
    }
    function save_meta_option_data($post_id) {  
        
        // verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['mo_nonce'], plugin_basename( __FILE__ ) ) )return;
        
          // Check permissions
          if ( $_POST['post_type'] ) 
          {
            if ( !current_user_can( 'edit_'.$_POST['post_type'], $post_id ) )
                return;
          }
                    
                    $customfields = $_POST['mofields'];
                    
                    if($customfields){
                                foreach( $customfields as $meta_key => $value ) {
            
                                            $old = get_post_meta($post_id, $meta_key, true);  
                                            $new = $value;  
                                            if ($new && $new != $old) {  
                                                update_post_meta($post_id, $meta_key, $new);  
                                            } elseif ('' == $new && $old) {  
                                                delete_post_meta($post_id, $meta_key, $old);  
                                            } 
                                      } 
                            }
                
            }  
    
    
    
}

endif;

?>