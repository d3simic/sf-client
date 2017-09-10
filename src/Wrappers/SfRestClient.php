<?php

namespace CfuPackage\SfClient\Wrappers;

use CfuPackage\SfClient\Contracts\SfClientInterface;

/**
 * 
 */
 class SfRestClient implements SfClientInterface
 {
 	private $serverUrl;
 	private $sessionId;

 	public function login()
 	{
 		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, config('SfClient.SF_REST.SF_LOGIN_URL').'/services/oauth2/token');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
			'username' => config('SfClient.SF_USERNAME'),
			'password' => config('SfClient.SF_PASSWORD').config('SfClient.SF_PASSWORD_TOKEN'),
			'client_id' => config('SfClient.SF_REST.SF_USER_ID'),
			'client_secret' => config('SfClient.SF_REST.SF_USER_SECRET'),
			'grant_type' => config('SfClient.SF_REST.SF_GRANT_TYPE'),
			'redirect_url' => config('SfClient.SF_REST.SF_CALLBACK_URL')

		)));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = json_decode(curl_exec($curl));

		curl_close ($curl);

		$this->serverUrl = $result->instance_url;
		$this->sessionId = $result->access_token;
		
		return $result;
 	}

 	public function create($sObjectArray, $type)
 	{
 		$sObjectJson = json_encode($sObjectArray);
 		
 		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $this->serverUrl.'/services/data/v40.0/sobjects/'.$type);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: '.strlen($sObjectJson),
			'Authorization: Bearer '.$this->sessionId
		));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $sObjectJson);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = json_decode(curl_exec($curl));

		curl_close ($curl);


		return $result;
 	}

 	public function upsert($sObjectArray, $type, $id_field, $id)
 	{
 		$sObjectJson = json_encode($sObjectArray);
 		
 		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $this->serverUrl.'/services/data/v40.0/sobjects/'.$type.'/'.$id_field.'/'.$id);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: '.strlen($sObjectJson),
			'Authorization: Bearer '.$this->sessionId
		));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $sObjectJson);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = json_decode(curl_exec($curl));

		curl_close ($curl);


		return $result;
 	}
 } 