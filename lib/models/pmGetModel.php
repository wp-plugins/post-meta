<?php
if( !class_exists( 'pmGetModel' ) ) :

class pmGetModel {
    
       public function get_label($metaKey){
             if($metaKey){
                global $postMeta,$post;
                $postType= get_post_type( $post->ID );
                
                $pm_options= get_option($postMeta->options['post_meta']);
                
                $groups=$pm_options[$postType]['group'];
                
                foreach($groups as $group ){
                foreach($group['field'] as $field){
                      if($field['meta_key']== $metaKey){
                            $label = $field['title'];
                            break;
                        }           
                    
                }
                
                }
                
                return $label;
             }
        }
    
       public function get_field($metaKey,$groupIndex=1,$fieldIndex=1,$post_id=null){
                 if($metaKey){
                        if(!$post_id){
                            global $post;
                            $post_id=$post->ID;
                        }
                        $meta_data=get_post_meta($post_id,$metaKey,true);
                        
                        if($groupIndex){
                            $data=$meta_data[$groupIndex];
                            if($fieldIndex){
                                $data=$meta_data[$groupIndex][$fieldIndex];
                            }
                         }
                     
                     return $data;  
                 }
                 
       }
       
       
       
       /**
        * All duplicate field with a meta key
        */
       
       
       public function get_all_field($metaKey,$groupIndex=1,$post_id=null){
                 if($metaKey){
                    if(!$post_id){
                        global $post;
                        $post_id=$post->ID;
                    }
                    $meta_data=get_post_meta($post_id,$metaKey,true);
                    
                 if($groupIndex){
                    $data=$meta_data[$groupIndex];
                 }
                 
                 return $data;
                    
                 }
                 
       }
       
       /**
        * Get Group by meta key   with a meta key
        */
       
       
       public function get_group($metaKey,$groupIndex=1,$post_id=null){
                 if($metaKey){
                            global $postMeta,$post;
                            if(!$post_id){
                                $post_id=$post->ID;
                            }
                    
                            
                            $postType= get_post_type( $post_id );
                            
                            $pm_options= get_option($postMeta->options['post_meta']);
                            
                            $groups=$pm_options[$postType]['group'];
                            
                            foreach($groups as $group){
                                if($group['meta_key']==$metaKey){
                                    $fields=$group['field'];
                                    break;
                                }
                                
                            }
                            
                            $data=array();
                            foreach($fields as $field){
                                $meta_data =get_post_meta($post_id, $field['meta_key'],true);
                                $data[$field['meta_key']] =$meta_data[$groupIndex];
                            }
                            
                            
                            return $data;
                    
                 }
                 
       }
       
       
       
       /**
        * Get All Group by meta key   with a meta key
        */
       
       
       public function get_all_group($metaKey,$post_id=null){
                 if($metaKey){
                            global $postMeta,$post;
                            if(!$post_id){
                                $post_id=$post->ID;
                            }
                    
                            
                            $postType= get_post_type( $post_id );
                            
                            $pm_options= get_option($postMeta->options['post_meta']);
                            
                            $groups=$pm_options[$postType]['group'];
                            
                            foreach($groups as $group){
                                if($group['meta_key']==$metaKey){
                                    $fields=$group['field'];
                                    break;
                                }
                                
                            }
                            
                            $group_count_meta = get_post_meta($post->ID, 'group_count_'.$metaKey, true);
                            $group_count = ($group_count_meta)?$group_count_meta:1;
                            
                            $data=array();
                            $field_data=array();
                            for($i=1;$i<=$group_count; $i++){
                                foreach($fields as $field){
                                    $meta_data =get_post_meta($post_id, $field['meta_key'],true);
                                    
                                    $field_data[$field['meta_key']] =$meta_data[$i];
                                    
                                }
                                
                               $data[$i]= $field_data;//$field_data;
                                
                                
                            }
                            
                            return $data;
                    
                 }
                 
       }
       
       
       
       
       
       /**
        * $parameter is the image thumbnail proprety ==== >   width,height,crop
        * $attr image Attribute Property ==> id,class,style,rel,extra    
        */
       
