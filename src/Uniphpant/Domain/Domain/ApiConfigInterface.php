<?php
declare(strict_types=1);

namespace App\Shrt\Domain;

interface ApiConfigInterface
{
    public function getHostUrl();
    public function getHeadersConfig();
    public function getEndpointConfig($name);
    public function getAllEndpointsConfig();
    public function getExtraEndpointConfig($name);
}
