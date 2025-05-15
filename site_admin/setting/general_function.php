<?php

function generateSeoURL($string, $wordLimit = 0){ 
    $separator = '-'; 
     
    if($wordLimit != 0){ 
        $wordArr = explode(' ', $string); 
        $string = implode(' ', array_slice($wordArr, 0, $wordLimit)); 
    } 
 
    $quoteSeparator = preg_quote($separator, '#'); 
 
    $trans = array( 
        '&.+?;'                 => '', 
        '[^\w\d _-]'            => '', 
        '\s+'                   => $separator, 
        '('.$quoteSeparator.')+'=> $separator 
    ); 
 
    $string = strip_tags($string); 
    foreach ($trans as $key => $val){ 
        $string = preg_replace('#'.$key.'#iu', $val, $string); 
    } 
 
    $string = strtolower($string); 
 
    return trim(trim($string, $separator)); 
}


function checkForDangerousFunctions($inputString, $dangerousFunctions) {
    $foundFunctions = [];

    // Loop through each dangerous function
    foreach ($dangerousFunctions as $function) {
        // Create a regular expression pattern to match the function
        $pattern = '/\b' . preg_quote($function, '/') . '\b/';

        // Check if the function is found in the input string
        if (preg_match($pattern, $inputString)) {
            $foundFunctions[] = $function;
        }
    }

    return $foundFunctions;
}

function include_module($filePath, $variables = array(), $print = false)
{
    $output = NULL;
   
    if(file_exists($filePath)){

        // Extract the variables to a local namespace
        
        if(!empty($variables)){
            extract($variables);
        }
        
        // Start output buffering
        ob_start();

        // Include the template file
        include $filePath;
        
        // End buffering and return its contents
        $output = ob_get_clean();
    }
    if ($print) {
        print $output;
    }

    return $output;

}

function remove_non_utf($text){
    return mb_convert_encoding($text, 'UTF-8', 'UTF-8');
}

function get_webpage($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
  curl_setopt($ch, CURLOPT_URL, $url);
  $response = curl_exec($ch);
  curl_close($ch);
  return  $response;
}

function stringToSecret(string $string = NULL){
    if (!$string) {
        return NULL;
    }
    $length = strlen($string);
    $visibleCount = (int) round($length / 4);
    $hiddenCount = $length - ($visibleCount * 2);
    return substr($string, 0, $visibleCount) . str_repeat('*', $hiddenCount) . substr($string, ($visibleCount * -1), $visibleCount);
}

function discount_calculate($orignal_price , $discount){
    
    return $orignal_price - ($orignal_price * ($discount / 100));
}

function add_percentage($originalPrice , $percentageIncrease = ORIGNALPRICE_PERCENTAGE){

    return round($originalPrice * (1 + $percentageIncrease / 100) , 1);
}

function clear($string){

  return preg_replace('/[^0-9]/', '', $string);

}


function md5_($value)
{
    $secret_key =  KEY_PASS;

    return md5(md5($value.$secret_key));
}

// Function to strip HTML tags and clean up content
function cleanContent($content) {
    // Remove HTML tags
    $content = strip_tags($content);
    // Convert special characters to HTML entities
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    // Trim whitespace
    $content = trim($content);
    // Replace multiple spaces with single space
    $content = preg_replace('/\s+/', ' ', $content);
    return $content;
}


function remove0with92($number){
    $phoneNumber = $number;
    $countryCode = '92';
    $newNumber = preg_replace("/^0/", $countryCode, $phoneNumber);
    return $newNumber;
}


function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  //First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }

  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }else {
        $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'    => $pattern
  );
} 


function upload_($target_dir){
  $file_name = 'file';

  $temp = explode(".", $_FILES[$file_name]["name"]);
  $newfilename =  md5(round(microtime(true)).rand(0,999)) . '.' . end($temp);

  if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_dir . $newfilename))
    return  $newfilename;
 else
    return 0;

}



function isImage($pathToFile)
{
  if( false === exif_imagetype($pathToFile) )
   return FALSE;

   return TRUE;
}


// function upload_image($target_dir){

//   $file_name = 'file';

//   if(!isImage($_FILES[$file_name]["tmp_name"])) return 0;

//   $temp = explode(".", $_FILES[$file_name]["name"]);

