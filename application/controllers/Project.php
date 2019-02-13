<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function do_upload($id)
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 12288;
        $config['file_name']			= $id.'-'.date('Ymdhis');
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $this->form_validation->set_rules('Title','Title','required|max_length[50]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run())
        {
	        $this->load->library('upload', $config);

	        if ($this->upload->do_upload('userfile'))
	        {
	    		//$data['upload_data'] = $this->upload->data();

	            $image = $this->input->post();
	        	$image['FKProjectID'] = $id;
		        $image['FKCreatedByID'] = $this->session->userdata('PersonID');
		        $image['FileName'] = $this->upload->data('file_name');
				$this->load->model('PagesModel');
				$this->PagesModel->saveRecord($image,'media');

				$this->session->set_flashdata('response','Image successfully saved.');

	            //$data['id'] = $id;
	         	//$data['error'] = "Image uploaded successfully!";
	        }
	        else
	        {
				$this->session->set_flashdata('response',$this->upload->display_errors());
	        }
        }

        return redirect("Project/images/{$id}");
    }

    public function images($id)
    {
    	$this->load->model('ProjectModel');
    	$data['images'] = $this->ProjectModel->viewProjectImages($id);
    	$data['ProjectName'] = $this->ProjectModel->getProjectName($id);

    	$this->load->view('project_image',$data);
    }

	public function new()
	{
		$this->load->model('PagesModel');
		$data['Regions'] = $this->PagesModel->getRegions();
		$data['Fields'] = $this->PagesModel->getFields();
		$data['Districts'] = $this->PagesModel->getRecords('districts');
		$data['Categories'] = $this->PagesModel->getCategory();
		$data['Coordinators'] = $this->PagesModel->getCoordinators();
		$data['Countries'] = $this->PagesModel->getRecords('countries');
		$this->load->view('project_new',$data);
	}

	public function list()
	{	
		//if($this->session->userdata('Username') != 'admin')
        //{
		$this->load->model('ProjectModel');
		$data['projects'] = $this->ProjectModel->getProjectsByUser($this->session->userdata('PersonID'));
		//}
		//else
		//{
		//	$this->load->model('PagesModel');
		//	$data['projects'] = $this->PagesModel->getRecords('projects');
		//}
		$this->load->view('project_list',$data);
	}

	public function view($id)
	{	
		$this->load->model('ProjectModel');
		$data['images'] = $this->ProjectModel->viewProjectImages($id);
		$data['project'] = $this->ProjectModel->viewProject($id);
		$this->load->view('project_view',$data);
	}

	public function coordinator($id)
	{	
		$this->load->model('PagesModel');
		$data['Coordinators'] = $this->PagesModel->getCoordinators();
		$this->load->model('ProjectModel');
		$data['project'] = $this->ProjectModel->viewProject($id);
		$this->load->view('project_coordinator',$data);
	}

	public function edit($id)
	{	
		$this->load->model('PagesModel');
		$data['project'] = $this->PagesModel->viewRecord('projects','ProjectID',$id);
		$data['Regions'] = $this->PagesModel->getRegions();
		$data['Countries'] = $this->PagesModel->getRecords('countries');
		$data['Fields'] = $this->PagesModel->getFields();
		$data['Categories'] = $this->PagesModel->getCategory();
		$data['Coordinators'] = $this->PagesModel->getCoordinators();
		$data['Districts'] = $this->PagesModel->getRecords('districts');
		$error ="";
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

		if(!isset($data['YouthTeamsAccepted']))
		{
			$data['YouthTeamsAccepted'] = 0;
		}

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

        return redirect("Project/view/{$id}");
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
	        $data['FKCreatedByID'] = $this->session->userdata('PersonID');

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

	public function ChangeStatus($id,$status)
	{
		$this->load->model('ProjectModel');
		$this->ProjectModel->ChangeStatus($id,$status);
		return redirect("Project/view/{$id}");
	}

	public function setThumbnail($mediaID,$ProjectID)
	{
		$this->load->model('ProjectModel');
		$this->ProjectModel->ChangeThumbnail($mediaID,$ProjectID);
		return redirect("Project/images/{$ProjectID}");
	}

	public function deleteImage($mediaID,$ProjectID)
	{
		$this->load->model('PagesModel');
		$this->PagesModel->delete('media',array('MediaID' => $mediaID));
		return redirect("Project/images/{$ProjectID}");
	}

	public function SaveCoordinator($ProjectID)
	{
		$this->load->model('ProjectModel');
		$CoordinatorID = $_POST['FKSiteCoordinatorID'];
		$this->ProjectModel->UpdateCoordinator($ProjectID,$CoordinatorID);
		return redirect("Project/view/{$ProjectID}");
	}

}
