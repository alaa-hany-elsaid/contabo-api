<?php

namespace Alaahany\ContaboApi\operations\images;

use Alaahany\ContaboApi\base\ContaboClient;
use Alaahany\ContaboApi\exceptions\ContaboException;
use Alaahany\ContaboApi\operations\Operation;

class ImagesManager extends  Operation
{

    public function __construct(ContaboClient $contaboClient)
    {
        parent::__construct($contaboClient);
    }

    /**
     * @throws ContaboException
     */
    public function listAvailable($page = 1 , $numberPerPage = 10 , $otherOptiond = []) {
        // compute/images

        return  $this->client->execute('get' , 'compute/images' , [
            'query' =>  array_merge([
                'page' => $page,
                'size' => $numberPerPage
            ] , $otherOptiond)
        ]);
    }

    /**
     * @throws ContaboException
     */
    public function getImageDetails($imageId) {

        return  $this->client->execute('get' , 'compute/images/' . $imageId );
    }

    /**
     * @throws ContaboException
     */
    public function provideCustomImage($name , $url , $osType , $version , $description = "") {
        // compute/images

        return  $this->client->execute('post' , 'compute/images' , [
            'json' =>  [
                'name' => $name,
                'url' => $url ,
                'osType' => $osType ,
                'version' => $version ,
                $description === "" ?: 'description' => $description ,
            ]
        ]);
    }

    /**
     * @throws ContaboException
     */
    public function updateCustomImage($imageId , $name , $description) {
        return  $this->client->execute('patch' , 'compute/images/' . $imageId , [
            'json' =>  [
                'name' => $name,
                $description === "" ?: 'description' => $description ,
            ]
        ]);
    }

    /**
     * @throws ContaboException
     */
    public function deleteCustomImage($imageId ) {
        return  $this->client->execute('DELETE' , 'compute/images/' . $imageId  );
    }


}