//   $newfilename  =  $temp[0]."_".uniqid().'.'.end($temp);

//   $newfilename = clean($newfilename);

//   if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_dir . $newfilename))
//     return  $newfilename;
//  else
//     return 0;

// }


/**
 * Enhanced image upload with validation and optimization, returning JSON error responses.
 *
 * @param string $target_dir Upload directory (must end with /)
 * @param int $max_width Maximum allowed width in pixels (0 = no resize)
 * @param int $max_height Maximum allowed height in pixels (0 = no resize)
 * @param int $max_size_kb Maximum file size in KB (default 500KB)
 * @return string|string JSON encoded error message on failure, filename on success
 */
/**
 * Enhanced image upload with validation and optimization, returning JSON error responses.
 *
 * @param string $target_dir Upload directory (must end with /)
 * @param int $max_width Maximum allowed width in pixels (0 = no resize)
 * @param int $max_height Maximum allowed height in pixels (0 = no resize)
 * @param int $max_size_kb Maximum file size in KB (default 500KB)
 * @return string JSON encoded response with success/error information
 */
function upload_image($target_dir, $max_width = 1920, $max_height = 1080, $max_size_kb = 2048, $quality = 85) {
    $file_name = 'file';
    $response = [
        'success' => false,
        'error' => '',
        'details' => [
            'code' => null,
            'message' => '',
            'file' => null,
            'size' => null,
            'target_dir' => $target_dir,
            'max_dimensions' => "{$max_width}x{$max_height}",
            'max_size_kb' => $max_size_kb
        ]
    ];

    try {
        // Validate input file exists
        if (!isset($_FILES[$file_name])) {
            $response['error'] = 'No file was uploaded.';
            $response['details']['code'] = 'NO_FILE';
            return json_encode($response);
        }

        $file = $_FILES[$file_name];
        $response['details']['file'] = $file['name'];
        $response['details']['size'] = round($file['size'] / 1024, 2) . 'KB';
        $temp_file = $file['tmp_name'];

        // Validate for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $upload_errors = [
                UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the server limit.',
                UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the form limit.',
                UPLOAD_ERR_PARTIAL => 'The file was only partially uploaded.',
                UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary upload directory.',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
                UPLOAD_ERR_EXTENSION => 'File upload stopped by extension.'
            ];
            $response['error'] = $upload_errors[$file['error']] ?? 'Unknown upload error.';
            $response['details']['code'] = 'UPLOAD_ERROR_' . $file['error'];
            return json_encode($response);
        }

        // Validate file exists in temp location
        if (!file_exists($temp_file)) {
            $response['error'] = 'Uploaded file not found.';
            $response['details']['code'] = 'FILE_MISSING';
            return json_encode($response);
        }

        // Validate it's an actual image
        $image_info = @getimagesize($temp_file);
        if ($image_info === false) {
            $response['error'] = 'Invalid image file.';
            $response['details']['code'] = 'INVALID_IMAGE';
            return json_encode($response);
        }

        // Validate against extremely large dimensions
        if ($image_info[0] > 5000 || $image_info[1] > 5000) {
            $response['error'] = 'Image dimensions are too large. Maximum allowed is 5000x5000 pixels.';
            $response['details']['code'] = 'DIMENSIONS_TOO_LARGE';
            $response['details']['original_dimensions'] = "{$image_info[0]}x{$image_info[1]}";
            return json_encode($response);
        }

        // Validate file size
        $max_size_bytes = $max_size_kb * 1024;
        if ($file['size'] > $max_size_bytes) {
            $response['error'] = 'File too large.';
            $response['details']['code'] = 'FILE_TOO_LARGE';
            $response['details']['message'] = sprintf(
                'File size (%sKB) exceeds maximum allowed size of %sKB.',
                round($file['size'] / 1024, 2),
                $max_size_kb
            );
            return json_encode($response);
        }

        // Generate secure filename
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $safe_name = substr(preg_replace('/[^a-z0-9_-]/i', '', pathinfo($file['name'], PATHINFO_FILENAME)), 0, 50);
        $new_filename = $safe_name . '_' . uniqid();
        $response['details']['original_extension'] = $extension;

        // Create target directory if needed
        if (!file_exists($target_dir)) {
            if (!@mkdir($target_dir, 0755, true)) {
                $response['error'] = 'Directory creation failed.';
                $response['details']['code'] = 'DIRECTORY_ERROR';
                return json_encode($response);
            }
        }

        // Check if target directory is writable
        if (!is_writable($target_dir)) {
            $response['error'] = 'Directory not writable.';
            $response['details']['code'] = 'DIRECTORY_PERMISSION';
            return json_encode($response);
        }

        // Process image based on type
        $mime_type = $image_info['mime'];
        $response['details']['image_type'] = $mime_type;
        $response['details']['original_dimensions'] = [
            'width' => $image_info[0],
            'height' => $image_info[1]
        ];

        // Create image resource with palette conversion if needed
        $source = null;
        switch ($mime_type) {
            case 'image/jpeg':
                $source = @imagecreatefromjpeg($temp_file);
                $new_filename .= '.jpg';
                break;
            case 'image/png':
                $source = @imagecreatefrompng($temp_file);
                if ($source && !imageistruecolor($source)) {
                    $truecolor = imagecreatetruecolor(imagesx($source), imagesy($source));
                    imagecopy($truecolor, $source, 0, 0, 0, 0, imagesx($source), imagesy($source));
                    imagedestroy($source);
                    $source = $truecolor;
                }
                $new_filename .= '.png';
                break;
            case 'image/gif':
                $source = @imagecreatefromgif($temp_file);
                if ($source) {
                    $truecolor = imagecreatetruecolor(imagesx($source), imagesy($source));
                    imagecopy($truecolor, $source, 0, 0, 0, 0, imagesx($source), imagesy($source));
                    imagedestroy($source);
                    $source = $truecolor;
                }
                $new_filename .= '.gif';
                break;
            case 'image/webp':
                $source = @imagecreatefromwebp($temp_file);
                $new_filename .= '.webp';
                break;
            default:
                $response['error'] = 'Unsupported image format.';
                $response['details']['code'] = 'UNSUPPORTED_FORMAT';
                return json_encode($response);
        }

        if ($source === false) {
            $response['error'] = 'Image processing failed.';
            $response['details']['code'] = 'IMAGE_PROCESSING';
            return json_encode($response);
        }

        // Calculate new dimensions if resizing needed
        $width = imagesx($source);
        $height = imagesy($source);
        $needs_resize = ($max_width > 0 && $width > $max_width) || ($max_height > 0 && $height > $max_height);
        $response['details']['resize_required'] = $needs_resize;

        if ($needs_resize) {
            $ratio = min($max_width / $width, $max_height / $height);
            $new_width = round($width * $ratio);
            $new_height = round($height * $ratio);

            $response['details']['new_dimensions'] = [
                'width' => $new_width,
                'height' => $new_height
            ];

            $new_image = imagecreatetruecolor($new_width, $new_height);
            if ($new_image === false) {
                $response['error'] = 'Image resizing failed.';
                $response['details']['code'] = 'IMAGE_RESIZING';
                imagedestroy($source);
                return json_encode($response);
            }

            // Preserve transparency
            if ($mime_type == 'image/png' || $mime_type == 'image/gif') {
                imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
            }

            if (!imagecopyresampled($new_image, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height)) {
                $response['error'] = 'Image resampling failed.';
                $response['details']['code'] = 'IMAGE_RESAMPLING';
                imagedestroy($source);
                imagedestroy($new_image);
                return json_encode($response);
            }

            imagedestroy($source);
            $source = $new_image;
        }

        // Save the image with appropriate format and quality
        $destination = $target_dir . $new_filename;
        $saved = false;

        // Try WebP first if supported
        if (function_exists('imagewebp')) {
            $saved = @imagewebp($source, $destination, $quality);
            if ($saved) {
                $response['details']['format_used'] = 'webp';
            }
        }

        // Fallback to original format if WebP fails
        if (!$saved) {
            switch ($mime_type) {
                case 'image/jpeg':
                    $saved = @imagejpeg($source, $destination, $quality);
                    break;
                case 'image/png':
                    $saved = @imagepng($source, $destination, round(9 * (100 - $quality) / 100));
                    break;
                case 'image/gif':
                    $saved = @imagegif($source, $destination);
                    break;
            }
            $response['details']['format_used'] = $extension;
        }

        imagedestroy($source);

        if (!$saved) {
            $response['error'] = 'Failed to save processed image.';
            $response['details']['code'] = 'IMAGE_SAVE_FAILED';
            return json_encode($response);
        }

        // Verify the saved file
        if (!file_exists($destination)) {
            $response['error'] = 'Image verification failed.';
            $response['details']['code'] = 'IMAGE_VERIFICATION';
            return json_encode($response);
        }

        // Success response
        $response['success'] = true;
        $response['filename'] = $new_filename;
        $response['details']['file_path'] = $destination;
        $response['details']['file_size'] = round(filesize($destination) / 1024, 2) . 'KB';
        $response['details']['quality'] = $quality;
        unset($response['error']);

        return json_encode($response);

    } catch (Exception $e) {
        error_log("Image upload error: " . $e->getMessage());
        $response['error'] = 'An unexpected error occurred during image processing.';
        $response['details']['code'] = 'UNEXPECTED_ERROR';
        $response['details']['exception'] = get_class($e);
        $response['details']['error_message'] = $e->getMessage();
        return json_encode($response);
    }
}

