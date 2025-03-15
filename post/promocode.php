<?php
include '../connect.php';


if(isset($_POST['check_promocode'])){

		$membership_;
		$promocode = $_POST['promo_code'];
		$membership_['m_cost'] = $_POST['m_cost'];

 		$error = array('result' => "0");
		$result = array('result' => "1");

    	$total_qunatity_of_used_promo_code = 0;
    	$promo_used_column = "";

    	$promo_code_id = return_single_ans("Select p_id from promocode Where p_code = '$promocode' and isactive = 1 $and_gc ");
    	
        $error['invalid'] = "Invalid Promo Code";

    	if(empty($promo_code_id)) exit(json_encode( $error , TRUE ));

    	$promocode_used_times = return_single_ans("Select p_used_times from promocode Where p_code = '$promocode' and isactive = 1 $and_gc ");

		if($promocode_used_times > 0){

    	$total_qunatity_of_used_promo_code = return_single_ans("SELECT COUNT(promocode) from order_dh Where promocode = '$promo_code_id' and isactive = 1 $and_gc ");

    	$promo_used_column = " and p_used_times >=  $total_qunatity_of_used_promo_code ";

		}

    	$promocode_ = return_single_row("Select * from promocode Where p_code = '$promocode' and DATE(p_validity) > date_format(DATE(NOW()) , '%Y-%m-%d' )  $promo_used_column and isactive = 1 $and_gc ");

        $error['invalid'] = "Promo Code Expired";

    	if(empty($promocode_)) exit(json_encode( $error, TRUE ));

    	$off_in_price = percentage_calculate($membership_['m_cost'] , $promocode_['p_percent']);

        $result['promocode_id'] = $promo_code_id;
    	$result['actual_total_cost'] = $membership_['m_cost'];
    	$result['promo_code_percentage'] =  $promocode_['p_percent'];
    	$result['off_in_price'] =  $off_in_price;
    	$result['final_price'] =  ($membership_['m_cost'] - $off_in_price)."";

    	echo json_encode($result , True);
}



function percentage_calculate($percent , $price){
	 return round(($price * $percent/100) , 2);
}

?>