<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient_model extends CI_Mod

	private $patient_id;
	private $firstname;
	private $lastname;
	private $middlename;
	private $dateofbirth;
	private $birthplace;
	private $occupation;
	private $e_mail;

	public function __construct(){
		parent::__construct();
	}

/**
	SETTER & GETTER
*/
	/**
	 * get patient's ID
	 * @return string patient's ID	
	*/
	public function getPatientId()
	{
		return $this->patient_id;
	}
	
	public function setPatientId($value)
	{
		$this->patient_id = $value;
	}

	public function getFirstName()
	{
		return $this->firstname;
	}

	public function setFirstName($value)
	{
		$this->firstname = $value;
	}

	public function getLastName()	{
		return $this->lastname;
	}

	public function setLastName($value=''){
		$this->lastname = $value
	}

	public function getMiddleName(){
		return $this->middlename;
	}

	public function setMiddleName($value=''){
		$this->middlename = $value;
	}

/**
	METHODS
*/
	public function create($patient)
	{
		$this->load->helper('date');
		$this->db->insert('dentalclinic', 
			array('patient_id' => $patient->patient_id,
				'firstname' => $patient->firstname
				)
			);
	}
}