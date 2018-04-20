<?php
	session_start();
	$config = json_decode(file_get_contents("config.json"), true);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?= $config['title']; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

		<link rel="stylesheet" type="text/css" href="common/css/fontawesome-all.min.css" />
		<link rel="stylesheet" type="text/css" href="common/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="common/css/main.css" />
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	</head>

	<body id="homepage">
		<span class="fa fa-asterisk" style="opacity: 0;"></span>
		<div id="wrapper" class="itemlist">
			<center><p>
			<?php
				foreach ($config['items'] as $i => $item) {
					echo '<a href="'.$item['link'].'" title="'.$item['alt'].'"><i class="'.$item['icon'].' fa-fw"></i></a>';
				}
			?>
			</p></center>
		</div>
		
		<script type="text/javascript" src="common/js/jquery.min.js"></script>
		<script src="common/js/trianglify.min.js"></script>
		<script>
			function addTriangleTo(target) {
				var dimensions = target.getClientRects()[0];
				var pattern = Trianglify({
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
					addTriangleTo(homepage);
				}, 400);
			});
			
			addTriangleTo(homepage);
		</script>
	</body>
</html>
