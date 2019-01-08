<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index()
	{
                if(!empty($this->session->userdata('Username')))
                {
	               $this->load->view('dashboard');
                }
                else
                {
                        $this->login();
                }
	}
}
