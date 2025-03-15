<?php 

function BaseNavBar($template_id){

	    global $and_gc;
   
   		$navbar = "";

   if(!empty($template_id)){

    $site_header = return_single_ans("Select st_menue from site_template Where st_id = $template_id $and_gc and isactive = 1 ");

        $navbar = $site_header;
   }

   return $navbar;

}

?>