       public function get_image($metaKey,$groupIndex=1,$fieldIndex=1,$parameter=array(),$attr=array(),$post_id=null){
             
             if($metaKey){
                global $postMeta,$post;
                
                if( $parameter ) extract($parameter); 
                if( $attr ) extract($attr);       
                
                
                
                if(!$post_id){
                        $post_id=$post->ID;
                    }
                $meta_data=get_post_meta($post->ID,$metaKey,true);
                if($groupIndex){
                    $data=$meta_data[$groupIndex];
                    if($fieldIndex){
                        $data=$meta_data[$groupIndex][$fieldIndex];
                    }
                 }
                
                if($data){
                    
                    if(@$width OR @$height){
                        $image_url = $postMeta->generate_thumb($data,$width,$height,$crop); 
                    }else{
                        $image_url =$data; 
                    } 
                        $attribute = null;
                        if($id){
                            $attribute .= "id='$id'";
                        }
                        if($class){
                            $attribute .= " class='$class'";
                        }
                        if($class){
                            $attribute .= " style='$style'";
                        }
                        if($class){
                            $attribute .= " rel='$rel'";
                        }
                        if($class){
                            $attribute .= " extra";
                        }
                        if($class){
                            $attribute .= "id='$id'";
                        }
                    
                        $image ="<img $attribute src='$image_url' />";                                 
                }
                
             }
             
             return $image;
        
        }
        
        /**
        * Audio
        *     
        */
       
       public function get_audio($metaKey,$groupIndex=1,$fieldIndex=1,$post_id=null){
             
             if($metaKey){
                global $postMeta,$post;
                if(!$post_id){
                        $post_id=$post->ID;
                    }
                $meta_data=get_post_meta($post->ID,$metaKey,true);
                if($groupIndex){
                    $data=$meta_data[$groupIndex];
                    if($fieldIndex){
                        $data=$meta_data[$groupIndex][$fieldIndex];
                    }
                 }
                $audio = $postMeta->render("preview_audio",array('file'=>$data,'id'=>rand(1,99)));
               
                return $audio;
             }
             
             
        
        }
        
        /**
        * Video
        *     
        */
       
       public function get_video($metaKey,$groupIndex=1,$fieldIndex=1,$post_id=null){
             
             if($metaKey){
                global $postMeta,$post;
                if(!$post_id){
                        $post_id=$post->ID;
                    }
                $meta_data=get_post_meta($post->ID,$metaKey,true);
                if($groupIndex){
                    $data=$meta_data[$groupIndex];
                    if($fieldIndex){
                        $data=$meta_data[$groupIndex][$fieldIndex];
                    }
                 }
                $video = $postMeta->render("preview_video",array('file'=>$data,'id'=>rand(1,99)));
               
                return $video;
             }
             
             
        
        }
        
      public function preview($url,$type='image',$attr=array('thumb'=>true)){//
                if($url){
                    global $postMeta;
                        switch ($type){
                            
                            case 'image':
                                if( $attr ) extract($attr);
                                
                                if($thumb==true){
                                        $url = $postMeta->generate_thumb($url,150,150);
                                }
                                
                                
                                //if( $parameter ) extract($parameter); 
                                
                                $attribute = null;
                                if($id){
                                    $attribute .= "id='$id'";
                                }
                                if($class){
                                    $attribute .= " class='$class'";
                                }
                                if($class){
                                    $attribute .= " style='$style'";
                                }
                                if($class){
                                    $attribute .= " rel='$rel'";
                                }
                                if($class){
                                    $attribute .= " extra";
                                }
                                if($class){
                                    $attribute .= "id='$id'";
                                }
                            
                                $image ="<img $attribute src='$url' />";  
                               return  $image;
                            break;
                            
                            case 'audio':
                            
                                $audio = $postMeta->render("preview_audio",array('file'=>$url,'id'=>rand(1,99)));
                                return  $audio;
                            
                            break;
                            
                            case 'video':
                            
                                $video = $postMeta->render("preview_video",array('file'=>$url,'id'=>rand(1,99)));               
                                return $video;
                            
                            break;
                            
                            case 'file':
                            
                                $file = "<a href='$url' > Download </a>";
                                return $file;
                            
                            break;
                            
                            case 'checkbox':
                                $html="<ul>";
                                foreach($url as $v){
                                    $html .="<li>$v</li>";
                                }
                                $html .="</ul>";
                                
                                return $html;
                            break;
            
            
                        }
                    
                }
      }  
       
}

endif;

?>