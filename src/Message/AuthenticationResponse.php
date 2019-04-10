<?php

namespace Omnipay\MaldoPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class AuthenticationResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() === 0;
    }

    /**
     * @return int|null
     */
    public function getCode()
    {
        return isset($this->data['response']['codeId']) ? (int)$this->data['response']['codeId'] : null;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return isset($this->data['response']['codeMessage']) ? $this->data['response']['codeMessage'] : null;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return isset($this->data['response']['userId']) ? (int)$this->data['response']['userId'] : null;
    }

    /**
     * @return string|null
     */
    public function getToken()
    {
        return isset($this->data['response']['token']) ? $this->data['response']['token'] : null;
    }
}
