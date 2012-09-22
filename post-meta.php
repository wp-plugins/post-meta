<?php
/*
Plugin Name: Post Meta
Plugin URI: http://post-meta.com
Description: This is a post meta generator plugin.
Author: Mahbubur Rahman
Version: 1.0.2
Author URI: http://post-meta.com
*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Please don\'t access this file directly.');
}

require_once ( 'lib/init.php' );  

if (!class_exists( 'postMeta' )){
    class postMeta extends pluginCore {
        public $name    = 'Post Meta';
        public $version = '1.0.2';
        public $prefix  = 'pm_';      
        
        public $pluginPath;
        public $modelsPath;
        public $controllersPath;
        
        public $pluginUrl;
        public $assetsUrl;
        
        public $options;
        
        
        function __construct(){ 
            global $pluginCore;
            $this->pluginSlug       = plugin_basename(__FILE__);
            $this->pluginPath       = dirname( __FILE__ );
            $this->modelsPath       = $this->pluginPath . '/lib/models/';
            $this->controllersPath  = $this->pluginPath . '/lib/controllers/';
            $this->viewsPath        = $this->pluginPath . '/lib/views/';
            $this->viewsPath        = $this->pluginPath . '/lib/helper/';
            
            $this->pluginUrl        = plugins_url( '' , __FILE__ ); 
            $this->assetsUrl        = $this->pluginUrl  . '/assets/'; 
            $this->helperUrl        = $this->pluginUrl  .'/lib/helper/';
            define('PM_PATH',dirname( __FILE__ )); 
            define('PM_PLUGIN_URL',plugins_url( '' , __FILE__ )).'/';
            define('PM_ASSECTS_URL', PM_PLUGIN_URL.'/assets/');
            
          
          $this->options=array(
                            'post_meta' =>'pm_post_meta',
                            'post_types' =>'pm_post_types',
                            'taxonomies'  =>'pm_taxonomies'
                            );
          

        }
        
        
    }
    global $postMeta;
    $postMeta = new postMeta;
    
    
}