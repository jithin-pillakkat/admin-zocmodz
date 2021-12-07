<?php
class Admin_model extends CI_Model
{
    public function login($email, $password){
        $this->db->where('user_role', 1);
        $this->db->where('user_status', 1);
        $this->db->where('email', trim($email));
        $this->db->where('password', md5($password));
        $qry = $this->db->get('users');
        return $qry->row();
    }

    public function update_profile($data){
        $this->db->where('id', 1);
        $this->db->update('users', $data);
        if($this->db->affected_rows() > 0){
            $this->db->where('id', 1);
            $qry = $this->db->get('users');
            return $qry->row();
        }
        return false;
    }

    public function update_socialmedia($data, $id){
        $this->db->where('id', $id);
        $this->db->update('socialmedia', $data);        
        if($this->db->affected_rows() > 0){           
            return true;
        }
        return false;
    }

    public function get_socialmedia($id){
        $this->db->where('id', $id);
        $qry = $this->db->get('socialmedia');
        return $qry->row('link');
    }

}