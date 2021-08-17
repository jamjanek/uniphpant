<?php
declare(strict_types=1);

namespace App\Shrt\Domain;

interface ApiServiceInterface
{

    public function getConfig();
    public function getHttpClient();
    public function callAllEndpointsByRepoName(string $repoName):array;
    public function callApiRateLimit():array;
}
