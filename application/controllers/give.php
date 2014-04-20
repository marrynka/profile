<?php
Class Give
 extends CI_Controller
{
    
    function __construct()
    {
      parent::__construct();
      $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
	  $this->profile_of = $subdomain_arr[0]; //assigns the first part  
      
      if(!$this->is_logged_in())
      {
		  echo "musis sa prihlasit";
		  die();
	  }
	  if(!$this->is_permitted())
      {
		  echo "nemozes udelovat veci sam sebe";
		  die();
	  }
    
    }
    function is_permitted()
	{
			  return $this->session->userdata('username') != $this->profile_of;
	}
    function is_logged_in()
      {
          
          $is_logged_in = $this->session->userdata('is_logged_in');
          if(!isset($is_logged_in) || $is_logged_in != true)
          {
				return FALSE;
          }
          return $this->session->userdata('username');
      }
    function index()
    { 
	  
      $this->load->model('membership_model');
      $this->load->model('edit_model');
      
      $badges = $this->edit_model->list_badges(); 
      $data['header'] = array(
							 'title' => 'Udeľ odznak na profile.matfyz.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Odznaky',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'give_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'items_name'=>'badge',
										'items' => $badges,
										'pictures_url' => $this->edit_model->get_badges_pictures_directory(),
	
										);
			$data['left_contents_data'] = array();
			$this->load->view('includes/template',$data);
      
    }
    function badge()
    {
		$this->load->model('userprofile_model');
		
		$this->userprofile_model->add_badge($this->input->post('item'), $this->userprofile_model->id($this->profile_of), $this->session->userdata('user_id'),$this->input->post('comment'), date('Y-m-d H:i:s',time(NULL)));
		redirect('userprofile');
	}
}

?>
