<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Classgrade extends CI_Model {
    
    public function getToCreate($iduser = null){
        if ($iduser != null){
            $arrayToCreate = array();
            
            $this->db->where('users_id', $iduser);
            $this->db->select('id, name, grades_id');
            $classquery = $this->db->get('classes')->result();
            
            foreach ($classquery as $class){
                $this->db->where('id', $class->grades_id);
                $this->db->select('name');
                $gradequery = $this->db->get('grades')->result();
                
                foreach ($gradequery as $grade){
                    $arrayToCreate[$class->id] = $grade->name.' | '.$class->name;
                }
            }
            
            return $arrayToCreate;
        }
    }
    
    public function getAllToCreate($iduser = null){
        if ($iduser != null){
            $arrayToCreate = array();
            
            $this->db->select('id, name, grades_id');
            $classquery = $this->db->get('classes')->result();
            
            foreach ($classquery as $class){
                $this->db->where('id', $class->grades_id);
                $this->db->select('name');
                $gradequery = $this->db->get('grades')->result();
                
                foreach ($gradequery as $grade){
                    $arrayToCreate[$class->id] = $grade->name.' | '.$class->name;
                }
            }
            
            return $arrayToCreate;
        }
    }
    
    public function getGrade($class = null){
        if ($class != null){
            $this->db->where('id', $class);
            $this->db->limit(1);
            $this->db->select('grades_id');
            $query = $this->db->get('classes')->result();
            
            foreach ($query as $q){
                return $q->grades_id;
            }
        }
    }
    
    public function getClassName($class = null){
        if ($class != null){
            $this->db->where('id', $class);
            $this->db->limit(1);
            $this->db->select('name');
            $query = $this->db->get('classes')->result();
            
            foreach ($query as $q){
                return $q->name;
            }
        }
    }
        
    public function getGradeName($grade = null){
        if ($grade != null){
            $this->db->where('id', $grade);
            $this->db->limit(1);
            $this->db->select('name');
            $query = $this->db->get('grades')->result();
            
            foreach ($query as $q){
                return $q->name;
            }
        }
    }
    
    public function classesOfGrade($grade = null){
        if ($grade != null){
            $classes = array();
            
            $this->db->where('grades_id', $grade);
            $this->db->select('id');
            $query = $this->db->get('classes')->result();
            
            foreach ($query as $q){
                $classes[] = $q->id;
            }
            
            return $classes;
        }
    }
    
   
    
}    