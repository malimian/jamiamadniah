if($("textarea[name=editor1]").length != 0) {

  CKEDITOR.replace( 'editor1', {
   
  height: 300,
  filebrowserUploadUrl:       "post/general/uploads.php?type=file",
  filebrowserImageUploadUrl: "post/general/uploads.php?type=image",

});


}


// if($(".js-switch").length != 0) {

// var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

// elems.forEach(function(html) {
//     var switchery = new Switchery(html, {
//         color: '#28a745',
//         secondaryColor: '#dc3545',
//         size: 'small'
//     });

// });

// }

