<?php
class Userprofile extends CI_Controller
{

    function __construct()
    {
    parent::__construct();
    //$this->is_logged_in();
    $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
    $this->profile_of = $subdomain_arr[0]; //assigns the first part  
    
    
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
     
    $this->profile();
   
    
    }
    function profile()
    {
    
		$this->load->model('userprofile_model');
		$this->load->model('membership_model');
		$data['main_contents'] = 'about';
		
		if($query = $this->userprofile_model->about($this->profile_of))
		{      
		  $data['records'] = $query;
		  
		}
		$data['header'] = array(
									  'title' => 'Profil používateľa '. $this->profile_of,
									  'apps' => $this->membership_model->get_apps(),
									  'header' => $query->first_name." ".$query->surname,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'userprofile_view';
		$data['left_content'] = 'left_userprofile_view';
		$data['main_contents_data'] = array(	'username' =>$this->profile_of,
												'main_content' => 'about',
												'main_contents_data' => array (
																				
																				'records' => $query,
																				'badges' => $this->userprofile_model->badges($this->profile_of),
																				'achievements'=>$this->userprofile_model->achievements($this->profile_of),
																				'username' => $this->profile_of,
																				'is_logged_in' => $this->is_logged_in(),
																			  ),
												
			
												);
		$data['left_contents_data']= array
											(
												'records'=>$query,
										        'is_logged_in' => ($this->is_logged_in() == $this->profile_of),
											);
			
		$this->load->view('includes/template',$data);
		
		   
		
    }
    
    function activities()
    {   
      $this->load->model('userprofile_model');
      $is_ajax = $this->input->post('ajax');
      if($is_ajax)
      {
        $query = $this->userprofile_model->activities($this->input->post('username'), $this->input->post('client_id'));
        $data['data'] = array(
							'records'=> $query,
							'which_activities' => $this->input->post('client_id'),
							);
        $this->load->view('userprofile_view-activities', $data );
        
      }
      
      else
      {
        
        $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
		$profile_of = $subdomain_arr[0]; //assigns the first part  
		//ak niesme na konkretnom profile, tak sa nedaju ani pozerat aktivity, cize redirect
		if($profile_of =="" ) redirect(userprofile);
		//ak sme na niekoho profile, tak chceme pozerat jeho aktivity:
		$which_activities = $this->uri->segment(3);
		
        $this->load->model('userprofile_model');
        $query_about = $this->userprofile_model->about($this->profile_of);
        $this->load->model('membership_model');
        
    
        $query = $this->userprofile_model->activities($this->profile_of, $which_activities);
         
              
          
          
        
           
        $data['header'] = array(
									  'title' => 'Profil používateľa '. $this->profile_of,
									  'apps' => $this->membership_model->get_apps(),
									  'header' => $query_about->first_name." ".$query_about->surname,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'userprofile_view';
		$data['left_content'] = 'left_userprofile_view';
		$data['main_contents_data'] = array(
												'username' => $this->profile_of,
												'main_content' => 'activities',
												'main_contents_data'=> array ('records' => $query,
																			  'which_activities' =>$which_activities,
																			 
																			 ) ,
			
												);
		$data['left_contents_data'] = array(
												'records'=>$query_about,
												'is_logged_in' => ($this->is_logged_in() == $this->profile_of),
											);
			
		$this->load->view('includes/template',$data);
      }  
    
    }
   
   
    function about()
    {
	  $this->load->model('userprofile_model');
	  $username = $this->input->post('username');
      $is_ajax = $this->input->post('ajax');
      if($is_ajax)
      {
        $query = $this->userprofile_model->about($username);
        $data['data'] = array(
								'records' => $query ,
								'badges' => $this->userprofile_model->badges($username),
								'achievements'=>$this->userprofile_model->achievements($username),
								'username' => $this->profile_of,
								'is_logged_in' => $this->is_logged_in(),
																				
							);
        $this->load->view('userprofile_view-about', $data );
        
      }
      
      else
      {
        
        $this->load->model('userprofile_model');
        $data['main_contents'] = 'about';
        $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
        $profile_of = $subdomain_arr[0]; //assigns the first part  
    
        if($query = $this->userprofile_model->about($this->profile_of))
        { 
              
          $data['records'] = $query;
          
        }
           
        $this->load->view('userprofile_view',$data);
      } 
	}
    
    
    
    
    
}
?>
