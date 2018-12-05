<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function new()
	{
		$this->load->model('PagesModel');
		//$data['Field'] = $this->PagesModel->getList('Fields');
		$data['Categories'] = $this->PagesModel->getCategory();
		$this->load->view('project_new',$data);
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
		$data['Categories'] = $this->PagesModel->getCategory();
		$this->load->view('project_edit',$data);
	}

	public function delete($id)
	{	
		$this->load->model('PagesModel');
		$data['Deleted'] = '1';
		$data['DateDeleted'] = date('Y-m-d H:i:s');
		$condition = array('ProjectID' => $id);

		if($this->PagesModel->update($data,'projects',$condition))
        {
            $this->session->set_flashdata('response','Project successfully deleted.');
        }
        else
        {
			$this->session->set_flashdata('response','Project was not deleted.');
        }

		return redirect("Project/list");
	}

	public function update($id)
	{	
		$this->form_validation->set_rules('ProjectName','Project Name','required');
		$this->form_validation->set_rules('VisionObjective','Vision','required');
		$this->form_validation->set_rules('Description','Description','required');
		//$this->form_validation->set_rules('FKCategoryID[]','Category','required');
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
	        unset($data['FKCategoryID']);
	        $data['ModifiedDate'] = date('Y-m-d H:i:s');

	        $condition = array('ProjectID' => $id);

        	if($this->PagesModel->update($data,'projects',$condition))
            {
            	//foreach ($_POST['FKCategoryID'] as $cat)
            	//{
            	//	$categories['FKCategoryID'] = $cat;
            	//	$this->PagesModel->saveRecord($categories,'mmprojectcategory');
            	//}

                $this->session->set_flashdata('response','Project successfully updated.');
            }
            else
            {
				$this->session->set_flashdata('response','Project was not updated.');
            }
        }

        $data['project'] = $this->PagesModel->viewRecord('projects','ProjectID',$id);
		$this->load->view('project_view',$data);
	}

	public function save()
	{
		$this->form_validation->set_rules('ProjectName','Project Name','required');
		$this->form_validation->set_rules('VisionObjective','Vision','required');
		$this->form_validation->set_rules('Description','Description','required');
		$this->form_validation->set_rules('FKCategoryID[]','Category','required');
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
	        unset($data['FKCategoryID']);

        	if($this->PagesModel->saveRecord($data,'projects'))
            {
            	$categories['FKProjectID'] = $this->db->insert_id();
            	foreach ($_POST['FKCategoryID'] as $cat)
            	{
            		$categories['FKCategoryID'] = $cat;
            		$this->PagesModel->saveRecord($categories,'mmprojectcategory');
            	}

                $this->session->set_flashdata('response','Project successfully saved.');
            }
            else
            {
				$this->session->set_flashdata('response','Project was not saved.');
            }
        }

		return redirect("Project/new/{$categoryList}");
	}

}
