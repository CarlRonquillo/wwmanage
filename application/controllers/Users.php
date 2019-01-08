<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

        public function Logout()
        {
                $this->session->sess_destroy();
                redirect('Users/Login');
        }

	public function login()
	{
		$this->load->view('login');
	}

	public function login_validation()
	{
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run())
                {
                	$username = $this->input->post('username');
                	$password = $this->input->post('password');

                	$this->load->model('UserModel');
                	if($this->UserModel->can_login($username,$password))
                	{
                		$session_data = $this->UserModel->user_details($username,$password);
                		$this->session->set_userdata($session_data);

                		redirect('pages/index');
                	}
                	else
                	{
                		$this->session->set_flashdata('response','Username or Password is Invalid!');
                		redirect('Users/Login');
                	}
                }
                else
                {
                	$this->login();
                }
	}

        public function New()
        {
                //$this->load->model('UserModel');
                //$data['Categories'] = $this->PagesModel->getCategory();
                $this->load->view('user_new');
        }

        public function save()
        {
                $this->form_validation->set_rules('GivenName','Given Name','required');
                $this->form_validation->set_rules('Username','Description','required');
                $this->form_validation->set_rules('Password','Category','required');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $this->load->model('PagesModel');

                if ($this->form_validation->run())
                {
                $data = $this->input->post();

                        if($this->PagesModel->saveRecord($data,'person'))
                        {
                        $this->session->set_flashdata('response','User successfully saved.');
                        }
                        else
                        {
                                $this->session->set_flashdata('response','User was not saved.');
                        }
                }

                return redirect("Pages/index");
        }
}
