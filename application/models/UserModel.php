<?php 
	class UserModel extends CI_Model
	{
		public function can_login($username,$password)
		{
			$this->db->where('Username',$username);
			$this->db->where('Password',$password);
			//$this->db->where('Deleted', 0);
			$query = $this->db->get('Person');

			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function user_details($username,$password)
		{
			$this->db->where('Username',$username);
			$this->db->where('Password',$password);
			$query = $this->db->get('Person');

			return $query->row_array();
		}

		public function getUsers()
		{
			$this->db->select('Person.*,person_roles.Title');
			$this->db->from('Person');
			$this->db->join('person_roles', 'person_roles.RoleID = Person.Role','left');
			$this->db->order_by('Person.PersonID', 'DESC');
			$this->db->where("Person.Deleted",0);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}
		
		public function viewUser($PersonID)
		{
			$this->db->select('Person.*,person_roles.Title');
			$this->db->from('Person');
			$this->db->join('person_roles', 'person_roles.RoleID = Person.Role','left');
			$this->db->order_by('Person.PersonID', 'DESC');
			$this->db->where("Person.PersonID",$PersonID);
			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->row_array();
			}
		}

		public function getRoles()
		{
			$query = $this->db->get_where('person_roles',array('Active' => '1'));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}


	}

?>