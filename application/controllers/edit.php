<?php
Class Edit extends CI_Controller
{
    
    function __construct()
    {
      parent::__construct();
      $this->load->model('edit_model');
    
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
			$data['left_contents_data'] = array();
			$this->load->view('includes/template',$data);
      
    }
    function sources()
    {
      $sources = $this->edit_model->list_sources(); 
      $data['items_name'] = 'source';
      $data['items'] = $sources;
      $data['options'] = FALSE;
      $this->load->view('edit_view', $data);
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
      $this->load->view('edit_view', $data);
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
			$data['left_contents_data'] = array();
			$this->load->view('includes/template',$data);
      
     
    }
    function add_source_type()
    {
      $source_title = $this->input->post('new_source_type'); 
      $id = $this->edit_model->add_source($source_title);
      $this->selected_source = $id;
      echo "New source was successfully added.<br />". $this->input->post('return');
      if($this->input->post('return')== 'edit_activity_types')
      {
      redirect('edit_activity_types/index/'.$id);
      }
      else $this->sources();
    }
    function delete_source_type()
    {
                                              
      $number_of_sources = $this->input->post('number_of_sources');
     
      for($i=0;$i<$number_of_sources;$i++)
      {
       if($this->input->post('item'.$i) != '')
       {
          $this->edit_model->delete_source($this->input->post('item'.$i));
          echo "Source was successfully deleted<br />" ;
       } 
      
      
      }
      
      $this->sources();
      
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
      $number_of_sources = $this->input->post('number_of_sources');
      for($i=0;$i<$number_of_sources;$i++)
      {
       if($this->input->post('source'.$i) != '')
       {
          $this->edit_model->delete_source($this->input->post('source'.$i));
          echo "Source was successfully deleted<br />" ;
       } 
      
      
      }
      $this->sources();
      
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
}

?>
