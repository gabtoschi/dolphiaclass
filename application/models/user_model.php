<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function get_login($login=null){
        if ($login != null){
            return $this->db->where('login',$login)->select('login', 'password', 'name', 'id', 'privileges_id', 'grades_id')->limit(1)->get('users')->result();
        }
    }
    
    public function verifyLogin($formdata = null){
        if ($formdata != null){
            $this->db->where('login', $formdata['login']);
            $this->db->select('id, name, login, password, privileges_id, grades_id');
            $this->db->limit(1);
            $dbquery = $this->db->get('users')->result();
            
            foreach ($dbquery as $dbdata){
            
            if ($formdata['password'] == $dbdata->password) {
                    
                // login feito com sucesso
                $this->session->set_userdata(array(
                    'name' => $dbdata->name,
                    'id' => $dbdata->id,
                    'privilege' => $dbdata->privileges_id,
                    'logged' => true,
                    'isMobile' => $formdata['isMobile']
                ));
                
                if ($dbdata->grades_id != null){
                    $this->session->set_userdata('grade', $dbdata->grades_id);
                }
                
                redirect('home');
            } else {
                
                // login falho
                $this->session->set_flashdata('loginfail', 'Login e/ou senha incorretos.');
                redirect('login');
            }
            }
        }
    }

    public function getGrade($user = null){
        if ($user != null){
            $this->db->where('id', $user);
            $this->db->limit(1);
            $this->db->select('grades_id');
            $query = $this->db->get('users')->result();
            
            foreach ($query as $q){
                return $q->grades_id;
            }
        }
    }
    
    public function getName($user = null){
        if ($user != null){
            $this->db->where('id', $user);
            $this->db->limit(1);
            $this->db->select('name');
            $query = $this->db->get('users')->result();
            
            foreach ($query as $q){
                return $q->name;
            }
        }
    }
    
}
