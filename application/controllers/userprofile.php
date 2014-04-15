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
          return TRUE;
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
									  'title' => 'Profil používateľa'. $profile_of,
									  'apps' => $this->membership_model->get_apps(),
									  'header' => $query->first_name." ".$query->surname,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'userprofile_view';
		$data['left_content'] = 'left_userprofile_view';
		$data['main_contents_data'] = array(
												'main_contents' => 'about',
												'records' => $query,
												
			
												);
			
		$this->load->view('includes/template',$data);
		
		   
		
    }
    
    function general()
    {
      $this->load->model('userprofile_model');
      $is_ajax = $this->input->post('ajax');
      if($is_ajax)
      {
        $query = $this->userprofile_model->general($this->input->post('username'));
        $data['records'] = $query;
        $this->load->view('userprofile_view-general', $data );
      }
      
      else
      {
        $this->load->model('userprofile_model');
        $data['main_contents'] = 'general';
        $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
    $profile_of = $subdomain_arr[0]; //assigns the first part  
    
        if($query = $this->userprofile_model->general($profile_of))
        {      
          $data['records'] = $query;
          
        }   
        $this->load->view('userprofile_view',$data);
      }
        
      
    }
    function blog()
    {   
      $this->load->model('userprofile_model');
      $is_ajax = $this->input->post('ajax');
      if($is_ajax)
      {
        $query = $this->userprofile_model->get_blog($this->input->post('username'));
        $data['records'] = $query;
        $this->load->view('userprofile_view-blog', $data );
        
      }
      
      else
      {
        
        $this->load->model('userprofile_model');
        $data['main_contents'] = 'blog';
        $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
        $profile_of = $subdomain_arr[0]; //assigns the first part  
    
        if($query = $this->userprofile_model->get_all($profile_of))
        { 
              
          $data['records'] = $query;
          
        }
           
        $this->load->view('userprofile_view',$data);
      }  
    
    }
    function about()
    {
		$this->load->model('userprofile_model');
      $is_ajax = $this->input->post('ajax');
      if($is_ajax)
      {
        $query = $this->userprofile_model->about($this->input->post('username'));
        $data['records'] = $query;
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
    
    
    function courses()
    {
    
    }
    
    function wiki()
    {
    
    }
    
    
}
?>
