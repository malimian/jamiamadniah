if($("textarea[name=editor1]").length != 0) {

  CKEDITOR.replace( 'editor1', {
   
  height: 300,
  filebrowserUploadUrl:       "post/general/uploads.php?type=file",
  filebrowserImageUploadUrl: "post/general/uploads.php?type=image",

});


}


if ($(".js-switch").length !== 0) {
    var elems = document.querySelectorAll('.js-switch');

    elems.forEach(function(el) {
        // Check if the next sibling is a .switchery element (already initialized)
        if (!el.nextElementSibling || !el.nextElementSibling.classList.contains('switchery')) {
            new Switchery(el, {
                color: '#28a745',
                secondaryColor: '#dc3545',
                size: 'small'
            });
        }
    });
}
