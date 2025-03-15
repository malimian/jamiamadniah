$('input[name="meta_keywords"]').amsifySuggestags({
type : 'amsify'
});

function process(value) {
    return value == undefined ? '' : value.replace(/[^a-z0-9_]+/gi, '-').replace(/^-|-$/g, '').toLowerCase();
}



   $('#check_url').click(function(){
    if(document.getElementById('check_url').checked) $("#page_url").attr("readonly", false);
    else $("#page_url").attr("readonly", true);

   });



    $('#page_title').on('input' , function(){
    
      if(document.getElementById('check_url').checked){

      var result = process($('#page_title').val());

      $('#page_url').empty().val(result+".html");  

      $('#meta_title').val($('#page_title').val());  
    }


    });



validateform(function(){
            
    var ctname = $('#ctname').val();
    var page_title = $('#page_title').val();
    var page_url = $('#page_url').val();
    var template_page = $('#template_page').val();
    var site_template = $('#site_template').val();
    var editor1 = CKEDITOR.instances['editor1'].getData();
    var meta_title = $('#meta_title').val();
    var meta_keywords = $('#meta_keywords').val();
    var meta_desc = $('#meta_desc').val();
    var header = $('#header').val();
    var p_image = $('#p_image').val();
    var is_active  = $('#is_active option:selected').val();
    var showInNavbar  = $('#showInNavbar option:selected').val();
    
    
     const formData = new FormData();

    // Read selected files
       var totalfiles = document.getElementById('files').files.length;
       for (var index = 0; index < totalfiles; index++) {
          formData.append("files[]", document.getElementById('files').files[index]);
          console.log( document.getElementById('files').files[index]);
       }


    console.log("Files length : "+ totalfiles);

    formData.append("ctname", ctname);
    formData.append("page_title", page_title);
    formData.append("page_url", page_url);
    formData.append("header", header);
    formData.append("template_page", template_page);
    formData.append("site_template", site_template);
    formData.append("is_active", is_active);
    formData.append("showInNavbar", showInNavbar);
    formData.append("editor1", editor1);
    formData.append("p_image", p_image);
    formData.append("meta_title", meta_title);
    formData.append("meta_keywords", meta_keywords);
    formData.append("meta_desc", meta_desc);
    formData.append("page_id", page_id);
    formData.append("submit", true);
    
    console.log(formData);

    senddata_file
    ('post/page/editpage.php' ,"POST", formData ,
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> Page Updated Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
         location.reload();   
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




function delete_image(id){
     senddata(
            'post/page/delete_photogallery.php',
            "POST", {
                id: id,
                delete: true
            },
            function(result) {
                console.log(result);
                 $( "#dr_"+id ).remove();
            },
            function(result) {
                console.log(result);
            }
        );
}

