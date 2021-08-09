<?php


namespace AlphaCar\Discovery\Registrar;


use yii\base\Exception;

class ServerConnectionException extends Exception
{
    public function __construct($message = 'fail to connect to discovery server', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}