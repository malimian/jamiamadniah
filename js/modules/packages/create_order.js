function create_order(username_dh , useremail_dh , userphoneno_dh , modalid , total_amount , packages_select , packages_title , packages_content ){

var order_summary = "";
    

 order_summary += "<div class=\"hostingSummary\">"+packages_title+" <span>"+total_amount+"</span></div>";
 order_summary += "<h5>" + packages_title+"</h5>"+packages_content;
 

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


}




$('.btn-order').on('click' , function(){
    
 
var modalid = $(this).data('modalid');

var total_amount = parseInt($('#TotalPrice_'+modalid).text());
var packages_select = $('#packages_select_'+modalid). children("option:selected"). val();

var packages_title = $('#pacakages_title_'+packages_select).html();
var packages_content = $('#pacakages_content_'+packages_select).html();

var username_dh = $('#username_dh_'+modalid).val();
var useremail_dh = $('#useremail_dh_'+modalid).val();
var userphoneno_dh = $('#userphoneno_dh_'+modalid).val();


      if(username_dh =="" || useremail_dh =="" || userphoneno_dh ==""){
         $('.sucsses_msg').empty().html('<div class="alert alert-warning"> Fill all required fields </div>');
          loader();
         return;
      }

    
    
    
    create_order(username_dh , useremail_dh , userphoneno_dh , modalid , total_amount , packages_select , packages_title , packages_content);


});