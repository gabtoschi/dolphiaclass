<div id="fundomenu">
<div id="comecomenu">
    <?php echo anchor('home', img(array('src' => base_url('images/menu_header.png'), 'id' => 'escrito'))); ?>
    <div id="bv">Bem-vindo</div>
    <div id="nome"><p><?php echo $this->session->userdata('name'); ?></p></div>
    <ul>
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
            echo '<li>'.anchor('post/listall', 'VISUALIZAR', array('class' => 'menu')).'</li><br><br>';
        }
        
        if ($teacherarea == true){
            echo '<li>'.anchor('post/create', 'ENVIAR', array('class' => 'menu')).'</li><br><br>';
            echo '<li>'.anchor('post/listmy', 'GERENCIAR', array('class' => 'menu')).'</li><br><br>';            
        }
        
        ?>
    </ul>
    <?php echo anchor('home/logoff', 'SAIR', array('id' => 'sair')); ?>
</div>
    
</div>