<?php
class Order_Model extends CI_Model
{

    public function AddOrder($orderdata,$itemdata){
        $this->db->trans_start();
        $this->db->insert('Orders',$orderdata);
        $id=$this->db->insert_id();
        $items=array();
        foreach($itemdata as $item){
            array_push($items,array(
                'OrderID' => $id,
                'ProductID' => $item['ProductID'],
                'Quantity' => $item['Qty'],
                'Price' => $item['Price']
            ));
        }
        $this->db->insert_batch('OrderDetail',$items);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    public function GetUserOrders($id){
        $this->db->where('UserID',$id);
        $q=$this->db->get('Orders');
        if($q->num_rows()>0){
            return $q->result_array();
        }
    }

}

?>
