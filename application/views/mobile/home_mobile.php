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
        <link rel="stylesheet" href=<?php echo base_url('styles/mobile.css'); ?>>
    </head>

    <body>
    <div id="divdomenu" align="center"><?php echo img(array('src' => base_url('images/logo_mobile.png'), 'id' => 'logo')); ?></div>   
    <div align="center" id="fundomenu">
    <?php echo anchor('home', img(array('src' => base_url('images/menu_headermobile.png'), 'id' => 'escrito'))); ?>
    <br><em id="bv">Bem-vindo</em><br><em id="nome"><?php echo $this->session->userdata('name'); ?></em><br><br>
        <?php 
        $studentarea = false;
        $teacherarea = false;
        
        if ($pvpub == 1){ 
        if ($pvpuball == 1){
                // direito de publicar tudo (coord/admin)
                $studentarea = true;
                $teacherarea = true;
            } else {
                // direito de publicar (professor)
                $teacherarea = true;
            }
        } else {
            // direito de visualizar (aluno)
            $studentarea = true;
        }
        
        if ($studentarea == true){
            echo anchor('post/listall', 'VISUALIZAR', array('class' => 'menu')).'<br>';
        }
        
        if ($teacherarea == true){
            echo anchor('post/create', 'ENVIAR', array('class' => 'menu')).'<br>';
            echo anchor('post/listmy', 'GERENCIAR', array('class' => 'menu')).'<br>';            
        }
        
        ?>
    <?php echo anchor('home/logoff', 'SAIR', array('id' => 'sair')); ?>
    </div>
    
    </div>

    </body>
</html>
