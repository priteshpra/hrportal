<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/currency"><strong><?php echo label('msg_lbl_title_currency')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/currency/<?php echo $page_name; ?>">
				<input id="cuid" name="cuid" value="<?php echo @$currency->CurrencyID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_currencyname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CurrencyName" name="CurrencyName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$currency->CurrencyName; ?>"  maxlength="50" />
                            <label for="CurrencyName"><?php echo label('msg_lbl_currencyname')?></label>
                        </div>
                         <div class="input-field col s6">
							<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_currencyhtmlcode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CurrencyHtmlCode" name="CurrencyHtmlCode" type="text" class="empty_validation_class" value="<?php echo @$currency->CurrencyHtmlCode; ?>"  maxlength="20" />
                            <label for="CurrencyHtmlCode"><?php echo label('msg_lbl_currencyhtmlcode')?></label>
						 </div>
                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($currency->Status) && @$currency->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/currency" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>