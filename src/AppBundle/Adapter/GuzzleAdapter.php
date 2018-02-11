<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/9/18
 * Time: 11:21 PM
 */

namespace AppBundle\Adapter;


use GuzzleHttp\Client;

class GuzzleAdapter implements DataComInterface
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get($uri, array $options = [])
    {
        $response = $this->client->get($uri, $options);
        return $response->getBody()->getContents();
    }

    public function post($uri, array $options = [])
    {
        // TODO: Implement post() method.
        return $this->client->post($uri, $options);
    }

}