function upload_mutiple_image( $file_name , $target_dir){

//   if(!isImage($_FILES[$file_name]["tmp_name"])) return 0; 

  $temp = explode(".", $_FILES[$file_name]["name"]);

  $newfilename  =  $temp[0]."_".uniqid().'.'.end($temp);

  $newfilename = clean($newfilename);

  if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_dir . $newfilename))
    return  $newfilename;
 else
    return 0;

}



/**
 * Replace system variables and shortcodes in content
 * 
 * @param string $content The content to process
 * @param string|null $module_location Path to module locations
 * @return string Processed content with all replacements
 */
function replace_sysvari($content, $module_location = null) {
    // First process module shortcodes if location provided
    if (!empty($module_location)) {
        $modules = return_multiple_rows("SELECT * FROM og_packages_category WHERE soft_delete = 0 AND isactive = 1");
        
        foreach ($modules as $module) {
            $modules_content = include_module(
                $module_location . $module['location'],
                array('packages_category' => $module['og_all_packages_id'])
            );
            $content = str_replace($module['short_code'], $modules_content, $content);
        }
    }

    // Process settings shortcodes
    $settings_codes = return_multiple_rows(
        "SELECT * FROM og_settings WHERE soft_delete = 0 AND isactive = 1 AND short_code IS NOT NULL"
    );
    
    foreach ($settings_codes as $settings_code) {
        $content = str_replace($settings_code['short_code'], $settings_code['settings_value'], $content);
    }

    // Process custom shortcodes (like date)
    $content = process_custom_shortcodes($content);

    // Final cleanup
    $content = replaceTxtArea(remove_non_utf($content));
    
    return $content;
}


