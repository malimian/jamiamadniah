var datatable_id = 'datatable_list_gallery_plugin';

var image_count_ = 0;
var html_gallery_ = "";
var html_list_ = "";

// searchdatatable(datatable_id);

/*  ==========================================
     SHOW UPLOADED IMAGE
  * ========================================== */
  function readURL(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function (e) {
             $('#imageResult')
                 .attr('src', e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
     }
  }

  $(function () {
     $('#files').on('change', function () {
         readURL(input);
     });
  });

  /*  ==========================================
     SHOW UPLOADED IMAGE NAME
  * ========================================== */
  var input = document.getElementById( 'files' );
  var infoArea = document.getElementById( 'upload-label' );

  input.addEventListener( 'change', showFileName );
  function showFileName( event ) {
   var input = event.srcElement;
   var fileName = input.files[0].name;
   infoArea.textContent = 'File name: ' + fileName;
  }


  function Copy_() {
   var copyText = document.getElementById("media_image_url");
   copyText.select();
   copyText.setSelectionRange(0, 99999);
   document.execCommand("copy");
  }


  function Copy_image_url(copy_id) {
   var copyText = document.getElementById("media_gallery_url_"+copy_id);
   copyText.select();
   copyText.setSelectionRange(0, 99999);
   document.execCommand("copy");
  }

  function Copy_image_url_list(copy_id) {
   var copyText = document.getElementById("list_media_gallery_url_"+copy_id);
   copyText.select();
   copyText.setSelectionRange(0, 99999);
   document.execCommand("copy");
  }



$('.btn-use').click(function(){
   var url =  $(this).data('url');
  $('#'+$('#textcopied').val()).val(url);
  $('#MediaGalleryModal').modal('toggle');

});


function Use_image_url(url){
  console.log("|"+url+"|")
 $('#'+$('#textcopied').val()).val(url);
  $('#MediaGalleryModal').modal('toggle');
}



function Use_image_id(id){

  var url = $('#media_gallery_url_'+id).val();
  
 $('#'+$('#textcopied').val()).val(url);
  $('#MediaGalleryModal').modal('toggle');
}

   
   $('.upload_image_module_btn').click(function(){

          var file_data = $('#files').prop('files')[0];
           var form_data = new FormData();
           form_data.append('file', file_data);
           form_data.append('upload_image', true);

           senddata_file
             ('post/modules/media_upload.php' ,"POST", form_data,
             function(result){

               console.log('success');
               console.log(result);

               $('#error_id_upload_module').empty();

               if(result == 0){
                 $('#error_id_upload_module').empty();
                 $('#error_id_upload_module').html('<div class="alert alert-danger" role="alert"> <strong>Alert !<\/strong> Something went wrong Try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;<\/span> <\/button> <\/div>');
                  return;
                 }

                var obj =   JSON.parse(result);
               
                result = obj.file_name;               

               if(result != 0){

               $('#error_id_upload_module').html('<div class="alert alert-success" role="alert"> Image Uploaded <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;<\/span> <\/button> <\/div>');

               $('.image_url_group').empty();

               $('.image_url_group').append('<input class="form-control" id="media_image_url" name="media_image_url" readonly="readonly" type="text" value="'+result+'">');

                $('.image_url_group').append('<button class="btn btn-success" onclick="Copy_()" type="button"> <i class="fa fa-copy"></i>&nbsp;Copy </button>');

                if($('#textcopied').val() != ""){
                
                $('.image_url_group').append('<button class="btn btn-primary btn-use" onclick="Use_image_url(\''+result+'\')" type="button"> <i class="fa fa-hand-rock-o"></i>&nbsp; Use </button>');
                
                }
                
                 $('.image_url_group').css('display' , '');
                
                $('#media_image_url').val(result);

                   image_count_ = image_count_+1;

                  var html_gallery = show_images_gallery(obj.file_name ,obj.file_path , (image_count_) );
                  var html_list    = show_images_list(obj.file_name ,obj.file_path , (image_count_));
                 
                $('#get_images').append(html_gallery);
                $('#datatable_list_gallery_plugin').append(html_list);

               }
               
               
             },function(result){
               console.log('faliure');
               console.log(result);

               $( "#error_id_upload_module" ).empty().html('<div class="alert alert-alert alert-dismissible fade show" role="alert"> <strong>Alert !<\/strong> Something went wrong double check and try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;<\/span> <\/button> <\/div>').fadeIn( 300 ).delay( 1500 );

             });

     });



   function delete_file(file_name , Continer_id){

        senddata
             ('post/modules/media_upload.php' ,"POST", {

              filename : file_name,
              delete_file_submit : true

             },
             function(result){

               console.log('success');
               console.log(result);

               if(result == 1){
                $('#imgContiner_'+Continer_id).remove();
                $('#list_tr_'+Continer_id).remove();
               }

               
             },function(result){
               console.log('faliure');
               console.log(result);

             });

   }




   function show_images_gallery( img ,img_link , count){

    var html = "";
        html+='<div class="col-md-3 col-sm-12 col-xs-12 mb-2" id="imgContiner_'+count+'">';
          html+='<div class="card">';
            html+='<div class="card-body">';
                html+='<div class="imgContainer text-center">';
                  html+='<a href="'+img_link+'" target="_blank">';
                    html+='<img class="img-fluid" src="'+img_link+'" alt="">';
                  html+='</a>';
                html+='<div class="form-inline input-group">';
                  html+='<input class="form-control" id="media_gallery_url_'+count+'"  readonly="readonly" type="text" value="'+img+'"> ';
                  html+='<button class="btn btn-success btn-sm btn-copy" onclick="Copy_image_url('+count+')" type="button">';
                    html+='<i class="fa fa-copy"></i>&nbsp;';
                  html+='</button> ';
                  html+='<button class="btn btn-primary btn-sm btn-use" type="button" onclick="Use_image_id('+count+')"  data-url="'+img+'">';
                    html+='<i class="fa fa-hand-rock-o"></i>&nbsp;';
                  html+='</button>';
                  html+='<button class="btn btn-danger btn-sm" onclick="delete_file(\''+img+'\' , \''+count+'\')" type="button">';
                    html+='<i class="fa fa-trash"></i>&nbsp;';
                  html+='</button>';
                html+='</div>';
               html+='</div>';
            html+='</div>';
          html+='</div>';
        html+='</div>';

        return html;

   }



   function show_images_list( img ,img_link , img_size , count){

        var html = "<tr id='list_tr_"+count+"'>";

                html +="<td>";
                html+='<a href="'+img_link+'" target="_blank">';
                html+='<img class="img-fluid thumb-img-gallery" src="'+img_link+'" alt="" >';
                html+='</a>';
                html +="</td>";

                html +="<td>"+img+"</td>";
                html += "<td>";

                html+='<div class="form-inline input-group">';
                html+='<input class="form-control" id="list_media_gallery_url_'+count+'"  readonly="readonly" type="text" value="'+img+'"> ';
                html+='<button class="btn btn-success btn-sm btn-copy" onclick="Copy_image_url_list('+count+')" type="button">';
                html+='<i class="fa fa-copy"></i>&nbsp;';
                html+='</button> ';
                html+='<button class="btn btn-primary btn-sm btn-use" type="button" onclick="Use_image_id('+count+')"  data-url="'+img+'">';
                html+='<i class="fa fa-hand-rock-o"></i>&nbsp;';
                html+='</button>';
                html+='<button class="btn btn-danger btn-sm" onclick="delete_file(\''+img+'\' , \''+count+'\')" type="button">';
                html+='<i class="fa fa-trash"></i>&nbsp;';
                html+='</button>';
                html+='</div>';

                html += "</td>";

                html +="</tr>";

          return html;
}


   function load_images(){


      senddata
             ('get/modules/upload_image.php' ,"GET", null,
             function(result){

               var obj = JSON.parse(result);

               $.each(obj , function(i , j){
                  
                  html_gallery_ += show_images_gallery(obj[i].file_name ,obj[i].file_path , i);
                  html_list_ += show_images_list(obj[i].file_name ,obj[i].file_path , obj[i].file_info , i);
                  image_count_ = i;

               });

               $('#get_images').empty().html(html_gallery_);
               $('#datatable_list_gallery_plugin').empty().html(html_list_);
               
               $('.module_loadimg_btn').hide();

             },function(result){
               console.log('faliure');
               console.log(result);

             });


   }



   // load_images();

  $('#filter_list_images').keyup(function () {

      var rex = new RegExp($(this).val(), 'i');
      $('.searchable_table tr').hide();
      $('.searchable_table tr').filter(function () {
          return rex.test($(this).text());
      }).show();

});