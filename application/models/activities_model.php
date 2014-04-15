<?php

class Activities_model extends CI_Model
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
}

?>
