<?php
if( !class_exists( 'moArrayModel' ) ) :

class moArrayModel {

           function moFields(){
            
            $meta_option_field_list=array(
                                        'text' => array(
                                            'title'         => 'Textbox',
                                            'is_free'       => true,  
                                        ), 
                                        'textarea' => array(
                                            'title'         => 'Paragraph',
                                            'is_free'       => true,   
                                        ),
                                        'email' => array(
                                            'title'         => 'Email',
                                            'is_free'       => true,  
                                        ),
                                        'url' => array(
                                            'title'         => 'Url',
                                            'is_free'       => true,  
                                        ),
                                        'Phone' => array(
                                            'title'         => 'Phone',
                                            'is_free'       => true,  
                                        ),
                                        'number' => array(
                                            'title'         => 'Number',
                                            'is_free'       => true,  
                                        ),                       
                                        'select' => array(
                                            'title'         => 'Drop Down',
                                            'is_free'       => true,   
                                        ),   
                                        'checkbox' => array(
                                            'title'         => 'Checkbox',
                                            'is_free'       => true,  
                                        ),   
                                        'radio' => array(
                                            'title'         => 'Select One (radio)',
                                            'is_free'       => true,  
                                        ),
                                        'hidden' => array(
                                            'title'         => 'Hidden Field',
                                            'is_free'       => true,   
                                        ),
                                        'image_media' => array(
                                            'title'         => 'Image Media',
                                            'is_free'       => true,   
                                        )     
                                        /*'datetime' => array(
                                            'title'         => 'Date / Time',
                                            'is_free'       => false,
                                        ),   
                                        'email' => array(
                                            'title'         => 'Email',
                                            'is_free'       => false,
                                        ),             
                                        'file' => array(
                                            'title'         => 'File Upload',
                                            'is_free'       => false,
                                        ), 
                                        'image_url' => array(
                                            'title'         => 'Image URL',
                                            'is_free'       => false,
                                        ),                   
                                        'phone' => array(
                                            'title'         => 'Phone Number',
                                            'is_free'       => false,
                                        ), 
                                        'number' => array(
                                            'title'         => 'Number',
                                            'is_free'       => false, 
                                        ), 
                                        'url' => array(
                                            'title'         => 'Website',
                                            'group_id'      => $id,
                                            'is_free'       => false,
                                        )*/
                                
                                );
                                
                   return $meta_option_field_list;          
            
           }


}

endif;

?>