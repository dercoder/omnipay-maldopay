<?php

namespace Omnipay\MaldoPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\MaldoPay\Message\PurchaseRequest;
use Omnipay\MaldoPay\Message\CompletePurchaseRequest;

class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'MaldoPay';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'apiKey'        => '',
            'clientId'      => '',
            'brandId'       => '',
            'integrationId' => '',
            'testMode'      => false,
        ];
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setClientId($value)
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->getParameter('brandId');
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setBrandId($value)
    {
        return $this->setParameter('brandId', $value);
    }

    /**
     * @return int
     */
    public function getIntegrationId()
    {
        return $this->getParameter('integrationId');
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setIntegrationId($value)
    {
        return $this->setParameter('integrationId', $value);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\MaldoPay\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\MaldoPay\Message\CompletePurchaseRequest', $parameters);
    }
}
