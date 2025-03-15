
var page_loader = 1;

$('.page_loader').on("change", function() {

    if ($(this).is(':checked')) {
    
    page_loader = 1;

    } else {

    page_loader = 0;

    }

});


var friendly_url = 1;

$('.friendly_url').on("change", function() {

    if ($(this).is(':checked')) {
    
    friendly_url = 1;

    } else {

    friendly_url = 0;

    }

});


validateform(function(){
            
    var title = $('#title').val();
    var tagline = $('#tagline').val();
    var url = $('#url').val();
    var email = $('#email').val();
    var key = $('#key').val();
    var key_pass = $('#keypass').val();
    var env = $('#env').val();
    var logo = $('#logo').val();
    var img_path = $('#img_path').val();
    var time_zone = $('#time_zone').val();
    var file_path = $('#file_path').val();
    var error_404 = $('#error_404').val();
    var is_active  = $('#is_active option:selected').val();
   
    senddata
    ('post/og_setting/og_setting.php' ,"POST", {
        title:title,
        tagline:tagline,
        url:url,
        email:email,
        key:key,
        logo:logo,
        key_pass:key_pass,
        env:env,
        img_path:img_path,
        time_zone:time_zone,
        file_path:file_path,
        error_404:error_404,
        page_loader:page_loader,
        friendly_url:friendly_url,
      submit:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success ! </strong> Settings Updated <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            
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




