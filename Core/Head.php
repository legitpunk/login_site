<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Login" content="<?= $meta_tag_domain_name; ?>"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
		<link href="<?php echo $_SESSION['http_site_dir']; ?>Default.css" rel="stylesheet">
		
		<link href = "https://fonts.googleapis.com/css?family=Roboto+Mono|Roboto+Slab|Roboto:300,400,500,700" rel = "stylesheet" />
		
		<script type="text/javascript" src="<?php echo $_SESSION['http_site_dir']; ?>Js/jquery-3.3.1.js"></script>
		
		<?php //$varname = json_decode($Settings_Css_Stylesheets_CssPage);foreach($varname as $varnames){echo '<style>';include "Css/".$varnames."";echo '</style>';}?>

		<!--<script>var url_root = '<?php //echo $Host.$SDir; ?>';var ModalError = '';</script>-->
	</head>
	<body>