<?php //pr($error_logs);die();
foreach ($error_logs as $error_log) { ?>
	<tr id="row_<?php echo $error_log->ErrorLogID; ?>">                                      
		
		<td><?php echo $error_log->MethodName; ?></td>  
		<td><?php echo $error_log->ErrorMessage; ?></td>
		<td><?php echo ($error_log->ErrorDate != "")?GetDateTimeInFormat($error_log->ErrorDate):""; ?></td>

	</tr>
<?php }
?>