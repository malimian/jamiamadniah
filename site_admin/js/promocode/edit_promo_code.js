  $('#update_promocode').click(function(){


    var p_title = $('#p_title').val();
    var p_percent = $('#p_percent').val();
    var p_code = $('#p_code').val();
    var editor1 = CKEDITOR.instances['editor1'].getData();
    var p_validity = $('#p_validity').val();
    var p_used_times = $('#p_used_times').val();
    var isactive  = $('#isactive option:selected').val();
          
            senddata
            ('post/promocode/edit_promo_code.php?id='+id ,"POST", {
                p_title:p_title,
                p_percent:p_percent,
                p_code:p_code,
                editor1:editor1,
                p_validity:p_validity,
                p_used_times:p_used_times,
                isactive:isactive,
              submit:true
            },function(result){
              console.log('success');
              console.log(result);
              $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

              if(result > 0){
              $('#error_id').empty();
              $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Promo Code Edit Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
              }
              else{
              $('#error_id').empty();
                $( "#error_id" ).empty().html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Something went wrong double check and try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeIn( 300 ).delay( 1500 );
              }
              
            },function(result){
              console.log('faliure');
              console.log(result);
              $( "#error_id" ).empty().html('<div class="alert alert-alert alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Something went wrong double check and try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeIn( 300 ).delay( 1500 );

            });

  });