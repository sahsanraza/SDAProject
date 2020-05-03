<?php

class Product_Model extends CI_Model
{

    public function AddProduct($name, $price)
    {
        $array = array(
            'ProductName'   =>  $name,
            'Price'  =>  $price
        );
        $q = $this->db->insert('Product', $array);
        return $q;
    }
    public function GetActiveProducts()
    {
        $this->db->where('Status','Active');
        $q = $this->db->get('Product');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }

    public function GetAllProducts()
    {
        $q = $this->db->get('Product');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    
    public function GetProduct($id){
        $this->db->where('ProductID',$id);
        $q = $this->db->get('Product');
        if ($q->num_rows() > 0) {
            return $q->row_array();
        }
    }

    public function UpdateProduct($id,$name,$price){
        $this->db->set('ProductName',$name);
        $this->db->set('Price',$price);
        $this->db->where('ProductID',$id);
        $que=$this->db->update('Product');
        return $que;
    }
    
    public function ProductExists($id){
        $this->db->where('ProductID',$id);
        $q=$this->db->get('Product');
        if($q->num_rows()>0){
            return true;
        }
    }
    
    public function DeleteProduct($id){
        $this->db->set('Status','Deleted');
        $this->db->where('ProductID',$id);
        $this->db->update('Product');
    }
        
    public function UnDeleteProduct($id){
        $this->db->set('Status','Active');
        $this->db->where('ProductID',$id);
        $this->db->update('Product');
    }

    public function GetProductPrice($id){
        $this->db->select('Price');
        $this->db->where('ProductID',$id);
        $q=$this->db->get('Product');
        if($q->num_rows()>0){
            return $q->row_array()['Price'];
        }
    }

    public function GetProductName($id){
        $this->db->select('ProductName');
        $this->db->where('ProductID',$id);
        $q=$this->db->get('Product');
        if($q->num_rows()>0){
            return $q->row_array()['ProductName'];
        }
    }
}
