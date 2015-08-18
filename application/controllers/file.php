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
		$this->load->view('file_', isset($this->data) ? $this->data : NULL);
	}
	
	function scan($dir,$action=TRUE){
		$dir =  RES_DIR.'/user/'.$dir;
		$files = array();

		// Is there actually such a folder/file?

		if(file_exists($dir)){
		
			foreach(scandir($dir) as $f) {
			
				if(!$f || $f[0] == '.') {
					continue; // Ignore hidden files
				}

				if(is_dir($dir . '/' . $f)) {

					// The path is a folder

					$files[] = array(
						"name" => $f,
						"type" => "folder",
						"path" => $dir . '/' . $f,
						"items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
					);
				}
				
				else {

					// It is a file

					$files[] = array(
						"name" => $f,
						"type" => "file",
						"path" => $dir . '/' . $f,
						"size" => filesize($dir . '/' . $f) // Gets the size of this file
					);
				}
			}
		
		}else{
			$this->data['error'] =  "file/folder ".$dir." not found";
		}

		if($action){
			
			header('Content-type: application/json');

			echo json_encode(array(
				"name" => "files",
				"type" => "folder",
				"path" => $dir,
				"items" => $files
			));
		}else{
			return $files;
		}
	}
	
	function elfinder_init($path=null)
	{
	  if($path = 1){
		$path = RES_DIR.'/user/';
	  }else{
		$path = RES_DIR.'/user/'.$this->session->userdata('account_id');
	  }
	  $this->load->helper('path');
	  $opts = array(
		// 'debug' => true, 
		'roots' => array(
		  array( 
			'driver' => 'LocalFileSystem', 
			'path'   => set_realpath($path), 
			'URL'    => site_url($path) . '/'
			//'path'   => './myfile', 
			//'URL'    => base_url('myfile') . '/'
			// more elFinder options here
		  ) 
		)
	  );
	  $this->load->library('elfinder_lib', $opts);
	}
}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */