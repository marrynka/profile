<?php
$dsn      = 'mysql:dbname=profile;host=localhost';
$username = 'root';
$password = 'root';

// error reporting (this is a demo, after all!)
ini_set('display_errors',1);error_reporting(E_ALL);


require __DIR__.'/../../vendor/autoload.php';
OAuth2\Autoloader::register();

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
$storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

$server = new OAuth2\Server($storage, array(
    'always_issue_new_refresh_token' => true,
    'refresh_token_lifetime'         => 10800,
    'access_lifetime'          => 7200,
    
));

//Add the "Refresh Token" grant type

$server->addGrantType(new OAuth2\GrantType\RefreshToken($storage, array(
    'always_issue_new_refresh_token' => true)));

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

$defaultScope = 'receiveinformation';
$supportedScopes = array(
  'receiveinformation',
  'postinformation'
);
$memory = new OAuth2\Storage\Memory(array(
  'default_scope' => $defaultScope,
  'supported_scopes' => $supportedScopes
));
$scopeUtil = new OAuth2\Scope($memory);

$server->setScopeUtil($scopeUtil);


?>
