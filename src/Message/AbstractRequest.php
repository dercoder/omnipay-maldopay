<?php

namespace Omnipay\MaldoPay\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://api.maldopay.com/json/transactions';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://api.maldopay.com/json/sandbox/transactions';

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
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
