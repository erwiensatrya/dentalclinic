<?php

class Calendar extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl', 'photo', 'mailbox'));
		$this->load->library(array('account/authentication', 'account/authorization'));
		$this->load->model(array('account/account_model','account/account_details_model'));
		$this->load->language(array('general', 'account/account_profile','dashboard'));
	}

	function index()
	{
		
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'dashboard'));
		}

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
			if($this->authorization->is_permitted('manage_mailbox')){
				$this->load->helper('mailbox');
				$data['mailinfo'] = mailInfo();
			}
			//$data['all_dentist'] = $this->account_model->get_dentist();
		}
		$data['calendar'] = true;
		
		$this->load->view('calendar', isset($data) ? $data : NULL);
	}
	
	function events(){
		//show calendar event
		$record[0]["title"]="Test 1";
		$record[1]["title"]="Test 2";
		$record[2]["title"]="Test 3";

		$record[0]["start_date"]="1441411200";
		$record[1]["start_date"]="1441929600";
		$record[2]["start_date"]="1441774800";

		$record[0]["end_date"]="1441497600";
		$record[1]["end_date"]="1442707200";
		$record[2]["end_date"]="1441800000";

		$record[0]["id"]="1";
		$record[1]["id"]="2";
		$record[2]["id"]="3";

		$record[0]["backgroundColor"]="#00a65a";
		$record[1]["backgroundColor"]="#0073b7";
		$record[2]["backgroundColor"]="#f39c12";

		for ($i=0; $i<sizeof($record); $i++) {

			$event_array[] = array(
					'id' => $record[$i]['id'],
					'title' => $record[$i]['title'],
					'start' => gmdate("c",$record[$i]['start_date']),
					'end' => gmdate("c",$record[$i]['end_date']),
					'backgroundColor' => $record[$i]['backgroundColor'],
					'borderColor' => $record[$i]['backgroundColor'],
					'allDay' => false
			);

		}

		echo json_encode($event_array);

		exit;

	}
	
}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */