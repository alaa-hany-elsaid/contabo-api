<?php

namespace Alaahany\ContaboApi\base;

use Alaahany\ContaboApi\exceptions\ContaboException;
use Alaahany\ContaboApi\operations\images\ImagesManager;
use Alaahany\ContaboApi\operations\instances\ComputeInstancesManager;
use Alaahany\ContaboApi\operations\networks\PrivateNetworksManager;
use Alaahany\ContaboApi\operations\storages\ObjectStorageManager;
use Alaahany\ContaboApi\utilities\Config;
use GuzzleHttp\Client as ClientG;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Ramsey\Uuid\Uuid;

class ContaboClient
{
    use  AuthAddon;

    private $clientG;
    private $token = null;
    private $clientID;
    private $clientSecret;
    private $APIUser;
    private $APIPassword;
    protected $defaultOptions = [];

    /**
     * @throws ContaboException
     */
    public function __construct($clientID, $clientSecret, $APIUser, $APIPassword)
    {
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
        $this->APIUser = $APIUser;
        $this->APIPassword = $APIPassword;
        $this->clientG = new ClientG([
            'base_uri' => config::BASE_URL
        ]);
        $this->getAccessToken();
        $this->defaultOptions['headers'] = [
            'Authorization' => "Bearer " . $this->getAccessToken(),
            'x-request-id' => Uuid::uuid4()->toString()
        ];
    }


    /**
     * @throws ContaboException
     */
    public function getAccessToken()
    {

        if ($this->token === null) {
            $this->token = $this->generateAccessToken();
        }

        return $this->token;

    }


    /**
     * @throws ContaboException
     */
    public function execute($method, $path, $options = [])
    {
        try {
            return json_decode($this->clientG->request($method, $path, array_merge_recursive($this->defaultOptions, $options))->getBody()->getContents());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            throw new ContaboException($response->getBody()->getContents(), $response->getStatusCode());
        } catch (GuzzleException $e) {
            throw new ContaboException("Unknow Exception", 50);
        }

    }


    public function getComputeInstancesManagerInstance()
    {
        return new ComputeInstancesManager($this);
    }


    public function getPrivateNetworksManagerInstance()
    {
        return new PrivateNetworksManager($this);
    }

    public function getObjectStorageManagerInstance()
    {
        return new ObjectStorageManager($this);
    }

    public function getImagesManagerInstance()
    {
        return new ImagesManager($this);
    }

}