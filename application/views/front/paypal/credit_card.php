  <!--  banner  -->
  <section class="banner-inner-page credit-card-bg">  
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="banner-text text-center color-white">
            <div class="inner-banner-text">
              <h3 class="font-36 font-w-bold"><?php if($type == "")echo "Credit Card";else echo "CcAvenue";?></h3>
              <span class="title-seperator"></span>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </section>
  <!--  /banner  -->
        <!-- added to cart section -->
        <section class="added-to">    
            <div class="container">
                <div class="row">   
                    <div class="empty-space-50"></div>
                    <div class="col-md-12">
                        <div class="row">  
                            <div class="">
                                <div class="stepwizard">
                                    <div class="rate-updates">         
                            <section class="added-to">    
                             <div class="container">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="row">      
                                        <?php 
                                        if($type == ""){
                                            $url = "front/appoinment/Credit_Card/".$order_id;
                                        }else{
                                            $url = "front/appoinment/CcavenueSubmit";
                                        }
                                        ?>
                <form method="post" <?php if($type == "") echo "id='paymentForm'"; else echo "id='ccform'";?> action="<?php echo base_url($url); ?>">
                <div class="col-md-6 col-md-offset-3">
                            <div class="credit-card-div">
                                <div class="panel panel-default m-0">
                                    <div class="panel-heading">

                                        <div class="row m-b-20">
                                            <div>
                                            <?php
                                            if(isset($_GET['msg'])){
                                                echo $_GET['msg'];
                                            }
                                            if(isset($Error) && $Error != ''){
                                                if(isset($Error['Errors'][0])){
                                                echo $Error['Errors'][0]['L_LONGMESSAGE']; 
                                              }
                                              } ?>
                                            </div>
                                        </div>
                                        <?php if($type != ""){?>
                                        <div id="CCavenue" class="row ">
                                            <div class="col-md-12 pad-adjust">
                                                 <span class="help-block text-muted small-font">Customer Name</span>
                                                <input onkeypress="return isLetterKey(event);" name="billing_cust_name" type="text" class="form-control" placeholder="Customer Name" value="<?php echo @$CustomerName;?>" required />
                                            </div>
                                            <div class="col-md-12 pad-adjust">
                                                <span class="help-block text-muted small-font">Customer Address</span>
                                                <input onkeypress="return isLetterKey(event);" name="billing_cust_address" type="text" class="form-control" placeholder="Customer Address" required/>
                                            </div>
                                            <div class="col-md-6 pad-adjust">
                                                <span class="help-block text-muted small-font">Zip Code</span>
                                                <input onkeypress="return isNumberKey(event);" name="billing_cust_zip" type="text" class="form-control" placeholder="Zip Code" required/>
                                            </div>
                                            <div class="col-md-6 pad-adjust">
                                                <span class="help-block text-muted small-font">City</span>
                                                <input onkeypress="return isLetterKey(event);" name="billing_cust_city" type="text" class="form-control" placeholder="City" required/>
                                            </div>
                                            <div class="col-md-6 pad-adjust">
                                                <span class="help-block text-muted small-font">State</span>
                                                <input onkeypress="return isLetterKey(event);" name="billing_cust_state" type="text" class="form-control" placeholder="State" required/>
                                            </div>
                                            <div class="col-md-6 pad-adjust">
                                                <span class="help-block text-muted small-font">Country</span>
                                                <input onkeypress="return isLetterKey(event);" name="billing_cust_country" type="text" class="form-control" placeholder="Country" required/>
                                            </div>
                                            <div class="col-md-6 pad-adjust hide">
                                                <span class="help-block text-muted small-font">Amount</span>
                                                <input onkeypress="return isLetterKey(event);" name="Amount" type="text" class="form-control" placeholder="Amount" value="<?=$price?>"/>
                                            </div>
                                            <div class="col-md-6 pad-adjust hide">
                                                <span class="help-block text-muted small-font">Order id</span>
                                                <input onkeypress="return isLetterKey(event);" name="order_id" type="text" class="form-control" placeholder="Order id" value="<?=$booking_id?>"/>
                                            </div>
                                            <div class="col-md-6 pad-adjust">
                                                <span class="help-block text-muted small-font">Email id</span>
                                                <input onkeypress="return isLetterKey(event);" name="billing_cust_email" type="text" class="form-control" placeholder="Email id" value="<?php echo @$EmailID;?>" required/>
                                            </div>
                                            <div class="col-md-6 pad-adjust">
                                                <span class="help-block text-muted small-font">Cellphone</span>
                                                <input onkeypress="return isNumberKey(event);" name="billing_cust_tel" type="text" class="form-control" placeholder="Cellphone" value="<?php echo @$MobileNo;?>" required/>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php } ?>
                                        <div class="row m-b-20">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <span class="help-block text-muted small-font">Credit Card Number</span>
                                                <input type="text" class="form-control" name="card_number" onkeypress="return isNumberKey(event);" maxlength="16" placeholder="0000000000000000" required/>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <span class="help-block text-muted small-font"> Expiry Month</span>
                                                <input type="text" class="form-control" name="expriy_month" onkeypress="return isNumberKey(event);" maxlength="2" placeholder="MM" required/>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <span class="help-block text-muted small-font">  Expiry Year</span>
                                                <input type="text" name="expiry_year" onkeypress="return isNumberKey(event);" maxlength="4" class="form-control" placeholder="YYYY" required/>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <span class="help-block text-muted small-font">CCV</span>
                                                <input type="password" maxlength="3" class="form-control" placeholder="CCV" name="cvv" onkeypress="return isNumberKey(event);" required/>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-12 pad-adjust">
                                                 <span class="help-block text-muted small-font">Name of card</span>
                                                <input onkeypress="return isLetterKey(event);" name="name_on_card" type="text" class="form-control" placeholder="Name On The Card" />
                                                <input name="order_id" type="hidden" class="form-control" value="<?php echo $order_id; ?>" />
                                            </div>
                                        </div>
                                        <br/> 
                                        <div class="row">       
                                            <div class="">
                                                <input type="submit" name="card_submit" id="Submit" class="btn btn-warning btn-block pull-right bg-color-pimk-hover" value="PAY NOW" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
            </form>
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

<div class="empty-space-50"></div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
    function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

</script>