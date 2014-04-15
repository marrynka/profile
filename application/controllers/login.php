<?php
class Login extends CI_Controller
{
	
	protected $logged_in_apps;
	
	function is_logged_in()
      {
          
          $is_logged_in = $this->session->userdata('is_logged_in');
          if(!isset($is_logged_in) || $is_logged_in != true)
          {
				return FALSE;
          }
          return $this->session->userdata('username');
      }
    
    function index($str=null)
    {
       
		if($this->is_logged_in() != FALSE)
		{
			$this->load->model('membership_model');
			$data['header'] = array(
								 'title' => 'Prihlásenie do systému matfyz.sk',
								  'apps' => $this->membership_model->get_apps(),
								  'header' => 'Prihlásenie do systému matfyz.sk',
								  'is_logged_in' => $this->is_logged_in(),
								);
		
			$data['main_content'] = 'logged_in_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
											//returnUrl' => $returnUrl,
											'text'=> 'V systéme už ste prihlásený',
		
											);
		
			$this->load->view('includes/template',$data);
			
		}
		else
		{
			$this->load->model('membership_model');
			$returnUrl = $this->input->get('returnUrl');
			$data['header'] = array(
									 'title' => 'Prihlásenie do systému matfyz.sk',
									  'apps' => $this->membership_model->get_apps(),
									  'header' => 'Prihlásenie do systému matfyz.sk',
									  'is_logged_in' => $this->is_logged_in(),
									);
			
			$data['main_content'] = 'login_form';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
												'returnUrl' => $returnUrl,
												'errors'=> $str,
			
												);
			
