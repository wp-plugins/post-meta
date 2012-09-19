<?php

global $pluginCore;

$html='';
$html .= $pluginCore->create_input("pm_taxonomy[option][public]","radio", array( 
                        "value"     => isset($taxonomy['public'])?$taxonomy['public']:true, 
                        "label"     => "Public",
                        "id"        => "pm_taxonomy_option_public",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Should this taxonomy be exposed in the admin UI.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False'));   
$html .= $pluginCore->create_input("pm_taxonomy[option][show_in_nav_menus]","radio", array( 
                        "value"     => isset($taxonomy['show_in_nav_menus'])?$taxonomy['show_in_nav_menus']:true, 
                        "label"     => "Show in nav menus",
                        "id"        => "pm_taxonomy_option_show_in_nav_menus",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>true makes this taxonomy available for selection in navigation menus.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_taxonomy[option][show_ui]","radio", array( 
                        "value"     => isset($taxonomy['show_ui'])?$taxonomy['show_ui']:true, 
                        "label"     => "Show ui",
                        "id"        => "pm_taxonomy_option_show_ui",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Whether to generate a default UI for managing this taxonomy.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                    ),array(true=>'True',false=>'False'));                     
$html .= $pluginCore->create_input("pm_taxonomy[option][show_tagcloud]","radio", array( 
                        "value"     => isset($taxonomy['show_tagcloud'])?$taxonomy['show_tagcloud']:false, 
                        "label"     => "Show tagcloud",
                        "id"        => "pm_taxonomy_option_show_tagcloud",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Wether to allow the Tag Cloud widget to use this taxonomy.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                    ),array(true=>'True',false=>'False')); 
$html .= $pluginCore->create_input("pm_taxonomy[option][hierarchical]","radio", array( 
                        "value"     => isset($taxonomy['hierarchical'])?$taxonomy['hierarchical']:true, 
                        "label"     => "Hierarchical",
                        "id"        => "pm_taxonomy_option_hierarchical",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False'));
$html .= $pluginCore->create_input("pm_taxonomy[option][update_count_callback]","text", array( 
                        "value"     => isset($taxonomy['update_count_callback'])?$taxonomy['update_count_callback']:null, 
                        "label"     => "Update count callback",
                        "id"        => "pm_taxonomy_option_update_count_callback",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>A function name that will be called to update the count of an associated $object_type, such as post, is updated.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                     )); 
$html .= $pluginCore->create_input("pm_taxonomy[option][rewrite]","radio", array( 
                        "value"     => isset($taxonomy['rewrite'])?$taxonomy['rewrite']:false, 
                        "label"     => "Rewrite",
                        "id"        => "pm_taxonomy_option_rewrite",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Set to false to prevent rewrite, Default will use $taxonomy as query var</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(1=>'True',0=>'False')); 
$html .= $pluginCore->create_input("pm_taxonomy[option][rewrite_slug]","text", array( 
                        "value"     => isset($taxonomy['rewrite_slug'])?$taxonomy['rewrite_slug']:null, 
                        "label"     => "Rewrite slug",
                        "id"        => "pm_taxonomy_option_rewrite_slug",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>Prepend posts with this slug - defaults to taxonomy's name</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                     ));
$html .= $pluginCore->create_input("pm_taxonomy[option][query_var]","radio", array( 
                        "value"     => isset($taxonomy['query_var'])?$taxonomy['query_var']:true, 
                        "label"     => "Query var",
                        "id"        => "pm_taxonomy_option_query_var",
                        "class"     => "pm_input",
                        "after"     => "<div class='pm_note'>False to prevent queries, or string to customize query var. Default will use $taxonomy as query var.</div>",
                        "field_enclose"     =>  "div class='pm_field_item'",
                        "enclose"   => "div class='pm_field'",
                        "combind"   =>true,
                        "by_key"        => true
                     ),array(true=>'True',false=>'False'));                                                                                                                                                                                                                                                                                                                                                                                                   
                     
return $html;
?>