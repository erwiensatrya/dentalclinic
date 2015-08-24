<?php

class Mail extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl', 'photo'));
		$this->load->library(array('account/authentication', 'form_validation', 'account/authorization','upload'));
		$this->load->model(array('account/mailbox_model','account/account_model','account/account_details_model'));
		$this->load->language(array('general', 'account/account_profile','mail'));
		
		$data = array();
		$address; $email; $password;
		$get;
		
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
			$this->data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
		}
		
		if($this->is_connected()){
			
			/*
			 Activate imap_open extension in Apache by doing the folowing
			 - open the file "\xampp\php\php.ini"
			 - removing the beginning semicolon at the line ";extension=php_imap.dll". 
			   Should be: extension=php_imap.dll
			 - removing the beginning semicolon at the line ";extension=php_openssl.dll". 
			   Should be: extension=php_openssl.dll
			*/
		
			$mailbox_settings = $this->mailbox_model->get();
			
			if(!empty($mailbox_settings)){
				
				$this->address 	= "{".$mailbox_settings->mail_server."}".$mailbox_settings->mailbox;
				$this->email 	= $mailbox_settings->email;
				$this->password = $mailbox_settings->password;

				if ($inbox  = imap_open($this->address,$this->email,$this->password, OP_READONLY)){
				
				$emails 			 		= imap_search($inbox,'ALL');
				$this->data['mailboxInfo'] 	= $this->getCurrentMailboxInfo($inbox,$this->address);
									
					if ($emails) {
						rsort($emails);
						$counter = 0;
								
						foreach($emails as $email_number) {
							$mail_row = array();
												
							$temp 						= $this->getMessage($inbox,$email_number,"false");
							$mail_row['id']				= $temp['id'];
							$mail_row['flagged']		= $temp['flagged'];
							$mail_row['unseen']			= $temp['unseen'];
							$mail_row['subject']		= $temp['subject'];
							$mail_row['from']   		= $temp['from'];
							$mail_row['udate']   		= $this->time_elapsed_string($temp['udate']);
							$mail_row['date']   		= $temp['date_sent'];
							$mail_row['attachments']   	= sizeof($temp['attachments']);
							$this->data['mail'][] 		= $mail_row;
							$counter++;
							if($counter >= 50 ){ break; };
						}
						$this->data['counter'] = $counter;
						imap_close($inbox);
						
					} else {
						$this->data['error'] = "Failed reading messages!";
					}
						
				} else { 
					exit; $this->data['error'] = "Can't connect: " . imap_last_error() ."\n"." FAIL!\n";  
				}
			
			}else{ $this->data['error'] = "Please do the Mailbox Configuration"; }
		}else{ $this->data['error'] = "No internet connection"; }
		
		$this->form_validation->set_rules(
			array(
				array('field' => 'mail_to', 'label' => 'lang:mail_to', 'rules' => 'trim|required|required|valid_email'), 
				array('field' => 'mail_subject', 'label' => 'lang:mail_subject', 'rules' => 'trim|required')
				));
		
		if($this->input->post('send_email')){$this->data['compose'] = true;}
		
		### Run form validation
		if ($this->form_validation->run())
		{
			$this->data['compose'] = true;
			$this->load->library('email'); // load email library
			$this->email->from('ikhsanrasyidi@gmail.com', 'DentalClinic');
			$this->email->to($this->input->post('mail_to',TRUE));
			$this->email->subject($this->input->post('mail_subject',TRUE));
			$this->email->message($this->input->post('message',TRUE));
			//$this->email->cc($this->input->post('cc',TRUE));
						
			 if (!empty($_FILES['attachment']['name'][0])) {
				
				$attachment_path = md5(uniqid(rand(), true));
				$files = $this->upload_files($attachment_path,$_FILES['attachment']);
                if ($files === FALSE) {
                    $this->data['error'] = $this->upload->display_errors();
                }else{
					foreach ($files as $idx){
						$this->email->attach(RES_DIR.'/img/'.$attachment_path.'/'.$idx); // attach file
					}
				}
            }                   

			if ($this->email->send()){
				$this->deleteAttachment(RES_DIR.'/img/'.$attachment_path);
				redirect(base_url().'mail');
			}else{
				$this->deleteAttachment(RES_DIR.'/img/'.$attachment_path);
				$this->data['error_send_email'] = "There is error in sending mail!";
			}
		}	
	
		$this->load->view('mail/mailbox', isset($this->data) ? $this->data : NULL);
	}
	/**
   * Read mail and set flas seen in mailbox from get value
   *
   * @param 
   *   subject
   *   date
   *
   * @return
   *   data (json string)
   *
   * @throws error message when fail reading email
   */
	function readMail(){
	
		maintain_ssl($this->config->item("ssl_enabled"));
		$this->load->library(array('account/authentication'));
		
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'dashboard'));
		}
		
		if($this->is_connected()){
			
			$this->load->model(array('account/mailbox_model','account/account_model','account/account_details_model'));
			
			/*
			 Activate imap_open extension in Apache by doing the folowing
			 - open the file "\xampp\php\php.ini"
			 - removing the beginning semicolon at the line ";extension=php_imap.dll". 
			   Should be: extension=php_imap.dll
			 - removing the beginning semicolon at the line ";extension=php_openssl.dll". 
			   Should be: extension=php_openssl.dll
			*/
			$mailbox_settings = $this->mailbox_model->get();
			
			if(!empty($mailbox_settings)){
				
				$this->address 	= "{".$mailbox_settings->mail_server."}".$mailbox_settings->mailbox;
				$this->email 	= $mailbox_settings->email;
				$this->password = $mailbox_settings->password;
								
				if ($inbox  = imap_open($this->address,$this->email,$this->password)){
				
				$url = parse_url($_SERVER['REQUEST_URI']);
				if (isset($url['query'])){
					parse_str($url['query'], $this->get);
					$id = 'SUBJECT "'.urldecode($this->get['subject']).'" ON "'.urldecode($this->get['date']).'"';
				}else{ $data['error'] = "Failed reading messages qualification!"; exit;}
				
				$emails = imap_search($inbox,$id);
					
					if ($emails) {
						rsort($emails);
										
						$temp 					= $this->getMessage($inbox,$emails[0],"true");
						imap_setflag_full($inbox, $emails[0], "\\Seen", ST_UID); 
						$data['id']				= $temp['id'];
						$data['unseen']			= $temp['unseen'];
						$data['subject']		= htmlentities(stripslashes(utf8_encode($temp['subject'])), ENT_QUOTES);
						$data['from']   		= htmlentities(stripslashes(utf8_encode($temp['from'])), ENT_QUOTES);
						$data['udate']   		= htmlentities(stripslashes(utf8_encode(date('d F Y H:i:s',$temp['udate']))), ENT_QUOTES);
						$data['message']   		= htmlentities(stripslashes(utf8_encode($temp['body'])), ENT_QUOTES);
						$data['attachments']   	= $temp['attachments'];
																
						imap_close($inbox);
						
					} else {
						$data['error'] = "Failed reading messages!";
					}
						
				} else { 
					exit; $data['error'] = "Can't connect: " . imap_last_error() ."\n"." FAIL!\n";  
				}
		
			}else{
				$data['error'] = "Error reading mailbox configuration!";
			}
			
		}else{
			$data['error'] = "Error no internet connection!";
		}
		if(empty($data)){$data['error'] = "Failed getting email";}
		//echo "<pre>";
		//print_r($data);
		echo json_encode($data, JSON_PRETTY_PRINT);
		//echo "</pre>";
	}
	
	/**
   * Set flag in message from get value
   *
   * @param 
   *   subject
   *   date
   *   flag
   *
   * @return
   *   status (string)
   *
   * @throws error message when fail to set flag
   */
	function setFlag(){
	
		maintain_ssl($this->config->item("ssl_enabled"));
		$this->load->library(array('account/authentication'));
		
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'dashboard'));
		}
		
		if($this->is_connected()){
			
			$this->load->model(array('account/mailbox_model','account/account_model','account/account_details_model'));
			
			/*
			 Activate imap_open extension in Apache by doing the folowing
			 - open the file "\xampp\php\php.ini"
			 - removing the beginning semicolon at the line ";extension=php_imap.dll". 
			   Should be: extension=php_imap.dll
			 - removing the beginning semicolon at the line ";extension=php_openssl.dll". 
			   Should be: extension=php_openssl.dll
			*/
			$mailbox_settings = $this->mailbox_model->get();
			
			if(!empty($mailbox_settings)){
				
				$this->address 	= "{".$mailbox_settings->mail_server."}".$mailbox_settings->mailbox;
				$this->email 	= $mailbox_settings->email;
				$this->password = $mailbox_settings->password;
								
				if ($inbox  = imap_open($this->address,$this->email,$this->password)){
				
				$url = parse_url($_SERVER['REQUEST_URI']);
				if (isset($url['query'])){
					parse_str($url['query'], $this->get);
					$id = 'SUBJECT "'.urldecode($this->get['subject']).'" ON "'.urldecode($this->get['date']).'"';
				}else{ $data['error'] = "Failed reading messages qualification!"; exit;}
				
				$emails = imap_search($inbox,$id);
					
					if ($emails) {
						if($this->get['action']=="true"){
							imap_setflag_full($inbox, $emails[0], "\\".$this->get['flag'], ST_UID);
						}else{
							imap_clearflag_full($inbox, $emails[0], "\\".$this->get['flag'], ST_UID);
						}						
						
						imap_close($inbox);
						
					} else {
						$data['error'] = "Failed reading messages here!";
					}
						
				} else { 
					exit; $data['error'] = "Can't connect: " . imap_last_error() ."\n"." FAIL!\n";  
				}
		
			}else{
				$data['error'] = "Error reading mailbox configuration!";
			}
			
		}else{
			$data['error'] = "Error no internet connection!";
		}
		//if(empty($data)){$data['error'] = "Failed getting email";}
	
		//echo json_encode($data, JSON_PRETTY_PRINT);
	}
	
	/**
   * Get elapsed time from time() - $ptime
   *
   * @param 
   *   $ptime
   *
   * @return 
   *   elapsed time (string)
   */
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

	/**
   * Check if there is internet connection
   *
   * @return
   *   $is_con (boolean)
   */
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
	
	/**
   * upload file to the respective path, if folder(path) dosen't exist create the folder
   *
   * @param 
   *   $attachment_path
   *   $files
   *
   * @return
   * images (array)
   *
   */
	 private function upload_files($attachment_path,$files)
    {
		if (!file_exists(RES_DIR."/img/".$attachment_path)) {
			mkdir(RES_DIR."/img/".$attachment_path);
		}
		
        $config = array(
            'upload_path'   => RES_DIR.'/img/'.$attachment_path,
			'allowed_types' => '*',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }
	
	/**
   * Delete recursively folder & file in it (temporary attachment files)
   *
   * @param 
   *   $path
   *
   * @return
   * false (boolean)
   *
   */
	function deleteAttachment($path)
	{
		if (is_dir($path) === true)
		{
			$files = array_diff(scandir($path), array('.', '..'));

			foreach ($files as $file)
			{
				Delete(realpath($path) . '/' . $file);
			}

			return rmdir($path);
		}

		else if (is_file($path) === true)
		{
			return unlink($path);
		}

		return false;
	}
	    
	/**
   * Returns an associative array with detailed information about a given
   * message.
   *
   * @param $messageId (int)
   *   Message id.
   *
   * @return Associative array with keys (strings unless otherwise noted):
   *   raw_header
   *   to
   *   from
   *   cc
   *   bcc
   *   reply_to
   *   sender
   *   date_sent
   *   subject
   *   deleted (bool)
   *   answered (bool)
   *   draft (bool)
   *   body
   *   original_encoding
   *   size (int)
   *   auto_response (bool)
   *
   * @throws Exception when message with given id can't be found.
   */
  function getMessage($inbox,$messageId,$action=null) {
    $this->tickle($inbox);

    // Get message details.
    $details = imap_headerinfo($inbox, $messageId);
    if ($details) {
      // Get the raw headers.
      $raw_header = imap_fetchheader($inbox, $messageId);

      // Detect whether the message is an autoresponse.
      $autoresponse = $this->detectAutoresponder($raw_header);

      // Get some basic variables.
      $deleted = ($details->Deleted == 'D');
      $answered = ($details->Answered == 'A');
      $draft = ($details->Draft == 'X');
      $unseen = ($details->Unseen == 'U');
      $flagged = ($details->Flagged == 'F');
	  
	  if($action == "true"){ // get body only when read the email message
		  // Get the message body & set status to read
		  $body = imap_fetchbody($inbox, $messageId, 1.2);
		  if (!strlen($body) > 0) {
			$body = imap_fetchbody($inbox, $messageId, 1);
		  }  
	  	  
		  // Get the message body without set status read
		  $body = imap_fetchbody($inbox, $messageId, 1.2, FT_PEEK);
		  if (!strlen($body) > 0) {
			$body = imap_fetchbody($inbox, $messageId, 1, FT_PEEK);
		  }
	  
		  // Get the message body encoding.
		  $encoding = $this->getEncodingType($inbox,$messageId,null);

		  // Decode body into plaintext (8bit, 7bit, and binary are exempt).
		  if ($encoding == 'BASE64') {
			$body = imap_base64($body);
		  }
		  elseif ($encoding == 'QUOTED-PRINTABLE') {
			$body = quoted_printable_decode($body);
		  }
		  elseif ($encoding == '8BIT') {
			$body = quoted_printable_decode(imap_8bit($body));
		  }
		  elseif ($encoding == '7BIT') {
			$body = $this->decode7Bit($body);
		  }
	  }else{ $body = null; }
	
      // Build the message.
      $message = array(
	    'id'=>$messageId,
        //'raw_header' => $raw_header,
        'to' => $details->toaddress,
        'from' => $details->fromaddress,
        'cc' => isset($details->ccaddress) ? $details->ccaddress : '',
        'bcc' => isset($details->bccaddress) ? $details->bccaddress : '',
        'reply_to' => isset($details->reply_toaddress) ? $details->reply_toaddress : '',
        'sender' => $details->senderaddress,
        'date_sent' => $details->date,
        'udate' => $details->udate,
        'subject' => $details->subject,
        'deleted' => $deleted,
        'answered' => $answered,
        'unseen' => $unseen,
        'flagged' => $flagged,
        'draft' => $draft,
        'body' => $body,
        //'original_encoding' => $encoding,
        'size' => $details->Size,
        'auto_response' => $autoresponse,
		'attachments' => $this->getAttachment($inbox, $messageId, $action)
      );
	  
    }
    else {
      //throw new Exception("Message could not be found: " . imap_last_error());
	$this->data['error'] ="Message could not be found: " . imap_last_error();
	}

    return $message;
  }
  
  /*Get Attachment Info*/
  function getAttachment($inbox, $messageId, $action=null){

	$structure = imap_fetchstructure($inbox, $messageId);
	//echo "<pre>";
	//print_r($structure);
	//echo "<pre>=======================================";
	$attachments = array();
	if(isset($structure->parts) && count($structure->parts)) {

		for($i = 0; $i < count($structure->parts); $i++) {

			$attachments[$i] = array(
				'is_attachment' => false,
				'filename' => '',
				'name' => '',
				'attachment' => '',
				'icon' => '',
				'size' => ''
			);
			
			if($structure->parts[$i]->ifdparameters) {
				foreach($structure->parts[$i]->dparameters as $object) {
					if(strtolower($object->attribute) == 'filename') {
						$attachments[$i]['is_attachment'] = true;
						$attachments[$i]['filename'] = $object->value;
						//$attachments[$i]['extension'] = pathinfo($object->value, PATHINFO_EXTENSION);
						$attachments[$i]['icon'] = $this->getIcon(pathinfo($object->value, PATHINFO_EXTENSION));
						$attachments[$i]['size'] = $this->humanFileSize($structure->parts[$i]->bytes);
					}
				}
			}
			
			if($structure->parts[$i]->ifparameters) {
				foreach($structure->parts[$i]->parameters as $object) {
					if(strtolower($object->attribute) == 'name') {
						$attachments[$i]['is_attachment'] = true;
						$attachments[$i]['name'] = $object->value;
						//$attachments[$i]['extension'] = pathinfo($object->value, PATHINFO_EXTENSION);
						$attachments[$i]['icon'] = $this->getIcon(pathinfo($object->value, PATHINFO_EXTENSION));
						$attachments[$i]['size'] = $this->humanFileSize($structure->parts[$i]->bytes);
					}
				}
			}
			
			if(!($attachments[$i]['is_attachment'])) {
				unset($attachments[$i]);
			}else{
			
			if(($action !== "true")&&($action !== "false")){
				if($attachments[$i]['is_attachment']) {
					$attachments[$i]['attachment'] = imap_fetchbody($inbox, $messageId, $i+1);
					if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
						$attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
					}
					elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
						$attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
					}
				}
			}
			}
			
			
		} return array_values($attachments);
	}
  }
  
  /*Get Attachment icon based on extension*/
  function getIcon($icon){
	$icon = strtolower(trim($icon));
	switch(true){
		case (($icon == "jpg")||($icon == "png")||($icon == "ico")): return "fa-file-image-o"; break;
		case (($icon == "mp3")||($icon == "wav")): return "fa-file-audio-o"; break;
		case (($icon == "mkv")||($icon == "avi")): return "fa-file-video-o"; break;
		case (($icon == "doc")||($icon == "docx")): return "fa-file-word-o"; break;
		case (($icon == "xls")||($icon == "xlsx")): return "fa-file-excel-o"; break;
		case (($icon == "ppt")||($icon == "pptx")): return "fa-file-powerpoint-o"; break;
		case (($icon == "rar")||($icon == "zip")||($icon == "7z")||($icon == "gzip")||($icon == "tar")): return "fa-file-archive-o"; break;
		case (($icon == "txt")||($icon == "log")||($icon == "def")||($icon == "properties")): return "fa-file-text"; break;
		case (($icon == "pdf")): return "fa-file-pdf-o"; break;
		default: return " fa-file-o";
	}
  }
  
  /*Get human file zise name*/
  function humanFileSize($size,$unit="") {
	  if( (!$unit && $size >= 1<<30) || $unit == "GB")
		return number_format($size/(1<<30),2)."GB";
	  if( (!$unit && $size >= 1<<20) || $unit == "MB")
		return number_format($size/(1<<20),2)."MB";
	  if( (!$unit && $size >= 1<<10) || $unit == "KB")
		return number_format($size/(1<<10),2)."KB";
	  return number_format($size)." bytes";
  }
  
  /*Download Attachment*/
  function downloadAttachment(){
  
	maintain_ssl($this->config->item("ssl_enabled"));
	$this->load->library(array('account/authentication'));
	
	if ( ! $this->authentication->is_signed_in())
	{
		redirect('account/sign_in/?continue='.urlencode(base_url().'dashboard'));
	}
	
	if($this->is_connected()){
		
		$this->load->model(array('account/mailbox_model','account/account_model','account/account_details_model'));
		
		/*
		 Activate imap_open extension in Apache by doing the folowing
		 - open the file "\xampp\php\php.ini"
		 - removing the beginning semicolon at the line ";extension=php_imap.dll". 
		   Should be: extension=php_imap.dll
		 - removing the beginning semicolon at the line ";extension=php_openssl.dll". 
		   Should be: extension=php_openssl.dll
		*/
		$mailbox_settings = $this->mailbox_model->get();
		
		if(!empty($mailbox_settings)){
			
			$this->address 	= "{".$mailbox_settings->mail_server."}".$mailbox_settings->mailbox;
			$this->email 	= $mailbox_settings->email;
			$this->password = $mailbox_settings->password;
							
			if ($inbox  = imap_open($this->address,$this->email,$this->password)){
			
			$url = parse_url($_SERVER['REQUEST_URI']);
			if (isset($url['query'])){
				parse_str($url['query'], $this->get);
				$id = 'SUBJECT "'.urldecode($this->get['subject']).'" ON "'.urldecode($this->get['date']).'"';
			}else{ $data['error'] = "Failed reading messages qualification!"; exit;}
			
			$emails = imap_search($inbox,$id);
						
				if ($emails) {
					rsort($emails);
					$data = $this->getAttachment($inbox, $emails[0],$this->get['file']); 		
					   															
					imap_close($inbox);
					
				} else {
					$data['error'] = "Failed reading messages!";
				}
					
			} else { 
				exit; $data['error'] = "Can't connect: " . imap_last_error() ."\n"." FAIL!\n";  
			}
	
		}else{
			$data['error'] = "Error reading mailbox configuration!";
		}
		
	}else{
		$data['error'] = "Error no internet connection!";
	}
	if(empty($data)){$data['error'] = "Failed getting email";}
	
	foreach ($data as $id){
		if($id['filename'] == $this->get['file']){
			$attachment_path = md5(uniqid(rand(), true));
			if (!file_exists(RES_DIR."/img/".$attachment_path)) {
				mkdir(RES_DIR."/img/".$attachment_path);
			}
			file_put_contents(RES_DIR."/img/".$attachment_path."/".$id['filename'], $id['attachment']);
			
			header("Content-Type: application/octet-stream");
			header("Content-Transfer-Encoding: Binary");
			header("Content-disposition: attachment; filename=\"".$id['filename']."\""); 
			readfile(base_url().RES_DIR."/img/".$attachment_path."/".$id['filename']);
			
			unlink(RES_DIR."/img/".$attachment_path."/".$id['filename']);
			rmdir(RES_DIR."/img/".$attachment_path);
			
		}
	}
	
	//echo "</pre>";

  }
  
  /**
   * Decodes 7-Bit text.
   *
   * PHP seems to think that most emails are 7BIT-encoded, therefore this
   * decoding method assumes that text passed through may actually be base64-
   * encoded, quoted-printable encoded, or just plain text. Instead of passing
   * the email directly through a particular decoding function, this method
   * runs through a bunch of common encoding schemes to try to decode everything
   * and simply end up with something *resembling* plain text.
   *
   * Results are not guaranteed, but it's pretty good at what it does.
   *
   * @param $text (string)
   *   7-Bit text to convert.
   *
   * @return (string)
   *   Decoded text.
   */
  function decode7Bit($text) {
    // If there are no spaces on the first line, assume that the body is
    // actually base64-encoded, and decode it.
    $lines = explode("\r\n", $text);
    $first_line_words = explode(' ', $lines[0]);
    if ($first_line_words[0] == $lines[0]) {
      $text = base64_decode($text);
    }

    // Manually convert common encoded characters into their UTF-8 equivalents.
    $characters = array(
      '=20' => ' ', // space.
      '=2C' => ',', // comma.
      '=E2=80=99' => "'", // single quote.
      '=0A' => "\r\n", // line break.
      '=0D' => "\r\n", // carriage return.
      '=A0' => ' ', // non-breaking space.
      '=B9' => '$sup1', // 1 superscript.
      '=C2=A0' => ' ', // non-breaking space.
      "=\r\n" => '', // joined line.
      '=E2=80=A6' => '&hellip;', // ellipsis.
      '=E2=80=A2' => '&bull;', // bullet.
      '=E2=80=93' => '&ndash;', // en dash.
      '=E2=80=94' => '&mdash;', // em dash.
    );

    // Loop through the encoded characters and replace any that are found.
    foreach ($characters as $key => $value) {
      $text = str_replace($key, $value, $text);
    }

    return $text;
  }
  
  /**
   * Determines whether the given message is from an auto-responder.
   *
   * This method checks whether the header contains any auto response headers as
   * outlined in RFC 3834, and also checks to see if the subject line contains
   * certain strings set by different email providers to indicate an automatic
   * response.
   *
   * @see http://tools.ietf.org/html/rfc3834
   *
   * @param $header (string)
   *   Message header as returned by imap_fetchheader().
   *
   * @return (bool)
   *   TRUE if this message comes from an autoresponder.
   */
  function detectAutoresponder($header) {
    $autoresponder_strings = array(
      'X-Autoresponse:', // Other email servers.
      'X-Autorespond:', // LogSat server.
      'Subject: Auto Response', // Yahoo mail.
      'Out of office', // Generic.
      'Out of the office', // Generic.
      'out of the office', // Generic.
      'Auto-reply', // Generic.
      'Autoreply', // Generic.
      'autoreply', // Generic.
    );

    // Check for presence of different autoresponder strings.
    foreach ($autoresponder_strings as $string) {
      if (strpos($header, $string) !== false) {
        return true;
      }
    }

    return false;
  }
	
	/**
   * Returns the encoding type of a given $messageId.
   *
   * @param $messageId (int)
   *   Message id.
   * @param $numeric (bool)
   *   Set to true for a numerical encoding type.
   *
   * @return (mixed)
   *   Integer value of body type if numeric, string if not numeric.
   */
  function getEncodingType($inbox,$messageId, $numeric = false) {
    // See imap_fetchstructure() documentation for explanation.
    $encodings = array(
      0 => '7BIT',
      1 => '8BIT',
      2 => 'BINARY',
      3 => 'BASE64',
      4 => 'QUOTED-PRINTABLE',
      5 => 'OTHER',
    );

    // Get the structure of the message.
    $structure = imap_fetchstructure($inbox, $messageId);;

    // Return a number or a string, depending on the $numeric value.
    if ($numeric) {
      return $structure->encoding;
    } else {
      return $encodings[$structure->encoding];
    }
  }
  
  /**
   * Deletes an email matching the specified $messageId.
   *
   * @param $messageId (int)
   *   Message id.
   * @param $immediate (bool)
   *   Set TRUE if message should be deleted immediately. Otherwise, message
   *   will not be deleted until disconnect() is called. Normally, this is a
   *   bad idea, as other message ids will change if a message is deleted.
   *
   * @return (empty)
   *
   * @throws Exception when message can't be deleted.
   */
  function deleteMessage($inbox, $messageId, $immediate = FALSE) {
    $this->tickle($inbox);

    // Mark message for deletion.
    if (!imap_delete($inbox, $messageId)) {
      //throw new Exception("Message could not be deleted: " . imap_last_error());
		$this->data['error'] = "Message could not be deleted: ".imap_last_error();
	}

    // Immediately delete the message if $immediate is TRUE.
    if ($immediate) {
      imap_expunge($inbox);
    }
  }
  
   /**
   * Moves an email into the given mailbox.
   *
   * @param $messageId (int)
   *   Message id.
   * @param $folder (string)
   *   The name of the folder (mailbox) into which messages should be moved.
   *   $folder could either be the folder name or 'INBOX.foldername'.
   *
   * @return (bool)
   *   Returns TRUE on success, FALSE on failure.
   */
  function moveMessage($inbox, $messageId, $folder) {
    $messageRange = $messageId . ':' . $messageId;
    return imap_mail_move($inbox, $messageRange, '{sslmail.webguyz.net:143/imap}Questionable');
  }
  
  /**
   * Return an associative array containing the number of recent, unread, and
   * total messages.
   *
   * @return Associative array with keys:
   *   unread
   *   recent
   *   total
   */
  function getCurrentMailboxInfo($inbox,$address) {
    $this->tickle($inbox);

    // Get general mailbox information.
    $info = imap_status($inbox, $address, SA_ALL);
    $mailInfo = array(
      'unread' => $info->unseen,
      'recent' => $info->recent,
      'total' => $info->messages,
    );
    return $mailInfo;
  }
  
  /**
   * Reconnect to the IMAP server.
   *
   * @return (empty)
   *
   * @throws Exception when IMAP can't reconnect.
   */
  function reconnect($inbox) {
    $inbox = imap_open($this->address, $this->user, $this->pass, OP_READONLY);
    if (!$inbox) {
      //throw new Exception("Reconnection Failure: " . imap_last_error());
	  $this->data['error'] = "Reconnection Failure: " . imap_last_error();
    }
  }

  /**
   * Checks to see if the connection is alive. If not, reconnects to server.
   *
   * @return (empty)
   */
  function tickle($inbox) {
    if (!imap_ping($inbox)) {
        $this->reconnect;
    }
  }
  
}


/* End of file mail.php */
/* Location: ./system/application/controllers/mail.php */