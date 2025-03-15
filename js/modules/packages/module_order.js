var modalid = 0;

$('.open_order_model').on('click' , function(){

    $('.sucsses_msg').empty();

    modalid = $(this).data('modalid');

    $('#username_dh_'+modalid).val('');
    $('#useremail_dh_'+modalid).val('');
    $('#userphoneno_dh_'+modalid).val('');

  
  var hosting_id = $(this).data('id');
  var hosting_cost = $(this).data('cost');

  $('#hosting_price').empty().html('RS '+hosting_cost);
    $('#packages_select_'+modalid).val(hosting_id);


    change_price(modalid);

  $('#modalOrder_'+modalid).modal('show');

        $('#packages_select_'+modalid).on('change' , function(){
    
          change_price(modalid);
      
    });
    
    
});





function change_price(modalid_){

    modalid = modalid_;

  var packages_select = $('#packages_select_'+modalid). children("option:selected"). val();

  var pacakages_title = $('#pacakages_title_'+packages_select).html();

  var packages_content = $('#pacakages_content_'+packages_select).html();
  
  var packages_cost = $('#pacakages_price_'+packages_select).html();

  $('#hosting_price').empty().html('RS '+packages_cost);

  $('.packagedatModal').empty().html("<h3>"+pacakages_title+"</h3>"+packages_content);

  $('#TotalPrice_'+modalid).empty().html(packages_cost);

    
}