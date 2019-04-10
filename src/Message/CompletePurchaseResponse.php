<?php

namespace Omnipay\MaldoPay\Message;

use Exception;
use DateTime;
use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @const string
     */
    const RESULT_CONFIRMED = 'CONFIRMED';

    /**
     * @const string
     */
    const RESULT_CANCELED = 'CANCELED';

    /**
     * @const string
     */
    const RESULT_DECLINED = 'DECLINED';

    /**
     * @const string
     */
    const RESULT_PENDING = 'PENDING';

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getResult() === self::RESULT_CONFIRMED;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->getResult() === self::RESULT_PENDING;
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return in_array($this->getResult(), [self::RESULT_CANCELED, self::RESULT_DECLINED]);
    }

    /**
     * @return string|null
     */
    public function getResult()
    {
        return isset($this->data['result']) ? $this->data['result'] : null;
    }

    /**
     * @return int|null
     */
    public function getCode()
    {
        return isset($this->data['codeId']) ? (int)$this->data['codeId'] : null;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return isset($this->data['reason']) ? $this->data['reason'] : null;
    }

    /**
     * @return int|null
     */
    public function getServiceId()
    {
        return isset($this->data['serviceId']) ? (int)$this->data['serviceId'] : null;
    }

    /**
     * @return string|null
     */
    public function getTransactionId()
    {
        return isset($this->data['referenceOrderId']) ? $this->data['referenceOrderId'] : null;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['maldoTransactionId']) ? $this->data['maldoTransactionId'] : null;
    }

    /**
     * @return float|null
     */
    public function getAmount()
    {
        return isset($this->data['amount']) ? (float)$this->data['amount'] : null;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return isset($this->data['currency']) ? $this->data['currency'] : null;
    }

    /**
     * @return DateTime|null
     * @throws Exception
     */
    public function getUpdatedAt()
    {
        return isset($this->data['dateUpdated']) ? new DateTime($this->data['dateUpdated']) : null;
    }
}
