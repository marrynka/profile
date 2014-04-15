<?php
class Userprofile_model extends CI_Model
{
      /**FUNCTIONS FOR PROFILE.MATFYZ.SK PART
      */
      function id($username)
      {
		  $this->db->select('id_user');
		  $this->db->where('username', $username);
		  $query = $this->db->get('oauth_users');
		  if($query->num_rows == 1)
		  {
			  foreach($query->result() as $row)
			  {
				  return $row->id_user;
			  }
		  }
	  }
      function all($username)
      {
           $this->db->where('username',$username);
           $query = $this->db->get('profile_general');
           
          foreach($query->result() as $row)
          {
          
           return $row;
          }
      }
      function about($username)
      {  
         $this->db->select('first_name, surname, username, about_long, about_short, occupation, email');
         $this->db->where('username',$username);   
         $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return $row;
          }
          
          
  
      }
      function general($username)
      {  $user_id = $this->id($username);
         $this->db->select('profile_activities.activity, profile_activities.activity_type, profile_activities.time, profile_activity_types.client_id');
         $this->db->from('profile_activities');
         $this->db->join('profile_activity_types','profile_activity_types.activity_type = profile_activities.activity_type');
         
         $this->db->where('profile_activities.id_user',$user_id);
         $this->db->order_by('time', 'desc');   
         $query = $this->db->get();
         
         
         if($query->num_rows > 0)
         return $query->result();
         return null;
          
          
  
      }
      
      /**
      FUNCTIONS FOR EXTERNAL API FOR OTHER APPLICATIONS
      */
      function get_firstname($id_user)
      {	
	  $this->db->select('first_name');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return $row->first_name;
          }
	
      }

      function get_surname($id_user)
      {
	  $this->db->select('surname');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return $row->surname;
          }
      }
      function get_whole_name($id_user)
      {
	  $this->db->select('first_name surname');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return $row->first_name. " ". $row->surname;
          }
      }
      function get_photo($id_user)
      {
	  $this->db->select('username');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('oauth_users');
         
         
          foreach($query->result() as $row)
          {
	    //way to the picture
            return base_url().'/images/users/'.$row->username.'/avatar.jpg'; 
          }
      }
      function get_about($id_user)
      {
	  $this->db->select('about_short');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return $row->about_short;
          }
      }
      function get_email($id_user)
      {
	  $this->db->select('email');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return $row->email;
          }
      }
      function get_is_student($id_user)
      {
	  $this->db->select('occupation');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return ($row->occupation == 'student');
          }
      }
      
      function get_is_teacher($id_user)
      {
	  $this->db->select('occupation');
          $this->db->where('id_user',$id_user);   
          $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
           return $row->occupation == 'teacher';
          }
      }

      /**returns short html, which can be places on a destination website. This information contains
      name, photo, short
      verson of
      about, little achievement pictures,...
      */
      //TOdo : should include small achievement pictures as well
      function get_profile($id_user)
      {
	 $this->db->select('first_name, surname, about_short');
         $this->db->where('id_user',$id_user);    
         $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
	      $html =
	      '<div id="userprofile">
	       <h3>'.$row->first_name. ' '. $row->surname.'</h3>
	       <img src="'.$this->get_photo($id_user).'" width=250 />'.
	      '<p>'.$row->about_short .'</p>'.
	      '</div>';
	      return $html;
          }
      }

      function get_profile_short($id_user)
      {
	  $this->db->select('first_name, surname');
         $this->db->where('id_user',$id_user);    
         $query = $this->db->get('profile_general');
         
         
          foreach($query->result() as $row)
          {
	      $html =
	      '<div id="userprofile_short">
	       <img src="'.$this->get_photo($id_user).'" width=50 />'.
	      '<h5>'.$row->first_name. ' '. $row->surname.'</h5>'.
	      '</div>';
	      return $html;
          }
      }


}

?>
