<?php
class Dentist_model extends CI_Model{
	private $dentistId;
	private $dentistName;

	public function __construct(){
		parent::__construct();
	}

	public function getDentistById($id)
	{
		$this->db->get_where('dentist',array('dentist_id' => $id)) -> $row();
	}
}