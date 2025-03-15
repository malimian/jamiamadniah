
$('#submit_btn').click(function(){
    
loader(); 
    	    var payment_method = $('#payment_method'). children("option:selected"). val();
            var tx_id = $('#tx_id').val();
            var amount_sent = $('#amount_sent').val();
            var username_dh = $('#username_dh').val();
            var useremail_dh = $('#user_email').val();
            var userphoneno_dh = $('#userphoneno_dh').val();
            var cthr = $('#cthr').val();
            var file_data = $('#files').prop('files')[0];
           
            var form_data = new FormData();
         	form_data.append('order_id', order_id);
            form_data.append('file', file_data);
            form_data.append('payment_method', payment_method);
            form_data.append('tx_id', tx_id);
            form_data.append('amount_sent', amount_sent);
            form_data.append('username_dh', username_dh);
            form_data.append('useremail_dh', useremail_dh);
            form_data.append('userphoneno_dh', userphoneno_dh);
		   form_data.append('submit_order', true);

           
            senddata_file
            ('post/checkout.php' ,"POST", form_data,
            function(result){
              loader(); 
              console.log('success');
              console.log(result);
              $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

              if(result > 0){
              $('#error_id').empty();
              $('#error_id').html('<div class="alert alert-success" role="alert"> <strong>Thanks ,</strong> Your Order has been placed <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                
                // location.href= "thankyou.php?order_id="+order_id;

                location.reload();

              }
              else{
              $('#error_id').empty();
              $('#error_id').html('<div class="alert alert-danger" role="alert"> <strong>Alert !</strong> Something went wrong Try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
              }
              
            },function(result){
              console.log('faliure');
              console.log(result);
              $( "#error_id" ).empty().html('<div class="alert alert-alert alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Something went wrong double check and try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeIn( 300 ).delay( 1500 );

            });
 

});