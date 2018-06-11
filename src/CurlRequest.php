<?php

namespace App;

use GuzzleHttp\Client;

Class CurlRequest{

	private $title;

	/**
	*
	* Get Title of website
	*@param url
	*
	*/
	
	public function getTitle($url)
	{
		$client = new \GuzzleHttp\Client();

		$res = $client->request('GET', $url, [
	        'allow_redirects' => [
	            'max'             => 10,        // allow at most 10 redirects.
	            'strict'          => true,      // use "strict" RFC compliant redirects.
	            'referer'         => true,      // add a Referer header
	            'protocols'       => ['http','https'],
	            'on_redirect'     => $onRedirect,
	            'track_redirects' => true
	        ],
	        'verify'            => false,
	        'http_errors'       => false,
	        'connect_timeout'   => 2,
	        'debug'             => false
	    ]);

	    $status = "OK";

	    $content = $res->getBody();

	    $this->title = htmlspecialchars(preg_match('/<title[^>]*>(.*?)<\/title>/ims', $content, $title_matches) ? $title_matches[1] : "");

	    return $this->title;
	}


	/**
	*
	* Check if title contains the words 'news' or 'noticias'
	*
	*/

	public function isMarfeelizable()
	{
		$marfeelizable = 'NO';

	    // We check if contains news or noticias in the <TITLE></TITLE> tag
	    if (strpos(strtoupper($this->title), 'NEWS') !== false || strpos(strtoupper($this->title), 'NOTICIAS') !== false) {
	        $marfeelizable = 'YES';
	    }

	    return $marfeelizable;
	}

}