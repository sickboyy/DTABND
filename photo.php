<?php
	require_once('config.php');
	
	// Corrupt some shit
	$upfile_name = $_REQUEST['photo'];
	$upfile_size = filesize($upfile_name);
	$upfile_type = pathinfo($upfile_name, PATHINFO_EXTENSION);
	$upfile      = $_REQUEST['picID'];
	$upfile_uniq = uniqid($upfile);
	
	// this value tells this code how many (succesful) corrupted files should be generated
	// with a maximum of set retries
	$nCorrupts = 3;
	$nRetries = 1000;
	//if($upfile_size > (500 * 1024)) die("File is too big");

	function jpegIsValid($filename) {
		// load the file
		$img = @imageCreateFromJPEG($filename);
		
		// return 0 if the image is invalid
		if(!$img) return(0);

		// return 1 otherwise
		return(1);
	}

	function scramble($content, $size) {
		$sStart = 10;
		$sEnd = $size-1;
		$nReplacements = rand(20, 30); // between 1999 and 3999

		for($i = 0; $i < $nReplacements; $i++) {
			$PosA = rand($sStart, $sEnd);
			$PosB = rand($sStart, $sEnd);

			$tmp = $content[$PosA];
			$content[$PosA] = $content[$PosB];
			$content[$PosB] = $tmp;
		}

		return($content);
	}

	// first check if 'upfile' is set
	if(empty($upfile) or empty($upfile_name)) {
		die("No file to corrupt, please go back and select a JPG image to upload.");
	}

	// then check if it is a JPEG file
	if($upfile_type != "jpg") {
		die("The image does not seem to be JPG but of type '$upfile_type', please go back and select a JPG image to upload.");
	}

	// load the file and get its size
	$content = file_get_contents($upfile_name);
	$size = $upfile_size;
	
	// now store the original one
	// I don't think this is needed.
	/*$fd = fopen("images/$upfile_name", "w") or die("The first fopen went wrong, e-mail webmaster Ben.");
	fwrite($fd, $content, $size) or die("The first fwrite went wrong, e-mail webmaster Ben.");
	fclose($fd);*/
	
	// check the copied image
	// Or this.
	/*if(!imageCreateFromJPEG("images/$upfile_name")) {
		die("This JPEG is not valid, please go back and try another one.");
	}*/

	// create a folder to store the corrupted versions
	@mkdir("uploads/$upfile_uniq-corrupted");
	
	// corrupt it a few times
	for($c = 0, $r = 0; $c < $nCorrupts && $r < $nRetries; $r++) {
		// corrupt the file
		$corrupted = scramble($content, $size);
		
		// save it to disc
		$fd = fopen("uploads/$upfile_uniq-corrupted/$c.jpg", "w") or die("The fopen went wrong, e-mail webmaster Ben.");
		fwrite($fd, $corrupted, $size) or die("The fwrite went wrong, e-mail webmaster Ben.");
		fclose($fd);

		// count succeeded corrupts
		if(jpegIsValid("uploads/$upfile_uniq-corrupted/$c.jpg")) $c++;
	}
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
	<link rel="shortcut icon" href="<?=$baseurl?>favicon.ico" type="image/x-icon" />
</head>

<body>

	<div id="content">
		<div id="header">
			<img src="logo.png" alt="DTABND" />
		</div>
		
		<div id="spin">
			<button onclick="window.self.close()">RE-BEND</button>
		</div>
		
		<div id="upload">
			<img src='uploads/<?php echo $upfile_uniq . "-corrupted/0.jpg"; ?>' alt="Corrupty goodness" />
		</div>
	</div>

</body>
</html>