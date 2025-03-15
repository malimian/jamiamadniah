
validateform(function(){
            
    var editor1 = CKEDITOR.instances['editor1'].getData();
    var username_dh = $('#username_dh').val();
    var useremail_dh = $('#useremail_dh').val();
    var userphoneno_dh = $('#userphoneno_dh').val();
    var total_price = $('#total_price').val();
    var discount = $('#discount').val();
    var promocode = $('#promocode').val();
    var order_proof = $('#order_proof').val();
    var tx_id = $('#tx_id').val();
    var Amount_Sent = $('#Amount_Sent').val();
    var payment_method = $('#payment_method').val();
    var payment_status  = $('#payment_status option:selected').val();
 
    senddata
    ('post/order/editorder.php' ,"POST", {
        order_summary:editor1,
        username_dh:username_dh,
        useremail_dh:useremail_dh,
        userphoneno_dh:userphoneno_dh,
        total_price:total_price,
        discount:discount,
        promocode:promocode,
        order_proof:order_proof,
        tx_id:tx_id,
        Amount_Sent:Amount_Sent,
        payment_method:payment_method,
        payment_status:payment_status,
        order_id:order_id,
        submit_btn:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong>Order Updated Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            
     }
      
    },function(result){
      console.log('faliure');
      console.log(result);
      $( "#error_id" ).empty().html('<div class="alert alert-alert alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Something went wrong double check and try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeIn( 300 ).delay( 1500 );

    });
},
function(){
// alert('Unvalidated');
      $('#error_id').empty().fadeIn( 50 ).delay( 1500 ).html('<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Please fill out all required field <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeOut( 10 );
}
);




