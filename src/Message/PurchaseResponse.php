<?php

namespace Omnipay\MaldoPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() >= 200 && $this->getCode() <= 299;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->getCode() >= 300 && $this->getCode() <= 399;
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return $this->getCode() >= 500 && $this->getCode() <= 599;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data['redirect']);
    }

    /**
     * @return int|null
     */
    public function getCode()
    {
        return isset($this->data['transaction']['codeId']) ? (int)$this->data['transaction']['codeId'] : null;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return isset($this->data['transaction']['codeMessage']) ? $this->data['transaction']['codeMessage'] : null;
    }

    /**
     * @return int|null
     */
    public function getServiceId()
    {
        return isset($this->data['transaction']['serviceId']) ? (int)$this->data['transaction']['serviceId'] : null;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['transaction']['transactionId']) ? $this->data['transaction']['transactionId'] : null;
    }
}
