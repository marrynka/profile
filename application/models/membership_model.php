<?php
class Membership_model extends CI_Model
{
    function validate()
    {
      $this->db->where('username', $this->input->post('username'));
      $this->db->where('password',sha1($this->input->post('password')));
      
      $query = $this->db->get('oauth_users');
      if($query->num_rows == 1)
      {
          foreach($query->result() as $row)
	  {
	    return $row->id_user;
	  }
      }
      else return FALSE;
    }
    function create_member()
    {
    $new_member_data = array
    (
    'first_name' => $this->input->post('first_name') ,
    'last_name' => $this->input->post('last_name') ,
    'email_address' => $this->input->post('email_address') ,
    'username' => $this->input->post('username') ,
    'password' => md5($this->input->post('password')) ,
    );
    $insert= $this->db->insert('profile_general',$new_member_data);
    return $insert;
    }
    /**
     * Returns an array of all registered apps, with their home urls.
     */
     
    function get_apps()
    {
		$this->db->select('home_uri, client_id ');
		
		$query = $this->db->get('oauth_clients');

		if($query->num_rows > 0)
		return $query->result();
		else return FALSE;
	}  
     
    /**
     * Returns an array of apps where the user is logged in
     * 
     */
      
    function where_is_logged_in()
    {
		
		$this->db->distinct();
		$this->db->select('client_id');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		
		$query = $this->db->get('oauth_access_tokens');

		return $query;
	}
	function logout_all()
	{
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->delete('oauth_access_tokens');
	}
	function logout_app($client_id)
	{	
		echo "deleting";
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('client_id', $client_id);
		$this->db->delete('oauth_access_tokens');
		
	}
	function get_redirect_uri($client_id)
	{
		
		$this->db->select('logout_uri');
		
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('oauth_clients');
		
		if($query->num_rows == 1)
        {
          foreach($query->result() as $row)
	    {
	    return $row->logout_uri;
	    }
        }
	}
	function is_logged_in_app($client_id)
	{
		$this->db->select('client_id');
		
		$this->db->where('client_id', $client_id);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query = $this->db->get('oauth_access_tokens');
		if($query->num_rows > 0) return TRUE;
		return FALSE;

	}
}
?>
