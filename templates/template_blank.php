<section>

<?php if($PAGE_LOADER == 1){?>

	<div id="div_content"></div>

<?php } else {
	echo replace_sysvari(RunPhp($content['page_desc']) , getcwd()."/");
}?>

</section>