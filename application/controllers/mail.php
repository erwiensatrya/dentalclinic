<?php

class Mail extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl', 'photo'));
		$this->load->library(array('account/authentication', 'form_validation', 'account/authorization'));
		$this->load->model(array('account/account_model','account/account_details_model'));
		$this->load->language(array('general', 'account/account_profile','mail'));
		
	}

	function index()
	{
		
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'mail'));
		}

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
		}
		$data['totalemail'] = 0;
		$data['totalunread'] = 0;		
			echo $this->is_connected();
		if($this->is_connected()){
			
		/*
		 Activate imap_open extension in Apache by doing the folowing
		 - open the file "\xampp\php\php.ini"
		 - removing the beginning semicolon at the line ";extension=php_imap.dll". 
		   Should be: extension=php_imap.dll
		 - removing the beginning semicolon at the line ";extension=php_openssl.dll". 
		   Should be: extension=php_openssl.dll
		*/
	
		$dns 		= "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
		$email 		= "ikhsanrasyidi@gmail.com";
		$password 	= "PELAJARAN.1";

		if ($inbox  = imap_open($dns,$email,$password)){
		
		$emails = imap_search($inbox,'ALL');
		$unread = imap_search($inbox,'UNSEEN');
		$data['totalemail'] = sizeof($emails);
		$data['totalunread'] = sizeof($unread);
		/*$check = imap_mailboxmsginfo($inbox);
			 
		echo "Date: "     . $check->Date    . "<br />\n" ;
		echo "Driver: "   . $check->Driver  . "<br />\n" ;
		echo "Unread: "   . $check->Unread  . "<br />\n" ;
		echo "Size: "     . $check->Size    . "<br />\n" ;*/
				
			if ($emails) {
				rsort($emails);
				$counter = 0;
				
				foreach($emails as $email_number) {
					$mail_row = array();

					//get information specific to this email 
					$overview = imap_fetch_overview($inbox,$email_number,0);
					//$message = imap_fetchbody($inbox,$email_number,2);
								
					$mail_row['status']			= $overview[0]->seen;
					$mail_row['subject']		= $overview[0]->subject;
					$mail_row['from']   		= $overview[0]->from;
					$mail_row['udate']   		= $this->time_elapsed_string($overview[0]->udate);
					$data['mail'][] 			= $mail_row;
					$counter++;
					if($counter >= 10 ){ break; };
				}

				//$msg = imap_fetchbody($inbox,1,"","FT_PEEK");

				/*
				$msgBody = imap_fetchbody ($inbox, $i, "2.1");
				if ($msgBody == "") {
				   $portNo = "2.1";
				   $msgBody = imap_fetchbody ($inbox, $i, $portNo);
				}

				$msgBody = trim(substr(quoted_printable_decode($msgBody), 0, 200));

				*/
				
				imap_close($inbox);
				
			} else {
				$data['error'] = "Failed reading messages!";
			}
				
		} else { 
			exit; $data['error'] = "Can't connect: " . imap_last_error() ."\n"." FAIL!\n";  
		}
		
		}
		
		$this->form_validation->set_rules(
			array(
				array('field' => 'mail_to', 'label' => 'lang:mail_to', 'rules' => 'trim|required|required|valid_email'), 
				array('field' => 'mail_subject', 'label' => 'lang:mail_subject', 'rules' => 'trim|required')
				));
				
		if($this->input->post('send_email') != null){$data['compose'] = true;}
		
		### Run form validation
		if ($this->form_validation->run())
		{
			$this->load->library('email'); // load email library
			$this->email->to($this->input->post('mail_to',TRUE));
			$this->email->subject($this->input->post('mail_subject',TRUE));
			$this->email->message($this->input->post('message',TRUE));
			//$this->email->cc($this->input->post('cc',TRUE));
			//$this->email->attach('/path/to/file1.png'); // attach file
			
				if ($this->email->send()){
					//redirect(base_url().'mail');
				}else{
					$data['error_send_email'] = "There is error in sending mail!";
				}
		}	
	
		$this->load->view('mail/mailbox', isset($data) ? $data : NULL);
	}

	function time_elapsed_string($ptime)
	{
		$etime = time() - $ptime;

		if ($etime < 1)
		{
			return '0 seconds';
		}

		$a = array( 365 * 24 * 60 * 60  =>  'year',
					 30 * 24 * 60 * 60  =>  'month',
						  24 * 60 * 60  =>  'day',
							   60 * 60  =>  'hour',
									60  =>  'minute',
									 1  =>  'second'
					);
		$a_plural = array( 'year'   => 'years',
						   'month'  => 'months',
						   'day'    => 'days',
						   'hour'   => 'hours',
						   'minute' => 'minutes',
						   'second' => 'seconds'
					);

		foreach ($a as $secs => $str)
		{
			$d = $etime / $secs;
			if ($d >= 1)
			{
				$r = round($d);
				return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
			}
		}
	}

	function is_connected()
	{
		$connected = @fsockopen("www.google.com", 80); 
											//website, port  (try 80 or 443)
		if ($connected){
			$is_conn = true; //action when connected
			fclose($connected);
		}else{
			$is_conn = false; //action in connection failure
		}
		return $is_conn;

	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */