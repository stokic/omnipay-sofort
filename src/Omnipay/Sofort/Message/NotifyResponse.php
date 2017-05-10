<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class NotifyResponse
 * @package Omnipay\Sofort\Message
 */
class NotifyResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data->transaction_details);
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        if (isset($this->data->transaction_details->transaction)) {
            return (string)$this->data->transaction_details->transaction;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return in_array($this->data->transaction_details->status, array('loss', 'refunded')) ? static::STATUS_FAILED : static::STATUS_COMPLETED;
    }
}
