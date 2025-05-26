<?php

$settings = return_multiple_rows("Select * from og_settings $Where_gc and isactive = 1");

##########################PROJECT
define('SITE_TITLE', $settings[0]['settings_value'] , '');

##########################SITE_TAGLINE
define('SITE_TAGLINE', $settings[1]['settings_value'] , '');

##########################PROJECT LOGO
define('SITE_LOGO', $settings[8]['settings_value'] , '');

##########################TIME ZONE
date_default_timezone_set($settings[10]['settings_value']);
define('TIME_ZONE', $settings[10]['settings_value'] , '');


##########################SITE TELEFONE NO
define('SITE_TELNO', $settings[16]['settings_value'] , '');


##########################PROJECT
define('Company', 'Ibotoempire' , '');

##########################Email
define('EMAIL', $settings[4]['settings_value'] , '');


##########################KEY PASS
define('KEY', $settings[5]['settings_value'] , '');
define('KEY_PASS', $settings[6]['settings_value'] , '');

##########################Enviroment
// 1 = Live , 2 = Development
define('ENV', $settings[7]['settings_value'] , '');

########################## BASE URL

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') $protocol = "https://";
else $protocol = "http://";

if($_SERVER['REMOTE_ADDR'] == "::1" || $_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
	
	define('BASE_URL', $protocol.'localhost/ibspotlight/' , '');
	define('API_BASE_URL', $protocol.'localhost/ibspotlight/api/' , '');
}
else{
	define('BASE_URL', $protocol.$settings[2]['settings_value'] , '');
    define('API_BASE_URL', $protocol.$settings[3]['settings_value'] , '');
}

##########################ADMIN URL
define('SITE_ADMIN', 'site_admin' , '');
define('ADMIN_URL', BASE_URL.SITE_ADMIN.'/' , '');

########################## API Version
define('API_V', API_BASE_URL.'v1/' , '');

##########################PATHS_ABSOLUTE
define('ABSOLUTE_IMAGEPATH', $settings[9]['settings_value'] , '');

define('ABSOLUTE_FILEPATH',  $settings[11]['settings_value'] , '');

define('ABSOLUTE_VIDEOPATH',  $settings[29]['settings_value'] , '');



##########################PAGE_LOADER
define('ERROR_404',  $settings[14]['settings_value'] , '');


##########################PAGE_LOADER
define('PAGE_LOADER',  $settings[13]['settings_value'] , '0');


define('COMMENT_API', '%241%24wq1rdBcg%24cC9mlw%2FSWcQWnSvdj5vpc1' , '');

define('CURRENCY', '$' , '');

define('COMMENTS_API', '%241%24wq1rdBcg%248zHXZtKoEIW1v91GvA%2FwO.' , '');


########################## URl SHORTNER https://cutt.ly/
define('API_URL_SHORTNER', '9af4fa21e51e6d4d0e57094c57d79b5561407' );


########################## USD_RATE 0.0058
define('USD_RATE', '0.0058');




?> 