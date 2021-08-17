<?php
declare(strict_types=1);

namespace App\Shrt\Domain;

class ApiConfig implements ApiConfigInterface
{
    private $host;
    private $headers;
    private $endpoints;
    private $extra;

    public function __construct(array $config)
    {
        $this->host = $config['host'];
        $this->headers = $config['headers'];
        $this->endpoints = $config['endpoints'];
        $this->extra = $config['extra'];
    }

    public function getHostUrl(){
        return $this->host['url'];
    }

    public function getHeadersConfig()
    {
        return $this->headers;
    }

    public function getEndpointConfig($name)
    {
        if(array_key_exists($name,$this->endpoints)) {
            return $this->endpoints[$name];
        }

        return null;
    }

    public function getAllEndpointsConfig()
    {
        return $this->endpoints;
    }

    public function getAllEndpointsCount()
    {
        return count($this->endpoints);
    }

    public function getExtraEndpointConfig($name)
    {
        if(array_key_exists($name,$this->extra)) {
            return $this->extra[$name];
        }

        return null;
    }
}
































