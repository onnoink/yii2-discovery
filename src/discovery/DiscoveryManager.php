<?php


namespace discovery;


use discovery\registrar\Discovery;
use yii\base\Component;

class DiscoveryManager extends Component
{
    public $registrar;

    /**
     * @var null | Discovery
     */
    private $instance = null;

    public function getService($serviceName, $tags = [])
    {
        if ($this->instance === null) {
            $this->instance = \Yii::createObject($this->registrar);
        }
        return $this->instance->getService($serviceName, $tags);
    }
}