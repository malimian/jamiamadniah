<?php 
function front_footer($libs = null){
        if(!empty($libs)){
        foreach ($libs as $lib){
            echo $lib;
         }
        }
}


function Basefooter($libs = null , $template_id = null){
    global $and_gc;
   
    require_once 'modals/loading.php';

   $footer = "";

   if(!empty($template_id)){

	    $st_footer = return_single_ans("Select st_footer from site_template Where st_id = $template_id $and_gc and isactive = 1 ");

	        $footer = $st_footer;
	   }

	    return $libs."

      ".$footer;
}