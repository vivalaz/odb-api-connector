<?php

namespace Vivalaz\OdbApiConnector\Services;

use Illuminate\Http\Response;
use Ixudra\Curl\CurlService;
use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class BaseService
{

    protected $curl;
    protected $apiKey;

    public function __construct()
    {
        $this->curl = new CurlService;
    }

    /**
     * Set initial service params
     * @param string $apiKey
     * @return $this
     */
    public function setArgs(string $apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Send request to OpenDataBot API with params
     * @param string $path - API path from docs
     * @param array $params - array of data
     * @return mixed
     * @throws ODBException
     */
    protected function openDataBotRequest(string $path = '', array $params = [])
    {
        if (!$this->apiKey) {
            throw ODBException::apiKeyNotSpecified();
        }

        $requestParams = array_merge([
            'apiKey' => $this->apiKey
        ], $params);

        $response = $this->curl->to("https://opendatabot.ua/api/v2${path}")
            ->withData($requestParams)
            ->asJson()
            ->returnResponseObject()
            ->get();

        return $this->getResponseContent($response);
    }

    /**
     * Check response status
     * If not equals HTTP_OK then throws exception with specific message
     * If equals HTTP_OK then returns content
     * @param $response
     * @return mixed
     * @throws ODBException
     */
    private function getResponseContent($response)
    {
        switch ($response->status) {
            case Response::HTTP_FORBIDDEN:
                throw ODBException::apiKeyNotSpecified();
            case Response::HTTP_PAYMENT_REQUIRED:
                throw ODBException::paymentRequired();
            case Response::HTTP_BAD_REQUEST:
                throw ODBException::badRequest($response->content);
            case Response::HTTP_NOT_FOUND:
                throw ODBException::notFound();
            case Response::HTTP_SERVICE_UNAVAILABLE:
                throw ODBException::serviceUnavailable();
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                throw ODBException::internalError();
            case Response::HTTP_OK:
                return $response->content;
        }
    }

    /**
     * Отримання повної інформації про використання API запитів
     * @return mixed
     * @throws ODBException
     */
    public function getApiUsageStatistics()
    {
        return $this->openDataBotRequest("/statistics");
    }

}
