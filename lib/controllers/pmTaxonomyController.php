<?php

if( !class_exists( 'pmTaxonomyController' ) ) :
    class pmTaxonomyController {
        
        function __construct() {
                add_action('admin_menu', array( $this, 'pm_menu' ) );
                add_action( 'wp_ajax_pm_taxonomy_add', array($this, 'pm_taxonomy_add' ) );
                add_action( 'wp_ajax_pm_taxonomy_update', array($this, 'pm_taxonomy_update' ) );
                add_action( 'wp_ajax_pm_taxonomy_edit', array($this, 'pm_taxonomy_edit' ) );
                add_action( 'wp_ajax_pm_taxonomy_delete', array($this, 'pm_taxonomy_delete' ) );
                
                add_action('init', array( &$this, 'pm_register_taxonomies' ) );
        }
        function pm_menu(){
            
                $page = add_submenu_page( 'post-meta', 'Manage Custom Taxonomies', 'Manage Taxonomies', 'administrator', 'manage-taxonomies', array( $this, 'taxonomies_menu_page' ));
                
                add_action('admin_print_styles-' . $page,array( $this,'taxonomies_sc'));
            
        }
        function taxonomies_menu_page(){
            global $pluginCore;
            
             $pluginCore->render('mamageTaxonomies');
        }
        function taxonomies_sc(){
                wp_enqueue_script('jquery');
                wp_enqueue_script('jquery-ui-core');
                wp_enqueue_script( 'jquery-ui-widget');
                wp_enqueue_script( 'jquery-ui-mouse');
                wp_enqueue_script('jquery-ui-tabs');
                
                wp_register_style( 'jquery-ui-all', PM_ASSECTS_URL.'css/ui/jquery.ui.all.css');
                wp_enqueue_style('jquery-ui-all' );
                
                wp_register_style( 'pluginCore-style', PM_ASSECTS_URL.'css/pluginCore.css' );
                wp_enqueue_style('pluginCore-style' );
                wp_register_style( 'meta-option-admin-style', PM_ASSECTS_URL.'css/meta_option_admin.css' );
                wp_enqueue_style('meta-option-admin-style' );
                wp_register_style( 'meta-option-validationEngine-css', PM_ASSECTS_URL.'css/jquery/validationEngine.css' );
                wp_enqueue_style('meta-option-validationEngine-css' ); 
                 
                wp_register_script( 'meta-option-admin-script', PM_ASSECTS_URL.'js/meta_option_admin.js'); 
                wp_enqueue_script('meta-option-admin-script' ); 
                wp_register_script( 'meta-option-third-party-slug-string', PM_ASSECTS_URL.'js/jquery/jquery.stringToSlug.js'); 
                wp_enqueue_script('meta-option-third-party-slug-string'); 
                wp_register_script( 'meta-option-validationEngine', PM_ASSECTS_URL.'js/jquery/validationEngine.js'); 
                wp_enqueue_script('meta-option-validationEngine'); 
                wp_register_script( 'meta-option-validationEngine-en', PM_ASSECTS_URL.'js/jquery/validationEngine-en.js'); 
                wp_enqueue_script('meta-option-validationEngine-en');
        }
        
        function pm_taxonomy_add(){
            global $pluginCore;
            echo $pluginCore->render('taxonomy');
            die();
        }
        
        
    function pm_taxonomy_update(){
        global $postMeta,$pluginCore;
        
        if ( wp_verify_nonce( $_REQUEST['pm_nonce'],'nonce') ){
                unset( $_REQUEST['_wp_http_referer'] );
                unset( $_REQUEST['pc_nonce'] );
                unset( $_REQUEST['action'] );
                 
                $taxonomy =  $_REQUEST['pm_taxonomy']; 
                
                $pm_options = get_option( $postMeta->options['taxonomies']);
                
                //check if option exists, if not create an array for it
                if ( !is_array( $pm_options ) ) {
                	$pm_options = array();
                }
                
                $editKey = intval( $_REQUEST['edit_key'] );
                
                foreach($pm_options as $key => $pm_option){
                    if($pm_option['type']==$taxonomy['type']){
                        
                        if($_REQUEST['edit'] && isset($editKey)){
                            
                            $pm_options[$key]=$taxonomy;
                            update_option($postMeta->options['taxonomies'], $pm_options ); //Update existing custom Taxonomy array in the CPT option  
                            echo $pluginCore->showMessage("Taxonomy successfully update", 'success');
                            die();
                        }
                        
                        echo $pluginCore->showMessage("This custom taxonomy allready exist", 'error');
                        die();
                    }
                    
                } 
                if($_REQUEST['edit'] && isset($editKey)){
                            $pm_options[$editKey]=$taxonomy;
                            update_option($postMeta->options['taxonomies'], $pm_options ); //Update existing custom Taxonomy if type name can ne change 
                            echo $pluginCore->showMessage("Taxonomy successfully update", 'success');
                            die();
                    }
                
                		
                	array_push( $pm_options, $taxonomy );//insert new custom post type into the array
                
                	
                	update_option( $postMeta->options['taxonomies'], $pm_options );  //save new custom Taxonomy array in the CPT option       
                
                echo $pluginCore->showMessage("Taxonomy successfully saved", 'success');
                
                die();
            }else{
                echo $pluginCore->showMessage("Security Error", 'error');
                die();
            }
    }
    
    function pm_taxonomy_edit(){
        global $postMeta,$pluginCore;
            if($_REQUEST['taxonomy_key'] || $_REQUEST['taxonomy_key'] ==0){
               $pm_options = get_option( $postMeta->options['taxonomies'] );
               $editKey = intval( $_REQUEST['taxonomy_key'] );
               echo $pluginCore->render('taxonomy', array('data'=>$pm_options[$editKey],'editKey'=>$editKey));
               die();
            }
    }
    
    function pm_taxonomy_delete(){
        global $postMeta,$pluginCore;
            
            if($_REQUEST['taxonomy_key']|| $_REQUEST['taxonomy_key']==0){
               $pm_options = get_option( $postMeta->options['taxonomies'] );
               $deleteKey = intval( $_REQUEST['taxonomy_key'] );
               unset($pm_options[$deleteKey]);
               
               $pm_options = array_values( $pm_options );

		      update_option( $postMeta->options['taxonomies'], $pm_options );
              
               echo $pluginCore->showMessage("Taxonomy Successfully Deleted", 'success');
               die();
            }else{
                echo 'Error';
            }
    }
    
    function pm_register_taxonomies(){
        
        $taxonomies = get_option( $postMeta->options['taxonomies'] );
        if($taxonomies){
            foreach($taxonomies as $taxonomy){
                $name = $taxonomy['type'];
                $in = $taxonomy['post_types'];
                $option = $taxonomy['option'];
                $option['labels'] = $taxonomy['labels'];
                $option['show_in_nav_menus'] = ($option['show_in_nav_menus']) ? true : false;
                $option['query_var'] = ($option['query_var']) ? true : false;
                
                
                if( !$option['update_count_callback'] ){
                unset($option['update_count_callback']);
                }
                if($option['rewrite'] && $option['rewrite_slug'])
                $option['rewrite'] = array( 'slug' => $option['rewrite_slug'] );
                
                unset($option['rewrite_slug']);
                
                register_taxonomy($name,$in,$option); // Register taxonomy
            }            
            
        }
        

    }

}
    
endif;

?>
