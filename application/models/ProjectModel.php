<?php 
	class ProjectModel extends CI_Model
	{

		public function update($data,$id)
		{
			$this->db->where('ProjectID', $id);
			return $this->db->update('projects', $data);
		}

		public function getProjectsByUser($UserID)
		{
			$this->db->select('projects.*,person.PersonID');
			$this->db->from('projects');
			$this->db->join('person', 'person.PersonID = projects.FKCreatedByID','left');
			$this->db->order_by('projects.ProjectID', 'DESC');
			$this->db->where("person.PersonID",$UserID);
			$this->db->where("projects.Deleted",0);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

	}

?>