<?php
class Bundle_Model extends CI_Model
{

    public function GetBundles()
    {
        // $query = $this->db->get('bundles');  
        // return $query->result_array();
        $this->db->select('bundles.BundleID,BundleName,product.ProductID,ProductName,bundledetails.Price,bundledetails.Quantity,Discount,Total,bundles.Description');
        $this->db->from('bundledetails');
        $this->db->join('bundles', 'bundledetails.BundleID = bundles.BundleID');
        $this->db->join('product', 'bundledetails.ProductID = product.ProductID');
        $this->db->where('bundles.Status', 'Active');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    public function BuyBundle($arr)
    {
      $q= $this->db->insert('bundleorderdetails', $arr);
      if($q){
          return $q;
      }  
      // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')     
    }
    public function GetAllBundles()
    {
        // $this->db->select('Bundles.BundleID,BundleName,Product.ProductID,ProductName,Bundledetails.Price,BundleDetails.Quantity,Discount,Total,bundles.Description,bundles.Status');
        // $this->db->from('Bundles');
        // $this->db->join('BundleDetails', 'Bundles.BundleID=BundleDetails.BundleID', 'inner');
        // $this->db->join('Product', 'Product.ProductID=BundleDetails.ProductID', 'inner');
        $q = $this->db->get('Bundles');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    public function GetAvailableBundles(){
        $this->db->where('Status','Active');
        $q = $this->db->get('Bundles');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    public function GetBundleItems($id){
        $this->db->select('Product.ProductID,ProductName,BundleDetails.Price,BundleDetails.Quantity');
        $this->db->where('BundleID',$id);
        $this->db->from('BundleDetails');
        $this->db->join('Product','Product.ProductID=BundleDetails.ProductID','inner');
        $q=$this->db->get();
        if($q){
            return $q->result_array();
        }
    }
    public function GetBundleInfo($id){
        $this->db->where('BundleID',$id);
        $q = $this->db->get('Bundles');
        if ($q->num_rows() > 0) {
            return $q->row_array();
        }
    }
    public function GetUserBundles($id){
            $this->db->select('Bundles.BundleID,BundleOrderDetailsID,UserID,BundleName,Description,Total');
            $this->db->where('UserID',$id);
            $this->db->from('BundleOrderDetails');
            $this->db->join('Bundles','Bundles.BundleID=BundleOrderDetails.BundleID','inner');
            $q=$this->db->get();
            if($q->num_rows()>0){
                return $q->result_array();
            }
    }
}
