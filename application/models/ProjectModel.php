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

		public function getProjectsByUser($UserID)
		{
			$this->db->select('projects.*,Person.PersonID,project_status.Title');
			$this->db->from('projects');
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
			$this->db->select('projects.*,Person.PersonID,project_status.Title');
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

	}

?>