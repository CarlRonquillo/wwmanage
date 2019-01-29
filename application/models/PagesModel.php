<?php 
	class PagesModel extends CI_Model
	{

		public function getRecords($tableName)
		{
			$query = $this->db->get_where($tableName,array('Deleted' => '0'));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function getCoordinators()
		{
			$query = $this->db->get_where('Person',array('Role' => '5','Deleted' => '0'));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}


		public function getCategory()
		{
			$query = $this->db->get('category');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function getRegions()
		{
			$query = $this->db->get('OPAL_Region');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function getCountries()
		{
			$query = $this->db->get('countries');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function getFields()
		{
			$query = $this->db->get_where('fields',array('is_active' => '1'));
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		public function getAllRecords($record_id,$tableName,$PKfield)
		{
			$query = $this->db->get_where($tableName,array($PKfield=> $record_id));
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
		}

		public function viewRecord($tableName,$PKfield,$id)
		{
			$query = $this->db->get_where($tableName, array($PKfield => $id,'Deleted' => '0'));
			if($query->num_rows() > 0)
			{
				return $query->row();
			}
		}

		public function saveRecord( $data,$tableName )
		{
			return $this->db->insert($tableName,$data);
		}

		public function update($data,$tableName,$where)
		{
			$this->db->where($where);
			return $this->db->update($tableName, $data);
		}

	}

?>