function each_(&$arr) {
    $key = key($arr);
    $result = ($key === null) ? false : [$key, current($arr), 'key' => $key, 'value' => current($arr)];
    next($arr);
    return $result;
}



function replaceTextArea($val){
    $safe = str_replace('textarea','txtarea',$val);
    return  $safe;
}

function replaceTxtArea($val){
    $safe = str_replace('txtarea','textarea',$val);
    return  $safe;
}

function small_txt($text){
   $text = strip_tags($text);
   $text = clean($text);
   $chars_limit = 60;

    if (strlen($text) > $chars_limit){
        $new_text = substr($text, 0, $chars_limit);
        $new_text = trim($new_text);
        return $new_text . "...";
    }
    else {
    return remove_non_utf($text);
    }

}

function createMenu($parent, $menu)
{
    $html = "";
    if (isset($menu['parents'][$parent])) {
        // $html .= '<ul class="sina-menu sina-menu-right" data-in="fadeInLeft" data-out="fadeInOut">';
        foreach ($menu['parents'][$parent] as $itemId) {
            if (!isset($menu['parents'][$itemId])) {
                $html .= "<li >
                         <a  href='" . $menu['items'][$itemId]['cat_url'] . "'>" . $menu['items'][$itemId]['catname'] . "</a>
                     </li>";
            }
            if (isset($menu['parents'][$itemId])) {
                $html .= "<li class='dropdown'>
                  <a class='dropdown-toggle' data-toggle='dropdown' href='" . $menu['items'][$itemId]['cat_url'] . "'>" . $menu['items'][$itemId]['catname'] .  "</a>";
                $html .= '<ul class="dropdown-menu">';
                $html .= createMenu($itemId, $menu);
                $html .= '</ul>';

                $html .= "</li>";
            }
        }
        // $html .= "</ul>";
    }
    return $html;
}


