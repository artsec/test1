<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>Счет-фактура</title>
	<base href="https://109.120.140.46/sf/" />
	<link rel="stylesheet" type="text/css" media="all" href="css/screen.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/datepicker.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/tipsy.css">
	<link rel="stylesheet" type="text/css" media="all" href="js/fancybox/jquery.fancybox-1.3.0.css">
	<link rel="stylesheet" type="text/css" media="all" href="js/visualize/visualize.css">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" media="all" href="css/ie.css" >
	<script type="text/javascript" src="js/excanvas.js"></script>
	<![endif]-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery.img.preload.js"></script>
	<script type="text/javascript" src="js/hint.js"></script>
	<script type="text/javascript" src="js/visualize/jquery.visualize.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script>
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="js/custom_blue.js"></script>

	<script src="js/js11/jquery-ui.js" type="text/javascript"></script>
	
<style>
   .layer1 {
    position: relative; /* Относительное позиционирование */
    background: #f0f0f0; /* Цвет фона */
    height: 200px; /* Высота блока */
   }
   .layer2 {
    position: absolute; /* Абсолютное позиционирование */
    bottom: 15px; /* Положение от нижнего края */
    right: 15px; /* Положение от правого края */
    line-height: 1px;
   }
  </style>
	</head>
<body>
	<div class="content_wrapper">
		<?php include Kohana::find_file('views', 'top'); ?>
		<?php //include Kohana::find_file('views', 'sidebar'); ?>
		<div id="content">
			<div class="inner">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</body>
</html>
