<?php

class Account extends CI_Controller
{

    public function Index(){
        if ($this->session->userdata('Loggedin')) {
            redirect("Admin/Products");
        }
        else{
            redirect("Account/SignIn");
        }

    }


    public function Signup()
    {
        $this->form_validation->set_rules('FullName', 'Full Name', 'required|trim|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('Email', 'Email address', 'required|trim|min_length[3]|max_length[30]|xss_clean|valid_email|is_unique[user.Email]');
        $this->form_validation->set_rules('Pass', 'Password', 'required|trim|min_length[6]|xss_clean');
        $this->form_validation->set_rules('Address', 'Address', 'required|trim|min_length[3]|xss_clean');

        $this->form_validation->set_rules('Phone', 'Phone', 'required|trim|xss_clean|max_length[13]');

        if ($this->form_validation->run() == FALSE) {
            $data['Title'] = 'Create an account';
            $data['Content'] = "Account/Signup";
            $this->load->view("Shared/AuthLayout", $data);
        } else {
            $name = $this->input->post('FullName');
            $pass = $this->input->post('Pass');
            $email = $this->input->post('Email');
            $add = $this->input->post('Address');
            $phone = $this->input->post('Phone');
            if ($this->Account_Model->Signup($name, $email, $pass, $add, $phone)) {
                $this->session->set_flashdata('signedup', 'Your account has been created!');
                redirect('Account/Signin');
            }
        }
    }
    public function SignIn()
    {
        $this->form_validation->set_rules('Email', 'Email address', 'required|trim|min_length[3]|max_length[30]|xss_clean|valid_email');
        $this->form_validation->set_rules('Pass', 'Password', 'required|trim|min_length[6]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['Content'] = 'Account/Signin';
            $data['Title'] = 'Sign in';
            $this->load->view('Shared/AuthLayout', $data);
        } else {
            $email = $this->input->post('Email');
            $pass = $this->input->post('Pass');
            $result = $this->Account_Model->Signin($email, $pass);
            if (!empty($result)) {
                $help = array(
                    'Loggedin' => true
                );
                $result = $result + $help;
                $this->session->set_userdata($result);
                if ($result['Role'] == "Admin") {

                    redirect("Admin/Products");
                } else {
                    redirect("User/Order");
                }
            }
        }
    }
}
