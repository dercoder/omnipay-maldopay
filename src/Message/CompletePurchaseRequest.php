<?php

namespace Omnipay\MaldoPay\Message;

class CompletePurchaseRequest extends AuthenticationRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    /**
     * @param array $data
     *
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }
}
