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
            $data['Product']=$this->Product_Model->GetProduct($id);
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
