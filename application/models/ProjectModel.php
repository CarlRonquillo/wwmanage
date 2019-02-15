<?php 
	class ProjectModel extends CI_Model
	{

		public function update($data,$id)
		{
			$this->db->where('ProjectID', $id);
			return $this->db->update('projects', $data);
		}

		public function ChangeStatus($id,$status)
		{
			$data = array('Status' => $status);
			$this->db->where('ProjectID', $id);
			return $this->db->update('projects', $data);
		}

		public function ChangeThumbnail($mediaID,$ProjectID)
		{
			$data = array('is_thumbnail' => 0);
			$this->db->where('is_thumbnail', 1);
			$this->db->where('FKProjectID', $ProjectID);
			$this->db->update('media', $data);

			$data = array('is_thumbnail' => 1);
			$this->db->where('MediaID', $mediaID);
			$this->db->where('FKProjectID', $ProjectID);
			return $this->db->update('media', $data);
		}

		public function UpdateCoordinator($projectID,$coordinatorID)
		{
			$data = array('FKSiteCoordinatorID' => $coordinatorID);
			$this->db->where('ProjectID', $projectID);
			return $this->db->update('projects', $data);
		}

		public function getProjectsByUser($UserID)
		{
			$this->db->select('projects.*,Person.PersonID,project_status.Title,media.FileName');
			$this->db->from('projects');
			$this->db->join('media', 'media.FKProjectID = projects.ProjectID AND media.is_thumbnail = 1','left');
			$this->db->join('Person', 'Person.PersonID = projects.FKCreatedByID','left');
			$this->db->join('project_status', 'project_status.Code = projects.Status','left');
			$this->db->order_by('projects.ProjectName', 'ASC');
			if($this->session->userdata('Role') == 2)
			{
				$this->db->where("projects.FKCreatedByID",$UserID);
			}
			elseif($this->session->userdata('Role') == 3)
			{
				$this->db->where("projects.FKFieldID",$this->session->userdata('FKFieldID'));
			}
			elseif($this->session->userdata('Role') == 4)
			{
				$this->db->where("projects.FKRegionID",$this->session->userdata('FKRegionID'));
			}
			elseif($this->session->userdata('Role') == 5)
			{
				$this->db->where("projects.FKSiteCoordinatorID",$this->session->userdata('PersonID'));
			}
			$this->db->where("projects.Deleted",0);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function viewProject($ProjectID)
		{
			$this->db->select("CONCAT(Person.GivenName,' ',Person.FamilyName)");
			$this->db->from('projects');
			$this->db->join('Person', 'Person.PersonID = projects.FKSiteCoordinatorID','left');
			$this->db->where("projects.Deleted",0);
			$this->db->where("projects.ProjectID",$ProjectID);
			$subQuery  =  $this->db->get_compiled_select();


			$this->db->select('projects.*,Person.PersonID,Person.GivenName,Person.FamilyName,project_status.Title,('. $subQuery .') as SiteCoordinator');
			$this->db->from('projects');
			$this->db->join('Person', 'Person.PersonID = projects.FKCreatedByID','left');
			$this->db->join('project_status', 'project_status.Code = projects.Status','left');
			$this->db->where("projects.Deleted",0);
			$this->db->where("projects.ProjectID",$ProjectID);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->row();
			}
		}

		public function getProjectName($ProjectID)
		{
			$this->db->select("ProjectName,ProjectID");
			$query = $this->db->get_where('projects',array('ProjectID' => $ProjectID,'Deleted'=> 0));
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
		}

		public function viewProjectImages($ProjectID)
		{
			$query = $this->db->get_where('media',array('FKProjectID' => $ProjectID));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function viewImage($mediaID)
		{
			$query = $this->db->get_where('media',array('MediaID' => $mediaID));
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
		}

	}

?>