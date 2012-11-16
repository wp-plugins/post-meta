<?php
$html ='';
if( @$file ) :
                $uploads    = wp_upload_dir();
                $fullUrl    = $uploads['baseurl'] . $file;
                
                if(preg_match('/\/wp-content\/uploads\//',$file ,$match)){
                   $fullUrl = $file;
                    
                }else{
                    $fullUrl = $uploads['baseurl'].$file;
                }
                $player_url = PM_ASSECTS_URL.'audio_player.swf';

$html .="<object type='application/x-shockwave-flash' name='$id' style='outline: none' data='$player_url' width='200' height='24'' id='$id'>
            <param name='bgcolor' value='#FFFFFF'>
            <param name='wmode' value='transparent'>
            <param name='menu' value='false'>
            <param name='flashvars' value='initialvolume=50&amp;left=000000&amp;lefticon=FFFFFF&amp;soundFile=$fullUrl&amp;titles=Title&amp;artists=Artist name&amp;autostart=no&amp;playerID=$id'>
        </object>"; 
        
          
endif;
     
?>