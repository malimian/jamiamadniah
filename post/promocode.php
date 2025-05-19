<?php
include '../connect.php';

if (isset($_POST['check_promocode'])) {

    // Sanitize input
    $promocode = isset($_POST['promo_code']) ? trim($_POST['promo_code']) : '';
    $membership_cost = isset($_POST['m_cost']) ? floatval($_POST['m_cost']) : 0;

    $error = ['result' => "0"];
    $result = ['result' => "1"];

    $total_qunatity_of_used_promo_code = 0;
    $promo_used_column = "";

    // Optional filter based on your global context (guard clause if needed)
    $and_gc = ""; // Define this properly if required

    // Validate Promo Code existence
    $promo_code_id = return_single_ans("SELECT p_id FROM promocode WHERE p_code = '$promocode' AND isactive = 1 $and_gc");
    $error['invalid'] = "Invalid Promo Code";

    if (empty($promo_code_id)) {
        exit(json_encode($error, true));
    }

    // Optional usage limit check (commented logic you had)
    $promocode_used_times = return_single_ans("SELECT p_used_times FROM promocode WHERE p_code = '$promocode' AND isactive = 1 $and_gc");
    if ($promocode_used_times > 0) {
        $total_qunatity_of_used_promo_code = return_single_ans("SELECT COUNT(promocode) FROM order_dh WHERE promocode = '$promo_code_id' AND isactive = 1 $and_gc");
        $promo_used_column = " AND $promocode_used_times >= $total_qunatity_of_used_promo_code";
    }

    // Validate promo code by date and activity
    $promocode_ = return_single_row("
        SELECT * 
        FROM promocode 
        WHERE p_code = '$promocode' 
          AND DATE(p_validity_ends) >= CURDATE() 
          AND DATE(p_validity) <= CURDATE() 
          $promo_used_column 
          AND isactive = 1 
          $and_gc
    ");

    $error['invalid'] = "Promo Code Expired";

    if (empty($promocode_)) {
        exit(json_encode($error, true));
    }

    // Calculate discount
    $off_in_price = percentage_calculate($membership_cost, $promocode_['p_percent']);

    $result['promocode_id'] = $promo_code_id;
    $result['actual_total_cost'] = $membership_cost;
    $result['promo_code_percentage'] = $promocode_['p_percent'];
    $result['off_in_price'] = $off_in_price;
    $result['final_price'] = ($membership_cost - $off_in_price) . "";

    echo json_encode($result, true);
}

function percentage_calculate($price, $percent) {
    return round(($price * $percent / 100), 2);
}
