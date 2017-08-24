<?php

return [
	'SF_USERNAME' => env('SF_USERNAME'),
	'SF_PASSWORD' => env('SF_PASSWORD'),
	'SF_PASSWORD_TOKEN' => env('SF_PASSWORD_TOKEN'),
	'SF_SOAP' => [
		'SF_VERSION' => env('SF_VERSION'),
		'SF_SOAP_WSDL' => env('SF_SOAP_WSDL'),
		'WSDL_HEADER_NAMESPACE' => 'urn:'.env('SF_VERSION').'.soap.sforce.com',
		'WSDL_OBJECT_NAMESPACE' => 'urn:sobject.'.env('SF_VERSION').'.soap.sforce.com'
	],
	'SF_REST' => [
		'SF_USER_SECRET' => env('SF_USER_SECRET'),
		'SF_USER_ID' => env('SF_USER_ID'),
		'SF_GRANT_TYPE' => env('SF_GRANT_TYPE'),
		'SF_CALLBACK_URL' => env('SF_CALLBACK_URL'),
		'SF_LOGIN_URL' => env('SF_LOGIN_URL')
	]
];