
validateform(function(){
            
    var form_name = $('#form_name').val();
    var form_code = $('#form_code ').val();
    var form_data = CKEDITOR.instances['editor1'].getData();
    var form_date = $('#form_date').val();
    var is_active  = $('#is_active option:selected').val();

   senddata
   ('post/form/editform.php' ,"POST", {
       form_name:form_name ,
       form_code:form_code ,
       form_data:form_data,
       form_date:form_date ,
       is_active:is_active,
       form_id:form_id,
       submit:true
   },
   function(result){
     console.log('success');
     console.log(result);
     $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

    if(result > 0){
     $('#error_id').empty();
     $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> Payment Updated Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
           
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




