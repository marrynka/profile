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
    //here scopes can be checked for example	
}
if($request->request('grant_type') == 'authorization_code')
{
 $code = $request->request('code');
 $this->load->model('oauth/token_model');
 $unique_session_id = $this->token_model->get_unique_session_id_to_authorization_code($code);
 $text = file_get_contents('debug.txt');
 $text .= 'checking code';
 file_put_contents('debug.txt', $text);
	 
 
}

if($request->request('grant_type') == 'refresh_token')
{
	$refresh = $request->request('refresh_token');
    $this->load->model('oauth/token_model');
    $unique_session_id = $this->token_model->get_unique_session_id_to_refresh_token($refresh);
}
   
 $response = new OAuth2\Response();

 
 $response = $server->handleTokenRequest($request,$response);
if($request->request('grant_type') == 'authorization_code' || $request->request('grant_type') == 'refresh_token')
{
	
 $parameters= $response->getParameters();
 $this->token_model->update_last_activity($unique_session_id, time(NULL));
 $this->token_model->assign_session_to_access_and_refresh_token($unique_session_id, $parameters['access_token'], $parameters['refresh_token']);  
 $text = file_get_contents('debug.txt');
 $text .= 'assigning session id to refresh and access';
 file_put_contents('debug.txt', $text);
}






$this->load->model('oauth/token_model');
$data = $response->getParameters();
$data_to_response = $this->token_model->get_username_and_user_id_to_access_token($data['access_token']);
$data_to_response['unique_session_id'] = $unique_session_id;

$text = file_get_contents('debug.txt');
 $text .= 'creating response';
 file_put_contents('debug.txt', $text);
 

$response->addParameters($data_to_response);
$return = $response->send();
$text = file_get_contents('debug.txt');
 $text .= 'response sent return value: ' . $return;
 file_put_contents('debug.txt', $text);
 
if( $request->request('grant_type') == 'authorization_code' || ($request->request('grant_type') == 'refresh_token' && $request->request('response') == 'false')  ) 
{	
	
	require __DIR__.'/../../vendor/autoload.php';
    
    $this->load->model('membership_model');
    $this->load->model('oauth/token_model');
    $user = $this->token_model->get_username_and_user_id_to_access_token($parameters['access_token']);
    $user_id = $user['id_user'];
    $username = $user['username'];
    
    $other_clients = $this->membership_model->where_is_logged_in($user_id);
     
    if($other_clients->num_rows >= 1)
    {  
		foreach($other_clients->result() as $client)
		{	         
			if($request->request('client_id') == $client->client_id) 
			{
				continue;
			}
			
			$http = new Guzzle\Http\Client($this->membership_model->get_redirect_uri($client->client_id), array(
			'request.options' => array(
			'exceptions' => false,
					)
				));
			$unique_session_id2 = $this->token_model->get_unique_session_id_to_access_token($parameters['access_token']);
			$request2 = $http->post($this->membership_model->get_redirect_uri($client->client_id), null, array(
					'request'     => 'prolong',
					'unique_session_id' => $unique_session_id2,
					'id_user' => $user_id,
				));
			   try{ 
			   $response2 = $request2->send();
			   }
				catch (Guzzle\Http\Exception\BadResponseException $e)
				{
					echo 'Error: ' . $e->getMessage();
				}
	       
		}
	}
	
	
}




}
}
?>
