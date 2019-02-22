<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends CI_Controller {

	public function index()
	{
                if(!empty($this->session->userdata('Username')))
                {
	               $this->load->view('dashboard');
                }
                else
                {
                        $this->load->view('login');
                }
	}

        public function new()
        {
                $this->load->view('team_new');
        }

        public function save()
        {
                $this->form_validation->set_rules('TeamName','Team Name','required');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $this->load->model('PagesModel');

                if ($this->form_validation->run())
                {
                        $data = $this->input->post();
                        $data['FKCreatedByID'] = $this->session->userdata('PersonID');

                        if($this->PagesModel->saveRecord($data,'teams'))
                    {
                        $this->session->set_flashdata('response','Team successfully saved.');
                    }
                    else
                    {
                        $this->session->set_flashdata('response','Team was not saved.');
                    }
                }

                return redirect("Teams/new");
        }

        public function list()
        {
                $this->load->model('TeamModel');
                $data['teams'] = $this->TeamModel->getTeams();

                $this->load->view('team_list',$data);
        }

        public function view($teamID)
        {
                $this->load->model('TeamModel');
                $data['team'] = $this->TeamModel->viewTeam($teamID);
                $data['members'] = $this->TeamModel->getTeamMembers($teamID);

                $this->load->view('team_view',$data);
        }
}
