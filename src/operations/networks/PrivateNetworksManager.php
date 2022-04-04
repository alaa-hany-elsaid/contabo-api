<?php

namespace Alaahany\ContaboApi\operations\networks;

use Alaahany\ContaboApi\base\ContaboClient;
use Alaahany\ContaboApi\exceptions\ContaboException;

class PrivateNetworksManager extends \Alaahany\ContaboApi\operations\Operation
{


    public function __construct(ContaboClient $contaboClient)
    {
        parent::__construct($contaboClient);
    }


    /**
     * @throws ContaboException
     */
    public function all($page = 1, $numberPerPage = 10, $otherOptiond = [])
    {

        return $this->client->execute('get', 'private-networks', [
            'query' => array_merge([
                'page' => $page,
                'size' => $numberPerPage
            ], $otherOptiond)
        ]);
    }




    /**
     * @throws ContaboException
     */
    public function  createPrivateNetwork($region , $name , $description  = '') {

        return  $this->client->execute('post' , 'private-networks' , [
            'json' =>  [
                'name' => $name,
                'region' => $region ,
                $description === "" ?: 'description' => $description ,
            ]
        ]);

    }


    /**
     * @throws ContaboException
     */
    public function  updatePrivateNetwork($privateNetworkId , $name , $description = '' ) {

        return  $this->client->execute('post' , 'private-networks/' .$privateNetworkId , [
            'json' =>  [
                'name' => $name,
                $description === "" ?: 'description' => $description ,
            ]
        ]);

    }


    /**
     * @throws ContaboException
     */
    public function  getPrivateNetwork($privateNetworkId) {

        return  $this->client->execute('get' , 'private-networks/' .$privateNetworkId );

    }




    /**
     * @throws ContaboException
     */
    public function  deletePrivateNetwork($privateNetworkId) {

        return  $this->client->execute('delete' , 'private-networks/' .$privateNetworkId );

    }




    /**
     * @throws ContaboException
     */
    public function addInstanceToPrivateNetwork($privateNetworkId , $instanceId) {


        return  $this->client->execute('post' , 'private-networks/' .$privateNetworkId . '/instances/' .$instanceId);
    }





    /**
     * @throws ContaboException
     */
    public function deleteInstanceFromPrivateNetwork($privateNetworkId , $instanceId) {


        return  $this->client->execute('delete' , 'private-networks/' .$privateNetworkId . '/instances/' .$instanceId);
    }


}