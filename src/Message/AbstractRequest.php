<?php

namespace Omnipay\MaldoPay\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://api.maldopay.com/json';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://api.maldopay.com/json/sandbox';

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
        return $this->setParameter('clientId', (int)$value);
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
        return $this->setParameter('brandId', (int)$value);
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
        return $this->setParameter('integrationId', (int)$value);
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
     * @return string
     */
    public function getPendingUrl()
    {
        return $this->getParameter('pendingUrl');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setPendingUrl($value)
    {
        return $this->setParameter('pendingUrl', $value);
    }

    /**
     * @param string $path
     *
     * @return string
     */
    protected function createUri($path)
    {
        return sprintf('%s/%s/', $this->getEndpoint(), $path);
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
