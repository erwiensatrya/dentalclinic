<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox_model extends CI_Model {	
	
	/**
	 * Get all mail configuration
	 *
	 * @access public
	 * @return object all accounts
	 */
	function get()
	{
		return $this->db->get('mailbox_configuration')->result()[0];
	}

	/**
	 * Create a mail configuration
	 *
	 * @access public
	 * @param string $username
	 * @param string $hashed_password
	 * @return int insert id
	 */
	function create($name, $email, $password, $mail_server, $mailbox)
	{
		$this->db->insert('mailbox_configuration', array('name' => $name, 'email' => $email, 'password' => $password, 'mail_server' => $mail_server,'mailbox' => $mailbox));
		return $this->db->insert_id();
	}

	// --------------------------------------------------------------------

	/**
	 * Change mail configuration
	 *
	 * @access public
	 * @param int $account_id
	 * @param int $new_username
	 * @return void
	 */
	function update($name, $email, $password, $mail_server, $mailbox)
	{
		$this->db->update('mailbox_configuration', array('name' => $name, 'email' => $email, 'password' => $password, 'mail_server' => $mail_server,'mailbox' => $mailbox), array('id_conf' => 1));
	}

	// --------------------------------------------------------------------

}


/* End of file mailbox_model.php */
/* Location: ./application/account/models/mailbox_model.php */