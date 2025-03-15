
validateform(function(){
            
    var title = $('#title').val();
    var short_code = $('#short_code').val();
    var location = $('#location').val();
    var isactive  = $('#isactive option:selected').val();
 
    senddata
    ('post/og_packages_category/edit_og_packages_category.php' ,"POST", {
        title:title,
        short_code:short_code,
        location:location,
        isactive:isactive,
        og_id:og_id,
        submit:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> OG Packages Category Successfully Updated <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            
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




