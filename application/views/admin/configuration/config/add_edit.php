<?php 
/*function timezoneList()
{
    $timezoneIdentifiers = DateTimeZone::listIdentifiers();
    $utcTime = new DateTime('now', new DateTimeZone('UTC'));
 
    $tempTimezones = array();
    foreach ($timezoneIdentifiers as $timezoneIdentifier) {
        $currentTimezone = new DateTimeZone($timezoneIdentifier);
 
        $tempTimezones[] = array(
            'offset' => (int)$currentTimezone->getOffset($utcTime),
            'identifier' => $timezoneIdentifier
        );
    }
 
    // Sort the array by offset,identifier ascending
    usort($tempTimezones, function($a, $b) {
		return ($a['offset'] == $b['offset'])
			? strcmp($a['identifier'], $b['identifier'])
			: $a['offset'] - $b['offset'];
    });
 
	$timezoneList = array();
    foreach ($tempTimezones as $tz) {
		$sign = ($tz['offset'] > 0) ? '+' : '-';
		$offset = gmdate('H:i', abs($tz['offset']));
        $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
			$tz['identifier'];
    }
 
    return $timezoneList;
	echo 'here'.pr($timezoneList);exit;
}

$tzlist = DateTimeZone::listAbbreviations();
	pr($tzlist);exit;
	foreach( $tzlist as $key => $zones )
{
    foreach( $zones as $id => $zone )
    {
       if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'] ) 
            && $zone['timezone_id']) {
            $cities[$zone['timezone_id']][] = $key;
        }
    }
}*/
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/configuration/config"><strong><?php echo label('msg_lbl_title_config')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="configForm" method="post" type="submit" action="<?php echo $this->config->item('base_url'); ?>admin/configuration/config/<?php echo $page_name; ?>">
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_crashemail');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<input class="empty_validation_class" id="CrashEmail" name="CrashEmail" type="email" value="<?php echo @$config->CrashEmail; ?>" maxlength="50"  />
                            <label for="CrashEmail" class="active"><?php echo label('msg_lbl_crashemail')?></label>
                        </div>
                         <div class="input-field col s6">
							<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_supportemail');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<input class="empty_validation_class" id="SupportEmail" name="SupportEmail" type="email"  value="<?php echo @$config->SupportEmail; ?>" maxlength="50" />
                            <label for="SupportEmail" class="active"><?php echo label('msg_lbl_supportemail')?></label>
						 </div>
                    </div>
					<div class="row">
						<div class="input-field col s12 m6">
                            <label  class="active">Select TimeZone</label>        
                             <select id="TimeZone" name="TimeZone" class="select-dropdown" style="width:100%;">
								<option value='+00:00' 
                                    <?php 
                                    if(@$config->TimeZone == '+00:00'){
                                    echo 'selected';
                                    }?>
                                > +00:00 </option>
								<option value='+05:30' 
                                    <?php 
                                    if(@$config->TimeZone == '+05:30'){
                                    echo 'selected';}?>
                                > +05:30 </option>
								 
							</select>
                        </div>
						
						<div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_appversionandroid');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<input class="empty_validation_class AmountOnly" id="AppVersionAndroid" name="AppVersionAndroid" type="text" value="<?php echo @$config->AppVersionAndroid; ?>" maxlength="4"  />
                            <label for="AppVersionAndroid" class="active"><?php echo label('msg_lbl_appversionandroid')?></label>
                        </div>
					</div>
                    <div class="row">
						<div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_appversionios');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							 <input class="empty_validation_class AmountOnly" id="AppVersionIOS" name="AppVersionIOS" type="text" value="<?php echo @$config->AppVersionIOS; ?>" maxlength="4"  />
                            <label for="AppVersionIOS" class="active"><?php echo label('msg_lbl_appversionios')?></label>
                        </div>
                        
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_currencycode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                             <input class="empty_validation_class" id="CurrencyCode" name="CurrencyCode" type="text" value="<?php echo @$config->CurrencyCode; ?>" maxlength="4"  />
                            <label for="CurrencyCode" class="active"><?php echo label('msg_lbl_currencycode')?></label>
                        </div>
					</div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_coolingperiod');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                             <input class="empty_validation_class NumberOnly" id="CoolingPeriod" name="CoolingPeriod" type="text" value="<?php echo @$config->CoolingPeriod; ?>" maxlength="3"  />
                            <label for="CoolingPeriod" class="active"><?php echo label('msg_lbl_coolingperiod')?></label>
                        </div>

                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cvprice');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                             <input class="empty_validation_class AmountOnly" id="CVPrice" name="CVPrice" type="text" value="<?php echo @$config->CVPrice; ?>" maxlength=""  />
                            <label for="CVPrice"><?php echo label('msg_lbl_cvprice')?></label>
                        </div>
                        
                    </div>
                    <div class="row">
                       <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit

                            </button>
                            <?php echo $loading_button; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>