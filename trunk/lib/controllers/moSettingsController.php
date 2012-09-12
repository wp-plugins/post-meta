<?php

if( !class_exists( 'moSettingsController' ) ) :
    class moSettingsController {
        
        function __construct() {
           // add_action('admin_menu', array( $this, 'admin_menu' )); 
           
            
        }
        function admin_menu(){
             //$page =add_submenu_page( 'meta_option', 'Manage Meta Settings', 'Settings', 'administrator', 'meta_option_settings', array( $this, 'meta_option_settings' ));
             //add_action('admin_print_styles-' . $page,array( $this,'meta_option_sc'));
        }
        function meta_option_settings(){
            global $pluginCore;
            
             $pluginCore->render("settings", $settings); 
        }
        function meta_option_sc(){
            global $metaOption;
            
            wp_register_style( 'meta-option-admin-style', $metaOption->assetsUrl.'/css/meta_option_admin.css' );
            wp_enqueue_style('meta-option-admin-style' );
             
            wp_register_script( 'meta-option-admin-script', $metaOption->assetsUrl.'/js/meta_option_admin.js'); 
            wp_enqueue_script('meta-option-admin-script' ); 
        
                 
        }

}
    
endif;

?>
