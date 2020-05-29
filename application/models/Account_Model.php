<?php

class Account_Model extends CI_Model
{

    public function Signin($email, $pass)
    {
        $data = array(
            'Email' => $email,
            'Password' => md5($pass),
            'Status' => 'Active'
        );
        $this->db->where($data);
        $this->db->select('UserID,FullName,Email,Role');
        $que = $this->db->get('User');
        if ($que->num_rows() > 0) {
            return $que->row_array();
        }
    }
    public function GetUserDetails($email){
        $this->db->select('UserID,FullName,Email,Address');
        $this->db->where('Email',$email);
        $q=$this->db->get('User');
        if ($q->num_rows() > 0) {
            return $q->first_row('array');
        }
    }

    public function Signup($name, $email, $pass, $add, $phone)
    {

        $data = array(
            'FullName' => $name,
            'Password' => md5($pass),
            'Email' => $email,
            'Address' => $add,
            'Phone' => $phone
        );
        $res = $this->db->insert('User', $data);
        return $res;
    }

}
?>