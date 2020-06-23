<?php
class Order_Model extends CI_Model
{

    public function AddOrder($orderdata, $itemdata)
    {
        $this->db->trans_start();
        $this->db->insert('Orders', $orderdata);
        $id = $this->db->insert_id();
        $items = array();
        foreach ($itemdata as $item) {
            array_push($items, array(
                'OrderID' => $id,
                'ProductID' => $item['ProductID'],
                'Quantity' => $item['Qty'],
                'Price' => $item['Price']
            ));
        }
        $this->db->insert_batch('OrderDetail', $items);
        $this->db->trans_complete();
        return $id;
    }
    public function UpdateOrder($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('OrderID', $id);
        $this->db->update('Orders', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    public function GetUserOrders($id)
    {
        $this->db->where('UserID', $id);
        $q = $this->db->get('Orders');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    public function GetAllOrders()
    {
        $this->db->select('OrderID,FullName,Orders.Email,TotalPrice,Orders.Status,Orders.DateCreated');
        $this->db->order_by("DateCreated", "desc");
        $this->db->join('User', 'User.UserID=Orders.UserID', 'inner');
        $q = $this->db->get('Orders');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
    public function GetAllBundles()
    {

        $this->db->select('Bundles.BundleID,BundleName,Product.ProductID,ProductName,Bundledetails.Price,BundleDetails.Quantity,Discount,Total,bundles.Description,Status');
        $this->db->from('BundleDetails');
        $this->db->join('Bundles', 'Bundles.BundleID=BundleDetails.BundleID', 'inner');
        $this->db->join('Product', 'Product.ProductID=BundleDetails.ProductID', 'inner');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q;
        }
    }

    public function OrderInfo($id)
    {
        $this->db->select('OrderID,FullName,Orders.Email,Orders.Address,Description,SubTotal,Discount,TotalPrice,Orders.Status,Orders.DateCreated');
        $this->db->where('OrderID', $id);
        $this->db->from('Orders');
        $this->db->join('User', 'User.UserID=Orders.UserID', 'inner');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $result = $q->row_array() + array('Items' => $this->Order_Model->GetOrderItems($id));
            return $result;
        }
    }

    public function GetOrderItems($id)
    {
        $this->db->select('Product.ProductID,ProductName,OrderDetail.Quantity,OrderDetail.Price');
        $this->db->where('OrderID', $id);

        $this->db->from('OrderDetail');
        $this->db->join('Product', 'Product.ProductID=OrderDetail.ProductID', 'inner');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }
}
