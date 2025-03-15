<?php 
include 'front_connect.php';

echo Baseheader(SITE_TITLE.' Solar Company in Lahore Pakistan | Solar System in Lahore Pakistan',  SITE_TITLE.', leading solar energy company in lahore pakistan, solar system companies in lahore, best solar energy Company in lahore pakistan, UAESOLAR top solar company in lahore pakistan, solar services company in pakistan, no 1 solar company in lahore pakistan, pakistan solar services, UAESOLAR systems, renewable eneergy solutions provider in lahore pakistan, residential solar System solutions provider in lahore pakistan, commercial solar system provider in lahore pakistan, roof top solar companies in pakistan, solar panel company in pakistan, solar system company in system, solar energy companies in pakistan, solar power companies in pakistan, turnkey solar energy system'  , SITE_TITLE.' is a Solar Company in Lahore Pakistan sell Solar System in Lahore Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!',
	'
    <link href="css/checkout_page.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	
	' , 1);
	

  $document_id = decrypt_($_GET['document_id']);
  
  if(empty($document_id)) exit( '<script type="text/javascript"> window.location = "'.BASE_URL.'" </script>');

  $document_detail = return_single_row("Select * from documents where docu_id = ".$document_id." and isactive = 1 and soft_delete = 0 ");
  
    if(empty($document_detail)) exit( '<script type="text/javascript"> window.location = "'.BASE_URL.'" </script>');

    echo replace_sysvari(BaseNavBar(1), getcwd()."/");


?>

<section>
	<div class="innerPage">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="div_content">
						<h1><?php echo $document_detail['document_Title'];?></h1>
						<div>
						    <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Short Link&nbsp;
                                      <i class="glyphicon glyphicon-link"></i>
                                      </span>
                                        <input readonly="readonly" class="form-control" value="<?php echo $document_detail['d_shortlink']?>" />
                                    </div>
                                </div>
                            </div>
                            </div>
						    
						</div>
							<?php 
                            $data =  str_replace("{date}", date("Y/m/d") ,$document_detail['document_detail']);
                            $data =  str_replace("{title}", $document_detail['document_Title'] ,$data);
                            echo $data;
                            ?>
						<div style="float:right;">
						  	<a href="<?php echo $document_detail['document_page'];?>?document_id=<?php echo encrypt_($document_id); ?>" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View</a>
							<a href="<?php echo $document_detail['document_page'];?>?document_id=<?php echo encrypt_($document_id); ?>&download" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download</a>
							<a href="<?php echo $document_detail['document_page'];?>?document_id=<?php echo encrypt_($document_id); ?>&print" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
  echo replace_sysvari( Basefooter(null,1) , getcwd()."/");
 ?>