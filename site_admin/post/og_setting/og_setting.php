<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){

    $title = escape($_POST['title']);    
    $tagline = escape($_POST['tagline']);
    $url = $_POST['url'];
    $email = $_POST['email'];
    $key = $_POST['key'];
    $key_pass = $_POST['key_pass'];
    $env = $_POST['env'];
    $logo = $_POST['logo'];
    $img_path = $_POST['img_path'];
    $time_zone = $_POST['time_zone'];
    $file_path = $_POST['file_path'];
    $site_telno = $_POST['site_telno'];
    $shop_location = $_POST['shop_location'];
    $uid = $_SESSION['user']['id'];
    $friendly_url = $_POST['friendly_url'];
    $page_loader = $_POST['page_loader'];

    // Update main settings in the database
    $updates = [
        ['title', 1],
        ['tagline', 2],
        ['url', 3],
        ['email', 5],
        ['key', 6],
        ['key_pass', 7],
        ['env', 8],
        ['logo', 9],
        ['img_path', 10],
        ['time_zone', 11],
        ['file_path', 12],
        ['friendly_url', 13],
        ['page_loader', 14],
        ['site_telno', 17],
        ['shop_location', 18]
    ];

    // Loop through and update each setting
    foreach ($updates as $setting) {
        $setting_name = $setting[0];
        $setting_id = $setting[1];
        $value = $$setting_name;  // Dynamically access the variable
        update("UPDATE og_settings SET settings_value = '$value' WHERE settings_id = $setting_id");
    }

    // Social media platforms with their corresponding IDs
    $social_media_platforms = [
        19 => isset($_POST['social_media_data']['facebook_url']) ? $_POST['social_media_data']['facebook_url'] : '',
        20 => isset($_POST['social_media_data']['twitter_url']) ? $_POST['social_media_data']['twitter_url'] : '',
        21 => isset($_POST['social_media_data']['instagram_url']) ? $_POST['social_media_data']['instagram_url'] : '',
        22 => isset($_POST['social_media_data']['linkedin_url']) ? $_POST['social_media_data']['linkedin_url'] : '',
        23 => isset($_POST['social_media_data']['youtube_url']) ? $_POST['social_media_data']['youtube_url'] : '',
        24 => isset($_POST['social_media_data']['pinterest_url']) ? $_POST['social_media_data']['pinterest_url'] : '',
        25 => isset($_POST['social_media_data']['snapchat_url']) ? $_POST['social_media_data']['snapchat_url'] : '',
        26 => isset($_POST['social_media_data']['tiktok_url']) ? $_POST['social_media_data']['tiktok_url'] : '',
        27 => isset($_POST['social_media_data']['reddit_url']) ? $_POST['social_media_data']['reddit_url'] : '',
        28 => isset($_POST['social_media_data']['whatsapp_url']) ? $_POST['social_media_data']['whatsapp_url'] : '',
        29 => isset($_POST['social_media_data']['telegram_url']) ? $_POST['social_media_data']['telegram_url'] : ''
    ];

    // Loop through each social media platform and update the corresponding URL by ID
    foreach ($social_media_platforms as $platform_id => $url) {
        if (!empty($url)) {
            Update("UPDATE og_settings SET settings_value = '$url' WHERE settings_id = $platform_id");
        } else {
            // Optionally clear the URL if it's empty
            Update("UPDATE og_settings SET settings_value = '' WHERE settings_id = $platform_id");
        }
    }

    echo "1";
}
?>