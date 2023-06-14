<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

		<title>ScoCare, Inc. - Making Technology Work for you!</title>

		<meta name="description" content="ScoCare, Inc. - Making Technology Work for you!"/>
		<meta name="keywords" content="ScoCare, Inc. - Making Technology Work for you!" />
		<meta name="author" content="ScoCare, Inc. - Making Technology Work for you!" />

		<link rel="icon" href="<?php echo base_url();?>assets/images/icons/favicon.png" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/msg.css" />
	</head>

	<body>
<?php
	if(isset($msg) && !empty($msg)){
		list($msg_type,$msg_nbr) = explode("_",$msg);
		$message_type = $msg_type;
		$message = $this->roles->api_getTheMsgsInfo($msg);

		if($message == null){
			$message = "An Error occured.<br />Please contact the Web Administrator.";
		}
	}else{
		$message = "You do not have access to the following page.<br />Please contact the Web Administrator.";
	}

	switch ($message_type){
		default:
		case "err":
			$message_cat = "error";
			break;
		case "war":
			$message_cat = "warning";
			break;
		case "suc":
			$message_cat = "success";
			break;
		case "inf":
			$message_cat = "information";
			break;
	}
?>
		<div id="websiteContainer">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" class="main-table-class">
				<tr>
					<td align="center" valign="middle" class="main-table-container">
						<div id="wrapper" align="center">
							<div id="messageContainer">
								<div id="messageHeader">
									<span><?php echo ucfirst($message_cat); ?></span>
								</div>
								<div id="messageContent">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" class="main-table-class2">
										<tr>
											<td width="120" valign="middle" align="center"><img src="<?php echo base_url(); ?>assets/images/<?php echo $message_cat; ?>.png" alt="<?php echo $message_cat; ?>" /></td>
											<td width="304" valign="middle" align="left"><?php echo $message; ?></td>
										</tr>
									</table>
								</div>
								<div id="messageFooter">
									<a href="https://login.sconet.net/users/login.php?"><img src="<?php echo base_url(); ?>assets/images/back-btn.png" alt="back" width="97" height="29" /></a>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>

<?php $this->roles->api_dbDisconnect(); exit; ?>
