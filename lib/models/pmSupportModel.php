<?php



if( !class_exists( 'pmSupportModel' ) ) :

class pmSupportModel {

           
       /**
         * get maximum key of an array
         */
        function maxKey( $arr ){
            if( !is_array( $arr ) ) return false;
            if( !$arr ) return false;
            
            $keys = array();
            foreach( $arr as $k => $v )
                $keys[] = $k;
            return max( $keys );
        }
        
        
        /**
        * return all post types
        *
        *  This function is a wrapper of  wordpress's get_post_types function
        *  here be  filter  a non-related post types of magic fields
        *
        *  @return array
        */
        function pm_get_post_types( $args = array('public' => true), $output = 'object', $operator = 'and' ){
        global $wpdb;
        
        $post_types = get_post_types( $args, $output, $operator );
        
        foreach ( $post_types as $key => $type ) {
          if( $output == 'names' ) {
            if( $type == 'attachment' ) {
              unset($post_types[$key]);
            }
          } else if ($output == 'object' ) {
            unset($post_types['attachment']);
          }
        }
        
        return $post_types;
        }
        
        
        
        
           /**
     * Get fields by 
     * @param $by: key, field_group
     * @param $value: 
     */    
    function getFields( $by=null, $param=null, $get=null, $isFree=false ){
        global $pluginCore;
        $fieldList = $pluginCore->moFields();
        if(!$by){
            return false; 
        }
        if( $by =='key' ){
            foreach( $fieldList as $key => $fieldData ){  
                            $result[$key] = $fieldData['title'];
                    }
        }
        return isset( $result ) ? $result : false;
    }

}

endif;

?>
