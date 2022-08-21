<?php

namespace App\Components\Novaposhta\Settings;

class NovaposhtaApiClientSettings
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $uri;

    /**
     * NovaposhtaApiClientSettings constructor.
     * @param string $apiKey
     * @param string $uri
     */
    public function __construct()
    {
        $this->apiKey = env('NOVAPOSHTA_API_KEY');
        $this->uri = env('NOVAPOSHTA_URL_JSON');
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
