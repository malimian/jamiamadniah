  validateform(function() {

              var inputEmail = $('#inputEmail').val();
              var inputPassword = $('#inputPassword').val();

              senddata('post/login/login.php',
                  "POST",
                  {username:inputEmail,
                   password:inputPassword,
                   login:true
                 },
                  function(result_sucess) {

                    console.log(result_sucess);

                   if (result_sucess == 0) {
                     $('#error_id').fadeIn().fadeOut(3000).empty().append('<div class="alert alert-danger alert-dismissible fade show" role="alert">Username / Email Or Password doesnot match<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                   }
                   else location.href = result_sucess;

                  },
                  function(result_fail) {

                  }
              );

          }

          ,
          function(){

          }

      );