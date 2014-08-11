<?php

class GoogleContacts{
	public function __construct(){
	}
	public function isLoggedIn(){
		$key = isset($_SESSION['access_token']);
		return $key;
	}

	public function getContacts(){
		$token = $_SESSION['access_token'];
		$decodedToken = json_decode($token);
		$decodedToken->access_token;
		$curl = curl_init("https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=10000&access_token=".$decodedToken->access_token);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($curl, CURLOPT_TIMEOUT,50);
		$contactsJson = curl_exec($curl);
		curl_close($curl);
		$contacts = json_decode($contactsJson, true);
		$returnArr = array();
		if (count($contacts) == 0){
			return 0;
		}
		foreach($contacts['feed']['entry'] as $contact){
			$return = array(
					'name'=>$contact['title']['$t'],
					'email' => isset($contact['gd$email'][0]['address']) ? $contact['gd$email'][0]['address'] : false,
					'phoneNumber' => isset($contact['gd$phoneNumber'][0]['$t']) ? $contact['gd$phoneNumber'][0]['$t'] : false,
				);
			array_push($returnArr, $return);
		}
		return $returnArr;
	}

	public function getSortedContacts($fromDateStr){
		$fromDateSplit = explode("/",$fromDateStr);
		$fromDate = $fromDateSplit[2].'-'.$fromDateSplit[1].$fromDateSplit[0].'T00:00:00';
		$token = $_SESSION['access_token'];
		$decodedToken = json_decode($token);
		$decodedToken->access_token;
		$curl = curl_init("https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=10000&orderby=lastmodified&updated-min=".$fromDate."&access_token=".$decodedToken->access_token);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($curl, CURLOPT_TIMEOUT,50);
		$contactsJson = curl_exec($curl);
		curl_close($curl);
		$contacts = json_decode($contactsJson, true);
		$returnArr = array();
		var_dump($contactsJson);
		foreach($contacts['feed']['entry'] as $contact){
			$return = array(
					'name'=>$contact['title']['$t'],
					'email' => isset($contact['gd$email'][0]['address']) ? $contact['gd$email'][0]['address'] : false,
					'phoneNumber' => isset($contact['gd$phoneNumber'][0]['$t']) ? $contact['gd$phoneNumber'][0]['$t'] : false,
				);
			array_push($returnArr, $return);
		
		}
		return $returnArr;
	}
/*
public function testContacts(){
		$fromDateSplit = explode("/",$fromDateStr);
		$fromDate = $fromDateSplit[2].'-'.$fromDateSplit[1].$fromDateSplit[0].'T00:00:00';
		$token = $_SESSION['access_token'];
		$decodedToken = json_decode($token);
		$decodedToken->access_token;
		#$curl = curl_init("https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=1&orderby=lastmodified&access_token=".$decodedToken->access_token);
		$curl = curl_init("https://schemas.google.com/contact/2008/kanha.prayas@0gmail.com/full/a8a24670cf69dd4&&access_token=".$decodedToken->access_token);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($curl, CURLOPT_TIMEOUT,50);
		$contactsJson = curl_exec($curl);
		curl_close($curl);
		$contacts = json_decode($contactsJson, true);
		$returnArr = array();
		var_dump($contactsJson);
		foreach($contacts['feed']['entry'] as $contact){
			#var_dump($contact) ; $feed->{'ab:test'}->value
			echo $contact->['gContact']['gender'];
		}
		return $returnArr;
	}
*/
}
