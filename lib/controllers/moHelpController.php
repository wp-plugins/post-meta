<?php

if( !class_exists( 'moHelpController' ) ) :
    class moHelpController {
        
        function __construct() {
            add_action('admin_menu', array( $this, 'admin_menu' )); 
           
            
        }
        function admin_menu(){
             $page =add_submenu_page( 'post-meta', 'Help', 'Help', 'administrator', 'post-meta-help', array( $this, 'meta_option_help' ));
             add_action('admin_print_styles-' . $page,array( $this,'meta_option_sc'));
        }
        function meta_option_help(){
            global $pluginCore;
            
             $pluginCore->render("help"); 
        }
        function meta_option_sc(){
            
            wp_register_style( 'meta-option-admin-style', PM_ASSECTS_URL.'/css/meta_option_admin.css' );
            wp_enqueue_style('meta-option-admin-style' );
             
            wp_register_script( 'meta-option-admin-script', PM_ASSECTS_URL.'/js/meta_option_admin.js'); 
            wp_enqueue_script('meta-option-admin-script' ); 
        
                 
        }

}
    
endif;

?>
