<?php

class Address_model extends CI_Model{
	private $addressId;
	private $streetName;

	public function __construct()
	{
		parent::__construct();
	}

	public function getAddressId(){
		return $this->addressId;
	}

	public function getAddressByPatientId($patientId){
		
	}

	public function getStreetName(){
		return $this->streetName;
	}
	public function setStreetName($value)
	{
		$this->streetName = $value;
	}
}