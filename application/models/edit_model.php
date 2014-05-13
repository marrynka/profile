<?php

Class edit_model extends CI_Model
{
	  function __construct()
	  {
		   parent::__construct();
		  $this->load->helper('directory');
	  }
	  function is_permitted()
	  {
		  $id = $this->session->userdata('user_id');
		  $this->db->where('id_user', $id);
		  $this->db->where('role', 1);
		  $query = $this->db->get('profile_roles');
		  if($query->num_rows > 0) return TRUE;
		  return FALSE;
	  }
      function list_clients()
      {
          $query  = $this->db->get('oauth_clients');
          return $query->result();
      }
      function list_activities()
      {
          $query  = $this->db->get('profile_activity_types');
          return $query->result();
      }
      function list_achievements()
      {
          $query  = $this->db->get('profile_achievement_types');
          return $query->result();
      }
      function list_badges()
      {
          $query  = $this->db->get('profile_badge_types');
          return $query->result();
      }
      function list_pictures_for_achievements()
      {
           $strpath = FCPATH.'images/files/achievements' ;
           $map = directory_map($strpath,1);
           
          
           return $map;
      }
      function list_pictures_for_badges()
      {
           $strpath = FCPATH.'images/files/badges' ;
           $map = directory_map($strpath,1);
           
           return $map;
      }
                                                
      function get_achievements_pictures_directory()
      {
           return base_url().'images/files/achievements';
      }
      function get_badges_pictures_directory()
      {
           return base_url().'images/files/badges';
      }
      
      
      function add_client()
      {
        $data = array(
            'client_id' => $this->input->post('client_id'),
            'client_secret' => $this->input->post('client_secret'),
            'home_uri' => $this->input->post('home_uri'),
            'requests_uri' => $this->input->post('requests_uri'),
            'redirect_uri' => $this->input->post('redirect_uri'),
            
            
             );
            
       return $this->db->insert('oauth_clients',$data);
       
      }
      function add_activity_type($id_client, $activity_title)
      {
        $data = array(
            'client_id' => $id_client,
            'activity_title' => $activity_title );
            
        $this->db->insert('profile_activity_types',$data);
        $this->db->where('activity_title', $activity_title);
        $id = $this->db->get('profile_activity_types');
        foreach ($id->result() as $row)
         {return $row->client_id;}
      }
      function add_achievement_type($achievement_title, $achievement_description, $achievement_max, $achievement_picture)
    
      {
        $data = array(
            
            'achievement_title' => $achievement_title,
            'achievement_description' => $achievement_description,
             'max' => $achievement_max,
             'picture' =>$achievement_picture,
             );
            
        $this->db->insert('profile_achievement_types',$data);
        $this->db->where('achievement_title', $achievement_title);
        $id = $this->db->get('profile_achievement_types');
        foreach ($id->result() as $row)
         {return $row->achievement_type;}
      }
      function add_badge_type($badge_title, $badge_description, $badge_picture)
    
      {
        $data = array(
            
            'badge_title' => $badge_title,
            'badge_description' => $badge_description,
            'picture' => $badge_picture,
             );
           
        $this->db->insert('profile_badge_types',$data);
        $this->db->where('badge_title', $badge_title);
        $id = $this->db->get('profile_badge_types');
        foreach ($id->result() as $row)
         {return $row->badge_type;}
      }
      function delete_achievement_type($id_achievement)
      {
        $this->db->where('achievement_type', $id_achievement);
        $this->db->delete('profile_achievement_types');
      }
      function delete_badge_type($id_badge)
      {
        $this->db->where('badge_type', $id_badge);
        $this->db->delete('profile_badge_types');
      }
      function delete_activity_type($id_activity)
      {
        $this->db->where('activity_type', $id_activity);
        $this->db->delete('profile_activity_types');
      }
      
      function delete_source($id_source)
      {
        $this->db->where('id_source', $id_source);
        $this->db->delete('profile_source_types');
      }

}

?>
