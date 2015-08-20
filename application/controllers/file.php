<?php

class File extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl', 'photo'));
		$this->load->library(array('account/authentication', 'account/authorization'));
		$this->load->model(array('account/account_model','account/account_details_model'));
		$this->load->language(array('general', 'account/account_profile','dashboard'));
		
		$data =Array();
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
			$this->data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
		}
	  
		//$this->data['scan'] = $this->scan($this->session->userdata('account_id'),FALSE);
		$this->data['dir'] = RES_DIR.'/user/'.$this->session->userdata('account_id');
		
		//$this->elfinder_init($this->data['dir']);
		$this->load->view('file', isset($this->data) ? $this->data : NULL);
	}
	
	
	function elfinder_init($path=null)
	{
	  if($path === 1){
		$path = RES_DIR.'/user/';
		
		$opts = array(
			//'debug' => true, 
			'roots' => array(
				  array( 
					'driver' => 'LocalFileSystem', 
					'path'   => $path, 
					'URL'    => base_url().$path,
					'accessControl' => 'access',
					'attributes' => array(
						array(
							'pattern' => '!^/index.html!',
							'hidden' => true
						),array(
							'pattern' => '!^/.tmb!',
							'hidden' => true
						),array(
							'pattern' => '!^/.quarantine!',
							'hidden' => true
						)
					)
					
				  ) 
			)
		  );
	  
	  }else{
		$this->load->model(array('account/account_details_model'));
		$fullname = $this->account_details_model->get_by_account_id($path)->fullname;
		$path = RES_DIR.'/user/'.$path.'/';
		
		$opts = array(
		//'debug' => true, 
			'roots' => array(
				  array( 
					'driver' => 'LocalFileSystem', 
					'path'   => $path, 
					'URL'    => base_url().$path,
					'accessControl' => 'access',
					'alias'  => $fullname,
					'attributes' => array(
						array(
							'pattern' => '!^/index.html!',
							'hidden' => true
						),array(
							'pattern' => '!^/.tmb!',
							'hidden' => true
						),array(
							'pattern' => '!^/.quarantine!',
							'hidden' => true
						)
					)
					
				  ) 
			)
		  );
	  }
	 
	  
	  $this->load->library('elfinder_lib', $opts);
	}
	
	function access($attr, $path, $data, $volume) {
		return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
    }

  
}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */