<?php
Class Not_permitted extends CI_Controller
{
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
		 $this->load->model('profile_model');
		   $data['header'] = array(
							 'title' => 'Administrácia profile.matfzy.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Administrácia',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'home_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										'text' => 'Nemáte oprávnenie na zobrazenie tejto stránky.',
	
										);
			$data['left_contents_data'] = array(
												'bestUsers' => $this->profile_model->get_bestRatingUsers(8),
											    'newUsers' => $this->profile_model->get_newUsers(8),		
						
			
			);
			$this->load->view('includes/template',$data);
	}
	
}
?>
