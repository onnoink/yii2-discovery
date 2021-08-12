<?php


namespace discovery\tests;

use discovery\registrar\Consul;
use discovery\registrar\ServerConnectionException;
use discovery\registrar\ServiceNotFoundException;

class ConsulTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUnknownService()
    {
        $this->expectException(ServiceNotFoundException::class);
        $consul = new Consul(
            "http://127.0.0.1:8500"
        );
        $consul->getService("basic.service.v12");
    }

    public function testConnectionError()
    {
        $this->expectException(ServerConnectionException::class);
        $consul = new Consul(
            "http://127.0.0.1:8500"
        );
        $consul->getService("basic.service.v1");
    }

    public function testGet()
    {
        $consul = new Consul(
            "http://127.0.0.1:8500"
        );
        $service = $consul->getService("basic.service.v1");
        $this->assertNotEmpty($service);
    }
}