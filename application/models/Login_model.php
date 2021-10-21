<?php
class Login_model extends CI_Model
{
    public function login($email, $password){
        $this->db->where('user_role', 1);
        $this->db->where('user_status', 1);
        $this->db->where('email', trim($email));
        $this->db->where('password', md5($password));
        $qry = $this->db->get('users');
        return $qry->row();
    }

}