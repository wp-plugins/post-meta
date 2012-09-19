<?php
global $pluginCore; 

if($data){
    $title = "Edit your custom post type :( $data[type] )";
    $hidden = "<input type='hidden' name='edit' value='edit' />";
    $button_txt ="Update Custom Post Type";
}else{
    $title ="Add new custom post type";
    $hidden = '';
    $button_txt ='Create Custom Post Type';
}

?>
<div class="widefat stuffbox metabox-holder" style="padding: 0 !important;">
      <h3><?php echo $title; ?></h3>
      <div class="msg"></div>
      <form id="pm_posttype_form" action="" method="post" onsubmit="pmUpdatePostType(this); return false;" >
        <div id="pm_tabs" style="padding: 10px;">
            <ul>
                <li><a href="#options"><span>Options</span></a></li>
                <li><a href="#advanced-label"><span>Advanced Label Options</span></a></li>
                <li><a href="#advanced-options"><span>Advanced Options</span></a></li>
            </ul>
            <div id="options">
            
                <?php echo $pluginCore->render("postTypeOptions",array('postType'=>$data)); ?>
            
            </div>
            <div id="advanced-label">
                
                <?php echo $pluginCore->render("postTypeAdvLabel",array('postType'=>$data['labels'])); ?>
                
            </div>
            <div id="advanced-options">
                
                
                <?php echo $pluginCore->render("postTypeAdvOptions",array('postType'=>$data['option'])); ?>
                
            </div>
        </div>
        
        <p>
            <?php echo $hidden; ?>
            <input type="submit" class="button button-primary" id="submit" value="<?php echo $button_txt; ?>" />
        </p>
        
      </form>
      <div class="msg"></div>
</div>
<script type="text/javascript">
jQuery(function() { 
    jQuery( "#pm_tabs" ).tabs();
    
    jQuery('#pm_posttype_labal').keyup(function(){
        jQuery('#advanced-label input[name*=pm_posttype]:text').each(function(index,value) {
              rel = jQuery(this).attr('rel');
              label = jQuery('#pm_posttype_labal').val();
              if(!rel){
                rel =label;
              }else{
                if(rel=='No found'){
                    rel='No '+label+' found';
                }else if(rel=='No found in Trash'){
                    rel='No '+label+' found in Trash';
                }else{
                    rel=jQuery(this).attr('rel')+label;
                }
                
              }
              jQuery(this).val(rel);
            });
            jQuery('#pm_posttype_plabels').val(jQuery(this).val()+'s');
    });
    
});


</script>