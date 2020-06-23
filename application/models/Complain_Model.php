<?php
class Complain_Model extends CI_Model
{
    public function AddComplain($array)
    {
        $q = $this->db->insert('Complains', $array);
        return $q;
    }
    public function GetAllComplains()
    {
        $q = $this->db->get('Complains');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    public function GetUserComplains($email)
    {
        $this->db->where('Email', $email);
        $q = $this->db->get('Complains');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    public function ComplainInfo($id)
    {
        $this->db->where('ComplainID', $id);
        $q = $this->db->get('Complains');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    public function UpdateComplain($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('ComplainID', $id);
        $this->db->update('Complains', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
