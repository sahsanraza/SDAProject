<?php  
   class bundles extends CI_Model  
   {  
      function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();  
      }  

      public function GetBundles(){
       // $query = $this->db->get('bundles');  
       // return $query->result_array();
       $this->db->select('*');
       $this->db->from('bundledetails');
       $this->db->join('bundles','bundledetails.BundleID = bundles.BundleID');
       $this->db->join('product','bundlesdetails.ProductID = product.ProductID');
       $query=$this->db->get();
       return $query->result_array();
    
    
    
    
    }
      
   }  
?>