function createmulltilevelcheckbox($parent, $menu, $selected_categories = null)
{
    $html = "";
    if (isset($menu['parents'][$parent])) {
        foreach ($menu['parents'][$parent] as $itemId) {
            // Check if the current category is selected
            $isChecked = in_array($menu['items'][$itemId]['catid'], $selected_categories) ? 'checked' : '';

            if (!isset($menu['parents'][$itemId])) {
                // If no parent exists, it's a main parent
                $html .= "
                    <div class='custom-control custom-checkbox col-md-8'>
                        <input type='checkbox' class='custom-control-input' id='chk_mdaction_" . $menu['items'][$itemId]['catid'] . "' datachck-id='" . $menu['items'][$itemId]['catid'] . "' $isChecked>
                        <label class='custom-control-label' for='chk_mdaction_" . $menu['items'][$itemId]['catid'] . "'>" . $menu['items'][$itemId]['catname'] . "</label>
                    </div>";
            }
            if (isset($menu['parents'][$itemId])) {
                $html .= "
                    <div class='custom-control custom-checkbox col-md'>
                        <input type='checkbox' class='custom-control-input' id='chk_mdaction_" . $menu['items'][$itemId]['catid'] . "' datachck-id='" . $menu['items'][$itemId]['catid'] . "' $isChecked>
                        <label class='custom-control-label' for='chk_mdaction_" . $menu['items'][$itemId]['catid'] . "'>" . $menu['items'][$itemId]['catname'] . "</label>
                        <div class='custom-control custom-checkbox col-md'>";
                $html .= createmulltilevelcheckbox($itemId, $menu, $selected_categories);
                $html .= '</div>
                    </div>';
            }
        }
    }
    return $html;
}


function remove_utf($str){

         $str = str_replace('"','',$str); 
        return mb_convert_encoding($str, 'UTF-8', 'UTF-8');
        
}


function timeAgo($datetime) {
    $now = new DateTime();
    $created = new DateTime($datetime);
    $diff = $now->diff($created);

    if ($diff->y > 0) return $diff->y . " year" . ($diff->y > 1 ? "s" : "") . " ago";
    if ($diff->m > 0) return $diff->m . " month" . ($diff->m > 1 ? "s" : "") . " ago";
    if ($diff->d > 0) return $diff->d . " day" . ($diff->d > 1 ? "s" : "") . " ago";
    if ($diff->h > 0) return $diff->h . " hour" . ($diff->h > 1 ? "s" : "") . " ago";
    if ($diff->i > 0) return $diff->i . " minute" . ($diff->i > 1 ? "s" : "") . " ago";
    return "Just now";
}


// Permission functions
function canEdit($isSystemOperated) {
    return in_array($isSystemOperated, [1, 4, 6 ,0]);
}

function canActivate($isSystemOperated) {
    return in_array($isSystemOperated, [2, 4, 5 ,0]);
}

function canDelete($isSystemOperated) {
    return in_array($isSystemOperated, [3, 5, 6 ,0]);
}

    // Function to build menu items
    function buildMenuItem($item, &$menuItems, &$idToItemMap, &$processedItems) {
        if (in_array($item['id'], $processedItems)) return;
        
        $processedItems[] = $item['id'];
        $hasChildren = isset($menuItems[$item['id']]);
        
        echo '<li class="nav-item' . ($hasChildren ? ' dropdown' : '') . '">';
        
        if ($hasChildren) {
            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown'.$item['id'].'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        } else {
            echo '<a class="nav-link" href="'.$item['url'].'">';
        }
        
        echo '<i class="'.$item['iconclass'].'"></i>&nbsp;';
        echo '<span>'.$item['title'].'</span>';
        echo '</a>';
        
        if ($hasChildren) {
            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown'.$item['id'].'">';
            buildMenu($item['id'], $menuItems, $idToItemMap, $processedItems);
            echo '</div>';
        }
        
        echo '</li>';
    }
    
    // Function to build menu hierarchy
    function buildMenu($parentId, &$menuItems, &$idToItemMap, &$processedItems) {
        if (!isset($menuItems[$parentId])) return;
        
        foreach ($menuItems[$parentId] as $item) {
            if ($parentId != 0) {
                // Child items in dropdown
                if (!in_array($item['id'], $processedItems)) {
                    echo '<a class="dropdown-item" href="'.$item['url'].'">';
                    echo '<i class="'.$item['iconclass'].'"></i>&nbsp;';
                    echo $item['title'];
                    echo '</a>';
                    $processedItems[] = $item['id'];
                }
            } else {
                // Top-level items
                buildMenuItem($item, $menuItems, $idToItemMap, $processedItems);
            }
        }
    }


