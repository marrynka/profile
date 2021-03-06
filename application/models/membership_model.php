<?php
class Membership_model extends CI_Model
{
    
    function add_unique_session_id()
    {
		$this->db->where('session_id', $this->session->userdata('session_id'));
		$data = array(
					  'unique_session_id' => $this->session->userdata('session_id'),
						);
		$this->db->update('ci_sessions', $data);
		return $this->session->userdata('session_id');
	}
    function validate()
    {
      $this->db->where('username', $this->input->post('username'));
      $this->db->where('password', sha1($this->input->post('password')));
      
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
    function change_password($username, $password)
    {
		$this->db->where('username',$username);
		$data = array(
               'password' => sha1($password),
            );
		return $this->db->update('oauth_users',$s);
	}
    function is_available($username)
    {
		
		if($username == 'profile' ) return FALSE;
		$this->db->where('username',$username);
		$query = $this->db->get('oauth_users');
		if($query->num_rows >0) return FALSE;
		
		return TRUE;
		
	}
	function change_information($username)
	{
		$this->load->model('userprofile_model');
		$id = $this->userprofile_model->id($username);
		
		$new_member_data = array
		(
		'first_name' => $this->input->post('first_name') ,
		'surname' => $this->input->post('last_name') ,
		'email' => $this->input->post('email_address') ,
		'occupation' => $this->input->post('occupation'),
		'about_short' => $this->input->post('about_short') ,
		'about_long' => $this->input->post('about_long') ,
		);
    
    
		$this->db->where('id_user', $id);
		$insert= $this->db->update('profile_general',$new_member_data);
		if($insert != TRUE) return 'Some problem with database';
		return 'ok';
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
    'username' => $username,
    'occupation' => $this->input->post('occupation'),
    'about_short' => $this->input->post('about_short') ,
    'about_long' => $this->input->post('about_long') ,
    );
    
    
    $insert= $this->db->insert('profile_general',$new_member_data);
    if($insert != TRUE) return 'Some problem with database';
    //vytvorime priecienok s avatarom:
    mkdir(FCPATH.'images/users/'.$username);
    copy(FCPATH.'images/avatar.jpg' , FCPATH.'images/users/'.$username.'/avatar.jpg');
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
      
    function where_is_logged_in($user_id=null)
    {
		if($user_id == null)
		{
			 $user_id = $this->session->userdata('user_id');
		}
		$this->db->distinct();
		$this->db->select('client_id');
		$this->db->where('user_id', $user_id);
		$this->db->where('expires <=', 'CURRENT_TIMESTAMP');
		
		$query = $this->db->get('oauth_access_tokens');

		return $query;
	}
	function logout_all()
	{
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->delete('oauth_access_tokens');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->delete('oauth_refresh_tokens');
	}
	function logout_app($client_id)
	{	
		
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('client_id', $client_id);
		$this->db->delete('oauth_access_tokens');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('client_id', $client_id);
		$this->db->delete('oauth_refresh_tokens');
		
		
	}
	function get_redirect_uri($client_id)
	{
		
		$this->db->select('requests_uri');
		
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('oauth_clients');
		
		if($query->num_rows == 1)
        {
          foreach($query->result() as $row)
			{
			return $row->requests_uri;
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
