<?php

namespace Omnipay\MaldoPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AuthenticationRequest
{
    /**
     * @return int
     */
    public function getServiceId()
    {
        return $this->getParameter('serviceId');
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setServiceId($value)
    {
        return $this->setParameter('serviceId', (int)$value);
    }

    /**
     * @return string|null
     * @throws InvalidRequestException
     */
    public function getToken()
    {
        $request = new AuthenticationRequest($this->httpClient, $this->httpRequest);
        $request->initialize($this->getParameters());

        /** @var AuthenticationResponse $response */
        $response = $request->send();

        if (!$response->isSuccessful()) {
            throw new InvalidRequestException($response->getMessage(), $response->getCode());
        }

        return $response->getToken();
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'clientId',
            'brandId',
            'integrationId',
            'serviceId',
            'currency',
            'amount',
            'clientIp',
            'transactionId'
        );

        $transaction = [
            'clientId'      => $this->getClientId(),
            'brandId'       => $this->getBrandId(),
            'integrationId' => $this->getIntegrationId(),
            'landingPages'  => [
                'landingSuccess'  => $this->getReturnUrl(),
                'landingPending'  => $this->getPendingUrl(),
                'landingDeclined' => $this->getCancelUrl(),
                'landingFailed'   => $this->getCancelUrl(),
            ],
            'request'       => [
                'serviceId'        => $this->getServiceId(),
                'currencyCode'     => $this->getCurrency(),
                'type'             => 'DEPOSIT',
                'token'            => $this->getToken(),
                'ipAddr'           => $this->getClientIp(),
                'amount'           => $this->getAmountInteger(),
                'reason'           => $this->getDescription(),
                'referenceOrderId' => $this->getTransactionId(),
            ],
        ];

        return ['transaction' => $transaction];
    }

    /**
     * @param array $data
     *
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('transactions');
        $response = $this->httpClient
            ->post($uri, null, [
                'json'   => json_encode($data),
                'apiKey' => $this->getApiKey(),
            ])
            ->send();

        echo(json_encode($data));

        echo($response->getBody(true));
        die();

        $data = json_decode($response->getBody(true), true);
        return new PurchaseResponse($this, $data);
    }
}
