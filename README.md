Unofficial Contabo API
====

Contabo API allows you to manage your resources using PHP


Installation
------------

Install the latest version with:

```bash
$ composer require  alaa-hany/contabo-api
```

Requirements
------------

* PHP 5.6 or higher is required

Supported Operations for Now
----------------------------

* Instance
    * List instances
    * Create a new instance
    * Get specific instance by id
    * Update specific instance
    * Reinstall specific instance
    * Cancel specific instance by id
    * List operations history
* Instance Action
    * Start
    * Restart
    * Stop
    * Shutdown
    * List action history
* Images
    * List available standard and custom images
    * Provide a custom image
    * Get details about a specific image by its id
    * Update custom image name by its id
    * Delete an uploaded custom image by its id
    * List Operations history
* Object Storage
    * List all your Object Storages
    * Create a new object storage
    * Get specific object storage by its id
    * Upgrade object storage size resp. update autoscaling settings.
    * Cancels the specified object storage at the next possible date
* Private Network
    * List private networks
    * Create a new private network
    * Update a private network by id
    * Get specific private network by id
    * Delete existing private network by id
    * Add instance to a private network
    * Remove instance from a private network
* Tags (It will be supported in next versions )
* Users (It will be supported in next versions )
* Roles (It will be supported in next versions )
* Secrets (It will be supported in next versions )

Basic usage
-----------

```php
// All API Calls made throw HTTPS 
use Alaahany\ContaboApi\base\ContaboClient;
$client_id = "client_id"; // IP is preferred , we take care of get Domain
$client_secret  = 'client_secret' ; //  for example
$username = "username" ; //
$password = "password" ; //
$contaboClient = new ContaboClient($client_id , $client_secret  , $username , $password);

var_dump($contaboClient->getComputeInstancesManagerInstance()->all());
var_dump($contaboClient->getComputeInstancesManagerInstance()->create('imageId' , \Alaahany\ContaboApi\operations\instances\Products::VPS_L ,\Alaahany\ContaboApi\operations\Regions::Germany , [
    'license' => \Alaahany\ContaboApi\operations\instances\Licenses::cPanel5
] ));
var_dump($contaboClient->getComputeInstancesManagerInstance()->listHistory());
var_dump($contaboClient->getComputeInstancesManagerInstance()->listActionsHistory());
$instance = $contaboClient->getComputeInstancesManagerInstance()->getInstance('instanceId');
var_dump($instance->restart());
var_dump($instance->start());
var_dump($instance->shutdown());
var_dump($instance->stop());
var_dump($contaboClient->getPrivateNetworksManagerInstance()->all());
var_dump($contaboClient->getImagesManagerInstance()->listAvailable());
var_dump($contaboClient->getObjectStorageManagerInstance()->all());
```

Note
----
If you need any non exists operation , you are welcome to order it . <br>
Contact me on : <br>
&nbsp;&nbsp;Email : [elboray.alaa1@gmail.com](mailto:elboray.alaa1@gmail.com) <br>
&nbsp;&nbsp;whatsapp : [+201063745208](https://wa.me/201063745208)

License
-------
alaa-hany/contabo-api is licensed under the MIT License.