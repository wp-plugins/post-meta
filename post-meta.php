<?php
/*
Plugin Name: Post Meta
Plugin URI: http://postmeta.warezdl.org/
Description: This is a post meta generator plugin
Author: Mahbubur Rahman
Version: 0.1
Author URI: http://postmeta.warezdl.org/
*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Please don\'t access this file directly.');
}

require_once ( 'lib/init.php' );  

if (!class_exists( 'metaOption' )){
    class metaOption extends pluginCore {
        public $name    = 'Post Meta';
        public $version = '0.1';
        public $prefix  = 'mo_';       
        

        public $options;
        public $transient;
        
        public $pluginPath;
        public $modelsPath;
        public $controllersPath;
        
        public $pluginUrl;
        public $assetsUrl;
        
        
        function __construct(){ 
            global $pluginCore;
            $this->pluginSlug       = plugin_basename(__FILE__);
            $this->pluginPath       = dirname( __FILE__ );
            $this->modelsPath       = $this->pluginPath . '/lib/models/';
            $this->controllersPath  = $this->pluginPath . '/lib/controllers/';
            $this->viewsPath        = $this->pluginPath . '/lib/views/';
            
            $this->pluginUrl        = plugins_url( '' , __FILE__ ); 
            $this->assetsUrl        = $this->pluginUrl  . '/assets/';  
               
          
          $posttypes=$pluginCore->meta_option_get_post_types();
          foreach($posttypes as  $pt){
            $this->options[$pt->name]='meta_options_'.$pt->name;
            //$this->all_fields[$pt->name]=array();
          }
                                                       
        }
    }
    global $metaOption;
    $metaOption = new metaOption;
}