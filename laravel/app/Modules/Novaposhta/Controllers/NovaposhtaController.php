<?php

namespace App\Modules\Novaposhta\Controllers;

use App\Components\Novaposhta\Request\NovaposhtaRequest;
use App\Components\Novaposhta\Api\NovaposhtaApiClient;
use App\Modules\Novaposhta\Requests\NovaposhtaCalculateDeliveryRequest;
use App\Modules\Novaposhta\Requests\NovaposhtaSearchSettlementsRequest;
use App\Components\Novaposhta\Settings\NovaposhtaApiClientSettings;
use App\Components\Novaposhta\Builder\NovaposhtaResponseBuilder;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;

class NovaposhtaController extends Controller
{
    public function searchSettlements(NovaposhtaSearchSettlementsRequest $request)
    {
        $apiClientSettings = new NovaposhtaApiClientSettings();
        $responseBuilder = new NovaposhtaResponseBuilder();
        $httpClient = new Client();

        $apiClient = new NovaposhtaApiClient(
            $apiClientSettings,
            $responseBuilder,
            $httpClient
        );

        $novaposhtaRequest = new NovaposhtaRequest();
        $novaposhtaRequest->setMethod(NovaposhtaRequest::SETTLEMENTS_METHOD);
        $novaposhtaRequest->setModelName(NovaposhtaRequest::ADDRESS_MODEL);
        $novaposhtaRequest->setProperties([
            'FindByString' => $request->search,
        ]);

        $settlements = $apiClient->getSettlements($novaposhtaRequest);

        return response()->json([
            'items' => $settlements->getItems(),
        ]);;
    }


    public function calculateDelivery(NovaposhtaCalculateDeliveryRequest $request){
        $apiClientSettings = new NovaposhtaApiClientSettings();
        $responseBuilder = new NovaposhtaResponseBuilder();
        $httpClient = new Client();

        $apiClient = new NovaposhtaApiClient(
            $apiClientSettings,
            $responseBuilder,
            $httpClient
        );

        $novaposhtaRequest = new NovaposhtaRequest();
        $novaposhtaRequest->setMethod(NovaposhtaRequest::DOCUMENT_PRICE);
        $novaposhtaRequest->setModelName(NovaposhtaRequest::INTERNET_DOCUMENT);
        $novaposhtaRequest->setProperties([
            'CitySender' => $request->citySender,
            'CityRecipient' => $request->cityRecipient,
            'CargoType' => $request->deliveryType,
            'ServiceType' => $request->serviceType,
            'OptionsSeat' => $request->optionsSeat,
            'CargoDetails' => $request->cargoDetails,
            'Weight' => 1,
        ]);
        $delivery = $apiClient->getDeliveryCost($novaposhtaRequest);

        if ($delivery->getErrors()) {
            return response()->json([
                'error' => $delivery->getErrors(),
            ]);
        }
        return response()->json([
            'delivery' => $delivery->getFirstItem(),
        ]);
    }
}
