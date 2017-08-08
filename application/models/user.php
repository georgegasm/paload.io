<?php
Class User extends CI_Model
{
    function login($username, $password)
    {
        $this -> db -> select('id, username');
        $this -> db -> from('users');
        $this -> db -> where('username', $username);
        $this -> db -> where('password', MD5($password));
        $this -> db -> limit(1);
        
        $query = $this -> db -> get();
        
        if($query -> num_rows() == 1)
        {
            $result = $query->row();
            $user = array(
                    "id"       => $result->id,
                    "username" => $result->username
                );
            $this->session->set_userdata('user', $user);
            return true;
        }
        else
        {
            return false;
        }
    }
}