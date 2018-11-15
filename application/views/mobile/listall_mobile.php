<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Visualizar conteúdos | Dolphia Class</title>
        <meta name="description" content="">
        <meta name="author" content="Dolphia">

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <?php $this->load->view('icons'); ?>
        <?php $this->load->model('classgrade', 'classgrade'); ?>
        <link rel="stylesheet" href=<?php echo base_url('styles/mobile.css'); ?>>
    </head>

    <body>
       <em align="left">
        <?php
        echo anchor('home', '<< Voltar', array('class' => 'voltar'));
        echo '</em><em align="center">';
        echo '<h2 id="titulo">Conteúdos disponíveis</h2>';
        echo '<div align=center>';
        $this->table->set_heading('Disciplina', 'Assunto', 'Data');
        foreach ($posts as $post){
            $this->table->add_row($this->classgrade->getClassName($post->classes_id),
                anchor('post/view/'.$post->id, $post->title, array('class' => 'postoflist')), 
                mdate('%d-%m-%Y %H:%i:%s', gmt_to_local(mysql_to_unix($post->date), 'UM3'))
                );
        }
        
        echo $this->table->generate();
        ?>
        </div>
        </em>
    </body>
</html>
