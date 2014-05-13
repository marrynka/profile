<?php

class Client_model extends CI_Model
{
    /* returns an id of a consumer */
		public function __construct
		{
		  parent::__construct();
		  $this->load->library('client');
		}
		public function findByKey($key)
		{s
		      $this->db->where('client_key',$key);
		      $query = $this->db->get('authorization_clients');
		      
		      foreach($query->result() as $row)
		      {
		      
		      return new Client($row);
		      }
		      return;
		}
		function get_redirects_uri($client_id)
		{
			
		
		}
		/* Create in the DB a consumer with a given key & secret */
		public function create($key,$secret)
		{
		$data = array(
			      'client_key' => $key,
			      'client_secret' => $secret,
			      'active' => TRUE,
			      );
		$this->db->insert('authorization_clients', $data);
		}
		

		

		

}

?>
