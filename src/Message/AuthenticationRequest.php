<?php

namespace Omnipay\MaldoPay\Message;

use Exception;
use DateTime;
use DateTimeZone;
use Omnipay\Common\Exception\InvalidRequestException;

class AuthenticationRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->getParameter('company');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCompany($value)
    {
        return $this->setParameter('company', $value);
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getParameter('firstName');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setFirstName($value)
    {
        return $this->setParameter('firstName', $value);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->getParameter('lastName');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setLastName($value)
    {
        return $this->setParameter('lastName', $value);
    }

    /**
     * @param string $format
     *
     * @return string|null
     */
    public function getBirthday($format = 'Y-m-d')
    {
        $value = $this->getParameter('birthday');

        return $value ? $value->format($format) : null;
    }

    /**
     * @param $value
     *
     * @return $this
     * @throws Exception
     */
    public function setBirthday($value)
    {
        if ($value && !($value instanceof DateTime)) {
            $value = new DateTime($value, new DateTimeZone('UTC'));
        }

        return $this->setParameter('birthday', $value);
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->getParameter('userId');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setUserId($value)
    {
        return $this->setParameter('userId', $value);
    }

    /**
     * @return string
     */
    public function getPassportNumber()
    {
        return $this->getParameter('passportNumber');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setPassportNumber($value)
    {
        return $this->setParameter('passportNumber', $value);
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->getParameter('country');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCountry($value)
    {
        return $this->setParameter('country', strtoupper($value));
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->getParameter('postCode');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setPostCode($value)
    {
        return $this->setParameter('postCode', $value);
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->getParameter('city');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCity($value)
    {
        return $this->setParameter('city', $value);
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->getParameter('address');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setAddress($value)
    {
        return $this->setParameter('address', $value);
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', strtoupper($value));
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', strtolower($value));
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setPhone($value)
    {
        return $this->setParameter('phone', $value);
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
            'firstName',
            'lastName',
            'birthday',
            'country',
            'userId',
            'postCode',
            'currency',
            'language',
            'email'
        );

        $request = [
            'firstName'    => $this->getFirstName(),
            'lastName'     => $this->getLastName(),
            'birthDate'    => $this->getBirthday(),
            'countryCode'  => $this->getCountry(),
            'playerId'     => $this->getUserId(),
            'postCode'     => $this->getPostCode(),
            'currencyCode' => $this->getCurrency(),
            'languageCode' => $this->getLanguage(),
            'emailAddress' => $this->getEmail(),
        ];

        if ($company = $this->getCompany()) {
            $request['company'] = $company;
        }

        if ($address = $this->getAddress()) {
            $request['address'] = $address;
        }

        if ($passportNumber = $this->getPassportNumber()) {
            $request['passportNo'] = $passportNumber;
        }

        if ($city = $this->getCity()) {
            $request['city'] = $city;
        }

        if ($phone = $this->getPhone()) {
            $request['phone'] = $phone;
        }

        if ($clientIp = $this->getClientIp()) {
            $request['ipAddr'] = $clientIp;
        }

        $auth = [
            'clientId' => $this->getClientId(),
            'brandId'  => $this->getBrandId(),
            'request'  => $request,
        ];

        return ['auth' => $auth];
    }

    /**
     * @param array $data
     *
     * @return AuthenticationResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('auth');
        $response = $this->httpClient
            ->post($uri, null, [
                'json'   => json_encode($data),
                'apiKey' => $this->getApiKey(),
            ])
            ->send();

        $data = json_decode($response->getBody(true), true);
        return new AuthenticationResponse($this, $data);
    }
}
