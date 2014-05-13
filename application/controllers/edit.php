<?php
Class Edit extends CI_Controller
{
    
    function __construct()
    {
      parent::__construct();
      $this->load->model('edit_model');
      if($this->edit_model->is_permitted() == FALSE)
     {
		
			redirect('not_permitted');
     } 
      
      
      
      
    
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
	  
      //$data['options'] = TRUE;
     // $this->load->view('edit_view', $data);
     
      
      $this->load->model('membership_model');
      $this->load->model('profile_model');
      $data['header'] = array(
							 'title' => 'Administrácia profile.matfzy.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Administrácia',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'edit_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'options' => TRUE,
	
										);
			$data['left_contents_data'] = array(
			'bestUsers' => $this->profile_model->get_bestRatingUsers(8),
											    'newUsers' => $this->profile_model->get_newUsers(8),		
						
			
			);
			$this->load->view('includes/template',$data);
      
    }
    function clients()
    {
      $clients = $this->edit_model->list_clients(); 
      $data['items_name'] = 'clients';
      $data['items'] = $clients;
      $data['options'] = FALSE;
      $this->load->model('membership_model');
      $this->load->model('profile_model');
      $this->load->library('table');
      $i = 0;
      $clients_array = array();
      $clients_array[$i]['client_id'] = 'ID';
	  $clients_array[$i]['home_uri'] = 'home_uri';
	  $clients_array[$i]['requests_uri'] = 'requests_uri';
	  $clients_array[$i]['redirect_uri'] = 'redirect_uri';
		$i = 1;  
      foreach($clients as $row)
      {
		  $clients_array[$i]['client_id'] = $row->client_id;
		  $clients_array[$i]['home_uri'] = $row->home_uri;
		  $clients_array[$i]['requests_uri'] = $row->requests_uri;
		  $clients_array[$i]['redirect_uri'] = $row->redirect_uri;
		  $i = $i + 1;
	  }
      
      
      
       $data['header'] = array(
							 'title' => 'Administrácia profile.matfzy.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Administrácia',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'edit_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'options' => FALSE,
										'items_name' => 'client',
										
											'items' => $clients_array,
											
										
										);
			$data['left_contents_data'] = array(
												'bestUsers' => $this->profile_model->get_bestRatingUsers(8),
											    'newUsers' => $this->profile_model->get_newUsers(8),		
						
			
			);
			$this->load->view('includes/template',$data);
    }
    
    function activities()
    {
      $pictures = $this->edit_model->list_pictures_for_achievements();
      
      $activities = $this->edit_model->list_activities(); 
      $data['items_name'] = 'activity';
      $data['items'] = $activities;
      $data['pictures'] = $pictures;
      $data['pictures_url'] = $this->edit_model->get_achievements_pictures_directory();
      $data['options'] = FALSE;
      $this->load->model('membership_model');
      $this->load->model('profile_model');
      
      
      $data['header'] = array(
							 'title' => 'Administrácia profile.matfzy.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Administrácia',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'edit_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'options' => FALSE,
										'items_name' => 'activity',
										'clients' => $this->edit_model->list_clients(),
										'items' => $activities,
											
										
										);
			$data['left_contents_data'] = array(
												'bestUsers' => $this->profile_model->get_bestRatingUsers(8),
											    'newUsers' => $this->profile_model->get_newUsers(8),		
						
			
			);
			$this->load->view('includes/template',$data);
    }
    
    
    function achievements()
    {
      $pictures = $this->edit_model->list_pictures_for_achievements();
      
      $achievements = $this->edit_model->list_achievements(); 
      $data['items_name'] = 'achievement';
      $data['items'] = $achievements;
      $data['pictures'] = $pictures;
      $data['pictures_url'] = $this->edit_model->get_achievements_pictures_directory();
      $data['options'] = FALSE;
      $this->load->model('membership_model');
      $this->load->model('profile_model');
      
      
      $data['header'] = array(
							 'title' => 'Administrácia profile.matfzy.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Administrácia',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'edit_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'options' => FALSE,
										'items_name' => 'achievement',
										
											'items' => $achievements,
											'pictures' => $pictures,
											'pictures_url' => $this->edit_model->get_achievements_pictures_directory(),
      
										
										);
			$data['left_contents_data'] = array(
												'bestUsers' => $this->profile_model->get_bestRatingUsers(8),
											    'newUsers' => $this->profile_model->get_newUsers(8),		
							
			
			);
			$this->load->view('includes/template',$data);
    }
    function badges()
    {
      $pictures = $this->edit_model->list_pictures_for_badges();
      $badges = $this->edit_model->list_badges(); 
      $data['items_name'] = 'badge';
      $data['items'] = $badges;
      $data['pictures'] = $pictures;
      $data['pictures_url'] = $this->edit_model->get_badges_pictures_directory();
      
      $this->load->model('membership_model');
      $this->load->model('profile_model');
      $data['header'] = array(
							 'title' => 'Administrácia profile.matfzy.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Administrácia',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'edit_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'options' => FALSE,
										'items_name' => 'badge',
										
											'items' => $badges,
											'pictures' => $pictures,
											'pictures_url' => $this->edit_model->get_badges_pictures_directory(),
      
										
										);
			$data['left_contents_data'] = array(
												'bestUsers' => $this->profile_model->get_bestRatingUsers(8),
											    'newUsers' => $this->profile_model->get_newUsers(8),		
						
			
			);
			$this->load->view('includes/template',$data);
      
     
    }
    function add_client()
    {
      
      
      $this->edit_model->add_client();
      $this->clients();
      
      
    }
    function delete_source_type()
    {
                                              
      $number_of_sources = $this->input->post('number_of_sources');
     
      for($i=0;$i<$number_of_sources;$i++)
      {
       if($this->input->post('item'.$i) != '')
       {
          $this->edit_model->delete_source($this->input->post('item'.$i));
          
       } 
       
      
      }
      
      $this->clients();
      
    }
    
    function add_achievement_type()
    {
      $achievement_title = $this->input->post('new_achievement_type');
      $achievement_description = $this->input->post('new_achievement_description');
      $achievement_max = $this->input->post('new_achievement_max');
      $achievement_picture = $this->input->post('new_achievement_picture'); 
      $id = $this->edit_model->add_achievement_type($achievement_title, $achievement_description, $achievement_max, $achievement_picture);
      echo "New achievement was successfully added.<br />";
      $this->achievements();
    }
    function delete_achievement_type()
    {
      $number_of_sources = $this->input->post('number_of_achievements');
      for($i=0;$i<$number_of_sources;$i++)
      {
       if($this->input->post('item'.$i) != '')
       {
          $this->edit_model->delete_achievement_type($this->input->post('item'.$i));
         
       } 
      
      
      }
      $this->achievements();
      
    }
    function add_badge_type()
    {
      $badge_title = $this->input->post('new_badge_type');
      $badge_description = $this->input->post('new_badge_description');
      $badge_max = $this->input->post('new_badge_max');
      $badge_picture = $this->input->post('new_badge_picture'); 
      $id = $this->edit_model->add_badge_type($badge_title, $badge_description, $badge_picture);
    
      
      $this->badges();
    }
    function delete_badge_type()
    {
      $number_of_badges = $this->input->post('number_of_badges');
      for($i=0;$i<$number_of_badges;$i++)
      {
       if($this->input->post('item'.$i) != '')
       {
          $this->edit_model->delete_badge_type($this->input->post('item'.$i));
          
       } 
      
      
      }
      $this->badges();
      
    }
    
    function add_activity_type()
  {
    $activity_title = $this->input->post('new_activity_type');
    $source_id = $this->input->post('source');
    $id = $this->edit_model->add_activity_type($source_id, $activity_title);
    
    $this->activities();
    
  
  }
  
  
  function delete_activity_type()
  {
      $number_of_activities = $this->input->post('number_of_activity_types');
      for($i=0;$i<$number_of_activities;$i++)
      {
       if($this->input->post('activity'.$i) != '')
       {
          $this->edit_model->delete_activity_type($this->input->post('activity'.$i));
         
       } 
       //
      
      }
      $this->activities();
      
  }
}

?>
