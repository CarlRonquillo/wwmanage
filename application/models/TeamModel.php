<?php 
	class TeamModel extends CI_Model
	{
		public function getTeams()
		{
			$this->db->select('teams.*,projects.ProjectName,COUNT(PersonID) as members');
			$this->db->from('teams');
			$this->db->join('projects', 'projects.ProjectID = teams.FKProjectID','left');
			$this->db->join('Person', 'Person.FKTeamID = teams.TeamID','left');
			$this->db->group_by('teams.TeamID'); 
			$this->db->order_by('teams.TeamName', 'DESC');
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function getTeamMembers($TeamID)
		{
			$this->db->select('*');
			$this->db->from('Person');
			$this->db->where('FKTeamID', $TeamID);
			$this->db->order_by('Person.PersonID', 'DESC');
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function viewTeam($teamID)
		{
			$this->db->select('teams.*,projects.ProjectName');
			$this->db->from('teams');
			$this->db->join('projects', 'projects.ProjectID = teams.FKProjectID','left');
			$this->db->where('teams.TeamID', $teamID);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->row();
			}
		}

		public function updateCurrentProject($data,$teamID)
		{
			$this->db->where(array('TeamID' => $teamID));
			return $this->db->update('teams', $data);
		}

		public function getMembers()
		{
			$this->db->select('Person.GivenName,Person.PersonID,Person.FamilyName');
			$this->db->from('Person');
			$this->db->order_by('Person.GivenName', 'DESC');
			$this->db->where("Person.Deleted",0);
			$this->db->where("Person.Role !=",1);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}
	
	}

?>