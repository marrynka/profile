<?php


class Post extends CI_Controller
{
    protected $response;
    protected $request;
    function __construct()
    {
	 parent::__construct();
	      // include our OAuth2 Server object
	 $this->load->model('userprofile_model');
	require_once __DIR__.'/server.php';
	
	// https://api.example.com/resource-requiring-postonwall-scope
	$this->request = OAuth2\Request::createFromGlobals();
	$this->response = new OAuth2\Response();
	$scopeRequired = 'postinformation'; // this resource requires "postinformation" scope
	if (!$server->verifyResourceRequest($this->request, $this->response, $scopeRequired)) 
	{
	  // if the scope required is different from what the token allows, this will send a "401 insufficient_scope" error
	    
	    $this->response->send();
	    die;
	}
    }
    
    function index()
    {
	
    }
    function activity()
    {
		//here we should chcek wether the message is plain html and not some malicious crap, if allowing third party apps
	   
	     if(!($activity_type = $this->request->request('activity_type')))
	     {
		$this->response->setParameters(array('Status' => 'Missing activity_id parameter'));
		$this->response->send();
		die;
	     }
	    
	     if(!($timestamp = $this->request->request('timestamp')))
	     {
		$this->response->setParameters(array('Status' => 'Missing timestamp parameter'));
		$this->response->send();
		die;
	     }
	     if(!($activity = $this->request->request('message')))
	     {
		$this->response->setParameters(array('Status' => 'Missing message type'));
		$this->response->send();
		die;
	     } 
	     $this->load->model('activities_model');	
	      if(!($id_user = $this->uri->segment(3)))
	      {
			 $this->response->setParameters(array('Status' => 'Missing user id in url'));
			 $this->response->send();
			 die; 
		  }
		  $timestamp = date('Y-m-d H:i:s',$timestamp);
	      $this->activities_model->add_activity($id_user, $activity_type, $activity, $timestamp);
  
	     //we can also check whether here the correct source is posting correct activty type
	    
	     
	     
             $this->response->setParameters(array('Status' => 'OK'));
			 $this->response->send();
    }
    function achievement()
    {
		//here we should chcek wether the message is plain html and not some malicious crap, if allowing third party apps
	   
	     if(!($activity_type = $this->request->request('id_achievement')))
	     {
		$this->response->setParameters(array('Status' => 'Missing id_achievement parameter'));
		$this->response->send();
		die;
	     }
	    
	     if(!($timestamp = $this->request->request('timestamp')))
	     {
		$this->response->setParameters(array('Status' => 'Missing timestamp parameter'));
		$this->response->send();
		die;
	     }
	     if(!($activity = $this->request->request('course_name')))
	     {
		$this->response->setParameters(array('Status' => 'Missing course_name'));
		$this->response->send();
		die;
	     } 
	     $this->load->model('activities_model');	
	      if(!($id_user = $this->uri->segment(3)))
	      {
			 $this->response->setParameters(array('Status' => 'Missing user id in url'));
			 $this->response->send();
			 die; 
		  }
		  $timestamp = date('Y-m-d H:i:s',$timestamp);
	      $this->activities_model->add_activity($id_user, $activity_type, $activity, $timestamp);
  
	     //we can also check whether here the correct source is posting correct activty type
	    
	     
	     
             $this->response->setParameters(array('Status' => 'OK'));
			 $this->response->send();
    }

     
}

 ?> 
