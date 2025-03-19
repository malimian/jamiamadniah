<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){

$title = escape($_POST['title']);    
$tagline =escape($_POST['tagline']);
$url =$_POST['url'];
$email =$_POST['email'];
$key =$_POST['key'];
$key_pass =$_POST['key_pass'];
$env =$_POST['env'];
$logo =$_POST['logo'];
$img_path =$_POST['img_path'];
$time_zone =$_POST['time_zone'];
$file_path =$_POST['file_path'];
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
        ['page_loader', 14]
    ];

    // Loop through and update each setting
    foreach ($updates as $setting) {
        $setting_name = $setting[0];
        $setting_id = $setting[1];
        $value = $$setting_name;  // Dynamically access the variable
        update("UPDATE og_settings SET settings_value = '$value' WHERE settings_id = $setting_id");
    }



$social_media_platforms = [
    'facebook' => isset($_POST['social_media_data']['facebook_url']) ? $_POST['social_media_data']['facebook_url'] : '',
    'twitter' => isset($_POST['social_media_data']['twitter_url']) ? $_POST['social_media_data']['twitter_url'] : '',
    'instagram' => isset($_POST['social_media_data']['instagram_url']) ? $_POST['social_media_data']['instagram_url'] : '',
    'linkedin' => isset($_POST['social_media_data']['linkedin_url']) ? $_POST['social_media_data']['linkedin_url'] : '',
    'youtube' => isset($_POST['social_media_data']['youtube_url']) ? $_POST['social_media_data']['youtube_url'] : '',
    'pinterest' => isset($_POST['social_media_data']['pinterest_url']) ? $_POST['social_media_data']['pinterest_url'] : '',
    'snapchat' => isset($_POST['social_media_data']['snapchat_url']) ? $_POST['social_media_data']['snapchat_url'] : '',
    'tiktok' => isset($_POST['social_media_data']['tiktok_url']) ? $_POST['social_media_data']['tiktok_url'] : '',
    'reddit' => isset($_POST['social_media_data']['reddit_url']) ? $_POST['social_media_data']['reddit_url'] : '',
    'whatsapp' => isset($_POST['social_media_data']['whatsapp_url']) ? $_POST['social_media_data']['whatsapp_url'] : '',
    'telegram' => isset($_POST['social_media_data']['telegram_url']) ? $_POST['social_media_data']['telegram_url'] : ''
];


    // Loop through each social media platform and update the corresponding URL
    foreach ($social_media_platforms as $platform => $url) {
           	
           	$platform = strtoupper($platform);

            Update("UPDATE og_settings SET settings_value = '$url' WHERE settings_id = (SELECT settings_id FROM og_settings WHERE settings_name = '$platform' LIMIT 1)");
    }



echo "1";

}

?>