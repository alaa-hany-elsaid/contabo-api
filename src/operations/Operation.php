<?php

namespace Alaahany\ContaboApi\operations;

use Alaahany\ContaboApi\base\ContaboClient;

abstract class Operation
{

    protected   $client ;

    public function __construct(ContaboClient $contaboClient)
    {
        $this->client = $contaboClient;
    }

}