<?php


namespace Alphacar\GrpcCaller;


class ServiceInstance
{
    public $id;
    public $name;
    public $version;
    public $metadata;
    public $endpoints;


    /**
     * @return mixed
     */
    public function getEndpoints()
    {
        return $this->endpoints;
    }
}