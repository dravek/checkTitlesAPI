<?php

require './vendor/autoload.php';
use GuzzleHttp\Client;

class curlTest extends PHPUnit\Framework\TestCase{

    /**
     * client variable for curl
     */
    protected $client;

    /**
     * Initialize curl client
     */
    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8888'
        ]);
    }

    /**
     * Test for status 200
     */
    public function testStatusCode_equals_200()
    {
        $this->setUp();

        $response = $this->client->request('post', 'curl', ['json' => [['url' => 'elpais.com'],['url' => '20minutos.es']]]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test comparing titles
     */
    public function testPost_comparing_titles()
    {
        $this->setUp();

        $response = $this->client->request('post', 'curl', ['json' => [['url' => 'elpais.com'],['url' => '20minutos.es']]]);

        $data = json_decode($response->getBody(), true);
        
        $this->assertEquals('EL PAÍS: el periódico global', $data[0]['title']);
        
    }

    /**
     * Test to check if array has key 'url' and 'title'
     */
    public function testPost_arrayHasKey_url_title()
    {
        $this->setUp();

        $response = $this->client->request('post', 'curl', ['json' => [['url' => 'elpais.com'],['url' => '20minutos.es']]]);

        $data = json_decode($response->getBody(), true);
        
        $this->assertArrayHasKey('url', $data[1]);
        $this->assertArrayHasKey('title', $data[1]);
    }


}