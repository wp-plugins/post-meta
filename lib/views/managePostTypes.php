<?php
global $pluginCore;

?>

<div class="wrap">
    <div id="pm-icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>  
    <h2>Custom Post Type Management Panel</h2>   
    <?php do_action( 'mo_notice' ); ?>
    <div id="dashboard-widgets-wrap">
        <div class="metabox-holder">
                <div id="mo_post_taxonomy_list">
                        <?php  
                        echo $pluginCore->render( 'metaBox', array( 
                                        'title'     => "Manage Post Type", 
                                        'content'   => $pluginCore->pmPostTypeList(), 
                                        'deleteIcon'=> false,
                                        'isOpen'    => true,
                                        'toggle'     =>  true
                                    ) );
                        ?>
                </div>
                <div id="mo_loading_area">
                        <?php  
                         echo $pluginCore->render('postType');
                        ?>
                </div>
        </div>
    </div>     
</div>

                    