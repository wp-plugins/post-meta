<?php

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Please don\'t access this file directly.');
}

if (!class_exists( 'pluginCore' )){
    class pluginCore {
        public $version = '1.0.0';
        public $prefix  = 'pc_';
        
        public $frameworkPath;
        public $modelsPath;
        public $controllersPath;
        public $viewsPath;
        public $pluginPath;
        
        public $frameworkUrl;
        public $pluginUrl;
        public $assetsUrl;
               
        public $scripts = array();
        
        
        function __construct(){                          
            $this->pluginCorePath   = dirname( __FILE__ );
            $this->modelsPath      = $this->pluginCorePath . '/models/';
            $this->controllersPath = $this->pluginCorePath . '/controllers/';
            $this->viewsPath       = $this->pluginCorePath . '/views/';
            
            $this->loadModels( $this->modelsPath );
            //$this->pluginPath      = $this->directoryUp( $this->frameworkPath );            
            //$this->frameworkUrl    = plugins_url( '' , __FILE__ );                                         
            //$this->pluginUrl       = $this->directoryUp( $this->frameworkUrl );
            //$this->assetsUrl       = $this->pluginUrl . '/assets/';                         
        }
         /**
         * Load all class from models directory
         */
        function loadModels( $dir ){
            $classes = $this->loadDirectory( $dir );
            foreach( $classes as $class )
                $this->objects[] = $class;
        }
        /**
         * Include all file from directory
         * Create instence of each class and add return all instance as an array
         */  
        function loadDirectory( $dir ){
            if (!file_exists($dir)) return;
            foreach (scandir($dir) as $item) {
                if( preg_match( "/.php$/i" , $item ) ) {
                    require_once( $dir . $item );
                    $className = str_replace( ".php", "", $item );
                    $classes[] = new $className;
                }      
            }
            return $classes;
        }
                /**
         * Dynamicaly call any  method from models class
         * by pluginFramework instance
         */
        function __call( $name, $args ){
            if( !is_array($this->objects) ) return;
            foreach($this->objects as $object){
                if(method_exists($object, $name)){
                    $count = count($args);
                    if($count == 0)
                        return $object->$name();
                    elseif($count == 1)
                        return $object->$name($args[0]);
                    elseif($count == 2)
                        return $object->$name($args[0], $args[1]);     
                    elseif($count == 3)
                        return $object->$name($args[0], $args[1], $args[2]);      
                    elseif($count == 4)
                        return $object->$name($args[0], $args[1], $args[2], $args[3]);  
                    elseif($count == 5)
                        return $object->$name($args[0], $args[1], $args[2], $args[3], $args[4]);         
                    elseif($count == 6)
                        return $object->$name($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);                                                                                             
                }
            }
        }
    }
    
    
    global $pluginCore;
    if( !is_object( $pluginCore ) )
        $pluginCore = new pluginCore;
        
    $pluginCore->loadControllers( $pluginCore->controllersPath );
    
    
}


?>