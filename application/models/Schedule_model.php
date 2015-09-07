<?php

Class Schedule_model extends CI_Model {

	private $scheduleId;
	private $scheduleDate;
	private $scheduleStatus;
	private $sysCreationDate;
	private $sysUpdateDate;

	public function __construct(){}
	{
		parent::__construct();
	}

	public function getScheduleId(){
		return $this->scheduleId;
	}

	public function setScheduleDate($value){
		$this->scheduleDate = $value;
	}

	public function getScheduleStatus(){
		return $this->scheduleStatus;
	}
	
	public function setScheduleStatus($value='')
	{
		$this->scheduleStatus = $value;
	}
	public function setScheduleDate($value){
		$this->scheduleDate = $value;
	}

	public function createSchedule(){

	}
}