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


	}

?>