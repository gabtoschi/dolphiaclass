<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model', 'user');
    }
    
    public function index(){            
        $this->form_validation->set_message('required', 'O campo %s é obrigatório.');
        $this->form_validation->set_message('alpha_dash', 'O campo %s tem caracteres inválidos.');
        $this->form_validation->set_rules('login', 'Login', 'required|alpha_dash');
        $this->form_validation->set_rules('password', 'Senha', 'required|alpha_dash');
        
        
            if ($this->form_validation->run() == true){
                if (! $this->form_validation->is_unique($this->input->post('login'), 'users.login')){
                    $data = elements(array('login', 'password', 'isMobile'), $this->input->post());
                    $this->user->verifyLogin($data);
                } else {
                    $this->session->set_flashdata('loginfail', 'Login e/ou senha incorretos.');
                    redirect('login');
                }
            }
        
        $mobile = null;
        $mobileswap = null;
        if ($this->session->flashdata('mobileswap') != null) {$mobileswap = $this->session->flashdata('mobileswap');}
        
        if ($mobileswap == null){
            if ($this->agent->is_mobile('ipad')){
                // se for um iPad
                $mobile = false;
            } elseif ($this->agent->is_mobile()) {
                // se for outro mobile
                $mobile = true;
            } else {
                // se for computador
                $mobile = false;
            }
        } else {
            if ($mobileswap == 1) {$mobile = true;}
            if ($mobileswap == 2) {$mobile = false;}
        }
        
        if ($mobile){ $this->load->view('mobile/login_mobile'); } else {$this->load->view('login_view'); }
          
    }

    public function swapMobile($isMobile = null){
        $isMobile = $this->uri->segment(3);    
        if ($isMobile != null){
            if ($isMobile == 1){
                $this->session->set_flashdata('mobileswap', 1);
            } elseif ($isMobile == 2) {
                $this->session->set_flashdata('mobileswap', 2);
            }
            redirect('login');
        }
    }
    
}
