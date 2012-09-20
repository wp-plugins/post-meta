<?php

global $pluginCore;
            if(!$meta_box['title']){$meta_box['title']='Untitled Group'.$id;}
            //$group_meta_key_id=$post_type."_".$id;
            $style=($loop==1 || $toggle == true)?" ":"style='display:none'";
            $html ='';
                                $html .=  "<div class='meta-group meta-box-sortables'>
                                            <div id='$meta_box[id]' class='postbox'>
                                                        <div class='mo_trash' title='Click to Romove' onclick='meta_option_remove_meta_box(this);'></div>
                                                        <div class='handlediv' title='Click to toggle' onclick='meta_option_toggole(this);'><br/></div>
                                                        <h3 class='hndle'>$meta_box[title] ID: $id</h3>
                                                        <div class='inside' $style>
                                                        <div class='meta_box_info'>";
                                                        $html .= $pluginCore->create_input("group[$id][title]","text", array( 
                                                                            "value"     => $meta_box['title'], 
                                                                            "label"     => "Group Name", 
                                                                            "id"        => "mo_group_$id",
                                                                            "class"     => "mo_input validate[required]",
                                                                            "onkeyup"     => "moChangeGroupTitle(this)",
                                                                            //"after"     => "<div>(Title that will be shown on frontend)</div>",
                                                                            "enclose"   => "div class='mo_segment'",
                                                                         ));
                                                        $html .=$pluginCore->create_input( "group[$id][context]", "select", array( 
                                                                        "value"     => isset($meta_box['context']) ? $meta_box['context'] : null,
                                                                        "label"     => "Context Type", 
                                                                        "class"     => "mo_input",
                                                                        "enclose"   => "div class='mo_segment'",
                                                                        //"onchange"  => "umChangeField(this, $id)",
                                                                        "by_key"    => true,
                                                                     ), array('normal'=>'normal','advanch' => 'advanch','side' => 'side') );
                                                        $html .=$pluginCore->create_input( "group[$id][priority]", "select", array( 
                                                                        "value"     => isset($meta_box['priority']) ? $meta_box['priority'] : null,
                                                                        "label"     => "Context Type", 
                                                                        "class"     => "mo_input",
                                                                        "enclose"   => "div class='mo_segment'",
                                                                        //"onchange"  => "umChangeField(this, $id)",
                                                                        "by_key"    => true,
                                                                     ), array('high' => 'high','core' => 'core','default' => 'default','low' => 'low') );
                                                        $html .= $pluginCore->create_input("group[$id][meta_key]","text", array( 
                                                                            "value"     => $post_type."_".$id, 
                                                                            "label"     => "Meta Key", 
                                                                            "id"        => "mo_group_$id",
                                                                            "class"     => "mo_input mo_group_meta_key",
                                                                            "readonly"  =>"true",
                                                                            //"onkeyup"     => "moChangeGroupTitle(this)",
                                                                            "after"     => "<div class='mo_note mo_required'>Must be unique and have no space</div>",
                                                                            "enclose"   => "div class='mo_segment'",
                                                                         ));
                                                          $html .="</div>";
                                                        echo $html;
                                                            echo "<input type='hidden' name='group[$id][post_type]' value='$post_type' />";
                                                        ?>
                                                        <div class="metabox-option-list">
                                                  <div class="metabox-fields-holder ui-sortable ui-droppable" >
                                                <?php @$fields= $meta_box['field'];
                                                if($fields){
                                                    $j=0;
                                                foreach($fields as $field):
                                                $j++;
                                                  //$this->render_meta_field($field,array('id'=>$j,'group_id'=>$id,'post_type'=>$meta_box['post_type']));
                                                  $pluginCore->render("field",array('field'=>$field,'id'=>$j,'group_id'=>$id,'post_type'=>$meta_box['post_type']));
                                                 endforeach; //end of field
                                                 }
                                                 else{
                                                    echo "<div id='not-found'>No field found</div>";
                                                 }
                                                  ?>
                                                    
                                                </div>
                                                <div class="meta-option-fields-list">
                                                    <?php
                                                     $moFieldList = $pluginCore->moFields();
                                                         
                                                     
                                                        echo "<div id='side-sortables' class='meta-box-sortables'>
                                                                    <div id='user_meta' class='postbox '>
                                                                        
                                                                        <div class='handlediv' title='Click to toggle' onclick='meta_option_toggle(this);'><br></div>
                                                                        <h3 class='hndle'>Available Field List</h3>
                                                                        <div class='inside'>
                                                                            <p></p>";
                                                                            foreach($moFieldList as $fieldKey => $fieldValue){
                                                                                
                                                                                echo "<div field_type='$fieldKey' post_type='$post_type' group_id='$id' class='button meta_option_field_selecor' onclick='moNewField(this)'>$fieldValue[title]</div>";
                                                                            }
                                                        echo "<p></p>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                ";
                                               // $wpFields .= "<div field_type='$fieldKey' class='button um_field_selecor' onclick='umNewField(this)'>$fieldValue</div>";
                                                    ?>
                                               
                                                </div>
                                            </div>
                                  </div>
                                </div>
                            <input type="hidden" class="group_count" value="<?php echo $id; ?>"/>
                            <?php $maxKey      = $pluginCore->maxKey( $fields ); ?>
                            <?php $last_field_id    = $maxKey ? $maxKey : 0 ?>
                            <input type="hidden" id="last_<?php echo $id; ?>_field_id" value="<?php echo $last_field_id; ?>" />
                            </div>   
