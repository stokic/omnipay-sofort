<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 * @package Omnipay\Sofort\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data->transaction);
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data->transaction) && isset($this->data->payment_url) && !isset($this->data->errors);
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return (string)$this->data->payment_url;
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return array
     */
    public function getRedirectData()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getTransactionReference()
    {
        return (string)$this->data->transaction;
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return static::STATUS_PENDING;
    }
}
