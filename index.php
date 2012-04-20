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
			$form_data .= "<p>You need picup.</p>";
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
		$form_data .= '<input type="file" name="photo" id="photo" />
					</form>';
		} else {
			$form_data .= "iPhone only, sorry honcho.";
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