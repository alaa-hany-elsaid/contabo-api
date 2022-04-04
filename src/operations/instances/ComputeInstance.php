<?php

namespace Alaahany\ContaboApi\operations\instances;

use Alaahany\ContaboApi\base\ContaboClient;
use Alaahany\ContaboApi\exceptions\ContaboException;
use Alaahany\ContaboApi\operations\Operation;

class ComputeInstance extends Operation
{
    private $instanceId;

    public function __construct($instanceId, ContaboClient $contaboClient)
    {
        $this->instanceId = $instanceId;
        parent::__construct($contaboClient);
    }

    /**
     * @return mixed
     */
    public function getInstanceId()
    {
        return $this->instanceId;
    }


    /**
     * @param mixed $instanceId
     */
    public function setInstanceId($instanceId)
    {
        $this->instanceId = $instanceId;
    }

    /**
     * @throws ContaboException
     */
    public function start()
    {

        return $this->client->execute('post', 'compute/instances/' . $this->instanceId . '/actions/start');
    }

    /**
     * @throws ContaboException
     */
    public function restart()
    {

        return $this->client->execute('post', 'compute/instances/' . $this->instanceId . '/actions/restart');

    }

    /**
     * @throws ContaboException
     */
    public function stop()
    {

        return $this->client->execute('post', 'compute/instances/' . $this->instanceId . '/actions/stop');

    }

    /**
     * @throws ContaboException
     */
    public function shutdown()
    {

        return $this->client->execute('post', 'compute/instances/' . $this->instanceId . '/actions/shutdown');

    }


    /**
     * @throws ContaboException
     */
    public function getInformation()
    {
        return $this->client->execute('get', 'compute/instances/' . $this->instanceId);
    }


    /**
     * @throws ContaboException
     */
    public function cancel()
    {
        return $this->client->execute('post', 'compute/instances' . $this->instanceId . '/cancel');
    }


    /**
     * @throws ContaboException
     */
    public function reinstall($imageId, $otherOptions = [])
    {
        return $this->client->execute('put', 'compute/instances/' . $this->instanceId, [
            'json' => array_merge([
                'imageId' => $imageId,
            ], $otherOptions)
        ]);
    }


    /**
     * @throws ContaboException
     */
    public function update($newName , $otherOptions = [] ) {
        return $this->client->execute('PATCH', 'compute/instances/' . $this->instanceId, [
            'json' => array_merge( [
                'displayName' => $newName,
            ] , $otherOptions)
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
                'size' => $numberPerPage,
                'instanceId' => $this->instanceId
            ], $otherOptions)
        ]);
    }


}