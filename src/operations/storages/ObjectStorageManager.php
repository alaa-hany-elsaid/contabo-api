<?php

namespace Alaahany\ContaboApi\operations\storages;

use Alaahany\ContaboApi\base\ContaboClient;
use Alaahany\ContaboApi\exceptions\ContaboException;
use Alaahany\ContaboApi\operations\Operation;

class ObjectStorageManager extends Operation
{


    public function __construct(ContaboClient $contaboClient)
    {
        parent::__construct($contaboClient);
    }

    public function all($page = 1, $numberPerPage = 10, $otherOptiond = [])
    {
        return $this->client->execute('get', 'object-storages', [
            'query' => array_merge([
                'page' => $page,
                'size' => $numberPerPage
            ], $otherOptiond)
        ]);
    }


    /**
     * @throws ContaboException
     */
    public function createObjectStorage($region, $totalPurchasedSpaceTB, $autoscalingState, $autoscalingsizeLimitTB)
    {
        return $this->client->execute('post', 'object-storages', [
            'json' => [
                'region' => $region,
                'totalPurchasedSpaceTB' => $totalPurchasedSpaceTB,
                'autoscaling' => [
                    'state' => $autoscalingState,
                    'sizeLimitTB' => $autoscalingsizeLimitTB
                ],
            ]
        ]);
    }


    /**
     * @throws ContaboException
     */
    public function getObjectStorage($objectStorageId)
    {
        return $this->client->execute('get', 'object-storages/' . $objectStorageId);
    }

    /**
     * @throws ContaboException
     */
    public function updateObjectStorage($objectStorageId, $totalPurchasedSpaceTB, $autoscalingState, $autoscalingsizeLimitTB)
    {
        return $this->client->execute('post', 'object-storages/' . $objectStorageId . '/resize', [
            'json' => [
                'totalPurchasedSpaceTB' => $totalPurchasedSpaceTB,
                'autoscaling' => [
                    'state' => $autoscalingState,
                    'sizeLimitTB' => $autoscalingsizeLimitTB
                ],
            ]
        ]);
    }


    /**
     * @throws ContaboException
     */
    public function cancelObjectStorage($objectStorageId)
    {
        return $this->client->execute('patch', 'object-storages/' . $objectStorageId . '/cancel');

    }


}