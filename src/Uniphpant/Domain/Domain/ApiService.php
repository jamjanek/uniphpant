<?php
declare(strict_types=1);

namespace App\Shrt\Domain;

use Zend\Json\Json;

class ApiService implements ApiServiceInterface
{
    private $config;
    private $repository;
    private $http_client;

    public function __construct(ApiConfigInterface $apiConfig, ApiClient $httpClient)
    {
        $this->config = $apiConfig;
        $this->http_client = $httpClient;

        $this->getHttpClient()->setHeaders($this->getConfig()->getHeadersConfig());
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getHttpClient()
    {
        return $this->http_client;
    }

    public function callAllEndpointsByRepoName(string $repoName):array
    {
        $endpointsConfig = $this->getConfig()->getAllEndpointsConfig();
        $apiResult = null;

        foreach($endpointsConfig as $endpointConfig) {
            $apiResult[$endpointConfig['name']] = $this->callRepoEndpoint($repoName,$endpointConfig['name']);


            $apiResult['repo_name'] = $repoName;
            // fetch and set url
            $endpointUri = sprintf($endpointConfig['uri'],$repoName);
            $endpointUrl = sprintf("%s%s",$this->getConfig()->getHostUrl(),$endpointUri);
            $this->getHttpClient()->setUri($endpointUrl);

            $apiResponse = $this->getHttpClient()->send();
            if($apiResponse->isSuccess()) {
                $apiResult[$endpointConfig['name']] = Json::decode($apiResponse->getBody(), Json::TYPE_ARRAY);
            } else {
                $apiResult[$endpointConfig['name']]['error']['reason'] = $apiResponse->getReasonPhrase();
                $apiResult[$endpointConfig['name']]['error']['is_client_error'] = $apiResponse->isClientError();
            }
            // #TODO hydrate response
        }

        return $apiResult;
    }
    public function callRepoEndpoint($repoName,$endpointName)
    {
        // call http client

        // hydrate response

        return;
    }

    public function callEndpoint($repoName, $endpointName)
    {
        // TODO: Implement callEndpoint() method.
    }


    public function callApiRateLimit():array
    {
        $callConfig = $this->getConfig()->getExtraEndpointConfig('rate_limit');
        $endpointUrl = sprintf("%s%s",$this->getConfig()->getHostUrl(),$callConfig['url']);
        $apiResponse = $this->getHttpClient()->setUri($endpointUrl)->send();

        $response = Json::decode($apiResponse->getBody(), Json::TYPE_ARRAY);

        return $response;
    }

}