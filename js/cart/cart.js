function delete_row(id){


        senddata(
            'post/update_cart.php',
            "POST", {
                id: id,
                delete: true
            },
            function(result) {
                console.log(result);
				
                var price_ = $('#price_'+id).html();
                var grand_total = $('#grand_total').html();
                var cost = parseFloat(grand_total)  - parseFloat(price_);
              
                if(cost > 0){
                    $('#grand_total').html(cost.toFixed(2));
                    $('#checkout').prop('disabled', false);
                }
                else{
                    $('#checkout').prop('disabled', true);
                    $('#grand_total').html('0.00');
                }

                $('#row_'+id).remove();

            },
            function(result) {
                console.log(result);

            }
        );


}

$('#checkout').on('click' , function(){

    var grand_total =  $('#grand_total').html();

    if(parseFloat(grand_total) > 0)

        senddata(
            'post/order.php',
            "POST", {
                submit_order: true
            },
            function(result) {

               if(loader('stop')){
                    console.log(result);
             
                    location.href = "checkout.php?order_id="+result.replace(/\s/g, '');

                }


            },
            function(result) {
                console.log(result);
            }
        );

     else $('#checkout').prop('disabled', true);
    


});