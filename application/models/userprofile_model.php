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
           if($query->num_rows >0)
		   {
			foreach($query->result() as $row)
			{
          
				return $row;
			}
		   }
		   return FALSE;
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
      function badges($username)
      {
		 $user_id = $this->id($username);
         $this->db->select('profile_badge_types.badge_title, profile_badge_types.picture, profile_badges.id_user_who_gave_it, profile_badges.time, profile_badges.comment');
         $this->db->from('profile_badges');
         $this->db->join('profile_badge_types','profile_badge_types.id_badge = profile_badges.id_badge' );
         
		 $this->db->where('profile_badges.id_user',$user_id);
		 
         $this->db->order_by('time', 'desc');   
         $query = $this->db->get();
         
         
         if($query->num_rows > 0)
         return $query->result();
         return null;
          
		
	  }
	  function achievements($username)
      {
		 $user_id = $this->id($username);
         $this->db->select('profile_achievement_types.achievement_title, profile_achievement_types.picture, profile_achievements.course_name, profile_achievements.time');
         $this->db->from('profile_achievements');
         $this->db->join('profile_achievement_types','profile_achievement_types.id_achievement = profile_achievements.id_achievement' );
         
		 $this->db->where('profile_achievements.id_user',$user_id);
		 
         $this->db->order_by('time', 'desc');   
         $query = $this->db->get();
         
         
         if($query->num_rows > 0)
         return $query->result();
         return null;
          
		
	  }
      function activities($username, $client_id)
      {  
		 $user_id = $this->id($username);
         $this->db->select('profile_activities.activity, profile_activities.activity_type, profile_activities.time, profile_activity_types.activity_title');
         $this->db->from('profile_activities');
         $this->db->join('profile_activity_types','profile_activity_types.activity_type = profile_activities.activity_type' );
         
		 $this->db->where('profile_activities.id_user',$user_id);
		 if($client_id != '')
         {
			$this->db->where('profile_activity_types.client_id', $client_id);
		 }
         $this->db->order_by('time', 'desc');   
         $query = $this->db->get();
         
         
         if($query->num_rows > 0)
         return $query->result();
         return null;
          
          
  
      }
      /**
       * ADD FUNCTIONS
       */
      function add_badge($badge_type, $id_user, $user_who_gave_it, $comment, $timestamp)
      {
		  $data = array
		  (
			  'id_badge' => $badge_type,
			  'id_user' => $id_user,
			  'id_user_who_gave_it' => $user_who_gave_it,
			  'comment' => $comment,
			  'time' => $timestamp,
		  );
		  $this->db->insert('profile_badges', $data);
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