/**
 * Generate comprehensive social media meta tags with SEO limits
 * 
 * @param array $content Page content array with SEO fields
 * @param string $type Content type (website/article/product/etc)
 * @return string Generated meta tags
 */
function generate_social_meta($content, $type = 'website') {
    $output = '';
    
    // Base information
    $site_name = $GLOBALS['SITE_TITLE'] ?? '';
    $url = ($content['page_canonical_url'] ?? $content['page_url'] ?? '') . ($_SERVER['REQUEST_URI'] ?? '');
    $title = substr($content['page_meta_title'] ?? $content['page_title'] ?? '', 0, 60);
    $description = substr($content['page_meta_desc'] ?? $content['page_desc'] ?? '', 0, 160);
    $image = $content['social_image'] ?? $content['featured_image'] ?? $GLOBALS['SITE_LOGO'] ?? '';
    $twitter_handle = $GLOBALS['TWITTER_HANDLE'] ?? '';
    $fb_app_id = $GLOBALS['FB_APP_ID'] ?? '';

    // Open Graph (Facebook)
    $output .= "\n<!-- Open Graph / Facebook -->\n";
    $output .= '<meta property="og:type" content="' . htmlspecialchars($type) . '">' . "\n";
    $output .= '<meta property="og:site_name" content="' . htmlspecialchars($site_name) . '">' . "\n";
    $output .= '<meta property="og:title" content="' . htmlspecialchars($title) . '">' . "\n";
    $output .= '<meta property="og:description" content="' . htmlspecialchars($description) . '">' . "\n";
    $output .= '<meta property="og:url" content="' . htmlspecialchars($url) . '">' . "\n";
    $output .= '<meta property="og:image" content="' . htmlspecialchars($image) . '">' . "\n";
    
    if ($fb_app_id) {
        $output .= '<meta property="fb:app_id" content="' . htmlspecialchars($fb_app_id) . '">' . "\n";
    }

    // Twitter Card
    $output .= "\n<!-- Twitter Card -->\n";
    $output .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
    if ($twitter_handle) {
        $output .= '<meta name="twitter:site" content="' . htmlspecialchars($twitter_handle) . '">' . "\n";
        $output .= '<meta name="twitter:creator" content="' . htmlspecialchars($twitter_handle) . '">' . "\n";
    }
    $output .= '<meta name="twitter:title" content="' . htmlspecialchars($title) . '">' . "\n";
    $output .= '<meta name="twitter:description" content="' . htmlspecialchars($description) . '">' . "\n";
    $output .= '<meta name="twitter:image" content="' . htmlspecialchars($image) . '">' . "\n";


    // Robots directives
    $robots = [];
    $robots[] = ($content['page_meta_index'] ?? 1) ? 'index' : 'noindex';
    $robots[] = ($content['page_meta_follow'] ?? 1) ? 'follow' : 'nofollow';
    $robots[] = ($content['page_meta_archive'] ?? 1) ? 'archive' : 'noarchive';
    $robots[] = ($content['page_meta_imageindex'] ?? 1) ? 'imageindex' : 'noimageindex';
    
    $output .= '<meta name="robots" content="' . implode(', ', $robots) . '">' . "\n";

    // Canonical URL
    if (!empty($content['page_canonical_url'])) {
        $output .= "\n<!-- Canonical URL -->\n";
        $output .= '<link rel="canonical" href="' . htmlspecialchars($content['page_canonical_url']) . '">' . "\n";
    }

    return $output;
}



