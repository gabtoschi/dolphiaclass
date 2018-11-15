<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php echo $title.' | Dolphia Class'; ?></title>
		<meta name="description" content="">
		<meta name="author" content="Dolphia">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

        <?php $this->load->view('icons'); ?>
		<link rel="stylesheet" href=<?php echo base_url('styles/menu.css'); ?>>
	</head>

	<body>
	<?php $this->load->view('menu_view', array('pvpub' => $pvpub, 'pvpuball' => $pvpuball)); ?>
    <div id="content">
    <?php
    if ($pvpuball == 1){
        echo anchor($_SERVER['HTTP_REFERER'], '<< Voltar', array('class' => 'voltar'));
    } else {
        if ($pvpub == 1){
            echo anchor('post/listmy', '<< Voltar', array('class' => 'voltar'));
        } else {
            echo anchor('post/listall', '<< Voltar', array('class' => 'voltar'));
        }
    }
    
    echo '<h1 id="titulo">'.$title.'</h1>';
    echo '<h4 id="datauser">'.$date.' | Postado por '.$user.'</h4>';
    if ($image != null){
        echo anchor($image, img(array('src' => $image, 'id' => 'imagemdoview')));
    }
    if ($file != null){
        echo anchor($file, '<p id="titulo">Download do arquivo</p>');
    }
    if ($text != null){
        echo '<p>'.$text.'</p><br>';
    }
    ?>
    </div>
	</body>
</html>
