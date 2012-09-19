<?php
global $pluginCore; 

if($data){
    $title = "Edit your custom taxonomy :( $data[type] )";
    $hidden = "<input type='hidden' name='edit' value='edit' />";
    $button_txt ="Update Custom Taxonomy";
}else{
    $title ="Add new custom Taxonomy";
    $hidden = '';
    $button_txt ='Create Custom Taxonomy';
}

?>
<div class="widefat stuffbox metabox-holder" style="padding: 0 !important;">
      <h3><?php echo $title; ?></h3>
      <div class="inside" style="padding:10px 10px;">
          <div class="msg"></div>
          <form id="pm_taxonomy_form" action="" method="post" onsubmit="pmUpdateTaxonomy(this); return false;" >
            <div id="pm_tabs" style="padding: 10px;">
                <ul>
                    <li><a href="#options"><span>Options</span></a></li>
                    <li><a href="#advanced-label"><span>Advanced Label Options</span></a></li>
                    <li><a href="#advanced-options"><span>Advanced Options</span></a></li>
                </ul>
                <div id="options">
                
                    <?php echo $pluginCore->render("taxonomyOptions",array('taxonomy'=>$data)); ?>
                
                </div>
                <div id="advanced-label">
                    
                    <?php echo $pluginCore->render("taxonomyAdvLabel",array('taxonomy'=>$data['labels'])); ?>
                    
                </div>
                <div id="advanced-options">
                    
                    
                    <?php echo $pluginCore->render("taxonomyAdvOptions",array('taxonomy'=>$data['option'])); ?>
                    
                </div>
            </div>
            
            <p>
                <?php echo $hidden; ?>
                <input type="submit" class="button button-primary" id="submit" value="<?php echo $button_txt; ?>" />
            </p>
            
          </form>
          <div class="msg"></div>
      </div>
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