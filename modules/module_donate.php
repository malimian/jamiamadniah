<div class="container">
  <form action="" class="was-validated" onsubmit="return false" novalidate>
    <div class="form-group">
      <label for="uname">Name:</label>
      <input type="text" class="form-control" id="username_dh" placeholder="Enter Name" name="uname" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="pwd">Phone No:</label>
      <input type="text" class="form-control" id="userphoneno_dh" placeholder="Enter Phone" name="pswd" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="email" class="form-control" id="useremail_dh" placeholder="Enter Email" name="pswd" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
     <div class="form-group">
      <label for="pwd">Amount:</label>
      <input type="number" class="form-control" id="amount" placeholder="Enter Amount" name="pswd" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-order">Submit</button>
  </form>
</div>
<script type="text/javascript">

  function create_order(username_dh , useremail_dh , userphoneno_dh , total_amount, order_summary , currency , title ){


        senddata('post/order.php',
                  "POST",
                  {
                    order_main_title:title,
                    username_dh:username_dh,
                    useremail_dh:useremail_dh,
                    userphoneno_dh:userphoneno_dh,
                    order_summary:order_summary,
                    total_price:total_amount,
                    currency:currency,
                    submit_order:true
                  },
                  function(result_sucess) {
                  
                  result_sucess = result_sucess.replace(/\s/g, '');

                  console.log(result_sucess);
                  
                    if(result_sucess != 0){
                      location.href = 'checkout.php?order_id='+result_sucess+"&user=true";
                    }
                 
               
                      },
                        function(result_fail) {
                        
                         console.log(result_fail);

                        }
              );


}




$('.btn-order').on('click' , function(){

  loader();

     currency = 'USD';

    var total_amount = parseFloat($('#amount').val());
    var title = "Online Donation";
    var order_summary = "";

        order_summary += "<div class=\"hostingSummary\">"+title+" <span>"+total_amount+"</span></div>";
      
       var username_dh= $('#username_dh').val();
       var useremail_dh= $('#useremail_dh').val();
       var userphoneno_dh= $('#userphoneno_dh').val();

        create_order(username_dh , useremail_dh , userphoneno_dh , total_amount, order_summary , currency , title);

});
</script>