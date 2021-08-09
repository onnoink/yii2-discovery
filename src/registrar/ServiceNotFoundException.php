<?php


namespace AlphaCar\Discovery\Registrar;


use yii\base\Exception;

class ServiceNotFoundException extends Exception
{
    public function __construct($message = 'service not found', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}