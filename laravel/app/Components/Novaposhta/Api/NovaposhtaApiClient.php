<?php
namespace App\Components\Novaposhta\Api;

use App\Components\Novaposhta\Builder\NovaposhtaDeliveryCostBuilder;
use App\Components\Novaposhta\Builder\NovaposhtaResponseBuilder;
use App\Components\Novaposhta\Builder\NovaposhtaSettlementBuilder;
use App\Components\Novaposhta\Request\NovaposhtaRequest;
use App\Components\Novaposhta\Settings\NovaposhtaApiClientSettings;
use GuzzleHttp\Client;

class NovaposhtaApiClient
{
    /**
     * @var NovaposhtaApiClientSettings
     */
    private $settings;

    /**
     * @var Client
     */
    private $client;
    /**
     * @var NovaposhtaResponseBuilder
     */
    private $novaposhtaResponseBuilder;

    /**
     * NovaposhtaApiClient constructor.
     * @param NovaposhtaApiClientSettings $settings
     * @param NovaposhtaResponseBuilder $novaposhtaResponseBuilder
     * @param Client $client
     */
    public function __construct(
        NovaposhtaApiClientSettings $settings,
        NovaposhtaResponseBuilder $novaposhtaResponseBuilder,
        Client $client
    )
    {
        $this->settings = $settings;
        $this->client = $client;
        $this->novaposhtaResponseBuilder = $novaposhtaResponseBuilder;
    }

    public function getSettlements(NovaposhtaRequest $request)
    {
        $response = $this->client->post($this->settings->getUri(), [
            'json' => $this->buildRequestBody($request)
        ]);

        $this->novaposhtaResponseBuilder->setItemBuilder(new NovaposhtaSettlementBuilder());

        $data = json_decode($response->getBody()->getContents(), true);

        if (!$data) {
            throw new \InvalidArgumentException('Invalid Response');
        }

        $response = $this->novaposhtaResponseBuilder->build($data);
        $response->setCurrentPage($request->getPage());

        return $response;
    }

    public function getDeliveryCost(NovaposhtaRequest $request)
    {
        $response = $this->client->post($this->settings->getUri(), [
            'json' => $this->buildRequestBody($request)
        ]);

        $this->novaposhtaResponseBuilder->setItemBuilder(new NovaposhtaDeliveryCostBuilder());

        $data = json_decode($response->getBody()->getContents(), true);

        if (!$data) {
            throw new \InvalidArgumentException('Invalid Response');
        }

        $response = $this->novaposhtaResponseBuilder->build($data);
        $response->setCurrentPage($request->getPage());

        return $response;
    }

    /**
     * @param NovaposhtaRequest $request
     * @return array
     */
    private function buildRequestBody(NovaposhtaRequest $request): array
    {
        return [
            'modelName' => $request->getModelName(),
            'calledMethod' => $request->getMethod(),
            'apiKey' => $this->settings->getApiKey(),
            'methodProperties' => $request->getProperties()
        ];
    }

}
