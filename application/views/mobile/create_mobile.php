<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Postar conteúdo | Dolphia Class</title>
        <meta name="description" content="">
        <meta name="author" content="Dolphia">

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <?php $this->load->view('icons'); ?>
        <link rel="stylesheet" href=<?php echo base_url('styles/mobile.css'); ?>>
    </head>

    <body>
        <em align="center">
        <?php
        echo validation_errors('<p>', '</p>');
        if ($uploaderror != null) {echo $uploaderror;}
        if ($this->session->flashdata('uploadfail')) {
            echo '<p>'.$this->session->flashdata('uploadfail').'</p>';
        }
        if ($this->session->flashdata('uploadsuccess')) {
            echo '<p>'.$this->session->flashdata('uploadsuccess').'</p>';
        }
        echo '</em><em align="left">';
        
        echo anchor('home', '<< Voltar', array('class' => 'voltar'));
        echo '</em><em align="center">';
        
        echo form_open_multipart('post/create');
        echo '<p>';
        echo form_label('Turma/aula ');
        echo form_dropdown('classes_id', $classes);
        echo '</p> <p>';
        echo form_label('Título do conteúdo ');
        echo form_input(array('name' => 'title'));
        echo '</p> <p>';
        echo form_textarea(array('name' => 'text'), 'Texto');
        echo '</p> <p>';
        echo form_label('Imagem ');
        echo form_upload(array('name' => 'image'));
        echo '</p> <p>';
        echo form_label('PDF/Word ');
        echo form_upload(array('name' => 'file'));
        echo '</p>';
        echo form_submit(array('name' => 'submit', 'class' => 'botao', 'value' => 'Enviar conteúdo'));
        echo form_hidden('date', mdate('%Y-%m-%d %H:%i:%s'));
        echo form_hidden('users_id', $this->session->userdata('id'));
        echo form_close();
        ?>
    </body>
</html>
