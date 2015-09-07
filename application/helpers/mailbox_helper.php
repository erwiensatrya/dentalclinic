<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * Get status of mailbox
	 * @return array mailbox status
	 */
	if(! function_exists("mailInfo")){
	function mailInfo()
	{
		if(is_connected()){
		 
			$CI = get_instance();

			// You may need to load the model if it hasn't been pre-loaded
			$CI->load->model('account/mailbox_model');

			// Call a function of the model
			//$CI->mailbox->do_something();       
			
			$mailbox_settings = $CI->mailbox_model->get();
			
			if(!empty($mailbox_settings)){
						
				$address 	= "{".$mailbox_settings->mail_server."}".$mailbox_settings->mailbox;
				$email 		= $mailbox_settings->email;
				$password 	= $mailbox_settings->password;

				if ($inbox  = imap_open($address,$email,$password, OP_READONLY)){
							
					// Get general mailbox information.
					$info = imap_status($inbox, $address, SA_ALL);
					$mailInfo = array(
					  'unread' => $info->unseen,
					  'recent' => $info->recent,
					  'total' => $info->messages,
					);
					return $mailInfo;
				  
				}
			}
		}
	}
	}

/**
   * Check if there is internet connection
   *
   * @return
   *   $is_con (boolean)
   */
   if(! function_exists("is_connected")){
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

