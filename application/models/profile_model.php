<?php
class profile_model extends CI_Model
{


    function get_random_mozaic($amount)
    {
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit($amount);
        $query = $this->db->get('profile_general');
        foreach($query->result() as $row)
         {
            $data[] = $row;
         }
         $data['pocet'] = $query->num_rows();
         return $data;
        
    
    }

}

?>