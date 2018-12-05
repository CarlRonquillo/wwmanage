<?php 
	class ProjectModel extends CI_Model
	{

	public function update($data,$id)
	{
		$this->db->where('ProjectID', $id);
		return $this->db->update('projects', $data);
	}

	}

?>