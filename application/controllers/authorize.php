<?php
class Authorize extends CI_Controller
{
      function __construct()
      {
	  parent::__construct();
	  // include our OAuth2 Server object
	  
      }
      function is_logged_in()
      {
          
          $is_logged_in = $this->session->userdata('is_logged_in');
          if(!isset($is_logged_in) || $is_logged_in != true)
          {
          echo 'You have to log in! ';
	  echo form_open('login');
	  $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
          $url =$this->config->site_url()."/".$this->uri->uri_string(). $query;  
	  echo form_hidden('returnUrl',$url);
	  
	  echo form_submit('submit','Login');
          echo form_close();
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
      //check if some user is logged in
      $this->is_logged_in();
      // display an authorization form
      /*if (empty($_POST)) {
	exit('
      <form method="post">
	<label>Do You Authorize TestClient?</label><br />
	<input type="submit" name="authorized" value="yes">
	<input type="submit" name="authorized" value="no">
      </form>');
      }

      // print the authorization code if the user has authorized your client
      $is_authorized = ($_POST['authorized'] === 'yes');
      */
      $user = $this->session->userdata('user_id');
      
      $server->handleAuthorizeRequest($request, $response, TRUE, $user);
      if ($is_authorized) {
	// this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
	$code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
	//exit("SUCCESS! Authorization Code: $code");
      }
      $response->send();
      }
}
?>
