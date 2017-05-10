<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class AbstractResponse
 * @package Omnipay\Sofort\Message
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse implements NotificationInterface
{
    /**
     * AbstractResponse constructor.
     * @param RequestInterface $request
     * @param mixed $response
     */
    public function __construct(RequestInterface $request, $response)
    {
        parent::__construct($request, $response);
        $this->data = $response->xml();
    }


    /**
     * @return null|string
     */
    public function getMessage()
    {
        if (!isset($this->data->error)) {
            return null;
        }

        $message = '';

        foreach ($this->data->error as $error) {
            $message .= $error->code . ': ' . $error->message . ' ';
        }

        return $message;
    }
}
