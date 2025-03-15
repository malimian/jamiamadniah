<?php
if(!headers_sent()){
    
    if(session_id() == '') {
        session_start();
    }
    
    if(!isset($_SESSION['cart']['order'])){
    			$_SESSION['cart']['order'] = [];
    			$_SESSION['cart']['grand_total'] = 0;
    }
    
}
