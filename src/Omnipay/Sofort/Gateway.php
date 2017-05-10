<?php

namespace Omnipay\Sofort;

use Omnipay\Common\AbstractGateway;

/**
 * Class Gateway
 * @package Omnipay\Sofort
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Sofort';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'password' => '',
            'projectId' => '',
            'protection' => true,
            'testMode' => false,
        );
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * @param $value
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setProtection($value)
    {
        return $this->setParameter('protection', $value);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Sofort\Message\PurchaseRequest', $parameters);
    }

    /**
     * Handle notification callback.
     * Replaces completeAuthorize() and completePurchase()
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function acceptNotification(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Sofort\Message\NotifyRequest', $parameters);
    }

    /**
     * Please now use purchase()
     * @deprecated
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function authorize(array $parameters = array())
    {
        return $this->purchase($parameters);
    }

    /**
     * Please now use acceptNotification()
     * @deprecated
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function completeAuthorize(array $parameters = array())
    {
        return $this->acceptNotification($parameters);
    }

    /**
     * Please now use acceptNotification()
     * @deprecated
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->acceptNotification($parameters);
    }
}
