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
    var sku     =       $('#sku').val();
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
    var featured_image1 =   $('#p_image1').val();
    var featured_image2 =   $('#p_image2').val();
    var featured_image3 =   $('#p_image3').val();
    var featured_image4 =   $('#p_image4').val();
    var featured_image5 =   $('#p_image5').val();

    var is_active  = $('#is_active option:selected').val();
    var plistprice = $('#plistprice').val();

    var Instock = 0;
    var NewArrival = 0;
    var FeaturedProduct = 0;
    var OnSale = 0;
    var BestSeller = 0;
    var TrendingItem = 0;
    var HotItem = 0;

    if( $("#additionalCheck1").is(':checked')) Instock = 1;
    if( $("#additionalCheck2").is(':checked')) NewArrival = 1;
    if( $("#additionalCheck3").is(':checked')) FeaturedProduct = 1;
    if( $("#additionalCheck4").is(':checked')) OnSale = 1;
    if( $("#additionalCheck5").is(':checked')) BestSeller = 1;
    if( $("#additionalCheck6").is(':checked')) TrendingItem = 1;
    if( $("#additionalCheck7").is(':checked')) HotItem = 1;



    senddata
    ('post/product/editproduct.php' ,"POST", {
        ctname:ctname,
        page_title:page_title,
        page_url:page_url,
        template_page:template_page,
        site_template:site_template,
        is_active:is_active,
        editor1, editor1,
        meta_title:meta_title,
        meta_keywords:meta_keywords,
        meta_desc:meta_desc,
        header:header,
        p_image:p_image,
        featured_image1:featured_image1,
        featured_image2:featured_image2,
        featured_image3:featured_image3,
        featured_image4:featured_image4,
        featured_image5:featured_image5,
        sku:sku,
        page_id : page_id,
        Instock:Instock,
        NewArrival:NewArrival,
        FeaturedProduct:FeaturedProduct,
        OnSale:OnSale,
        BestSeller:BestSeller,
        TrendingItem:TrendingItem,
        plistprice:plistprice,
        HotItem:HotItem,
      submit:true
    },
    function(result){
      console.log('success');
      console.log(result);
      $( "#error_id" ).fadeIn( 300 ).delay( 1500 );

     if(result > 0){
      $('#error_id').empty();
      $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> Page Updated Successfully <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            
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




