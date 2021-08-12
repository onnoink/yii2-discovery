<?php

namespace discovery\registrar;

interface Discovery
{
    function getService($serviceName, $tags = []);
}