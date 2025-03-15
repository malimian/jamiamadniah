
validateform(function(){
            
    var document_Title = $('#document_Title').val();
    var document_page = $('#document_page').val();
    var editor1 = CKEDITOR.instances['editor1'].getData();
     var is_active  = $('#is_active option:selected').val();
 
    senddata
    ('post/documents/adddocuments.php' ,"POST", {
        document_Title:document_Title,
        document_detail:editor1,
        document_page:document_page,
        is_active:is_active,
       
        submit_btn:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
     $('#ptitle').val('');      
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> Document Added Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            
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




