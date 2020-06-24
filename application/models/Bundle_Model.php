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

    public function buybundle($bundleid, $userid)
    {
        $data = array(
            'BundleID' => $bundleid,
            'UserID' => $userid
        );

        $this->db->insert('bundleorderdetails', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')     

    }
}
