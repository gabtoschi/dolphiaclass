<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('privileges_model', 'privileges');
    }
    
    public function index(){    
    if ($this->session->userdata('logged') == 1):
        
        $viewdata = array(
            'Suseragent' => $this->session->userdata('user_agent'),
            'Slastact' => $this->session->userdata('last_activity'),
            'Sid' => $this->session->userdata('id'),
            'Sname' => $this->session->userdata('name'),
            'Sprivilege' => $this->session->userdata('privilege'),
            'Slogged' => $this->session->userdata('logged'),
            'pvpub' => $this->privileges->getPublish($this->session->userdata('privilege')),
            'pvpuball' => $this->privileges->getPublishAll($this->session->userdata('privilege')),          
        );
        
        if ($this->session->userdata('isMobile') == '1'){
            $this->load->view('mobile/home_mobile', $viewdata);
        } else {
            $this->load->view('home_view', $viewdata);
        }
        
    
    else:
        $this->session->set_flashdata('loginfail', 'Você não tem permissão para acessar.');
        redirect('login');
    endif;
    }
    
    public function logoff(){
        $this->session->unset_userdata(array('id' => '', 'name' => '', 'privilege' => '', 'logged' => ''));
        redirect('login');
    }
}