<?php //print_r($customer_activity_logs);die();
	foreach ($customer_activity_logs as $customer_activity_log) {
		?>


		<tr id="row_<?php echo $customer_activity_log->CustomerActivityID; ?>">                                      
		
			<td><?php echo $customer_activity_log->MethodName; ?></td>  
			<td><?php echo $customer_activity_log->ActivityDescription; ?></td>
			<td><?php echo ($customer_activity_log->CreatedDate != "")?GetDateTimeInFormat($customer_activity_log->CreatedDate):""; ?></td>
			
		</tr>
<?php }
?>  
