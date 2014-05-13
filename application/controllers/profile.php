<?php

class Profile extends CI_Controller
{
function __construct()
    {
		parent::__construct();
    
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
		if($this->profile_of=='profile')
		{
				
			$this->startpage();
			
		
		}
		else 
		{
		redirect('userprofile');
		}
    }
    function sortedpage($users)
    {
		
		
	}
    function startpage()
    {
		$this->load->model('profile_model');
		$this->load->model('membership_model');
		$this->load->model('userprofile_model');
		
		$best = $this->profile_model->get_bestRatingUsers(5);
		$new = $this->profile_model->get_newUsers(5);
		$random = $this->profile_model->get_randomUsers(5); 
		
		if($query = $this->profile_model->get_random_mozaic(42))
		{
		//echo $query->username;
		//$data['mozaic'] = $query;
		//$data['amount'] = $query['pocet']; 
		
		$data['header'] = array(
									  'title' => 'Naši užívatelia - profile.matfyz.sk',
									  'apps' => $this->membership_model->get_apps(),
									  'header' => 'Naši užívatelia' ,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'profile_view';
		$data['left_content'] = 'left_search_view';
		$data['main_contents_data'] = array(	
												'bestUsers' => $best,
												'newUsers' => $new,
												'randomUsers' => $random,
												'is_logged_in' => $this->is_logged_in(),
												);
		$data['left_contents_data']= array
											(
												
											);
			
		$this->load->view('includes/template',$data);
		
		
		
		
		//$this->load->view('profile_view', $data);
		}
		//if($query= $this->profile_model->get_random_users())
		{
		$data['users'] = $query;
		}
		//$this->load->view('profile_view',$data);
    }
    function search()
    {
		$this->load->model('profile_model');
		
		$user = $this->input->post('search');
		
		 $this->load->library('pagination');
		 $this->load->library('table');
		 $config['base_url'] = site_url(). '/profile/search/'; 
		 $config['per_page'] = 6;
		 $config['num_links'] = 10;
		 $config['total_rows'] = $this->profile_model->search($user)->num_rows();
		 $config['uri_segment'] = 3;
		 $config['full_tag_open'] = '<div id="pagination">';
		 $config['full_tag_close']='</div>';
		 $this->pagination->initialize($config);
    
		 $users_data= $this->profile_model->search($user, $config['per_page'],$this->uri->segment(3));
		 $users=array();
		 $base = base_url();
		 $pos = strpos($base,'://');
         $baseurl = substr($base,$pos+3,strlen($base));
        
         $users[0]['picture'] ='';
         $users[0]['name'] = 'Meno:';
		 $i=1;
		 foreach($users_data->result() as $row)
		 {
			 
			 $users[$i]['picture']= '<a href="http://'.$row->username.'.'.$baseurl.'"><img src="'.base_url().'/images/users/'.$row->username.'/avatar.jpg" width=50/></a>';
			 $users[$i]['name'] = '<div id="name"><a href="http://'.$row->username.'.'.$baseurl.'">'.$row->first_name .' '.$row->surname.'</a><name>' ;
			
			 $i = $i+1;
		 } 
		
		
		$this->load->model('membership_model');
		 $data['header'] = array(
									  'title' => 'Vybraní užívatelia - profile.matfyz.sk',
									  'apps' => $this->membership_model->get_apps(),
									  'header' => 'Vybraní užívatelia' ,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'sorted_view';
		$data['left_content'] = 'left_search_view';
		$data['main_contents_data'] = array(	
												'title' => 'Užívatelia nájdení podľa Vašeho kritéria:',
												'users' => $users,
												'is_logged_in' => $this->is_logged_in(),
												);
		$data['left_contents_data']= array
											(
												
											);
			
		$this->load->view('includes/template',$data);
		
	}
	function sort_name()
	{
		$letter = $this->uri->segment(3);
		if($letter == '') redirect('profile');
		$this->load->model('profile_model');
		$users = $this->profile_model->sort_name($letter);
		 $this->load->library('pagination');
		 $this->load->library('table');
		 $config['base_url'] = site_url(). '/profile/sort_name/'.$letter; 
		 $config['per_page'] = 6;
		 $config['num_links'] = 10;
		 $config['total_rows'] = $this->profile_model->sort_name($letter)->num_rows();
		 $config['uri_segment'] = 4;
		 $config['full_tag_open'] = '<div id="pagination">';
		 $config['full_tag_close']='</div>';
		 $this->pagination->initialize($config);
    
		 $users_data = $this->profile_model->sort_name($letter, $config['per_page'], $this->uri->segment(4));
		 $users = array();
		 
		 $base = base_url();
		 $pos = strpos($base,'://');
         $baseurl = substr($base,$pos+3,strlen($base));
        
         $users[0]['picture'] ='';
         $users[0]['name'] = 'Meno:';
		 $i=1;
		 foreach($users_data->result() as $row)
		 {
			 
			 $users[$i]['picture']= '<a href="http://'.$row->username.'.'.$baseurl.'"><img src="'.base_url().'/images/users/'.$row->username.'/avatar.jpg" width=50/></a>';
			 $users[$i]['name'] = '<div id="name"><a href="http://'.$row->username.'.'.$baseurl.'">'.$row->first_name .' '.$row->surname.'</a><name>' ;
			
			 $i = $i+1;
		 } 
		 
		// $users = $this->db->get('profile_general', $config['per_page'], $this->uri->segment(3));
		 $this->load->model('membership_model');
		 $data['header'] = array(
									  'title' => 'Vybraní užívatelia - profile.matfyz.sk',
									  'apps' => $this->membership_model->get_apps(),
									  'header' => 'Vybraní užívatelia' ,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'sorted_view';
		$data['left_content'] = 'left_search_view';
		$data['main_contents_data'] = array(	
												'title' => 'Užívatelia na '.$letter.":",
												'users' => $users,
												'is_logged_in' => $this->is_logged_in(),
												);
		$data['left_contents_data']= array
											(
												
											);
			
		$this->load->view('includes/template',$data);
		
		
		
	}
	function sort_rating()
	{
		 $how = $this->uri->segment(3);
		 if($how != 'asc' && $how != 'desc') $how = 'desc';
		 
		 
		 $this->load->model('profile_model');
		 $this->load->library('pagination');
		 $this->load->library('table');
		 $config['base_url'] = site_url(). '/profile/sort_rating'; 
		 $config['total_rows'] = $this->db->get('profile_general')->num_rows();
		 $config['per_page'] = 6;
		 $config['num_links'] = 10;
		 $config['full_tag_open'] = '<div id="pagination">';
		 $config['full_tag_close']='</div>';
		 $this->pagination->initialize($config);
    
		 $users_data = $this->profile_model->sort_rating($how, $config['per_page'], $this->uri->segment(3));
		 $users = array();
		 
		 $base = base_url();
		 $pos = strpos($base,'://');
         $baseurl = substr($base,$pos+3,strlen($base));
        
         $users[0]['picture'] ='';
         $users[0]['name'] = 'Meno:';
		 $users[0]['rating'] ='Rating:';
		 $i=1;
		 foreach($users_data->result() as $row)
		 {
			 
			 $users[$i]['picture']= '<a href="http://'.$row->username.'.'.$baseurl.'"><img src="'.base_url().'/images/users/'.$row->username.'/avatar.jpg" width=50/></a>';
			 $users[$i]['name'] = '<div id="name"><a href="http://'.$row->username.'.'.$baseurl.'">'.$row->first_name .' '.$row->surname.'</a></div>' ;
			 $users[$i]['rating']= $row->rating;
			 $i = $i+1;
		 } 
		 
		// $users = $this->db->get('profile_general', $config['per_page'], $this->uri->segment(3));
		 $this->load->model('membership_model');
		 $data['header'] = array(
									  'title' => 'profile.matfyz.sk',
									  'apps' => $this->membership_model->get_apps(),
									  'header' => 'Užívatelia' ,
									  'is_logged_in' => $this->is_logged_in(),
									);
			
		$data['main_content'] = 'sorted_view';
		$data['left_content'] = 'left_search_view';
		$data['main_contents_data'] = array(	
												'title' => 'Užívatelia podľa ratingu: ',
												'users' => $users,
												'is_logged_in' => $this->is_logged_in(),
												);
		$data['left_contents_data']= array
											(
												
											);
			
		$this->load->view('includes/template',$data);
		
		 
	}
	
	
	
	
    
    
    

}

?>
