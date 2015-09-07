<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model {	
	
	/**
	 * Get all user listed as dentist
	 *
	 * @access public
	 * @return object all accounts
	 */
	function get_dentist()
	{
		$result =  $this->db->get('mailbox_configuration')->result();
		if(!empty($result)) return $result[0];
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

	
	//mail ================================================================
	function save_send_mail($flag=null, $to=null, $subject=null, $body=null, $attachment=null, $date=null, $group=null){
		$this->db->insert('mailbox', array('flag' => $flag, 'to' => $to, 'subject' => $subject, 'body' => $body, 'attachment' => $attachment, 'group'=>$group));
		return $this->db->insert_id();
	}
	
	// --------------------------------------------------------------------
	
	function delete_mail($id_mail){
		$this->db->delete('mailbox', array('id_mail' => $id_mail));
	}
	
	// --------------------------------------------------------------------
	
	function update_mail($id_mail, $flag=null, $to=null, $subject=null, $body=null, $attachment=null, $date=null, $group=null){
		$this->db->update('mailbox', array('flag' => $flag, 'to' => $to, 'subject' => $subject, 'body' => $body, 'attachment' => $attachment, 'group'=>$group), array('id_mail' => $id_mail));
	}
	
	// --------------------------------------------------------------------
}


/* End of file mailbox_model.php */
/* Location: ./application/account/models/mailbox_model.php */