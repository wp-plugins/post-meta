<?php
if( !class_exists( 'moPostController' ) ) :
 class moPostController {
        
        function __construct() {
            
            add_action('add_meta_boxes', array( $this,'add_custom_meta_box'));
            add_action( 'admin_enqueue_scripts', array( $this,'meta_option_script' )); 
            add_action('save_post', array($this, 'save_meta_option_data')); 
            }
            
        function meta_option_script(){
                global $metaOption;
                global $post_type; 
                if (($_GET['post_type']) || ($post_type)) :
                
                wp_register_style( 'pluginCore-css', $metaOption->assetsUrl.'/css/pluginCore.css' );
                wp_enqueue_style('pluginCore-css' ); 
                wp_register_style( 'meta-option-post-style', $metaOption->assetsUrl.'/css/meta_option_post.css' );
                wp_enqueue_style('meta-option-post-style' );
                wp_register_script( 'meta-option-post-script', $metaOption->assetsUrl.'/js/meta_option_post.js' );
                wp_enqueue_script('meta-option-post-script' );
                
               
                
                wp_register_style( 'meta-option-validationEngine-css', $metaOption->assetsUrl.'/css/jquery/validationEngine.css' );
                wp_enqueue_style('meta-option-validationEngine-css' );
                
                wp_register_script( 'meta-option-validationEngine', $metaOption->assetsUrl.'/js/jquery/validationEngine.js'); 
                wp_enqueue_script('meta-option-validationEngine'); 
                wp_register_script( 'meta-option-validationEngine-en', $metaOption->assetsUrl.'/js/jquery/validationEngine-en.js'); 
                wp_enqueue_script('meta-option-validationEngine-en');
                endif;
            } 
            
            
            function add_custom_meta_box(){
                global $metaOption;
                global $pluginCore, $post_type;
                $posttypes=$pluginCore->meta_option_get_post_types();
        
                  foreach($posttypes as  $pt){
                    $meta_boxs=get_option($metaOption->options[$pt->name]);
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