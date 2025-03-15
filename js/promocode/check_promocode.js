$('#check_promocode').click(function(){

loader();

	var promo_code = $('#promo_code').val();
	var final_price = $('#order_Price').val();

	console.log(final_price);

	senddata('post/promocode.php',
                  "POST",
                  {
                  	m_cost:final_price,
                  	promo_code:promo_code,
                    check_promocode:true
                  },
                  function(result_sucess) {
loader(); 
                   var obj = JSON.parse(result_sucess);
	               
                   if(obj['result'] == "0" ){
                    $('#promo_code_result').empty().html('<div class="alert alert-danger" role="alert"> <strong>Sorry !</strong> '+obj['invalid']+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                    return;
                    }

                   if(obj['result'] == "1" ){

                    $('#promo_code_id').val(obj.promocode_id);

                    $('#promo_code_result').empty().html('<div class="alert alert-success" role="alert"> <strong>Success !</strong> Promo Code Applied <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                   
                    $('#promo_code_setion').empty().append("<p>Actual Fee<span class='feeActual'>"+CURRENCY+obj.actual_total_cost+"</span></p>");
                    $('#promo_code_setion').append("<p>Discount in Percentage<span>"+obj.promo_code_percentage+"%</span></p>");
                    $('#promo_code_setion').append("<p>Discount in Fee<span>$"+obj.off_in_price+"</span></p>");
                    $('#final_price').empty().html(obj.final_price);

                   }


               
                      },
                        function(result_fail) {
                        
                         console.log(result_fail);

                        }
              );



});