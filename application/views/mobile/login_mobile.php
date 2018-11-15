<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Dolphia Class | Login</title>
        <meta name="description" content="">
        <meta name="author" content="Dolphia">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

        <?php $this->load->view('icons'); ?>
		<link rel="stylesheet" href=<?php echo base_url('styles/login.css'); ?>>
	</head>

	<body>
		<?php $this->session->unset_userdata(array('id' => '', 'name' => '', 'privilege' => '', 'logged' => '', 'isMobile' => '')); ?>
        <div align="center"><?php echo img(array('src' => base_url('images/login_headermobile.png'))); ?></div>
        <div align="center">
        <?php
        echo form_open('login');
        echo '<p>';
        echo form_label('Login ');
        echo form_input(array('name' => 'login'), set_value('login'), 'autofocus');
        echo '</p> <p>';
        echo form_label('Senha ');
        echo form_password(array('name' => 'password'));
        echo '</p>';
        echo form_submit(array('name' => 'enter', 'id' => 'entrar2'), 'ENTRAR');
        echo '<br><br>';
        echo form_hidden('isMobile', '1');
        echo form_close();
        ?>
        </div>
        <?php
        
        echo anchor('login/swapMobile/2', '<p align="center">Entrar na versão convencional</p>');
        
        echo validation_errors('<p class="centralizado">', '</p>');
        if ($this->session->flashdata('loginfail')) {
            echo '<p class="centralizado">'.$this->session->flashdata('loginfail').'</p>';
        }
        ?>
	</body>
</html>
