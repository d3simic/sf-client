<?php

namespace CfuPackage\SfClient;

use CfuPackage\SfClient\Contracts\SfClientInterface;

/**
**/
class SfWrapper implements SfClientInterface
{
	private $client;

	public function __construct(SfClientInterface $client)
	{
		$this->client = $client;
	}

	public function login()
	{
		$result = $this->client->login();

		return $result;
	}

	public function create($sObjectArray, $type)
	{
		$result = $this->client->create($sObjectArray, $type);

		return $result;
	}	
}
