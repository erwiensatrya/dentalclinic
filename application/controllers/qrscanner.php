<?php

class Qrscanner extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl', 'photo'));
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
		}

		
		$this->load->view('qrscanner', isset($data) ? $data : NULL);
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */