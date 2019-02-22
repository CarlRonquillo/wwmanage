<?php 
	class TeamModel extends CI_Model
	{
		public function getTeams()
		{
			$this->db->select('teams.*,projects.ProjectName,COUNT(PersonID) as members');
			$this->db->from('teams');
			$this->db->join('projects', 'projects.ProjectID = teams.FKProjectID','left');
			$this->db->join('Person', 'Person.FKTeamID = teams.TeamID','left');
			$this->db->group_by('Person.FKTeamID'); 
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
	
	}

?>