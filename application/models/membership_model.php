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
    function is_available($username)
    {
		
		$this->db->where('username',$username);
		$query = $this->db->get('oauth_users');
		if($query->num_rows >0) return FALSE;
		
		return TRUE;
		
	}
    function create_member()
    {
		//check if the username is not already used
		$username = $this->input->post('username');
		if(!($this->is_available($username)))
		{ 
			
			return 'Username already used';
		}
    $new_oauth_user_data = array
    (
		'username' => $username,
		'password' => sha1($this->input->post('password')),
    );
    $insert = $this->db->insert('oauth_users', $new_oauth_user_data);
    if($insert != TRUE) return 'Some problem with database';
    $this->load->model('userprofile_model');
    $id = $this->userprofile_model->id($username);
    
    $new_member_data = array
    (
    'id_user' => $id ,
    'first_name' => $this->input->post('first_name') ,
    'surname' => $this->input->post('last_name') ,
    'email' => $this->input->post('email_address') ,
    'username' => $this->input->post('username') ,
    'occupation' => $this->input->post('occupation'),
    'about_short' => $this->input->post('about_short') ,
    'about_long' => $this->input->post('about_long') ,
    );
    
    
    $insert= $this->db->insert('profile_general',$new_member_data);
    if($insert != TRUE) return 'Some problem with database';
    return 'ok';
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
