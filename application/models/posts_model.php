<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts_model extends CI_Model {

public function createPost($postdata = null){
    if ($postdata != null){
        $this->db->select_max('id');
        $this->db->limit(1);

        $query = $this->db->get('posts')->result();
        foreach ($query as $q){
            $postdata['id'] = $q->id+1;
        }
                
        $this->db->insert('posts', $postdata);
        $this->session->set_flashdata('uploadsuccess', 'Post enviado com sucesso.');
        redirect('post/create');
    }
}

public function listmyPosts(){
    if ($this->privileges->getPublishAll($this->session->userdata('privilege')) == 0){
    $this->db->where('users_id', $this->session->userdata('id'));
    }
    $this->db->select('id, title, date, classes_id');
    $this->db->order_by('date', 'desc');
    return $this->db->get('posts')->result();        
}

public function listallPosts($classes){
    $this->db->select('id, title, date, classes_id');
    $this->db->where_in('classes_id', $classes);
    $this->db->order_by('date', 'desc');
    return $this->db->get('posts')->result();
}

public function getSinglePost($idurl){
    $this->db->where('id', $idurl);
    $this->db->limit(1);
    $this->db->select('id, date, title, text, image, file, classes_id, users_id');
    $query = $this->db->get('posts')->result();
    
    foreach ($query as $q){
        if ($q->title != null){
            return $q;
        } else {
            $this->session->set_flashdata('viewfail', 'Esse post não existe.');
            redirect('post/listmy');
        }
    }   
    
}


}
    