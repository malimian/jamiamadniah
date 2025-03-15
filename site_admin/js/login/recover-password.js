

validateform(function() {

              var inputPassword = $('#inputPassword').val();
              var inputPassword1 = $('#inputPassword1').val();
              var inputEmail = $('#inputEmail').val();
              var confirmation_code = $('#confirmation_code').val();


              if(inputPassword != inputPassword1){

                $('#error_id').empty().html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Password doesnot match the confirm password<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                return;
              }

              senddata('post/login/recover-password.php',
                  "POST",
                  {
                    confirmation_code:confirmation_code,
                    inputEmail:inputEmail,
                    inputPassword:inputPassword,
                    inputPassword1:inputPassword1,
                   submit:true
                 },
                  function(result_sucess) {

                    console.log(result_sucess);
                    //alert(result_sucess);

                   if (result_sucess == 0) {
                  
                     $('#error_id').empty().html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry , This link have expired generate a new one <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                  
                   } 
                   if (result_sucess == 1) {
                  
                     $('#error_id').empty().html('<div class="alert alert-success alert-dismissible fade show" role="alert">Your Password have been reset you can now login with your new password now<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                  
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