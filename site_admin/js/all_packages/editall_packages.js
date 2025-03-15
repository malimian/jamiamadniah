
validateform(function(){
     var ptitle = $('#ptitle').val();
     var p_image = $('#p_image').val();              
     var p_cost = $('#p_cost').val();
     var packages_category  = $('#packages_category option:selected').val();
     var IsFeatured  = $('#IsFeatured option:selected').val();  
     var FeaturedText = $('#FeaturedText').val();
     var isactive  = $('#isactive option:selected').val();
     var editor1 = CKEDITOR.instances['editor1'].getData();
 
    senddata
    ('post/all_packages/editall_packages.php' ,"POST", {
        ptitle:ptitle,
        p_image:p_image,
        p_cost:p_cost,
        packages_category:packages_category,
        IsFeatured:IsFeatured,
        FeaturedText:FeaturedText,
        isactive:isactive,
        p_content:editor1,
        all_packages_id:all_packages_id,
        submit:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result != 0){
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> New Package Updated Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            
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




