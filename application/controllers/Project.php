<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function new()
	{
		//$data['Field'] = $this->PagesModel->getList('Fields');
		$this->load->view('project_new');
	}

	public function list()
	{	
		$this->load->model('PagesModel');
		$data['projects'] = $this->PagesModel->getRecords('projects');
		$this->load->view('project_list',$data);
	}

	public function view($id)
	{	
		$this->load->model('PagesModel');
		$data['project'] = $this->PagesModel->viewRecord('projects','ProjectID',$id);
		$this->load->view('project_view',$data);
	}

	public function edit($id)
	{	
		$this->load->model('PagesModel');
		$data['project'] = $this->PagesModel->viewRecord('projects','ProjectID',$id);
		$this->load->view('project_edit',$data);
	}

	public function save()
	{
		$this->form_validation->set_rules('ProjectName','Project Name','required');
		$this->form_validation->set_rules('VisionObjective','Vision','required');
		$this->form_validation->set_rules('Description','Description','required');
		/*$this->form_validation->set_rules('FKRegionID','Region','required|min_length[1]');
		$this->form_validation->set_rules('FKFieldID','Field','required|min_length[1]');
		$this->form_validation->set_rules('FKDistrictID','District','requiredmin_length[1]');
		$this->form_validation->set_rules('EstimatedCost','Estimated Cost','required|decimal|min_length[1]');
		$this->form_validation->set_rules('RequestedProjectFunds','Requested Project Funds','required|decimal|min_length[1]');
		$this->form_validation->set_rules('Country','Country','required|min_length[1]');
		$this->form_validation->set_rules('IndividualCostPerDay','Individual CostPer Day','decimal|min_length[1]');
		$this->form_validation->set_rules('City','City','required');
		$this->form_validation->set_rules('FKSiteCoordinatorID','Coordinator','required|min_length[1]');*/
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->load->model('PagesModel');

		if ($this->form_validation->run())
        {
        	$data = $this->input->post();

        	if($this->PagesModel->saveRecord($data,'projects'))
            {
                $this->session->set_flashdata('response','Project successfully saved.');
            }
            else
            {
				$this->session->set_flashdata('response','Project was not saved.');
            }
        }

		$this->load->view('project_new');
	}

}
