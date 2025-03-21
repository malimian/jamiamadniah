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



validateform(function () {
    // Existing fields
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
    var is_active = $('#is_active option:selected').val();
    var showInNavbar = $('#showInNavbar option:selected').val();

    // New fields
    var sale_start_date = $('#saleStartDate').val();
    var sale_end_date = $('#saleEndDate').val();
    var brand = $('#brand').val();
    var type = $('#type').val();
    var condition = $('#condition').val();
    var warranty = $('#warranty').val();
    var model = $('#model').val();
    var features = $('#features').val();
    var color = $('#color').val();
    var seller_notes = $('#sellerNotes').val();
    var shipping_info = $('#shippingInfo').val();
    var weight = $('#weight').val();
    var length = $('#length').val();
    var width = $('#width').val();
    var height = $('#height').val();
    var return_policy = $('#returnPolicy').val();

    // Flags
    var Instock = 0;
    var NewArrival = 0;
    var FeaturedProduct = 0;
    var OnSale = 0;
    var BestSeller = 0;
    var TrendingItem = 0;
    var HotItem = 0;

    if ($("#additionalCheck1").is(':checked')) Instock = 1;
    if ($("#additionalCheck2").is(':checked')) NewArrival = 1;
    if ($("#additionalCheck3").is(':checked')) FeaturedProduct = 1;
    if ($("#additionalCheck4").is(':checked')) OnSale = 1;
    if ($("#additionalCheck5").is(':checked')) BestSeller = 1;
    if ($("#additionalCheck6").is(':checked')) TrendingItem = 1;
    if ($("#additionalCheck7").is(':checked')) HotItem = 1;

    // Create FormData object
    const formData = new FormData();

    // Append files
    var totalfiles = document.getElementById('files').files.length;
    for (var index = 0; index < totalfiles; index++) {
        formData.append("files[]", document.getElementById('files').files[index]);
    }

    // Append existing fields
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

    // Append new fields
    formData.append("sale_start_date", sale_start_date);
    formData.append("sale_end_date", sale_end_date);
    formData.append("brand", brand);
    formData.append("type", type);
    formData.append("condition", condition);
    formData.append("warranty", warranty);
    formData.append("model", model);
    formData.append("features", features);
    formData.append("color", color);
    formData.append("seller_notes", seller_notes);
    formData.append("shipping_info", shipping_info);
    formData.append("weight", weight);
    formData.append("length", length);
    formData.append("width", width);
    formData.append("height", height);
    formData.append("return_policy", return_policy);

    // Append flags
    formData.append("Instock", Instock);
    formData.append("NewArrival", NewArrival);
    formData.append("FeaturedProduct", FeaturedProduct);
    formData.append("OnSale", OnSale);
    formData.append("BestSeller", BestSeller);
    formData.append("TrendingItem", TrendingItem);
    formData.append("HotItem", HotItem);

    formData.append("page_id", page_id);
    formData.append("submit", true);

    console.log(formData);

    // Send data to server
    senddata_file(
        'post/page/editpage.php',
        "POST",
        formData,
        function (result) {
            console.log('success');
            console.log(result);
            $("#error_id").fadeIn(300).delay(1500);

            if (result > 0) {
                $('#error_id').empty();
                $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> Page Updated Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
                location.reload();
            }
        },
        function (result) {
            console.log('failure');
            console.log(result);
            $("#error_id").empty().html('<div class="alert alert-alert alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Something went wrong double check and try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeIn(300).delay(1500);
        }
    );
}, function () {
    // Validation failed
    $('#error_id').empty().fadeIn(50).delay(1500).html('<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Please fill out all required field <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeOut(10);
});




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

