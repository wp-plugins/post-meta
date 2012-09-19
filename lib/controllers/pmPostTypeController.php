<?php

if( !class_exists( 'pmPostTypeController' ) ) :
    class pmPostTypeController {
        
        function __construct() {
            add_action('admin_menu', array( $this, 'meta_option_menu' ) );
            add_action( 'wp_ajax_pm_post_type_add', array($this, 'pm_post_type_add' ) );
            add_action( 'wp_ajax_pm_post_type_edit', array($this, 'pm_post_type_edit' ) );
            add_action( 'wp_ajax_pm_post_type_delete', array($this, 'pm_post_type_delete' ) );
            add_action( 'wp_ajax_pm_post_type_update', array($this, 'pm_post_type_update' ) );
           
           
           add_action('init', array( &$this, 'pm_register_post_types' ) );
        }
        function meta_option_menu(){
            
            $page = add_submenu_page( 'post-meta', 'Manage Custom Post Types', 'Manage Post Types', 'administrator', 'manage-post-types', array( $this, 'post_types_menu_page' ));
            
        //$page = add_options_page('Meta Option', 'Meta Option','manage_options' ,'meta_option', array( $this, 'meta_option_menu_page' ));
        add_action('admin_print_styles-' . $page,array( $this,'post_types_sc'));
        }
        
        
        function post_types_menu_page(){
                 global $pluginCore;
                 $pluginCore->render('managePostTypes');
        }
        
        function post_types_sc(){
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
        
        
        function pm_post_type_add(){
            global $pluginCore;
            
            echo $pluginCore->render('postType');
            die();
        }
        function pm_post_type_edit(){
            global $pluginCore;
            if($_REQUEST['post_type_key'] || $_REQUEST['post_type_key'] ==0){
               $pm_options = get_option( 'pm_post_types' );
               
               echo $pluginCore->render('postType', array('data'=>$pm_options[$_REQUEST['post_type_key']]));
               die();
            }
        }
        function pm_post_type_update(){
            //delete_option('pm_post_types');
            global $pluginCore;
                unset( $_REQUEST['_wp_http_referer'] );
                unset( $_REQUEST['mo_nonce'] );
                unset( $_REQUEST['action'] );
                unset( $_REQUEST['post_type'] );
                 
                $postType =  $_REQUEST['pm_posttype']; 
                
              	$pm_options = get_option( 'pm_post_types' );
                
                
                
                

        		//check if option exists, if not create an array for it
        		if ( !is_array( $pm_options ) ) {
        			$pm_options = array();
        		}
                

                foreach($pm_options as $key => $pm_option){
                    if($pm_option['type']==$postType['type']){
                        
                        if($_REQUEST['edit']){
                            $pm_options[$key]=$postType;
                            update_option('pm_post_types', $pm_options );
                            echo $pluginCore->showMessage("Successfully Update", 'success');
                            die();
                        }
                        
                        echo $pluginCore->showMessage("This post type allready exist", 'error');
                        die();
                    }
                    
                } 
                //$pm_options[$postType['type']]=$postType;
                		//insert new custom post type into the array*/
            		array_push( $pm_options, $postType );
            
            		//save new custom post type array in the CPT option
            		update_option( 'pm_post_types', $pm_options );         
                
                echo $pluginCore->showMessage("Settings Successfully Saved", 'success');
            
            die();
        }
        
        function pm_post_type_delete(){
            global $pluginCore;
            
            if($_REQUEST['post_type_key']|| $_REQUEST['post_type_key']==0){
               $pm_options = get_option( 'pm_post_types' );
               $delType = intval( $_REQUEST['post_type_key'] );
               unset($pm_options[$delType]);
               $pm_options = array_values( $pm_options );

		      update_option( 'pm_post_types', $pm_options );
              
              print_r($pm_options);
               
               echo $pluginCore->showMessage("Successfully Update", 'success');
               die();
            }else{
                echo 'Error';
            }
        }
        
        
        function pm_register_post_types(){
            
            $pm_postTyps = get_option( 'pm_post_types' );
            
            if($pm_postTyps){
                        foreach($pm_postTyps as $postType){
                            
                            $name = $postType['type'];
                            $postType['labels'] =  (is_array($postType['labels']))?$postType['labels']:array();  
                            $option = $postType['option'];
                            $postType['taxonomy'] = (is_array($postType['taxonomy']))?$postType['taxonomy']:array();
                            $postType['support'] =  (is_array($postType['support']))?$postType['support']:array();
                            //$option['public'] =   ($$option['public']==1)?true:false;  
                            //$option['show_ui'] = ($option['show_ui']==1)?true:false;   
                               
                                              
                             $option['show_in_menu'] = ($option['show_in_menu']) ? true : false;
                                $option['query_var'] = ($option['query_var']) ? true : false;
                                $option['exclude_from_search'] = ($option['exclude_from_search']) ? true : false;
                              
                                if(isset($option['has_archive']) && $option['has_archive'] && isset($option['has_archive_slug']) && $option['has_archive_slug'])	
                                    $option['has_archive'] = $option['has_archive_slug'];
                                
                                  if($option['rewrite'] && $option['rewrite_slug'])
                                    $option['rewrite'] = array( 'slug' => $option['rewrite_slug'],'with_front' => true );
                                
                                  //check Capability type
                                trim($option['capability_type']);
                                if(empty($option['capability_type'])){
                                    $option['capability_type'] = 'post';
                                }elseif( !in_array($option['capability_type'],array('post','page')) ){
                                $option['capabilities'] = $this->_get_cap($option['capability_type']);
                                }
                                
                                
                          $args = array(
                            'labels' => $postType['labels'],
                            'public' => $option['public'],
                            'publicly_queryable' => true,
                            'show_ui' => $option['show_ui'], 
                            'show_in_menu' => true, 
                            'query_var' => true,
                            'rewrite' => true,
                            'capability_type' => 'post',
                            'has_archive' => true, 
                            'hierarchical' => false,
                            'menu_position' => null,
                            'taxonomies'            =>$postType['taxonomy'],
                            'supports' => $postType['support']
                          ); 
                          register_post_type($name,$args);
                            
                            /*
                                $option['show_in_menu'] = ($option['show_in_menu']) ? true : false;
                                $option['query_var'] = ($option['query_var']) ? true : false;
                                $option['exclude_from_search'] = ($option['exclude_from_search']) ? true : false;
                              
                                if(isset($option['has_archive']) && $option['has_archive'] && isset($option['has_archive_slug']) && $option['has_archive_slug'])	
                                    $option['has_archive'] = $option['has_archive_slug'];
                                
                                  if($option['rewrite'] && $option['rewrite_slug'])
                                    $option['rewrite'] = array( 'slug' => $option['rewrite_slug'],'with_front' => true );
                                
                                  //check Capability type
                                trim($option['capability_type']);
                                if(empty($option['capability_type'])){
                                    $option['capability_type'] = 'post';
                                }elseif( !in_array($option['capability_type'],array('post','page')) ){
                                $option['capabilities'] = $this->_get_cap($option['capability_type']);
                                }
                              
                                            
                              $args = array(
                                    'labels'                => $postType['labels'],
                                    'public'                => $option['public'],
                                    'publicly_queryable'    => $option['publicly_queryable'],
                                    'exclude_from_search'   => $option['exclude_from_search'],
                                    'show_ui'               => $option['show_ui'], 
                                    'show_in_menu'          => $option['show_in_menu'], 
                                    'query_var'             => $option['query_var'],
                                    //'rewrite'               => $option['rewrite'],
                                    'capability_type'       => $option['capability_type'],
                                    //'capabilities'          => $option['capabilities'],
                                    //'has_archive'           => isset($option['has_archive'])?$option['has_archive']:true, 
                                    //'hierarchical'          => isset($option['hierarchical'])?$option['hierarchical']:false,
                                    'menu_position'         => isset($option['menu_position'])?intval($option['menu_position']):null,
                                    //'description'           => esc_html($postType["description"]),
                                    'taxonomies'            =>$postType['taxonomy'],
                                    'supports'              => $postType['support']
                                  ); 
                                  
                                  register_post_type($name,$args);*/
                        }
            }
            
        }
        
      public function _get_cap($name){

            $caps = array(
              'edit_post'          => sprintf('edit_%s',$name),
              'read_post'          => sprintf('read_%s',$name),
              'delete_post'        => sprintf('delete_%s',$name),
              'edit_posts'         => sprintf('edit_%ss',$name),
              'edit_others_posts'  => sprintf('edit_others_%ss',$name),
              'publish_posts'      => sprintf('publish_%ss',$name),
              'read_private_posts' => sprintf('read_private_%ss',$name)
            );
        
              return $caps;
          }
        

}
    
endif;

?>
