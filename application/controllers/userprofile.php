<?php
class Userprofile extends CI_Controller
{

    function __construct()
    {
    parent::__construct();
    //$this->is_logged_in();
    $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
    $profile_of = $subdomain_arr[0]; //assigns the first part  
    
    
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
		$subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
		$profile_of = $subdomain_arr[0]; //assigns the first part  

		if($query = $this->userprofile_model->about($profile_of))
		{      
		  $data['records'] = $query;
		  
		}
		$data['header'] = array(
									  'title' => 'Profil používateľa '. $profile_of,
									  'apps' => $this->membership_model->get_apps(),
									  'header' => $query->first_name." ".$query->surname,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'userprofile_view';
		$data['left_content'] = 'left_userprofile_view';
		$data['main_contents_data'] = array(	'username' =>$profile_of,
												'main_content' => 'about',
												'main_contents_data' => array (
																				
																				'records' => $query,
																				
																			  ),
												
			
												);
		$data['left_contents_data']= array
											(
												'records'=>$query,
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
        $query_about = $this->userprofile_model->about($profile_of);
        $this->load->model('membership_model');
        
    
        $query = $this->userprofile_model->activities($profile_of, $which_activities);
         
              
          
          
        
           
        $data['header'] = array(
									  'title' => 'Profil používateľa '. $profile_of,
									  'apps' => $this->membership_model->get_apps(),
									  'header' => $query_about->first_name." ".$query_about->surname,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'userprofile_view';
		$data['left_content'] = 'left_userprofile_view';
		$data['main_contents_data'] = array(
												'username' => $profile_of,
												'main_content' => 'activities',
												'main_contents_data'=> array ('records' => $query,
																			  'which_activities' =>$which_activities,
																			 
																			 ) ,
			
												);
		$data['left_contents_data'] = array(
												'records'=>$query_about,
											);
			
		$this->load->view('includes/template',$data);
      }  
    
    }
   
   
    function about()
    {
		$this->load->model('userprofile_model');
      $is_ajax = $this->input->post('ajax');
      if($is_ajax)
      {
        $query = $this->userprofile_model->about($this->input->post('username'));
        $data['data'] = array(
								'records' => $query ,
							);
        $this->load->view('userprofile_view-about', $data );
        
      }
      
      else
      {
        
        $this->load->model('userprofile_model');
        $data['main_contents'] = 'about';
        $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
        $profile_of = $subdomain_arr[0]; //assigns the first part  
    
        if($query = $this->userprofile_model->about($profile_of))
        { 
              
          $data['records'] = $query;
          
        }
           
        $this->load->view('userprofile_view',$data);
      } 
	}
    
    
    
    
    
}
?>
