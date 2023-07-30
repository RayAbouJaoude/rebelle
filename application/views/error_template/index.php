<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

		<title>Rebelle</title>

		<meta name="description" content="Rebelle"/>
		<meta name="keywords" content="Rebelle" />
		<meta name="author" content="Rebelle" />

		<link rel="icon" href="<?php echo base_url();?>assets/images/icons/faviconOne.png" />
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
	
	</body>
</html>

<?php $this->roles->api_dbDisconnect(); exit; ?>
