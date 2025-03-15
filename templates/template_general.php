<section>
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown"><?php echo $content['page_title'];?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="<?php echo replace_sysvari($content['cat_url']);?>"><?php echo replace_sysvari($content['catname']);?></a></li>
\                    <li class="breadcrumb-item text-white active" aria-current="page"><a href="<?php echo replace_sysvari($content['page_url']);?>"><?php echo $content['page_title'];?></a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
	<div class="innerPage">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
                    <?php if($PAGE_LOADER == 1){?>

						<div id="div_content"></div>

					<?php } else {
						echo replace_sysvari(remove_non_utf($content['page_desc']) , getcwd()."/");
					}?>
				</div>
			</div>
		</div>
	</div>
</section>