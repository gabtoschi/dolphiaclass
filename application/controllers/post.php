<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('privileges_model', 'privileges');
        $this->load->model('classgrade', 'classgrade');
        $this->load->model('posts_model', 'posts');
        $this->load->model('user_model', 'user');
    }
    
    public function create(){
    
    $uploaderror = null;
    $imagedata = null;
    $filedata = null;
    
    $pvpub = $this->privileges->getPublish($this->session->userdata('privilege'));
    if ($this->session->userdata('logged') == 1 and $pvpub == 1):
        
    $this->form_validation->set_message('required', 'O campo %s é obrigatório.');
    $this->form_validation->set_rules('title', 'Título', 'required');
    
    if ($this->form_validation->run() == true){
        
        // UPLOAD DE IMAGEM
        $config['upload_path'] = 'uploads/images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
        $config['file_name'] = 'img'.now();
        $config['overwrite'] = false;
        $config['max_size'] = 51200;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['remove_spaces'] = true;
        $this->upload->initialize($config);
              
        if ($this->upload->do_upload('image')){
            $imagedata = $this->upload->data();
        } else {
            $uploaderror = array('uploaderror' => $this->upload->display_errors('<p>', '</p>'));
            $this->load->view('create_view', $uploaderror);
        }
                
        // UPLOAD DE ARQUIVO
        $config['upload_path'] = 'uploads/files/';
        $config['allowed_types'] = 'doc|docx|pdf|ppt|pptx';
        $config['file_name'] = 'file'.now();
        $config['overwrite'] = false;
        $config['max_size'] = 51200;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['remove_spaces'] = true;
        $this->upload->initialize($config);
              
        if ($this->upload->do_upload('file')){
            $filedata = $this->upload->data();;
        } else {
            $uploaderror = array('uploaderror' => $this->upload->display_errors('<p>', '</p>'));
            $this->load->view('create_view', $uploaderror);
        }
        
        $postdata = elements(array('classes_id', 'title', 'date', 'users_id'), $this->input->post());
        if ($this->input->post('text') != null){
            $postdata['text'] = nl2br($this->input->post('text'));
        }        
        if ($imagedata != null){ $postdata['image'] = base_url('uploads/images/'.$imagedata['file_name']); }
        if ($filedata != null) { $postdata['file']  = base_url('uploads/files/'.$filedata['file_name']);  }
        
        $this->posts->createPost($postdata);
        
    }
    
    $pvpuball = $this->privileges->getPublishAll($this->session->userdata('privilege'));
        
    if ($pvpuball == 1) {
        $arrayToCreate = $this->classgrade->getAllToCreate($this->session->userdata('id'));
    } else {
        $arrayToCreate = $this->classgrade->getToCreate($this->session->userdata('id'));
    }
       
    $viewdata = array(
        'classes' => $arrayToCreate,
        'uploaderror' => $uploaderror,
        'pvpub' => $this->privileges->getPublish($this->session->userdata('privilege')),
        'pvpuball' => $this->privileges->getPublishAll($this->session->userdata('privilege')), 
    );
    
    if ($this->session->userdata('isMobile') == '1'){
            $this->load->view('mobile/create_mobile', $viewdata);
        } else {
            $this->load->view('create_view', $viewdata);
        }        
        
    else:
      $this->session->set_flashdata('privilegefail', 'Você não tem permissão para acessar.');
      redirect('home');
    endif;
    }

    public function listmy(){
        $pvpub = $this->privileges->getPublish($this->session->userdata('privilege'));
        $pvpuball = $this->privileges->getPublishAll($this->session->userdata('privilege'));
        if ($this->session->userdata('logged') == 1 and $pvpub == 1):
            
        $posts = $this->posts->listmyPosts();
            
        if ($this->session->userdata('isMobile') == '1'){
            $this->load->view('mobile/listmy_mobile', array('posts' => $posts, 'pvpub' => $pvpub, 'pvpuball' => $pvpuball));
        } else {
            $this->load->view('listmy_view', array('posts' => $posts, 'pvpub' => $pvpub, 'pvpuball' => $pvpuball));
        } 
            
        else:
        $this->session->set_flashdata('privilegefail', 'Você não tem permissão para acessar.');
        redirect('home');
        endif;
    }
    
    public function view(){
        if ($this->session->userdata('logged') == 1):
        $canView = false;
        $pvpub = $this->privileges->getPublish($this->session->userdata('privilege'));
        $pvpuball = $this->privileges->getPublishAll($this->session->userdata('privilege'));
        
        $query = $this->posts->getSinglePost($this->uri->segment(3));
        
        $post = array(
            'id' => $query->id,
            'title' => $query->title,
            'date' => $query->date,
            'text' => $query->text,
            'image' => $query->image,
            'file' => $query->file,
            'class' => $query->classes_id,
            'user' => $query->users_id,
            'pvpub' => $pvpub,
            'pvpuball' => $pvpuball
        );
       
        $post['grade'] = $this->classgrade->getGrade($post['class']);

        if ($pvpub == 1){ 
            if ($pvpuball == 1){
                // direito de publicar tudo (coord/admin)
                $canView = true;
            } else {
                // direito de publicar (professor)
                if ($this->session->userdata('id') == $post['user']){
                    $canView = true;
                }
            }
        } else {
           // direito de visualizar (aluno)
           if ($this->user->getGrade($this->session->userdata('id')) == $post['grade']){
               $canView = true;
           }
        }
        
        if ($canView == true){
            $post['user'] = $this->user->getName($post['user']);
            $post['date'] = mdate('%d-%m-%Y %H:%i:%s', gmt_to_local(mysql_to_unix($post['date']), 'UM3'));
            
            if ($this->session->userdata('isMobile') == '1'){
                $this->load->view('mobile/view_mobile', $post);
            } else {
                $this->load->view('view_view', $post);
            }
            
        } else {
            $this->session->set_flashdata('privilegefail', 'Você não tem permissão para acessar.');
            redirect('home');
        }
    else:
      $this->session->set_flashdata('privilegefail', 'Você não tem permissão para acessar.');
      redirect('home');
    endif;
    }

    public function listall(){
    $pvpub = $this->privileges->getPublish($this->session->userdata('privilege'));
    $pvpuball = $this->privileges->getPublishAll($this->session->userdata('privilege'));
    if ($this->session->userdata('logged') == 1 and ($pvpub == 0 or $pvpuball == 1)):
        
    $grade = $this->user->getGrade($this->session->userdata('id'));
    $classes = $this->classgrade->classesOfGrade($grade);
    
    $posts = $this->posts->listallPosts($classes);
    
    if ($this->session->userdata('isMobile') == '1'){
            $this->load->view('mobile/listall_mobile', array('posts' => $posts, 'pvpub' => $pvpub, 'pvpuball' => $pvpuball));
        } else {
            $this->load->view('listall_view', array('posts' => $posts, 'pvpub' => $pvpub, 'pvpuball' => $pvpuball));
        }     
    
    else:
      $this->session->set_flashdata('privilegefail', 'Você não tem permissão para acessar.');
      redirect('home');
    endif;
    }
}