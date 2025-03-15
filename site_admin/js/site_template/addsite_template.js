validateform(function(){
            
    var st_name = $('#st_name').val();
    var st_header = $('#st_header').val();
    var st_menue = $('#st_menue').val();
    var st_footer = $('#st_footer').val();
    var st_script = $('#st_script').val();
    var is_active  = $('#is_active option:selected').val();
 
    senddata
    ('post/site_template/addsite_template.php' ,"POST", {
        st_name:st_name,
        st_header:st_header,
        st_menue:st_menue,
        st_footer:st_footer,
        st_script:st_script,
        is_active:is_active,
        submit:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
     $('#t_name').val('');      
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> site Template Added Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            
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




