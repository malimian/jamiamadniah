
    // Disable form submissions if there are invalid fields
    validateform(function(){
            
            var username = $('#username').val();
            var email = $('#email').val();
            var userphone = $('#userphone').val();
            var userpass = $('#userpass').val();
            var userpass1 = $('#userpass1').val();
            var p_image = $('#p_image').val();
            var user_type_select = $('#user_type_select').children("option:selected").val();
            var userrights_list = $('#userrights_list').children("option:selected").val();

             var selectedusermodule_list = [];
            $("#usermodule_list input:checked").each(function () {
                selectedusermodule_list.push($(this).attr('data-id'));
            });

            var selecteduserrights_list = [];
            $("#userrights_list input:checked").each(function () {
                selecteduserrights_list.push($(this).attr('data-id'));
            });
            
            senddata
            ('post/user/adduser.php' ,"POST", {
              username:username,
              email:email,
              userphone:userphone,
              userpass:userpass,
              userpass1:userpass1,
              p_image:p_image,
              user_type_select:user_type_select,
              userrights_list:userrights_list,
              selectedusermodule_list:selectedusermodule_list,
              selecteduserrights_list:selecteduserrights_list,
              save:true
            },function(result){
              console.log('success');
              console.log(result);
              $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

              if(result == "0"){
              $('#error_id').empty();
              $('#error_id').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Password doesnot match <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
              }
              else if(result == "1"){
              $('#error_id').empty();
              $('#error_id').html('<div class="alert alert-danger fade show" role="alert"> <strong>Alert !</strong> Select User Rigts and Privileges <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
              }
              else{
              $('#error_id').empty();
              $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> User Added Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
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