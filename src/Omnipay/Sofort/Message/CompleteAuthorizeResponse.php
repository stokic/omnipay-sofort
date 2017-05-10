<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class CompleteAuthorizeResponse
 * @package Omnipay\Sofort\Message
 */
class CompleteAuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data->transaction_details);
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return in_array($this->data->transaction_details->status, array('loss', 'refunded')) ? static::STATUS_FAILED : static::STATUS_COMPLETED;
    }
}
