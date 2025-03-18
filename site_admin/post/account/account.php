<?php

require_once('../../admin_connect.php');

if (isset($_POST['update'])) {
    
    $uid = $_SESSION['user']['id'];
    
    $username = escape($_POST['username']);
    $userpass = escape($_POST['userpass']);
    $userpass1 = $_POST['userpass1'];
    
    $emailaddress = escape($_POST['emailaddress']);
    $other_email_address = escape($_POST['other_email_address']);
    
    $phonenumber = escape($_POST['phonenumber']);
    $phonenumber2 = escape($_POST['phonenumber2']);
    $mobile_phone = escape($_POST['mobile_phone']);
    $home_phone = escape($_POST['home_phone']);
    $company_phone = escape($_POST['company_phone']);
    $toll_phone = escape($_POST['toll_phone']);
    $fax = escape($_POST['fax']);
    
    $fullname = escape($_POST['fullname']);
    $profile_pic = escape($_POST['p_image']);
    
    $country = escape($_POST['country']);
    $city = escape($_POST['city']);
    $state = escape($_POST['state']);
    $zip = escape($_POST['zip']);
    $address = escape($_POST['address']);
    
    $website = escape($_POST['website']);
    $company = escape($_POST['company']);
    $company_title = escape($_POST['company_title']);

    $p_desc = escape($_POST['editor1']);

    
    if (($userpass == $userpass1) && !empty($userpass)) {
        
        $sql = "UPDATE `loginuser` SET 
                    `username` = '$username',
                    `password` = '$userpass',
                    `emailaddress` = '$emailaddress',
                    `emailaddress2` = '$emailaddress2',
                    `other_email_address` = '$other_email_address',
                    `phonenumber` = '$phonenumber',
                    `phonenumber2` = '$phonenumber2',
                    `mobile_phone` = '$mobile_phone',
                    `home_phone` = '$home_phone',
                    `company_phone` = '$company_phone',
                    `toll_phone` = '$toll_phone',
                    `fax` = '$fax',
                    `fullname` = '$fullname',
                    `profile_pic` = '$profile_pic',
                    `country` = '$country',
                    `city` = '$city',
                    `state` = '$state',
                    `zip` = '$zip',
                    `address` = '$address',
                    `website` = '$website',
                    `company` = '$company',
                    `details` = '$p_desc',
                    `company_title` = '$company_title'
                WHERE `id` = $uid";
        
        $no_of_row_effected = Update($sql);
        echo $no_of_row_effected;
    } else {
        echo "0";
    }
}
?>