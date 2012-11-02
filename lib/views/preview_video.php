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
 $player_url = PM_ASSECTS_URL.'player.swf';

$html .="<object width='400' height='300' type='application/x-shockwave-flash' data='$player_url' bgcolor='#000000' id='jwplayer-1' name='jwplayer-1' tabindex='0'>
            <param name='allowfullscreen' value='true'/>
            <param name='allowscriptaccess' value='always'/>
            <param name='seamlesstabbing' value='true'/>
            <param name='wmode' value='opaque'/>
            <param name='flashvars' value='netstreambasepath=http%3A%2F%2Fwww.purepowerfitness.com.au%2F&amp;id=jwplayer-1&amp;flashplayer=$player_url&amp;autostart=false&amp;image=&amp;file=$fullUrl&amp;controlbar.position=bottom&amp;dock=false'/>
        </object>";
         
endif;
     
?>