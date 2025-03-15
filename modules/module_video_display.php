<?php
function myvideo_display($content)
{
	$found = preg_match_all('/(<p>\s*)?\(%\s*(myvideo)(\s+(?:%[^%\)]|[^%])+)?\s*%\)(\s*<\/p>)?/', $content, $match);

	for ($i=0; $i<=$found; $i++) {
		if (isset($match[0][$i])) {
			$paramstr=$match[3][$i];
			$params = array();
	    		while (preg_match('/([a-zA-Z][a-zA-Z_-]*)[:=]([^"\'\s]*|"[^"]*"|\'[^\']*\')(?:\s|$)/', $paramstr, $pmatch)) {
				$key = $pmatch[1];
				$value = trim($pmatch[2]);
				if (substr($value,0,1) == '"' || substr($value,0,1) == "'") $value = substr($value,1,strlen($value)-2);
				$params[$key] = $value;
				$paramstr = substr($paramstr, strlen($pmatch[0]));
			}
       		 	$sVideo = $match[0][$i];
			$iType = ''; $iWidth = ''; $iHeight = '';
			if (isset($params["path"])) { 
				$vPath = $params["path"];
				if (isset($params["type"])) $iType = $params["type"];
				if (isset($params["width"])) $iWidth = $params["width"];
				if (isset($params["height"])) $iHeight = $params["height"];
				$video = my_video_embed($vPath,$iType,$iWidth,$iHeight);
			} else {
				$video="<font color=red><b>Error:</b> Path need...</font><br>";
			}
			$content = str_replace($sVideo, $video, $content);
		} else {
        		return $content;
		}

	}
	return $content;
}

function my_video_embed($path, $type, $w = 320, $h = 260){

    if ($w == '') $w = 360;
    if ($h == '') $h = 240;

    $type = strtoupper($type);

    switch ($type) {
	case "WEBM" : 
		$sType = 'type=\'video/webm; codecs="vp8, vorbis"\'';
	break;
	case "OGG" :
    		$sType = 'type=\'video/ogg; codecs="theora, vorbis"\'';
	break;
	case "MP4" : 
    		$sType = 'type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'';
	break;
	default : 
    		$sType = 'type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'';
	break;
    }

    return('<div class="leanback-player-video">
		<video width="'.$w.'" height="'.$h.'" preload="metadata" controls poster="'.$path.'.jpg">
        		<!-- HTML5 <video> sources -->
			<source src="'.$path.'" '.$sType.'/>

			<div class="leanback-player-html-fallback">
            		<img src="'.$path.'.jpg" width="'.$w.'" height="'.$h.'" alt="Poster Image" 
                		title="No HTML5 media playback capabilities available." />
            			<div>
                			<strong>Download Video:</strong>
                			<a href="'.$path.'">.mp4</a>
            			</div>
        		</div>
    		</video>
	    </div>		
           ');
  
}



echo my_video_embed($video_link , $format ,  $height , $width);

?>