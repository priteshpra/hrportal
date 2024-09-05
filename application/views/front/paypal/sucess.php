<div class="empty-space-50"></div>
        <!-- added to cart section -->
        <section class="added-to">    
            <div class="container">
                <div class="row">   
                    <div class="empty-space-50"></div>
                    <div class="col-md-12">
                        <div class="row">  
                            <div class="checkout-div">
                                <div class="stepwizard">
                                    <div class="rate-updates">         
                            <section class="added-to">    
                             <div class="container">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="row">  
                                         <?php 
                                         if(isset($msg) && $msg != ''){
                                            //echo $msg;
                                         }
                                          ?>  
          <center>
                        <div class="thank-you-contain">
                            <div class="thank-you-icon"> 
                                <i class="fa fa-check-circle-o font-36 font-weight-300" aria-hidden="true"></i>
                            </div>
                            <div class="thank-you-h1">
                               <p>Order No : <?php 
                               if(isset($of_id[0]->OrderNo)){ echo $of_id[0]->OrderNo; } ?></p>
                              <h1>Thank You!</h1>
                            </div>
                            <p>Your order was completed successfully.</p>
                        </div>
                    </center>       
                                         </div>
                                   </div>
                                 </div>
                            </div>
                           </section>                                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</section>

    <script>
    var response='Your payment was successful, thank you for purchase.';
    var status='1';
    var result=JSON.parse(PaymentResponse.success(response, status));
    </script>