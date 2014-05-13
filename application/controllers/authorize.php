<?php
class Authorize extends CI_Controller
{
      function __construct()
      {
	  parent::__construct();
	  
      }
      function is_logged_in()
      {
          
          $is_logged_in = $this->session->userdata('is_logged_in');
          if(!isset($is_logged_in) || $is_logged_in != true)
          {
         
		  $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
          $url =$this->config->site_url()."/".$this->uri->uri_string(). $query;  
	 
	  
	 
          redirect('login?returnUrl='.urlencode($url));

           die();
          }
      }

      function index()
      {
      require_once __DIR__.'/server.php';
      $request = OAuth2\Request::createFromGlobals();
      $response = new OAuth2\Response();

      // validate the authorize request
      if (!$server->validateAuthorizeRequest($request, $response)) {
	  $response->send();
	  die;
      }
      //check if some user is logged in, we will get further only after somebody has logged in
      $this->is_logged_in();
      
      $user = $this->session->userdata('user_id');
      
       $server->handleAuthorizeRequest($request, $response, TRUE, $user);
      
	// this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
	  $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
	//exit("SUCCESS! Authorization Code: $code");
      //ulozime k danemu authorization codu este aj session_id aby sme si to potom vedeli v databaze spravne priradit:
      
      $this->load->model('oauth/token_model');
      $this->token_model->assign_session_to_authorization_code($this->session->userdata('unique_session_id'), $code);
     
      
      $response->send();
      }
}
?>
