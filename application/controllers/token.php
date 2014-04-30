<?php

use OAuth2\ResponseType\ResponseTypeInterface;

class Token extends CI_Controller
{
function index()
{
// include our OAuth2 Server object
require_once __DIR__.'/server.php';

// Handle a request for an OAuth2.0 Access Token and send the response to the client

//check if it's not a combination client credentials and usupported scope for client credentials
$request = OAuth2\Request::createFromGlobals();

if($request->request('grant_type') == 'client_credentials')
{
    if($request->request('scope') != 'receiveinformation' )
    {
	$response = new OAuth2\Response();
        $response->setError(400, 'invalid_scope', 'The scope requested is invalid for this request');
	$response->send();
	return null;
    }	
}
if($request->request('grant_type') == 'authorization_code')
{
 $code = $request->request('code');
 $this->load->model('oauth/token_model');
 $session_id = $this->token_model->get_session_id_to_authorization_code($code);
}
   
 $response = new OAuth2\Response();

 $response = $server->handleTokenRequest($request,$response);
if($request->request('grant_type') == 'authorization_code')
{
 $parameters= $response->getParameters();
 $this->token_model->update_last_activity($session_id, time(NULL));
 $this->token_model->assign_session_to_access_and_refresh_token($session_id, $parameters['access_token'], $parameters['refresh_token']);
    


}
if($request->request('grant_type') == 'authorization_code')
{
    //updatnut last_activity sessionu so session id , na ktory bol vydany tento access token na profile, 
    //tym padom session na profile prirodzene timoutne najneskor zo vsetkych clients
    //danemu clientovi treba teraz poslat novy token, ktory expirne za tych standardnych 3600  
    // 
   // 
  
    
   //$this->load->model('oauth/token_model'); 
   //
   //$this->token_model->update_last_activity($session_id, 3);
   //$this->token_model->assign_session_to_access_and_refresh_token($session_id, $parameters['access_token'], $parameters['refresh_token'])
    	
}

//$this->load->model('oauth/token_model');
 //$session_id = $this->token_model->get_session_id_to_authorization_code('3550948f7bd53360f6f2b34dae630fb2f81ec1c2');
if($request->request('grant_type') == 'refresh_token')
{
	
	//overit, ci niekde este bol user aktivny, ci sme v limite a bla bla bla.
}



//$response->setParameters(array('session' => $session_id));
$response->send();
//$server->handleTokenRequest($request)->send();
//echo "kontrolny vypis";

}
}
?>
