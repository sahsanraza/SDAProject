<?php
 class Complain_Model extends CI_Model
 {
     public function AddComplain($array){
         $q= $this->db->insert('Complains', $array);
         return $q;
     }
     public function GetAllComplains()
     {
         $q= $this->db->get('Complains');
         if ($q-> num_rows() > 0)
         {
            return $q->result_array();
         }
     }
     public function SetResponse($id, $response)
     {
         $this->db->where('ComplainID',$id);
         $this->db->set('Response', $response);
         $q= $this->db->update('Complains');
         return $q;
     }
     }
?>