<?php
	/**
	* homepage
	*/

	session_start();

	$config = json_decode(file_get_contents("config.json"), true);

	function get_current_url() {
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['SERVER_NAME'];
    return $protocol . $domainName;
	}

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	    <title><?= $config['title']; ?></title>

	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <link rel="stylesheet" type="text/css" href="hp_assets/css/font-awesome.min.css" />
	    <link rel="stylesheet" type="text/css" href="hp_assets/css/bootstrap.min.css" />
	    <link rel="stylesheet" type="text/css" href="hp_assets/css/main.css" />
      <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
	</head>

	<body id="homepage">
		<div id="bg-overlay">&nbsp;</div>
		<!-- Line below is to preload the font when the page loads -->
		<span class="fa fa-asterisk" style="opacity: 0;">&nbsp;</span>

		<!-- <div id="mobile-menu-wrap" class="bg">
			<a href="#"><span class="fa fa-bars">&nbsp;</span></a>
		</div> -->

		<div id="links-wrap" class="menu-item bg">
			<?php
				echo '<center>';
				foreach ($config['items'] as $i => $item) {
					$icon = $item['icon'];
					$link = str_replace("{{cur}}", get_current_url(), $item['link']);

					echo '<a href="' . $link . '" title="' . $item['alt'] . '"><i class="fa ' . $icon . ' fa-fw"></i></a>';
				}
				echo '</center>';
			?>
		</div>

		<?php
			if ($config['credits'] == true) {
				echo '<div id="pic-info-wrap" class="menu-item hidden bg">';
				echo '	<span id="pic-info">Picture by <a href="#" id="pic-info-url"></a></span>';
				echo '</div>';
			}
		?>

		<script type="text/javascript" src="hp_assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="hp_assets/js/mousetrap.min.js"></script>
		<script type="text/javascript" src="hp_assets/js/main.js"></script>
		
		<script type="text/javascript">
			setMenuVisibility(true);
		</script>
	</body>
</html>
