function process(value) {
    return value == undefined ? '' : value.replace(/[^a-z0-9_]+/gi, '-').replace(/^-|-$/g, '').toLowerCase();
}

$('#page_title').on('input' , function(){

  var result = process($('#page_title').val());

  $('#page_url').empty().val(result);  

  $('#meta_title').empty().val($('#page_title').val());  


});

validateform(function(){
            
    var page_title = $('#page_title').val();
    var page_url = $('#page_url').val();
    var ctname  = $('#ctname option:selected').val();
    var showInNavBar  = $('#showInNavBar option:selected').val();
    var CreateHierarchy  = $('#CreateHierarchy option:selected').val();
    var is_active  = $('#is_active option:selected').val();
    
 
    senddata
    ('post/category/addmenue.php' ,"POST", {
        page_title:page_title,
        page_url:page_url,
        showInNavBar:showInNavBar,
        CreateHierarchy:CreateHierarchy,
        is_active:is_active,
        ctname:ctname,
        submit:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
     $('#page_title').val('');      
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> Page Added Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
      
        location.href='categories.php';

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




