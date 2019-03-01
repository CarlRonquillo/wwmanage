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
                $data['Users'] = $this->TeamModel->getMembers();

                $this->load->model('ProjectModel');
                $data['projectNames'] = $this->ProjectModel->getProjectNames();

                $this->load->view('team_view',$data);
        }

        public function saveCurrentProject($TeamID)
        {
            $data = $this->input->post();
            $this->load->model('TeamModel');

            if($this->TeamModel->updateCurrentProject($data,$TeamID))
            {
                $this->session->set_flashdata('response','Team successfully updated.');
            }
            else
            {
                 $this->session->set_flashdata('response','Team was not updated.');
            }

            return redirect("Teams/view/{$TeamID}");
        }

    public function addMember($TeamID)
    {
            $this->form_validation->set_rules('search','Name','required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if ($this->form_validation->run())
            {
                $arr_searched = explode('-',$this->input->post('search'));
                $PersonID = trim($arr_searched[1],' ');

                $this->load->model('PagesModel');
                if($this->PagesModel->update(array("FKTeamID" => $TeamID),'Person',array("PersonID" => $PersonID)))
                {
                    $this->session->set_flashdata('response','Team successfully saved.');
                }
                else
                {
                    $this->session->set_flashdata('response','Team was not saved.');
                }
            }

            return redirect("Teams/view/{$TeamID}");
    }

    public function removeMember($personID,$TeamID)
    {
        $this->load->model('PagesModel');
        if($this->PagesModel->update(array("FKTeamID" => 0),'person',array("PersonID" => $personID)))
        {
            $this->session->set_flashdata('response','Member successfully removed.');
        }
        else
        {
            $this->session->set_flashdata('response','Member was not successfully removed.');
        }

        return redirect("Teams/view/{$TeamID}");
    }

}
