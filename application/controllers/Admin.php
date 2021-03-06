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
        $this->load->model('Bundle_Model');
    }
    public function Index()
    {
        $data['Content'] = 'Admin/Dashboard';
        $data['Title'] = 'IMS';
        $this->load->view('Shared/Layout', $data);
    }

    public function AllComplains()
    {
        $data['Complains'] = $this->Complain_Model->GetAllComplains();
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
    public function AddBundleItem($id = null)
    {
        if ($id == null) {
            redirect('Admin/AddBundle');
        } else if (!$this->Product_Model->ProductExists($id)) {
            redirect('Admin/AddBundle');
        } else {
            $this->form_validation->set_rules('QuantityTxt', 'Quantity', 'required');
            $item = $this->Product_Model->GetProduct($id);
            $item['Quantity'] = $this->input->post('QuantityTxt');
            // print_r($item);
            // die();

            $curr = $this->session->userdata('BundleItems');
            // array_push($item, $curr);
            if (array_search($id, array_column($curr, 'ProductID')) !== false) {
                $key = array_search($id, array_column($curr, 'ProductID'));
                if ($key != null) {
                    $curr[$key]['Quantity'] = $curr[$key]['Quantity'] + 1;
                } else if ($key == 0) {
                    $curr[0]['Quantity'] = $curr[0]['Quantity'] + 1;
                }
            } else {
                array_push($curr, array(
                    'ProductID'    =>  $item['ProductID'],
                    'ProductName'  =>  $item['ProductName'],
                    'Price' =>  $item['Price'],
                    'Quantity'   =>  $item['Quantity']
                ));
                $curr = array_values($curr);
            }
            $this->session->set_userdata('BundleItems', $curr);
            // $data['Content'] = "Admin/AddBundle";
            // $data['Title'] = "Add Bundle";
            // $this->load->view('Shared/Layout');
        }
        // print_r($this->session->userdata('BundleItems'));
        // die();
        redirect('Admin/AddBundle');
    }
    public function RemoveBundleItem($id = null)
    {
        if ($id == null) {
            redirect('Admin/AddBundle');
        } else if (!$this->Product_Model->ProductExists($id)) {
            redirect('Admin/AddBundle');
        } else if (!$this->session->userdata('BundleItems')) {
            redirect('Admin/AddBundle');
        } else {
            $temp = $this->session->userdata('BundleItems');
            if (array_search($id, array_column($temp, 'ProductID')) !== false) {
                $key = array_search($id, array_column($temp, 'ProductID'));
                // $this->session->unset_userdata('BundleItems');
                // print_r($temp);
                // print_r($key);
                // die();
                if ($key != null) {
                    unset($temp[$key]);
                } else if ($key == 0) {
                    unset($temp[$key]);
                }
            }
            $temp = array_values($temp);
            $this->session->set_userdata('BundleItems', $temp);
            redirect('Admin/AddBundle');
        }
    }
    public function AddBundle()
    {
        $this->form_validation->set_rules('BundleNameTxt', 'Bundle Name', 'required|trim|min_length[3]|xss_clean');
        $this->form_validation->set_rules('DescTxt', 'Bundle Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('Discount', 'Discount', 'required|trim|xss_clean|greater_than[0]');
        $this->form_validation->set_rules('Total', 'Total Price', 'required|trim|xss_clean|greater_than[0]');
        if ($this->form_validation->run() == FALSE) {
            $data['Content'] = "Admin/AddBundle";
            $data['Title'] = "Add Bundle";
            $data['BundleItems'] = $this->session->userdata('BundleItems');
            $data['Items'] = $this->Product_Model->GetActiveProducts();
            if (!$this->session->userdata('BundleItems')) {
                $array = array();
                $this->session->set_userdata('BundleItems', $array);
            }
            $this->load->view('Shared/Layout', $data);
        } else {
            $name = $this->input->post('BundleNameTxt');
            $desc = $this->input->post('DescTxt');
            $disc = $this->input->post('Discount');
            $tot = $this->input->post('Total');
            $arr = array(
                'BundleName' => $name,
                'Discount' => $disc,
                'Total' => $tot,
                'Description'=> $desc
            );
            if ($this->Bundle_Model->AddBundle($arr)) {
                $this->session->set_flashdata('padd', 'Bundle added successfully');
                redirect('Admin/Bundles');
            }
        }
    }
    public function UpdateUserStatus($id = null)
    {
        if ($id == null) {
            redirect('Admin/AllUsers');
        } else if (!$this->Account_Model->GetUserInfo($id)) {
            redirect('Admin/AllUsers');
        } else {
            $stats = $this->input->post('Status');
            $q = $this->Account_Model->UpdateUser(array('Status' => $stats), $id);
            if ($q) {
                $this->session->set_flashdata('padded', 'The Status has been updated!');
                redirect('Admin/AllUsers');
            }
        }
    }
    public function UpdateUserRole($id = null)
    {
        if ($id == null) {
            redirect('Admin/AllUsers');
        } else if (!$this->Account_Model->GetUserInfo($id)) {
            redirect('Admin/AllUsers');
        } else {
            $role = $this->input->post('Role');
            $q = $this->Account_Model->UpdateUser(array('Role' => $role), $id);
            if ($q) {
                $this->session->set_flashdata('padded', 'The Role has been updated!');
                redirect('Admin/AllUsers');
            }
        }
    }
    public function OrderDetail($id)
    {
        if ($id == null) {
            redirect('Admin/AllOrders');
        }
        if (empty($this->Order_Model->OrderInfo($id))) {
            redirect("Admin/AllOrders");
        }
        $data['Order'] = $this->Order_Model->OrderInfo($id);
        $data['Content'] = 'Admin/OrderDetail';
        $data['Title'] = 'Order # ' . $id;
        $this->load->view('Shared/Layout', $data);
    }
    public function AllUsers()
    {
        $data['Users'] = $this->Account_Model->GetUsers();
        $data['Content'] = 'Admin/AllUsers';
        $data['Title'] = 'All Users';
        $this->load->view('Shared/Layout', $data);
    }
    public function UpdateResponse($id = null)
    {
        if ($id == null) {
            redirect("Admin/AllComplains");
        } else if (!$this->Complain_Model->ComplainInfo($id)) {
            redirect("Admin/AllComplains");
        } else {

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
        } else {

            $status = $this->input->post('Status');
            $q = $this->Complain_Model->UpdateComplain(array('Status' => $status), $id);
            if ($q) {
                $this->session->set_flashdata('padded', 'The Status has been updated!');
                redirect("Admin/AllComplains");
            }
        }
    }
    public function Bundles()
    {
        $array = $this->Bundle_Model->GetAllBundles();
        $result['Items'] = array();
        for ($i = 0; $i < count($array, 0); $i++) {
            $result['Items'] = $this->Bundle_Model->GetBundleItems($array[$i]['BundleID']);
            $array[$i] = $array[$i] + $result;
        }
        $data['Bundles'] = $array;
        $data['Content'] = 'Admin/Bundles';
        $data['Title'] = 'All Bundles';
        $this->load->view('Shared/Layout', $data);
    }

    public function UpdateOrderStatus($id = null)
    {

        if ($id == null) {
            redirect("Admin/AllOrders");
        } else if (!$this->Order_Model->OrderInfo($id)) {
            redirect("Admin/AllOrders");
        } else {

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
