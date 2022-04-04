<?php

namespace Alaahany\ContaboApi\operations\instances;

use Alaahany\ContaboApi\exceptions\ContaboException;
use Alaahany\ContaboApi\operations\Operation;

class ComputeInstancesManager extends Operation
{

    public function __construct($contaboClient)
    {
        parent::__construct($contaboClient);
    }




    /**
     * @throws ContaboException
     */
    public function all($page = 1, $numberPerPage = 10, $otherOptions = [])
    {

        return $this->client->execute('get', 'compute/instances', [
            'query' => array_merge([
                'page' => $page,
                'size' => $numberPerPage
            ], $otherOptions)
        ]);
    }




    /**
     * @throws ContaboException
     */
    public function create($imageId, $product, $region,  $otherOptions = [])
    {

        return $this->client->execute('post', 'compute/instances', [
            'json' => array_merge([
                'imageId' => $imageId,
                'productId' => $product,
                'region' => $region,
            ], $otherOptions)
        ]);
    }




    public function getInstance($instanceId)
    {
        return new ComputeInstance($instanceId, $this->client);
    }


    /**
     * @throws ContaboException
     */
    public function getInstanceInformation($instanceId)
    {

        return (new ComputeInstance($instanceId, $this->client))->getInformation();
    }


    /**
     * @throws ContaboException
     */
    public function updateInstance($instanceId, $name)
    {
        return (new ComputeInstance($instanceId, $this->client))->update($name);
    }


    /**
     * @throws ContaboException
     */
    public function reinstallInstance($instanceId, $imageId, $otherOptions = [])
    {
        return (new ComputeInstance($instanceId, $this->client))->reinstall($imageId, $otherOptions);
    }


    /**
     * @throws ContaboException
     */
    public function cancelInstance($instanceId)
    {
        return (new ComputeInstance($instanceId, $this->client))->cancel();
    }


    /**
     * @throws ContaboException
     */
    public function listHistory($page = 1, $numberPerPage = 10, $otherOptions = [])
    {

        return $this->client->execute('get', 'compute/instances/audits', [
            'query' => array_merge([
                'page' => $page,
                'size' => $numberPerPage
            ], $otherOptions)
        ]);
    }


    /**
     * @throws ContaboException
     */
    public function listActionsHistory($page = 1, $numberPerPage = 10, $otherOptions = [])
    {
        return $this->client->execute('get', 'compute/instances/actions/audits', [
            'query' => array_merge([
                'page' => $page,
                'size' => $numberPerPage
            ], $otherOptions)
        ]);
    }

}