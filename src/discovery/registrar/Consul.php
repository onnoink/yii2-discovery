<?php


namespace discovery\registrar;


use discovery\ServiceInstance;
use SensioLabs\Consul\ServiceFactory;
use SensioLabs\Consul\Services\Health;
use SensioLabs\Consul\Services\HealthInterface;
use Symfony\Component\HttpClient\Exception\TransportException;
use yii\base\Component;

class Consul extends Component implements Discovery
{
    public $address;

    /**
     * @var $client Health
     */
    private $client;


    public function init()
    {
        parent::init();
        $factory = new ServiceFactory(['base_uri' => $this->address]);
        /**
         * @var $service Health
         */
        $this->client = $factory->get(HealthInterface::class);
    }
    
    function getService($serviceName, $tags = [])
    {
        $query = [
            'service' => $serviceName,
            'near' => '_agent',
            'passing' => true,
        ];

        if ($tags) {
            $query['tags'] = $tags;
        }

        try {
            $response = $this->client->service($serviceName, $query);
            if ($response === null) {
                throw new ServerConnectionException();
            }
            if (empty($response->json())) {
                throw new ServiceNotFoundException(sprintf("service not found by name : %s", $serviceName));
            }

        } catch (TransportException $e) {
            throw new ServerConnectionException(sprintf("service not found by name : %s%s", $e->getMessage(), $serviceName));
        }


        $servers = $response->json();
        shuffle($servers);
        $target = array_pop($servers)['Service'];

        $instance = new ServiceInstance();
        $instance->id = $target['ID'];
        $instance->name = $target['Service'];
        $instance->version = "";
        $instance->metadata = [];
        $instance->endpoints = $target['Address'] . ":" . $target['Port'];
        return $instance;
    }
}