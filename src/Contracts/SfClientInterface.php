<?php

namespace CfuPackage\SfClient\Contracts;

interface SfClientInterface
{
	public function login();
	public function create($sObjectArray, $type);
}