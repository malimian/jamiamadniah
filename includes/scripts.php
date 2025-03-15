<?php 
function front_script($libs = null){
        if(!empty($libs)){
        foreach ($libs as $lib){
            echo $lib;
         }
        }
 }


function BaseScript($libs = null , $template_id = null){
    global $and_gc;
   
   $scripts = "";

   if(!empty($template_id)){

        $st_scripts = return_single_ans("Select st_script from site_template Where st_id = $template_id $and_gc and isactive = 1 ");

            $scripts = $st_scripts;
       }

        return "

      ".$scripts."

      ".$libs."

      ";
}


?>