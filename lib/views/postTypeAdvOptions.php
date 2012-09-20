<?php

global $pluginCore;

$html='';
$html .= $pluginCore->create_input("pm_posttype[option][public]","radio", array( 
                        "value"     => isset($postType['public'])?$postType['public']:true, 
                        "label"     => "Public",
                        "id"        => "pm_posttype_option_public",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Meta argument used to define default values for publicly_queriable, show_ui, show_in_nav_menus and exclude_from_search.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False'));   
$html .= $pluginCore->create_input("pm_posttype[option][publicly_queryable]","radio", array( 
                        "value"     => isset($postType['publicly_queryable'])?$postType['publicly_queryable']:true, 
                        "label"     => "Publicly queryable",
                        "id"        => "pm_posttype_option_publicly_queryable",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Whether post_type queries can be performed from the front end.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_posttype[option][exclude_from_search]","radio", array( 
                        "value"     => isset($postType['exclude_from_search'])?$postType['exclude_from_search']:false, 
                        "label"     => "Exclude from search",
                        "id"        => "pm_posttype_option_exclude_from_search",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Whether to exclude posts with this post type from search results.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                    ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_posttype[option][show_ui]","radio", array( 
                        "value"     => isset($postType['show_ui'])?$postType['show_ui']:true, 
                        "label"     => "Show ui",
                        "id"        => "pm_posttype_option_show_ui",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Whether to generate a default UI for managing this post type. Note that _built-in post types, such as post and page, are intentionally set to false.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                    ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_posttype[option][show_in_menu]","radio", array( 
                        "value"     => isset($postType['show_in_menu'])?$postType['show_in_menu']:true, 
                        "label"     => "Show in menu",
                        "id"        => "pm_posttype_option_show_in_menu",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Whether to show the post type in the admin menu and where to show that menu. Note that show_ui must be true.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                    ),array(true=>'True',false=>'False'));    
$html .= $pluginCore->create_input("pm_posttype[option][menu_position]","text", array( 
                        "value"     => isset($postType['menu_position'])?$postType['menu_position']:'Post', 
                        "label"     => "Menu position",
                        "id"        => "pm_posttype_option_menu_position",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>The position in the menu order the post type should appear.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                     ));
$html .= $pluginCore->create_input("pm_posttype[option][capability_type]","text", array( 
                        "value"     => isset($postType['capability_type'])?$postType['capability_type']:'Post', 
                        "label"     => "Capability type",
                        "label_extra"       =>"<span class='pm_required'>*</span>",
                        "id"        => "pm_posttype_option_capability_type",
                        "class"     => "pm_input validate[required]",
                        "after"     => "<div class='pm_note'>Capability type (post,page) in Singular</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                     ));
$html .= $pluginCore->create_input("pm_posttype[option][hierarchical]","radio", array( 
                        "value"     => isset($postType['hierarchical'])?$postType['hierarchical']:false, 
                        "label"     => "Hierarchical",
                        "id"        => "pm_posttype_option_hierarchical",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Whether the post type is hierarchical. Allows Parent to be specified</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_posttype[option][has_archive]","radio", array( 
                        "value"     => isset($postType['has_archive'])?$postType['has_archive']:true, 
                        "label"     => "Has archive",
                        "id"        => "pm_posttype_option_has_archive",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Enables post type archives. Will use string as archive slug. Will generate the proper rewrite rules if rewrite is enabled.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False'));                      
$html .= $pluginCore->create_input("pm_posttype[option][has_archive_slug]","text", array( 
                        "value"     => isset($postType['has_archive_slug'])?$postType['has_archive_slug']:null, 
                        "label"     => "Archive slug",
                        "id"        => "pm_posttype_option_has_archive_slug",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Archive slug. The archive for the post type can be viewed at this slug. Has archives must be checked for this to work.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                     ));
$html .= $pluginCore->create_input("pm_posttype[option][rewrite]","radio", array( 
                        "value"     => isset($postType['rewrite'])?$postType['rewrite']:false, 
                        "label"     => "Rewrite",
                        "id"        => "pm_posttype_option_rewrite",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Rewrite permalinks with this format. False to prevent rewrite.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(1=>'True',0=>'False'));                      
$html .= $pluginCore->create_input("pm_posttype[option][rewrite_slug]","text", array( 
                        "value"     => isset($postType['rewrite_slug'])?$postType['rewrite_slug']:null, 
                        "label"     => "Rewrite",
                        "id"        => "pm_posttype_option_rewrite_slug",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Prepend posts with this slug - defaults to post type's name</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                     ));
$html .= $pluginCore->create_input("pm_posttype[option][query_var]","radio", array( 
                        "value"     => isset($postType['query_var'])?$postType['query_var']:true, 
                        "label"     => "Query var",
                        "id"        => "pm_posttype_option_query_var",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>False to prevent queries, or string value of the query var to use for this post type.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_posttype[option][can_export]","radio", array( 
                        "value"     => isset($postType['can_export'])?$postType['can_export']:true, 
                        "label"     => "Can export",
                        "id"        => "pm_posttype_option_can_export",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Can this post_type be exported.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                    ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_posttype[option][show_in_nav_menus]","radio", array( 
                        "value"     => isset($postType['show_in_nav_menus'])?$postType['show_in_nav_menus']:true, 
                        "label"     => "Show in nav menus",
                        "id"        => "pm_posttype_option_show_in_nav_menus",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Whether post_type is available for selection in navigation menus.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False'));                                                                                                                                                                                                                                                                                                                                                                                                    
                     
return $html;
?>