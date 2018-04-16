<?php
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

		<link rel="stylesheet" type="text/css" href="hp_assets/css/fontawesome-all.min.css" />
		<link rel="stylesheet" type="text/css" href="hp_assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="hp_assets/css/main.css" />
		
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
	</head>

	<body id="homepage">
		<div id="bg-overlay">&nbsp;</div>
		<!-- Line below is to preload the font when the page loads -->
		<span class="fa fa-asterisk" style="opacity: 0;">&nbsp;</span>

		<div id="links-wrap" class="menu-item bg">
			<?php
				echo '<center><p>';
				foreach ($config['items'] as $i => $item) {
					$icon = $item['icon'];
					$link = str_replace("{{cur}}", get_current_url(), $item['link']);

					echo '<a href="' . $link . '" title="' . $item['alt'] . '"><i class="fa ' . $icon . ' fa-fw"></i></a>';
				}
				echo '</p></center>';
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
		<script type="text/javascript" src="hp_assets/js/main.js"></script>
		
		<script src="hp_assets/js/trianglify.min.js"></script>
		<script>
			function addTriangleTo(target) {
				var dimensions = target.getClientRects()[0];
				var pattern = Trianglify({
					<?php
						if ($config['unsplash_client_id'] != "") {
							echo 'x_colors: \'Greys\',';
							echo 'y_colors: \'match_x\',';
						}
					?>
					width: dimensions.width,
					height: dimensions.height
				});
				target.style['background-image'] = 'url(' + pattern.png() + ')';
				target.style['background-size'] = 'cover';
				target.style['-webkit-background-size'] = 'cover';
				target.style['-moz-background-size'] = 'cover';
				target.style['-o-background-size'] = 'cover';
			}
			
			var resizeTimer;
			
			$(window).on('resize', function(e) {
			  clearTimeout(resizeTimer);
			  resizeTimer = setTimeout(function() {
				<?php
					if ($config['unsplash_client_id'] == "") {
						echo 'addTriangleTo(homepage)';
					}
				?>
			  }, 400);
			});
			
			addTriangleTo(homepage);
		</script>
	</body>
</html>
