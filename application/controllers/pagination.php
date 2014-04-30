<?php
class Pagination extends CI_Controller
{
    function index()
    {
    $this->load->library('pagination');
    $this->load->library('table');
    $config['base_url'] = 'http://localhost/profile/index.php/pagination/index'; 
    $config['total_rows'] = $this->db->get('profile_general')->num_rows();
    $config['per_page'] = 5;
    $config['num_links'] = 10;
    $config['full_tag_open'] = '<div id="pagination">';
    $config['full_tag_close']='</div>';
    $this->pagination->initialize($config);
    
    $data['records'] = $this->db->get('profile_general', $config['per_page'], $this->uri->segment(3));
    $this->load->view('pagination_view', $data);
    }
}

?>
