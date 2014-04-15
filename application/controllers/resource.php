<?php


class Resource extends CI_Controller
{
    protected $response;
    protected $user;

    function __construct()
    {
	 parent::__construct();
	      // include our OAuth2 Server object
	 $this->load->model('userprofile_model');
	require_once __DIR__.'/server.php';
	
    // https://api.example.com/resource-requiring-postonwall-scope
    $request = OAuth2\Request::createFromGlobals();
    $this->response = new OAuth2\Response();
    $scopeRequired = 'receiveinformation'; // this resource requires "receiveinformation" scope
    if (!$server->verifyResourceRequest($request, $this->response, $scopeRequired)) 
    {
      // if the scope required is different from what the token allows, this will send a "401 insufficient_scope" error
	
	$this->response->send();
	die;
    }
    
    if(!$this->user = $this->uri->segment(3))
    {echo "Invalid url.";}
    
    
    }
    function index()
    {
    }

     
    
     /**
      function called by rescource functions to actually send the response
      */
    function _send_response($parameters)
    {
      $this->response->setParameters($parameters);
      $this->response->send();
    }
    /**returns first name of the user whose id is as a first parameter in URI
    */
    function get_firstname()
    {
	 
	 $first_name=$this->userprofile_model->get_firstname($this->user);
	 $this->_send_response(array('message' => $first_name));
	 
    }
    /**returns surname of the user
    */
    function get_surname()
    {
	
	 $surname=$this->userprofile_model->get_surname($this->user);
	 
	 $this->_send_response(array('message' => $surname));
	 
    }
    /**returns the whole name including collage degrees, etc.
    */
    function get_whole_name()
    {
	
	 $whole_name=$this->userprofile_model->get_whole_name($this->user);
	 
	 $this->_send_response(array('message' => $whole_name));
	
    }
    /**returns link to the profile picture of the user
    */
    function get_photo()
    {
	 
	 $photo=$this->userprofile_model->get_photo($this->user);
	 
	 $this->_send_response(array('message' => $photo));
	
    }
    /**returns the short version of “about the user”
    */
    function get_about()
    {
	
	 $about=$this->userprofile_model->get_about($this->user);
	 
	 $this->_send_response(array('message' => $about));

    }
    /**returns the email of the user
    */
    function get_email()
    {
	
	 $email=$this->userprofile_model->get_email($this->user);
	 
	 $this->_send_response(array('message' => $email));
	
    }
    /**returns true if user is a student else returns false function
    */
    function get_is_student()
    {
	
	 $student=$this->userprofile_model->get_is_student($this->user);
	 
	$this->_send_response(array('message' => $student));
	
    }
    /**returns true if user is a teacher else returns false
    */
    function get_is_teacher()
    {
	
	 $teacher=$this->userprofile_model->get_is_teacher($this->user);
	 
	 $this->_send_response(array('message' => $teacher));
	 
    }
    /**returns short html, which can be places on a destination website. This information contains
    name, photo, short
    verson of
    about, little achievement pictures,...
    */
    function get_profile()
    {
	
	 $profile=$this->userprofile_model->get_profile($this->user);
	 
	 $this->_send_response(array('message' => $profile));
	
    }
    /**returns extra short version, only with name and photo.
    */
    function get_profile_short()
    {
	
	 $profile_short=$this->userprofile_model->get_profile_short($this->user);
	 
	$this->_send_response(array('message' => $profile_short));
	
    }

}

?>