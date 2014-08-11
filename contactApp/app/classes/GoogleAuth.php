<?php

class GoogleAuth {
	protected $client;

	public function __construct(Google_Client $googleClient = null){
		$this->client = $googleClient;
		if($this->client){
			$this->client->setApplicationName('Google Contact App');
			$this->client->setClientId('966971385643-o36bsg0ssr4kgdgqcee7qdseds17q4kp.apps.googleusercontent.com');
			$this->client->setClientSecret('QfhCa03KbJwUHJi6ejuhAsqe');
			$this->client->setRedirectUri('http://contactapp-prayascode.rhcloud.com/contactApp/index.php');
			$this->client->setScopes('http://www.google.com/m8/feeds');
			$this->client->setAccessType('online');
		}
	}
	public function isLoggedIn(){
		return isset($_SESSION['access_token']);
	}
	public function getAuthUrl(){
		session_start();
		return $this->client->createAuthUrl();
	}
	public function checkRedirectCode(){
		if(isset($_GET['code'])){
			$this->client->authenticate($_GET['code']);
			$this->setToken($this->client->getAccessToken());
			return true;
		}
		return false;
	}

	public function setToken($token){
		$_SESSION['access_token'] = $token;
		$this->client->setAccessToken($token);
	}
}