function organizeAttributes($attributes) {
    $organized = [];

    // First pass: Group attributes by tab and section
    foreach ($attributes as $attr) {
        $tabId = $attr['tab_id'];
        $sectionName = $attr['section_name'] ?: 'General';
        $attributeId = $attr['attribute_id'];

        // Initialize tab
        if (!isset($organized[$tabId])) {
            $organized[$tabId] = [
                'tab_id' => $tabId,
                'tab_name' => $attr['tab_name'],
                'tab_group' => $attr['tab_group'],
                'sections' => []
            ];
        }

        // Initialize section
        if (!isset($organized[$tabId]['sections'][$sectionName])) {
            $organized[$tabId]['sections'][$sectionName] = [
                'section_name' => $sectionName,
                'is_dynamic' => false,
                'attributes' => []
            ];
        }

        // Check if section is dynamic
        if (!empty($attr['attribute_is_dynamic'])) {
            $organized[$tabId]['sections'][$sectionName]['is_dynamic'] = true;
        }

        // Initialize attribute
        if (!isset($organized[$tabId]['sections'][$sectionName]['attributes'][$attributeId])) {
            $organized[$tabId]['sections'][$sectionName]['attributes'][$attributeId] = [
                'attribute_id'     => $attributeId,
                'attribute_name'   => $attr['attribute_name'],
                'attribute_label'  => $attr['attribute_label'],
                'attribute_type'   => $attr['attribute_type'],
                'is_required'      => isset($attr['attribute_is_required']) ? (int)$attr['attribute_is_required'] : 0,
                'is_dynamic'       => isset($attr['attribute_is_dynamic']) ? (bool)$attr['attribute_is_dynamic'] : false,
                'default_value'    => $attr['default_value'],
                'icon_class'       => $attr['icon_class'],
                'options'          => [],
                'values'           => []
            ];
        }

        // Add option
        if (!empty($attr['option_value'])) {
            $organized[$tabId]['sections'][$sectionName]['attributes'][$attributeId]['options'][] = [
                'option_value' => $attr['option_value'],
                'option_label' => $attr['option_label']
            ];
        }

        // Add value
        if (!empty($attr['attribute_value'])) {
            $organized[$tabId]['sections'][$sectionName]['attributes'][$attributeId]['values'][] = [
                'id'    => $attr['id'],
                'value' => $attr['attribute_value']
            ];
        }
    }

    // Second pass: Build value sets for dynamic sections
    foreach ($organized as &$tab) {
        foreach ($tab['sections'] as &$section) {
            if ($section['is_dynamic']) {
                // Find max sets by count of values
                $maxSets = 1;
                foreach ($section['attributes'] as $attr) {
                    if ($attr['is_dynamic']) {
                        $maxSets = max($maxSets, count($attr['values']));
                    }
                }

                $section['sets'] = [];
                for ($i = 0; $i < $maxSets; $i++) {
                    $set = [];
                    foreach ($section['attributes'] as $attrId => $attr) {
                        if ($attr['is_dynamic']) {
                            $value = $attr['values'][$i]['value'] ?? $attr['default_value'];
                            $set[$attrId] = [
                                'attribute_label' => $attr['attribute_label'],
                                'attribute_type'  => $attr['attribute_type'],
                                'value'           => $value,
                                'is_required'     => $attr['is_required']
                            ];
                        }
                    }
                    $section['sets'][] = $set;
                }

                // Handle non-dynamic attributes
                foreach ($section['attributes'] as $attrId => $attr) {
                    if (!$attr['is_dynamic']) {
                        $value = $attr['values'][0]['value'] ?? $attr['default_value'];
                        $section['attributes'][$attrId]['current_value'] = $value;
                    }
                }
            } else {
                // Handle non-dynamic section attributes
                foreach ($section['attributes'] as $attrId => $attr) {
                    $value = $attr['values'][0]['value'] ?? $attr['default_value'];
                    $section['attributes'][$attrId]['current_value'] = $value;
                }
            }

            // Convert attributes to indexed array
            $section['attributes'] = array_values($section['attributes']);
        }

        // Convert sections to indexed array
        $tab['sections'] = array_values($tab['sections']);
    }

    // Convert tabs to indexed array
    return array_values($organized);
}