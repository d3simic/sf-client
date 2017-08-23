<?php

namespace CfuPackage\SfClient\Wrappers;

use CfuPackage\SfClient\Contracts\SfClientInterface;
use CfuPackage\SfClient\Contracts\SfSoapInterface;

/**
**/
class SfSoapClient implements SfClientInterface
{
	private $soapClient;
	private $serverUrl;
	private $sessionId;

	public function __construct()
	{
		$this->soapClient = new \SoapClient(config('SfClient.SF_SOAP.SF_SOAP_WSDL'));
	}

	public function login()
	{
		$result = $this->getSoapClient()->login([
			'username' => config('SfClient.SF_USERNAME'),
			'password' => config('SfClient.SF_PASSWORD').config('SfClient.SF_PASSWORD_TOKEN')
		]);

		$this->serverUrl = $result->result->serverUrl;
		$this->sessionId = $result->result->sessionId;

		$header = new \SoapHeader(config('SfClient.SF_SOAP.WSDL_HEADER_NAMESPACE'), "SessionHeader", array ('sessionId' => $this->sessionId));
		$this->soapClient->__setLocation($this->serverUrl);
		$this->soapClient->__setSoapHeaders($header);

		return $result;
	}

	public function create($sObjectArray, $type)
	{
		$sObjects = array( 
		    new \SoapVar((object) $sObjectArray, SOAP_ENC_OBJECT, $type, config('SfClient.SF_SOAP.WSDL_OBJECT_NAMESPACE'))
		);
		$result = $this->getSoapClient()->create(new \SoapParam($sObjects, 'sObjects'));

		return $result;
	}
		

	public function getSoapClient()
	{
		return $this->soapClient;
	}
}
