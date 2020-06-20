<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('Loggedin')) {
            redirect('Account/SignIn');
        }
        if ($this->session->userdata('Role') != "User") {
            redirect("Error");
        }
        $this->load->model('Order_Model');
    }
    public function Index()
    {
        $data['Content'] = 'User/Home';
        $data['Title'] = 'IMS';
        $this->load->view('Shared/UserLayout', $data);
    }
    public function History(){
       $data['Content'] = 'User/History';
       $data['Title'] = 'Order Details';
       $data['Orders']=$this->Order_Model->GetUserOrders($this->session->userdata('UserID'));
       $this->load->view('Shared/UserLayout', $data);
    }

    public function Order()
    {
        $this->form_validation->set_rules('AddressTxt', 'Address', 'required|trim|min_length[3]|xss_clean');
      
        if ($this->form_validation->run() == FALSE){
            $data['Content'] = 'User/Order';
            $data['Title'] = 'New Order';
            $data['User']=$this->Account_Model->GetUserDetails($this->session->userdata('Email'));
            $data['Products'] = $this->Product_Model->GetActiveProducts();
            $this->load->view('Shared/UserLayout', $data);
        }
        else{
            $Cart=$this->session->userdata('Cart');
            $desc=$this->input->post('DescTxt');
            $data=array(
               'UserID'     =>  $this->session->userdata('UserID'),
               'Email'      =>  $this->session->userdata('Email'),
               'Address'    =>  $this->input->post('AddressTxt'),
            );
            if($desc!=null){
                $data=$data+array(
                    'Description'   =>  $desc
                );
            }
            $subt=0;
            foreach($Cart as $Item){
                $subt+=($Item['Qty']*$Item['Price']);
            }            
            $data=$data+array(
                'SubTotal' => $subt,
                'Discount' => 0.0,
                'TotalPrice' =>$subt
            );
            $resultid=$this->Order_Model->AddOrder($data,$Cart);
            if($resultid>0){
                
                $this->session->unset_userdata('Cart');
                $this->session->set_flashdata('OrderSuccess','Thank you. Your order has been placed successfully!');
                redirect('User/OrderDetail/'.$resultid);

            }
            else{
                redirect('User/Index');
                        }
        }
    }
    public function OrderDetail($id){
        if ($id == null) {
            redirect('User/Order');
        }
        if (empty($this->Order_Model->OrderInfo($id))) {
            redirect("User/Order");
        }
        $data['Order']=$this->Order_Model->OrderInfo($id);
        $data['Content'] = 'User/OrderDetail';
        $data['Title'] = 'Order # '.$id;
        $this->load->view('Shared/UserLayout', $data);
    }

    public function RemoveFromCart($id = null)
    {
        if ($id == null) {
            redirect('User/Order');
        }
        if (!$this->Product_Model->ProductExists($id)) {
            redirect("User/Order");
        }
        if (!$this->session->userdata('Cart')) {
            redirect("User/Order");
        } else {
            $temp = $this->session->userdata('Cart');
            if (array_search($id, array_column($temp, 'ProductID')) !== false) {
                $key = array_search($id, array_column($temp, 'ProductID'));

                if ($key != null) {
                    unset($temp[$key]);
                } else if ($key == 0) {
                    unset($temp[$key]);
                }
                //   $this->session->where($temp[$key]['ID'],$id);
                //     $this->session->unset_userdata('Cart',$id);
                // } else if ($key == 0) {
                //     $this->session->where($temp[0]['ID'],$id);
                //     $this->session->unset_userdata('Cart',$id);
                // }
            }
            $this->session->set_userdata('Cart', $temp);
            //print_r($this->session->userdata()); die();

        }
        redirect("User/Order");
    }
    // public function ConfirmOrder($email=null){
    //     if ($email == null) {
    //         redirect('User/Order');
    //     }
    //     /*if (!$this->Account_Model->GetUserDetails()) {
    //         redirect("User/Order");
    //     }*/
    //     $this->form_validation->set_rules('Address', 'Address', 'required|trim|min_length[3]|xss_clean');
    //     if ($this->form_validation->run() == FALSE) {
    //         $data['Content'] = "User/ConfirmOrder";
    //         $data['Title'] = "ConfirmOrder";
    //         $this->load->view('Shared/Layout', $data);
    //     } else {
    //         $address=$this->input->post('AddressTxt');
    //         $desc=$this->input->post('DescTxt');
    //         $User=$this->session->user_data('UserID');
    //         $customerid=$User;
    //         $subtotal=$_POST['Subtotal'];
    //         $discount=0;
    //         $total=$subtotal-$discount;
    //         $q=$this->User_Model->AddOrder($customerid,$email,$address,$desc,$subtotal,$total);
    //        //To be continued..
    //     }
    // }
    public function AddtoCart($id = null)
    {
        if ($id == null) {
            redirect('User/Order');
        }
        if (!$this->Product_Model->ProductExists($id)) {
            redirect("User/Order");
        }
        //$this->session->unset_userdata('Cart'); die();
        $price = $this->Product_Model->GetProductPrice($id);
        $name = $this->Product_Model->GetProductName($id);
        if (!$this->session->userdata('Cart')) {
            $this->InitCart($id, $price, $name);
        } else {

            $temp = $this->session->userdata('Cart');
            // if (in_array($id, $temp['ID'])) {
            if (array_search($id, array_column($temp, 'ProductID')) !== false) {
                $key = array_search($id, array_column($temp, 'ProductID'));
                if ($key != null) {
                    $temp[$key]['Qty'] = $temp[$key]['Qty'] + 1;
                } else if ($key == 0) {
                    $temp[0]['Qty'] = $temp[0]['Qty'] + 1;
                }
            } else {
                array_push($temp, array(
                    'ProductID'    =>  $id,
                    'Name'  =>  $name,
                    'Price' =>  $price,
                    'Qty'   =>  1
                ));
            }
            $this->session->set_userdata('Cart', $temp);
        }
        redirect("User/Order");
    }

    private function InitCart($id, $price, $name)
    {
        $array = array(
            array(
                'ProductID'    =>  $id,
                'Name'  =>  $name,
                'Price' =>  $price,
                'Qty'   =>  1
            )
        );
        $this->session->set_userdata('Cart', $array);
    }
    
   
}
