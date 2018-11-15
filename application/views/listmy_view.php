<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Gerenciar conteúdos | Dolphia Class</title>
		<meta name="description" content="">
		<meta name="author" content="Dolphia">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

        <?php $this->load->view('icons'); ?>
		<?php $this->load->model('classgrade', 'classgrade'); ?>
		<link rel="stylesheet" href=<?php echo base_url('styles/menu.css'); ?>>
	</head>

	<body>
	<?php $this->load->view('menu_view', array('pvpub' => $pvpub, 'pvpuball' => $pvpuball)); ?>
    <div id="content">
    <?php
        echo anchor('home', '<< Voltar', array('class' => 'voltar'));
        
        if ($this->session->flashdata('viewfail')) {
                echo '<p>'.$this->session->flashdata('viewfail').'</p>';
        }
        
        echo '<h2 id="titulo">Conteúdos postados</h2>';
        $this->table->set_heading('Assunto', 'Data', 'Turma', 'Disciplina');
        foreach ($posts as $post){
            $this->table->add_row(anchor('post/view/'.$post->id, $post->title, array('class' => 'postoflist')), 
                mdate('%d-%m-%Y %H:%i:%s', gmt_to_local(mysql_to_unix($post->date), 'UM3')),
                $this->classgrade->getGradeName($this->classgrade->getGrade($post->classes_id)),
                $this->classgrade->getClassName($post->classes_id));
        }
        
        echo $this->table->generate();
    ?>
    </div>
	</body>
</html>
