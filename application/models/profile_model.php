<?php
class profile_model extends CI_Model
{

	function sort_name($letter,$per_page=null, $page=null)
	{
		$this->db->select('username, first_name, surname');
		$this->db->like('surname',$letter, 'after');
		$this->db->order_by('surname','asc');
		$query = $this->db->get('profile_general',$per_page, $page);
		return $query;
	}
	function sort_rating($how, $per_page, $page)
	{
		$this->db->select('username, first_name, surname,rating');
		$this->db->order_by('rating',$how);
		$query = $this->db->get('profile_general', $per_page, $page);
		return $query;
	}
	function get_bestRatingUsers($amount)
	{
		$this->db->order_by('rating', 'desc');
		$this->db->limit($amount);
		$this->db->select('first_name, surname,username');
        $query = $this->db->get('profile_general');
        foreach($query->result() as $row)
         {
            $data[] = $row;
         }
         $data['amount'] = $query->num_rows();
         return $data;
		
	}
	function get_newUsers($amount)
	{
		$this->db->order_by('id_user', 'desc');
		$this->db->limit($amount);
		$this->db->select('first_name, surname,username');
        $query = $this->db->get('profile_general');
        foreach($query->result() as $row)
         {
            $data[] = $row;
         }
         $data['amount'] = $query->num_rows();
         return $data;
		
	}
	function get_randomUsers($amount)
	{
		$this->db->order_by('id_user', 'RANDOM');
		$this->db->limit($amount);
		$this->db->select('first_name, surname,username');
        $query = $this->db->get('profile_general');
        foreach($query->result() as $row)
         {
            $data[] = $row;
         }
         $data['amount'] = $query->num_rows();
         return $data;
		
	}
    function get_random_mozaic($amount)
    {
        $this->db->order_by('id_user', 'RANDOM');
        $this->db->limit($amount);
        $query = $this->db->get('profile_general');
        foreach($query->result() as $row)
         {
            $data[] = $row;
         }
         $data['pocet'] = $query->num_rows();
         return $data;
        
    
    }
    function search($user, $per_page =null, $page=null)
    {

		$parts = explode(" ",$user);
		if(count($parts) == 1)
		{
			
			$this->db->query("SET CHARACTER SET utf8");
			
			$this->db->select('username, first_name, surname');
			$this->db->like('first_name', $user);
			$this->db->or_like('surname', $user);	
			$this->db->or_like('username', $user);
			$query = $this->db->get('profile_general', $per_page, $page);
			return $query;
		}
		if(count($parts) == 2)
		{
			echo "two words";
				$this->db->query("SET CHARACTER SET utf8");
			$this->db->select('username, first_name, surname');
			$this->db->like(array('first_name'=> $parts[0], 'surname'=> $parts[1]));
			$this->db->or_like(array('first_name'=> $parts[0], 'surname' => $parts[1]));
			$this->db->or_like(array('username'=> $parts[0], 'surname' => $parts[1]));
			$this->db->or_like(array('username'=> $parts[0], 'first_name' => $parts[1]));
			$this->db->or_like(array('username'=> $parts[1], 'first_name' => $parts[0]));
			$this->db->or_like(array('username'=> $parts[1], 'surname' => $parts[0]));
			$query = $this->db->get('profile_general');
			
			return $query;
		
		}
		
	}

}

?>
