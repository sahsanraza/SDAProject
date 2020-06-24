<?php

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('Loggedin')) {
            redirect("Account/Signin");
        }
        if ($this->session->userdata('Role') != "Admin") {
            redirect("Error");
        }
        $this->load->model('Complain_Model');
        $this->load->model('Order_Model');
    }
    public function Index()
    {
        $data['Content'] = 'Admin/Dashboard';
        $data['Title'] = 'IMS';
        $this->load->view('Shared/Layout', $data);
    }
    public function Bundles(){
    public function AllComplains(){
        $data['Complains']=$this->Complain_Model->GetAllComplains();
        $data['Content'] = 'Admin/AllComplains';
        $data['Title'] = 'Manage Complains';
        $this->load->view('Shared/Layout', $data);
    }
    public function AllOrders()
    {
        $data['Orders'] = $this->Order_Model->GetAllOrders();
        $data['Content'] = 'Admin/AllOrders';
        $data['Title'] = 'All Orders';
        $this->load->view('Shared/Layout', $data);
    }
    public function UpdateUserStatus($id=null){
        if($id==null){
            redirect('Admin/AllUsers');
        }
        else if (!$this->Account_Model->GetUserInfo($id)){
            redirect('Admin/AllUsers');
        }
        else{
            $stats=$this->input->post('Status');
            $q=$this->Account_Model->UpdateUser(array('Status'=>$stats),$id);
            if($q){
                $this->session->set_flashdata('padded', 'The Status has been updated!');
                redirect('Admin/AllUsers');
            }
        }
    }
    public function UpdateUserRole($id=null){
        if($id==null){
            redirect('Admin/AllUsers');
        }
        else if (!$this->Account_Model->GetUserInfo($id)){
            redirect('Admin/AllUsers');
        }
        else{
            $role=$this->input->post('Role');
            $q=$this->Account_Model->UpdateUser(array('Role'=>$role),$id);
            if($q){
                $this->session->set_flashdata('padded', 'The Role has been updated!');
                redirect('Admin/AllUsers');
            }
        }
    }
    public function OrderDetail($id){
        if ($id == null) {
            redirect('Admin/AllOrders');
        }
        if (empty($this->Order_Model->OrderInfo($id))) {
            redirect("Admin/AllOrders");
        }
        $data['Order']=$this->Order_Model->OrderInfo($id);
        $data['Content'] = 'Admin/OrderDetail';
        $data['Title'] = 'Order # '.$id;
        $this->load->view('Shared/Layout', $data);
    }
    public function AllUsers(){
        $data['Users']=$this->Account_Model->GetUsers();
        $data['Content'] = 'Admin/AllUsers';
        $data['Title'] = 'All Users';
        $this->load->view('Shared/Layout', $data);

    }
    public function UpdateResponse($id=null){
        if ($id == null) {
            redirect("Admin/AllComplains");
        } else if (!$this->Complain_Model->ComplainInfo($id)) {
            redirect("Admin/AllComplains");
        } 
        else {

            $res = $this->input->post('Response');
            $q = $this->Complain_Model->UpdateComplain(array('Response' => $res), $id);
            if ($q) {
                $this->session->set_flashdata('padded', 'The response has been submitted!');
                redirect("Admin/AllComplains");
            }
        } 
    }
    public function UpdateComplainStatus($id = null)
    {

        if ($id == null) {
            redirect("Admin/AllComplains");
        } else if (!$this->Complain_Model->ComplainInfo($id)) {
            redirect("Admin/AllComplains");
        } 
        else {

            $status = $this->input->post('Status');
            $q = $this->Complain_Model->UpdateComplain(array('Status' => $status), $id);
            if ($q) {
                $this->session->set_flashdata('padded', 'The Status has been updated!');
                redirect("Admin/AllComplains");
            }
        }
    }
    public function UpdateOrderStatus($id = null)
    {

        if ($id == null) {
            redirect("Admin/AllOrders");
        } else if (!$this->Order_Model->OrderInfo($id)) {
            redirect("Admin/AllOrders");
        } 
        else {

            $status = $this->input->post('Status');
            $q = $this->Order_Model->UpdateOrder(array('Status' => $status), $id);
            if ($q) {
                $this->session->set_flashdata('padded', 'The Status has been updated!');
                redirect("Admin/AllOrders");
            }
        }
    }
    public function Products()
    {
        $this->form_validation->set_rules('PName', 'Product Name', 'required|trim|min_length[3]|xss_clean');
        $this->form_validation->set_rules('PPrice', 'Product Price', 'required|trim|xss_clean|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['Content'] = "Admin/ManageProduct";
            $data['Title'] = "Manage Products";
            $data['Products'] = $this->Product_Model->GetAllProducts();
            $this->load->view('Shared/Layout', $data);
        } else {
            $name = $this->input->post('PName');
            $price = $this->input->post('PPrice');
            if ($this->Product_Model->AddProduct($name, $price)) {
                $this->session->set_flashdata('padded', 'The Product has been added!');
                redirect("Admin/Products");
            }
        }
    }


    public function EditProduct($id = null)
    {
        if ($id == null) {
            redirect("Admin/Products");
        }

        if (!$this->Product_Model->ProductExists($id)) {
            redirect("Admin/Products");
        }

        $this->form_validation->set_rules('ProductName', 'Product Name', 'required|trim|min_length[3]|xss_clean');
        $this->form_validation->set_rules('PPrice', 'Product Price', 'required|trim|xss_clean|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['Content'] = "Admin/EditProduct";
            $data['Title'] = "Manage Products";
            $data['Product'] = $this->Product_Model->GetProduct($id);
            $this->load->view('Shared/Layout', $data);
        } else {
            $name = $this->input->post('ProductName');
            $price = $this->input->post('PPrice');
            if ($this->Product_Model->UpdateProduct($id, $name, $price)) {
                $this->session->set_flashdata('padded', 'The Product has been updated!');
                redirect("Admin/Products");
            }
        }
    }

    public function DeleteProduct($id = null)
    {
        if ($id == null) {
            redirect("Admin/Products");
        }
        if (!$this->Product_Model->ProductExists($id)) {
            redirect("Admin/Products");
        }
        $this->Product_Model->DeleteProduct($id);
        redirect("Admin/Products");
    }
    public function UnDeleteProduct($id = null)
    {
        if ($id == null) {
            redirect("Admin/Products");
        }
        if (!$this->Product_Model->ProductExists($id)) {
            redirect("Admin/Products");
        }
        $this->Product_Model->UnDeleteProduct($id);
        redirect("Admin/Products");
    }
}
