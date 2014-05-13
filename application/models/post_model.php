<?php

class Post_model extends CI_Model
{
    function add_activity($id_user, $activity_type,$activity, $timestamp)
    {
	$data= array(
		      'id_user' => $id_user,
		      'activity_type' => $activity_type,
		      'activity' => $activity,
		      'time' =>$timestamp,/
		     );
	$this->db->insert('profile_activities' , $data);
    }
    function add_achievement($id_user, $achievement_type,$source, $timestamp)
    {
	$data= array(
		      'id_user' => $id_user,
		      'achievement_type' => $achievement_type,
		      'source' => $source,
		      'time' =>$timestamp,/
		     );
	$this->db->insert('profile_achievements' , $data);
    }
    function add_badge($id_user, $badge_type,$id_user_who_gave_it,$comment,  $timestamp)
    {
	$data= array(
		      'id_user' => $id_user,
		      'badge_type' => $badge_type,
		      'id_user_who_gave_it' => $id_user_who_gave_it,
		      'time' =>$timestamp,
		      'comment' => $comment,
		     );
	$this->db->insert('profile_badges' , $data);
    }
}

?>
