<?php

if( !class_exists( 'pmPostMetaController' ) ) :
    class pmPostMetaController {
        
        function __construct() {
            
            add_action('admin_menu', array( $this, 'meta_option_menu' ) );
            add_action( 'wp_ajax_mo_manage_group', array($this, 'meta_option_manage_group' ) );
            add_action( 'wp_ajax_mo_add_group', array($this, 'meta_option_add_group' ) );   
            add_action( 'wp_ajax_mo_add_field', array($this, 'meta_option_add_field' ) );
            add_action( 'wp_ajax_mo_change_field', array($this, 'meta_option_change_field' ) );
            add_action( 'wp_ajax_meta_option_group_save', array($this, 'meta_option_group_save' ) );
            add_action('wp_enqueue_scripts', array($this,'load_fe_scripts'));

                    
            
        }
        function set_my_js_var() {
            // logic here for setting the right JS var
            return "some value";
        }
        function load_fe_scripts() {
            
            $localize_array = array(
                'my_js_var' => set_my_js_var()
            );
            wp_localize_script( 'meta-option-post-script', 'my_global', $localize_array );
        }

        function meta_option_menu(){
            $page = add_menu_page( 'Post Meta', 'Post Meta', 'administrator', 'post-meta', array( $this, 'post_meta_menu_page' ) , PM_ASSECTS_URL.'images/icon_gray.png',52); 
            $page = add_submenu_page( 'post-meta', 'Manage Post Meta', 'Manage Post Meta', 'administrator', 'post-meta', array( $this, 'post_meta_menu_page' ));
            
        //$page = add_options_page('Meta Option', 'Meta Option','manage_options' ,'meta_option', array( $this, 'meta_option_menu_page' ));
        add_action('admin_print_styles-' . $page,array( $this,'meta_option_sc'));
        }   
        
        function meta_option_sc(){
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery-ui-droppable');
        wp_enqueue_script('jquery-ui-selectable');
        wp_enqueue_script('jquery-ui-resizable');
        wp_enqueue_script('jquery-ui-dialog');
        
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
        function meta_option_manage_group(){
            global $pluginCore;
            
            $pluginCore->render('manageForm',array('post_type'=>$_POST['post_type']));
           
            die();
            
        }
        function meta_option_add_group(){
            global $pluginCore;
            $meta_box['id']="group_".$_POST['id'];
            $meta_box['title']="New Group ";
            $pluginCore->render('group',array('meta_box'=>$meta_box,'id'=>$_POST['id'],'toggle'=>$_POST['toggle'],'post_type'=>$_POST['post_type']));
            
            die();
        }
        function meta_option_add_field(){
            global $pluginCore;
            $field['title']="$_POST[field_type] Field $_POST[field_id]";
            $field['type']=$_POST['field_type'];
            $pluginCore->render("field",array('field'=>$field,'group_id'=>$_POST['group_id'],'id'=>$_POST['field_id'],'post_type'=>$_POST['post_type'],'field_type'=>$_POST['field_type']));
            
            die();
        }
        
        function meta_option_change_field(){
            global $pluginCore;
            $data =  $_REQUEST ;
            $group_id_array= array_keys($data[group]);
            $group_id=$group_id_array[0];
            $field_id_array=array_keys($data[group][$group_id][field]);
            $field_id = $field_id_array[0];
            $field = $data[group][$group_id][field][$field_id];
            
            $pluginCore->render("field",array('field'=>$field,'group_id'=>$group_id,'id'=>$field_id,'field_type'=>$_POST['field_type'],'toggle'=>true));
            
            die();
        }
        
        
        function meta_option_group_save(){
            global $postMeta,$pluginCore;
            
            if ( wp_verify_nonce( $_REQUEST['mo_nonce'],'nonce') ){
                
                $post_type = $_POST['post_type']; 
                
                unset( $_REQUEST['_wp_http_referer'] );
                unset( $_REQUEST['mo_nonce'] );
                unset( $_REQUEST['action'] );
                unset( $_REQUEST['post_type'] );
                 
                $groups =  $_REQUEST ;           
                
                update_option($postMeta->options[$post_type], $groups );
                
                echo $pluginCore->showMessage("Settings Successfully Saved", 'success');
                die();
                
            }else{
                echo $pluginCore->showMessage("Security Error", 'error');
                die();
            }
            
        }
        function post_meta_menu_page(){
            global $pluginCore;
                            //Section
                    if( !empty( $_GET['section'] ) ) {
                      $section = urlencode($_GET['section']);
                    }
                
                    if( !empty( $_GET['type'] ) ) {
                      $post_type = urlencode( $_GET['type'] );
                    }
                    $data=array(
                                'post_type'=>$post_type
                                );
                    if($section){
                            $this->$section($data);
                            
                    }
                    else{
                         $pluginCore->render('manage');
                    }
                   
    
        }
        
        
        function form_custom_group( $parameter ) {
            global $pluginCore,$postMeta;
            if( $parameter ) extract($parameter); 
            ?>
            <div class="wrap">
              <div id="message_mf_error" class="error below-h2" style="display:none;"><p></p></div>
              <div id="icon-themes" class="icon32"><br></div>
              <?php if( $post_type): ?>
              <h2>Create custom group for <?php echo $post_type; ?></h2>
    <div id="dashboard-widgets-wrap">
    <input type="hidden" name="post_type" id="mo_post_type" value="<?php echo $post_type; ?>" />
    <h2>Meta Option Group <span post_type="<?php  echo $post_type; ?>" class="button add-new-h2 mo_add_button" onclick="moNewGroup(this);">New Group</span> </h2>
    <form id="group_form" method='post' action='options.php' onsubmit='meta_option_group_save(this); return false;'>
        
        <p class="submit">
              	  <a style="color:black" href="admin.php?page=meta_option" class="button">Cancel</a>
              	  <input type="submit" class="button button-primary" name="submit" id="submit" value="Save Custom Group" />
       	</p>
        <div class="metabox-holder">
                    <div id="mo_group_container" class="meta-group-holder  ui-sortable ui-droppable">             
                                <?php
                                     $meta_boxs=get_option($postMeta->options[$post_type]);
                                     if($meta_boxs){
                                     
                                             $i=0;
                                          foreach($meta_boxs['group'] as $meta_box_id => $meta_box):
                                            $i++;
                                            $pluginCore->render('group', array('meta_box'=>$meta_box,'loop'=>$i,'id'=>$meta_box_id,'post_type'=>$post_type));
                                            //$this->render_meta_group($meta_box, array('loop'=>$i,'id'=>$meta_box_id,'post_type'=>$post_type));
                                         
                                         endforeach; //end of metaboxes 
                                     
                                     }
                                     else{
                                        echo '<div id="not-found">No Group Found </div>';
                                     }
                             ?>  
                        </div> <!-- mo_group_container   -->
        </div> <!-- End of metabox-holder   -->
                    <p class="submit">
                              	  <a style="color:black" href="admin.php?page=meta_option" class="button">Cancel</a>
                              	  <input type="submit" class="button button-primary" name="submit" id="submit" value="Save Custom Group">
                   	</p>
                 </form>
                            <?php $maxKey      = $pluginCore->maxKey( $meta_boxs['group'] ); ?>
                            <?php $last_group_id    = $maxKey ? $maxKey : 0 ?>
                        <input type='hidden' id='last_group_id' value='<?php echo $last_group_id; ?>' />
    
                </div>
        
            <?php endif;?>
             </div>
          <?php
          }
        

}
    
    
endif;

?>