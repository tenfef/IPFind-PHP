<?php

namespace IPFind;

use Exception;

class IPFind
{
	private $apiKey;
	private $urlHost = "https://ipfind.co";

	public function __construct($apiKey = NULL)
	{
		$this->apiKey = $apiKey;
	}

	public function setApiKey($apiKey)
	{		
		$this->apiKey = $apiKey;
	}

    public function fetchIPAddress($ipAddress)
    {
    	if (! $this->_validateIPAddress($ipAddress))
    	{
    		throw new InvalidIPAddressException("Invalid IP Address: " . $ipAddress);
    	}

    	$query = ['ip' => $ipAddress];
    	if ($this->apiKey)
    	{
    		$query['auth'] = $this->apiKey;
    	}
    	
		$curl = curl_init();		
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $this->urlHost . '?' . http_build_query($query),
		    CURLOPT_USERAGENT => 'IPFind PHP Library',
		    CURLOPT_HEADER => 0,
		    CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_SSL_VERIFYHOST => 0
		));		
		$response = curl_exec($curl);		

		if (! $response)
		{
			$error = curl_error($curl);
			$errorCode = curl_errno($curl);

			throw new APIErrorException("Could not fetch IP Find " . $errorCode . " - ". $error);
		}

		curl_close($curl);

		$data = json_decode($response);

		if (! $data)
		{
			throw new UnexpectedResponseException("Could not reach IP Find at this time");
		}

		return $data;

    }

    private function _validateIPAddress($ipAddress)
    {
    	return filter_var($ipAddress, FILTER_VALIDATE_IP) !== false;
    }

}

class InvalidIPAddressException extends Exception {}
class APIErrorException extends Exception {}
class UnexpectedResponseException extends Exception {}