validateform(function() {

              var inputEmail = $('#inputEmail').val();

              senddata('post/login/forget-password.php',
                  "POST",
                  {inputEmail:inputEmail,
                   submit:true
                 },
                  function(result_sucess) {

                    console.log(result_sucess);
                    //alert(result_sucess);

                   if (result_sucess == 0) {
                  
                     $('#error_id').empty().html('<div class="alert alert-danger alert-dismissible fade show" role="alert">We could not find your Email<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                  
                   } 
                   if (result_sucess == 1) {
                  
                     $('#error_id').empty().html('<div class="alert alert-success alert-dismissible fade show" role="alert">We have sent you the password Recovery on your email<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                  
                   }
                  // else location.href = result_sucess;

                  },
                  function(result_fail) {

                  }
              );

          }

          ,
          function(){

          }

      );