<?php global $pluginCore; ?>

<div class="wrap">
    <div id="icon-options-general" class="icon32 icon32-posts-page"><br /></div>  
    <h2>Meta Option Help</h2>   
    <?php do_action( 'um_admin_notice' ); ?>
    <div id="dashboard-widgets-wrap">
        <div class="metabox-holder">
        
                <div id='side-sortables' class='meta-box-sortables'>
                    <div id='user_meta' class='postbox '>
                        <div class='handlediv' title='Click to toggle'><br /></div>
                        <h3 class='hndle'>Meta Option Help</h3>
                        <div class='inside'>
                            <p></p>
                            <div id="mo_meta_key_help">
                                <div class="mo_meta_key_holder">
                                    <?php  
                                    echo $pluginCore->render( 'metaBox', array( 
                                                    'title'     => "Meta Key List", 
                                                    'content'   => $pluginCore->getMetaKeyList(), 
                                                    'deleteIcon'=> false,
                                                    'isOpen'    => true,
                                                    'toggle'     =>  false
                                                ) );
                                    ?>
                                </div>
                                <div class="mo_meta_key_use">
                                    <?php  
                                    echo $pluginCore->render( 'metaBox', array( 
                                                    'title'     => "How to use of Meta Key", 
                                                    'content'   => $pluginCore->getMetaKeyUse(), 
                                                    'deleteIcon'=> false,
                                                    'isOpen'    => true,
                                                    'toggle'     =>  false
                                                ) );
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>     
</div>