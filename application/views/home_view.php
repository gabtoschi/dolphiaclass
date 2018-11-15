<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Dolphia Class</title>
		<meta name="description" content="">
		<meta name="author" content="Dolphia">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

        <?php $this->load->view('icons'); ?>
        <link rel="stylesheet" href=<?php echo base_url('styles/menu.css'); ?>>
	</head>

	<body>
	<?php $this->load->view('menu_view', array('pvpub' => $pvpub, 'pvpuball' => $pvpuball)); ?>
	<div id="content">
	    <div style="height: 99%;" align="center"><?php echo img(array('src' => base_url('images/logo.png'), 'id' => 'logo')); ?></div>
	</div>

	</body>
</html>