			$this->load->view('includes/template',$data);
		}
    }
    
    
    
    function create_member()
    {
    $this->load->library('form_validation');
    //field name, error message, validation rules
    $this->form_validation->set_rules('first_name','Name','trim|required');
    $this->form_validation->set_rules('last_name','Last Name','trim|required');
    $this->form_validation->set_rules('email_address','Email','trim|required|valid_email');
    $this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
    $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
    $this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
    $this->form_validation->set_rules('occupation','Occupation','trim|required');
    $this->form_validation->set_rules('about_short','About_short','trim|max_length[250]');
    $this->form_validation->set_rules('about_long','About long','trim|max_length[250]');
    if($this->form_validation->run()==FALSE)
    {
       $this->signup();
    }
    else
    {
    $this->load->model('membership_model');
    if($query = $this->membership_model->create_member())
    {
       $data['main_content'] = 'signup_successful';
       $this->load->view('includes/template', $data);
    }
    else
    {
    $this->load->view('signup_form');
    }
    }
    
    
    }
    
    
    function validate_credentials()
    {
      error_reporting(E_ALL);
		ini_set('display_startup_errors',1);
		ini_set('display_errors',1);
		error_reporting(-1);
		ini_set('error_reporting', E_ALL);
     
      $this->load->library('form_validation');
      
      $this->form_validation->set_rules('username','trim|required|xss_clean');
      $this->form_validation->set_rules('password','trim|required|xss_clean');
      
      if($this->form_validation->run()==FALSE)
      {   //nevhodny vstup
		  $this->index();
	  }
	  else
	  { 
	    
	    $this->load->model('membership_model');	
		$id = $this->membership_model->validate();
		
		if($id == FALSE)
		{
			$this->form_validation->set_message('validate', 'Invalid username or password');
			$this->index('Invalid username or password');
		}
		else 
		{
			$data = array(
			'username' => $this->input->post('username'),
			'is_logged_in' => true,
			'user_id' => $id,
			);
			
			$this->session->set_userdata($data);
		
			 
			
			
			$returnUrl = $this->input->post('returnUrl');
			if($returnUrl != "")
			{
		 
		 
			redirect($returnUrl."&user_id=".$this->session->userdata('user_id'));
			}
			$data['header'] = array(
							 'title' => 'Prihlásenie do systému matfyz.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Prihlásenie do systému matfyz.sk',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'logged_in_view';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'text' => 'Boli ste prihlásený',
	
										);
	
			$this->load->view('includes/template',$data);
			
		} 
	  }
    }
    function signup()
    {
			$this->load->model('membership_model');
			$data['header'] = array(
							 'title' => 'Prihlásenie do systému matfyz.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Prihlásenie do systému matfyz.sk',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
			$data['main_content'] = 'signup_form';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										//'text' => 'Boli ste prihlásený',
	
										);
	
			$this->load->view('includes/template',$data);
    }
    function logout()
    { 
		error_reporting(E_ALL);
		ini_set('display_startup_errors',1);
		ini_set('display_errors',1);
		error_reporting(-1);
		ini_set('error_reporting', E_ALL);
		
	  //*3 segment v url znamena, ze nejaka appka sa chce odhlasit
	  //ak tam tento segment nieje, znamena to, ze sa chce uzivatel odhlasit z profilu 	
	  // pri odhlasovani Yo ho to spyta ci sa chce odhlasit zo vsetkych(vyenuje ktorych), kde je prihlaseny alebo len z danej appky
	 
	 
	  $this->load->model('membership_model');
	  $this->logged_in_apps = $this->membership_model->where_is_logged_in();	
	  if($this->logged_in_apps->num_rows > 0)
	  {
		  
	  $app = $this->uri->segment(3);
	  $err="";
	  if($this->membership_model->is_logged_in_app($app)== FALSE) $err = "V aplikácii, z ktorej sa pokúšate odhlásit, nieste prihlasený";
	  
	  $data['header'] = array(
							 'title' => 'Prihlásenie do systému matfyz.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Prihlásenie do systému matfyz.sk',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
	   $data['main_content'] = 'logging_out_view';
	   $data['left_content'] = 'left_normal_view';
   	   $data['main_contents_data'] = array(
										'error' => $err,
										'logging_out_app' => $app,
										'logged_in_apps' => $this->logged_in_apps,
										//'text' => 'Boli ste prihlásený',
	
										);
	
	    $this->load->view('includes/template',$data);
		}
		
	    //ak nebol prihlaseny v ziadnej appke tak ho len odhlasime:
	   
	    else
	    {
			if($this->is_logged_in()==FALSE)
			{
				
				$data['header'] = array(
							 'title' => 'Prihlásenie do systému matfyz.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Prihlásenie do systému matfyz.sk',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
				$data['main_content'] = 'logging_out_view';
				$data['left_content'] = 'left_normal_view';
				$data['main_contents_data'] = array(
										'error' => 'Nieste prihlásený',
										//'text' => 'Boli ste prihlásený',
	
										);
	
				$this->load->view('includes/template',$data);
			}
			else
			{
			$this->logout_end();
			}
		}
	 
	 
    
    }
    
    function logout_all()
    {
	  
	  
	  $this->load->model('membership_model');
	  $this->logged_in_apps = $this->membership_model->where_is_logged_in();
	 
	  
	  if($this->logged_in_apps->num_rows > 0)
	  {
		  foreach($this->logged_in_apps->result() as $row)
		  {
			  $redirectUri = $this->membership_model->get_redirect_uri($row->client_id);
			  $this->membership_model->logout_app($row->client_id);
			 
			 
			  redirect($redirectUri."?redirectUrl=".base_url()."index.php/login/logout_all");
		  }
      } 
      
	 
	  
	 
	  $this->session->sess_destroy();
      $data['header'] = array(
									 'title' => 'Prihlásenie do systému matfyz.sk',
									  'apps' => $this->membership_model->get_apps(),
									  'header' => 'Prihlásenie do systému matfyz.sk',
									  'is_logged_in' => $this->is_logged_in(),
									);
			
			$data['main_content'] = 'login_form';
			$data['left_content'] = 'left_normal_view';
			$data['main_contents_data'] = array(
												'returnUrl' => '',
												'errors' =>'Boli ste odhlásený zo všetkých aplikácii',
			
												);
			
			$this->load->view('includes/template',$data);
			
	  
	}
	 
	function logout_end()
	{
	  $this->session->sess_destroy();
      $data['header'] = array(
							 'title' => 'Prihlásenie do systému matfyz.sk',
							  'apps' => $this->membership_model->get_apps(),
							  'header' => 'Prihlásenie do systému matfyz.sk',
							  'is_logged_in' => $this->is_logged_in(),
							);
	
	  $data['main_content'] = 'login_form';
	  $data['left_content'] = 'left_normal_view';
	  $data['main_contents_data'] = array(
										//'returnUrl' => $returnUrl,
										'errors'=> 'Boli ste odhlásený',
	
										);
	
	  $this->load->view('includes/template',$data);
      
	}
	function logout_app()
	{
		
		      $this->load->model('membership_model');
		 	  $redirectUri = $this->membership_model->get_redirect_uri($this->uri->segment(3));
			  $this->membership_model->logout_app($this->uri->segment(3));
		  	  redirect($redirectUri);
		 
		 
		      
		 
	}
	function logout_theonlyapp()
	{
		
		      $this->load->model('membership_model');
		 	  $redirectUri = $this->membership_model->get_redirect_uri($this->uri->segment(3));
			  $this->membership_model->logout_app($this->uri->segment(3));
		  	  $this->session->sess_destroy();
		  	  redirect($redirectUri);
		 
		 
		      
		 
	}
	 
	
	
}
?>
