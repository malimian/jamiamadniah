<style>

.bloc_left_price {
    color: #c01508;
    text-align: center;
    font-weight: bold;
    font-size: 150%;
}
.category_block li:hover {
    background-color: #007bff;
}
.category_block li:hover a {
    color: #ffffff;
}
.category_block li a {
    color: #343a40;
}
.add_to_cart_block .price {
    color: #c01508;
    text-align: center;
    font-weight: bold;
    font-size: 200%;
    margin-bottom: 0;
}
.add_to_cart_block .price_discounted {
    color: #343a40;
    text-align: center;
    text-decoration: line-through;
    font-size: 140%;
}
.product_rassurance {
    padding: 10px;
    margin-top: 15px;
    background: #ffffff;
    border: 1px solid #6c757d;
    color: #6c757d;
}
.product_rassurance .list-inline {
    margin-bottom: 0;
    text-transform: uppercase;
    text-align: center;
}
.product_rassurance .list-inline li:hover {
    color: #343a40;
}
.reviews_product .fa-star {
    color: gold;
}
.pagination {
    margin-top: 20px;
}
footer {
    background: #343a40;
    padding: 40px;
}
footer a {
    color: #f8f9fa!important
}

</style>

<div class="container">
    <div class="row">
        <!--<div class="col-12 col-sm-3">-->
        <!--    <div class="card bg-light mb-3">-->
        <!--        <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>-->
        <!--        <ul class="list-group category_block">-->
        <!--            <li class="list-group-item"><a href="category.html">Cras justo odio</a></li>-->
        <!--            <li class="list-group-item"><a href="category.html">Dapibus ac facilisis in</a></li>-->
        <!--            <li class="list-group-item"><a href="category.html">Morbi leo risus</a></li>-->
        <!--            <li class="list-group-item"><a href="category.html">Porta ac consectetur ac</a></li>-->
        <!--            <li class="list-group-item"><a href="category.html">Vestibulum at eros</a></li>-->
        <!--        </ul>-->
        <!--    </div>-->
        <!--    <div class="card bg-light mb-3">-->
        <!--        <div class="card-header bg-success text-white text-uppercase">Last product</div>-->
        <!--        <div class="card-body">-->
        <!--            <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />-->
        <!--            <h5 class="card-title">Product title</h5>-->
        <!--            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
        <!--            <p class="bloc_left_price">99.00 $</p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="col">
            <div class="row">
                <?php
                   $products = return_multiple_rows("Select * from products Where isactive = 1 and stock_status = 1 and soft_delete = 0 ");
					foreach ($products as $product) {
				?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo BASE_URL?>images/<?php echo $product['featured_image']?>" alt="<?php echo $product['page_title'];?>">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $product['page_title'];?></h4>
                            <p class="card-text"><?php echo $product['page_desc'];?></p>
                            <div class="row">
                                <div class="col">
                                    <h3 class="text-center btn-block learn-more-btn" ><?php echo CURRENCY;?> <?php echo $product['plistprice']?></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php 
                                    $readonly = "";
                                    if($product['stock_status'] == 0 ) $readonly = "readonly='readonly'";
                                    ?>
                                    <button <?php echo $readonly;?> data-price="<?php echo $product['plistprice']?>" data-title="<?php echo $product['page_title']?>" class="btn btn-success btn-block btn-order">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
              
                <!--<div class="col-12">-->
                <!--    <nav aria-label="...">-->
                <!--        <ul class="pagination">-->
                <!--            <li class="page-item disabled">-->
                <!--                <a class="page-link" href="#" tabindex="-1">Previous</a>-->
                <!--            </li>-->
                <!--            <li class="page-item"><a class="page-link" href="#">1</a></li>-->
                <!--            <li class="page-item active">-->
                <!--                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>-->
                <!--            </li>-->
                <!--            <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                <!--            <li class="page-item">-->
                <!--                <a class="page-link" href="#">Next</a>-->
                <!--            </li>-->
                <!--        </ul>-->
                <!--    </nav>-->
                <!--</div>-->
            </div>
        </div>

    </div>
</div>
<script>
    function create_order(total_amount, order_summary  ){

                var username_dh= "";
                var useremail_dh= "";
                var userphoneno_dh= "";
                
                $.notify('Added to Cart', "success");
                

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

    var total_amount = parseFloat($(this).data("price"));
    var title = $(this).data("title");
    var order_summary = "";
    
        order_summary += "<div class=\"hostingSummary\">"+title+" <span>"+total_amount+"</span></div>";
    
        create_order(total_amount, order_summary);

});


</script>

