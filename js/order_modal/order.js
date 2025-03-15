
$('#btn-order').on('click' , function(){

loader();

var order_summary = "";
var total_amount = parseInt($('#TotalPrice').text());
var hosting_years = $('#hosting_years'). children("option:selected"). val();
var packages_select = $('#packages_select'). children("option:selected"). val();
var hosting_title = $('#pacakages_title_'+packages_select).html();
var hosting_content = $('#pacakages_content_'+packages_select).html();
var username_dh = $('#username_dh').val();
var useremail_dh = $('#useremail_dh').val();
var userphoneno_dh = $('#userphoneno_dh').val();
var domain_price = $('#domain_price').text();
var hosting_price = $('#hosting_price').text();
var domain_name = $('#domain_name').val();


  if(username_dh =="" || useremail_dh =="" || userphoneno_dh ==""){
     $('#sucsses_msg').empty().html('<div class="alert alert-warning"> Fill all required fields </div>');
    
      loader();

    return;
  }




if(domain_price != ""){
  order_summary = "Domain "+domain_name+" Per Year "+domain_price+" </br>";
}
 order_summary += "<div class=\"hostingSummary\"> Hosting "+hosting_title+" Per Year <span>"+hosting_price+"</span></div>";

 order_summary += "For "+hosting_years+" Years </br><h5>" + hosting_title+"</h5>"+hosting_content;


				senddata('post/order.php',
                  "POST",
                  {
                  	username_dh:username_dh,
                  	useremail_dh:useremail_dh,
                    userphoneno_dh:userphoneno_dh,
                    order_summary:order_summary,
                    total_price:total_amount,
                    submit_order:true
                  },
                  function(result_sucess) {
                  
                  console.log(result_sucess);
                  
	                  if(result_sucess != 0){
	                  	location.href = 'checkout.php?order_id='+result_sucess;
	                  }
                 
               
                      },
                        function(result_fail) {
                        
                         console.log(result_fail);

                        }
              );


});