<?php

namespace Omnipay\Sofort\Message;

/**
 * Class AbstractRequest
 * @package Omnipay\Sofort\Message
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = 'https://api.sofort.com/api/xml';

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->getParameter('projectId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setProjectId($value)
    {
        return $this->setParameter('projectId', $value);
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->getParameter('country');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }

    /**
     * @return mixed
     */
    public function getProtection()
    {
        return $this->getParameter('protection');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setProtection($value)
    {
        return $this->setParameter('protection', $value);
    }

    /**
     * @param $userVariable
     * @return $this
     */
    public function setUserVariable($userVariable)
    {
        $this->setParameter('user_variable', $userVariable);

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getUserVariable()
    {
        return $this->getParameter('user_variable');
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient
            ->post($this->getEndpoint(), null, $data->asXML())
            ->setAuth($this->getUsername(), $this->getPassword())
            ->send();

        return $this->createResponse($httpResponse);
    }

    /**
     * @param $httpResponse
     * @return mixed
     */
    abstract protected function createResponse($httpResponse);

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }
}
