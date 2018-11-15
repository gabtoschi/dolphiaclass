<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privileges_model extends CI_Model {
    public function getPublish($id = null){
        if ($id != null){
            $this->db->where('id', $id);
            $this->db->select('publish');
            $this->db->limit(1);
            
            $query = $this->db->get('privileges')->result();
            foreach ($query as $q){
                return $q->publish;
            }
        }
    }
    
    public function getPublishAll($id = null){
        if ($id != null){
            $this->db->where('id', $id);
            $this->db->select('publishall');
            $this->db->limit(1);
            
            $query = $this->db->get('privileges')->result();
            foreach ($query as $q){
                return $q->publishall;
            }
        }
    }
    
    public function getManage($id = null){
        if ($id != null){
            $this->db->where('id', $id);
            $this->db->select('manage');
            $this->db->limit(1);
            
            $query = $this->db->get('privileges')->result();
            foreach ($query as $q){
                return $q->manage;
            }
        }
    }
    
    
}
