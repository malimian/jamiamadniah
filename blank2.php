<?php
include 'front_connect.php';

echo Baseheader(SITE_TITLE.'- digital solution company',  SITE_TITLE.', digital solution'  , Company.' is a leading digital solution providing firm in transforming your business ideas into reality.',
	'<link href="css/checkout.css" rel="stylesheet">' , 1);

    echo replace_sysvari(BaseNavBar(1), getcwd()."/");

?>

  


<?php 
	echo replace_sysvari( Basefooter(null,1) , getcwd()."/");
 ?>