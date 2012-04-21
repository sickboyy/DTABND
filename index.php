<?php
	require_once('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<base href="<?=$baseurl?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>DTABND</title>
	<meta name="author" content="Chrish Dunne">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<link rel="stylesheet" type="text/css" href="screen.css">
	<script type="application/x-javascript">
		addEventListener('load', function() { 
			setTimeout(hideAddressBar, 0); 
		}, false);
		function hideAddressBar() { 
			window.scrollTo(0, 1); 
		}
	</script>
	
	<?php
		$form_data .= '<form action="'.$baseurl.'upload.php" method="post" id="photo-form" enctype="multipart/form-data">';
		if(ismobilesafari()) {
	?>
	
	<script type="text/javascript" language="JavaScript" src="<?=$baseurl?>js/prototype.js"></script>
	<script type="text/javascript" language="JavaScript" src="<?=$baseurl?>js/picup.js"></script>
	<script type="text/javascript">
		var currentParams = {}
		document.observe('dom:loaded', function() {
			$(document.body).addClassName('iphone');
			Picup.checkHash();
			currentParams = {
				'callbackURL' 		: '<?=$baseurl?>status.php',				
				'referrername' 		: escape('DTABND'),
				'referrerfavicon' 	: escape('<?=$baseurl?>favicon.ico'),
				'purpose'           : escape('Select your photo to be Databent.'),
				'debug' 			: 'false',
				'returnServerResponse' : 'true',
				'postURL'           : '<?=$baseurl?>upload.php'
			};
			
			Picup.convertFileInput($('photo'), currentParams);
		});
	</script>
	
	<?php
		$form_data .= '<div id="spin">
						<input type="file" name="photo" id="photo" />
					</form>';
					
		$form_data .= "<p>To use this web app you must first install <a href='http://www.picupapp.com/'>Picup App</a>.</p>";
		$form_data .= "This app was developed by <a href='http://www.sicksicksicks.co.uk/'>Chrish 'Sickboy' Dunne</a>. For more information, please visit <a href='info.pdf'>this page</a></p>";
		$form_data .= '<p>Using <strong><a href="http://www.recyclism.com/corrupt/corrupt.zip">Corrupt</a>&trade; - data corruption software 3.0</strong></p>';
		} else {
			$form_data .= "Please visit this page using Safari on your iPhone.";
		}
	?>
	
	<link rel="shortcut icon" href="<?=$baseurl?>favicon.ico" type="image/x-icon" />
</head>
<body>

	<div id="content">
		<div id="header">
			<img src="logo.png" alt="DTABND" />
		</div>
		
		<div id="upload">
			<?php echo $form_data; ?>
		</div>
	</div>

</body>
</html>