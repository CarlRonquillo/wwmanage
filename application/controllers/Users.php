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
                                if($session_data['Role'] == 1 || $session_data['Role'] == 3 || $session_data['Role'] == 4)
                                {
                                        $session_data['CanApprove'] = true;
                                }
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
        
        public function View($PersonID)
        {
                $this->load->model('UserModel');
                $data['User'] = $this->UserModel->viewUser($PersonID);
                $data['Roles'] = $this->UserModel->getRoles();
                $this->load->view('user_view',$data);
        }

        public function New()
        {
                $this->load->model('UserModel');
                $data['Roles'] = $this->UserModel->getRoles();
                $this->load->view('user_new',$data);
        }

        public function List()
        {
                $this->load->model('UserModel');
                $data['Users'] = $this->UserModel->getUsers();
                $this->load->view('user_list',$data);
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

                        if($this->PagesModel->saveRecord($data,'Person'))
                        {
                        $this->session->set_flashdata('response','User successfully saved.');
                        }
                        else
                        {
                                $this->session->set_flashdata('response','User was not saved.');
                        }
                }

                return redirect("Users/New");
        }

        public function update($id)
        {
                $this->form_validation->set_rules('GivenName','Given Name','required');
                $this->form_validation->set_rules('Username','Description','required');
                $this->form_validation->set_rules('Password','Category','required');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $this->load->model('PagesModel');

                if ($this->form_validation->run())
                {
                        $data = $this->input->post();
                        //$data['ModifiedDate'] = date('Y-m-d H:i:s');

                        $condition = array('PersonID' => $id);

                        if($this->PagesModel->update($data,'Person',$condition))
                        {
                                $this->session->set_flashdata('response','User successfully updated.');
                        }
                        else
                        {
                                $this->session->set_flashdata('response','User was not updated.');
                        }
                }

                return redirect("Users/View/{$id}");
        }

        public function delete($id)
        {       
                $this->load->model('PagesModel');
                $data['Deleted'] = '1';
                $data['DateDeleted'] = date('Y-m-d H:i:s');
                $condition = array('PersonID' => $id);

        if($this->PagesModel->update($data,'Person',$condition))
        {
                $this->session->set_flashdata('response','User successfully deleted.');
        }
        else
        {
                $this->session->set_flashdata('response','User was not deleted.');
        }

                return redirect("Users/list");
        }
}
