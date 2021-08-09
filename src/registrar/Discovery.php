<?php

namespace AlphaCar\Discovery\Registrar;

interface Discovery
{
    function getService($serviceName, $tags = []);
}