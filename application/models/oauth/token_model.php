<?php
class Token_model extends CI_Model
{
	
	
	function get_username_and_user_id_to_access_token($access_token)
	{
		$this->db->select('user_id');
		$this->db->where('access_token', $access_token);
		$query = $this->db->get('oauth_access_tokens');
		$this->load->model('userprofile_model');
		foreach($query->result() as $row)
		{
			$data = array(
							'id_user' => $row->user_id,
							'username' => $this->userprofile_model->username($row->user_id),
						);
		    return $data;
		}
		return array();
		
	}
	function assign_session_to_access_and_refresh_token($session_id,$access, $refresh)
	{
		$this->db->where('access_token', $access);
		
		$query = $this->db->get('oauth_access_tokens');
		foreach($query->result() as $row)
		{
			$data = array(
			'unique_session_id'=> $session_id,
			'expires' =>$row->expires,
			);
			break;
		}
		
		$this->db->where('access_token', $access);
		
		$this->db->update('oauth_access_tokens', $data);
		
		
		$this->db->where('refresh_token', $refresh);
		
		$query = $this->db->get('oauth_refresh_tokens');
		foreach($query->result() as $row)
		{
			$data = array(
			'unique_session_id'=> $session_id,
			'expires' =>$row->expires,
			);
			break;
		}
		
		$this->db->where('refresh_token', $refresh);
		
		$this->db->update('oauth_refresh_tokens', $data);
		
	}
	function get_unique_session_id_to_refresh_token($refresh)
	{
		
		$this->db->select('unique_session_id');
		$this->db->where('refresh_token', $refresh);
		
		$query = $this->db->get('oauth_refresh_tokens');
		foreach($query->result() as $row)
		{
			return $row->unique_session_id;
		}
		
	
	}
	function get_unique_session_id_to_access_token($access)
	{
		
		$this->db->select('unique_session_id');
		$this->db->where('access_token', $access);
		
		$query = $this->db->get('oauth_access_tokens');
		foreach($query->result() as $row)
		{
			return $row->unique_session_id;
		}
		
	
	}
	
	function get_unique_session_id_to_authorization_code($code)
	{
		
		$this->db->select('unique_session_id');
		$this->db->where('authorization_code', $code);
		
		$query = $this->db->get('oauth_authorization_codes');
		foreach($query->result() as $row)
		{
			return $row->unique_session_id;
		}
		
	
	}
	function assign_session_to_authorization_code($session_id, $code)
	{
		
		$this->db->where('authorization_code', $code);
		
		$query = $this->db->get('oauth_authorization_codes');
		foreach($query->result() as $row)
		{
			$data = array(
			'unique_session_id'=> $session_id,
			'expires' =>$row->expires,
			);
			break;
		}
		
		$this->db->where('authorization_code', $code);
		
		$this->db->update('oauth_authorization_codes', $data);
		
	}
	function user_to_authorization_code($code)
	{
		$this->db->select('user_id');
		$this->db->where('authorization_code', $code);
		$query = $this->db->get('oauth_authorization_codes');
		foreach($query->result() as $row)
		{
			return $row->user_id;
		}
	}
	
	function update_last_activity($session_id, $time)
	{
		$this->db->where('unique_session_id', $session_id);
		$data = array(
		'last_activity' => $time
	    );
	    $this->db->update('ci_sessions', $data);
		
	}
}
?>
