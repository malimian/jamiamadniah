<?php
if(!headers_sent()){
    
    if(session_id() == '') {
        session_start();
    }
    
    if(!isset($_SESSION['cart']['order'])){
    			$_SESSION['cart']['order'] = [];
    			$_SESSION['cart']['grand_total'] = 0;
    }

    if(!isset($_SESSION['pages_views'])){
        $_SESSION['pages_views'] =   array();
    }


  if(!isset($_SESSION['weather'])){
            $_SESSION['weather'] = "";
    }


  if(!isset($_SESSION['country'])){
            $_SESSION['country'] = "";
    }


    if (!isset($_SESSION['content_alert'])) {
            $_SESSION['content_alert'] = "";
    }

    
}
