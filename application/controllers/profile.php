


<?php

class Profile extends CI_Controller
{
function __construct()
    {
    parent::__construct();
    
    
    
    }
    function index()
    {
    
    $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
    
    $profile_of = $subdomain_arr[0]; //assigns the first part  
    if($profile_of=='profile')
    {
            
	    $this->startpage();
	    
    
    }
    else 
    {
    redirect('userprofile');
    }
    }
    function startpage()
    {
          $this->load->model('profile_model');
    if($query = $this->profile_model->get_random_mozaic(19))
    {
    //echo $query->username;
    $data['mozaic'] = $query;
    $data['amount'] = $query['pocet']; 
    
    $this->load->view('profile_view', $data);
    }
    //if($query= $this->profile_model->get_random_users())
    {
    $data['users'] = $query;
    }
    //$this->load->view('profile_view',$data);
    }
    function login()
    {
       echo "login";
    }
    function register()
    {
       $this->load->view('client_register_view');
    }
    function client_register()
    {
      error_reporting(E_ALL);
    ini_set('display_errors', '1');
      
      $this->load->library('form_validation');
    
      $this->load->library('Provider');

    //field name, error message, validation rules
    $this->form_validation->set_rules('client_key','Name','trim|required');
    $this->form_validation->set_rules('client_about','Last Name','trim|required');
    
    if($this->form_validation->run()==FALSE)
    {
        
	$this->register();

    }
    echo "<!DOCTYPE html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

</head><body>";
      
    echo "<h1>Registering the app</h1>";
    $client_secret = Provider::createClient($this->input->post('client_key'));
    echo "You generated secret is: ".bin2hex($client_secret);
    echo "</body></html5>";
    
    }
    
    

}

?>
