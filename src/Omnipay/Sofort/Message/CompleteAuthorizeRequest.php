<?php

namespace Omnipay\Sofort\Message;

use SimpleXMLElement;

/**
 * Class CompleteAuthorizeRequest
 * @package Omnipay\Sofort\Message
 */
class CompleteAuthorizeRequest extends AbstractRequest
{
    /**
     * @return SimpleXMLElement
     */
    public function getData()
    {
        $data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><transaction_request/>');

        $data->addAttribute('version', 2);
        $data->addChild('transaction', $this->getTransactionReference());

        return $data;
    }

    /**
     * @param $response
     * @return CompleteAuthorizeResponse
     */
    protected function createResponse($response)
    {
        return $this->response = new CompleteAuthorizeResponse($this, $response);
    }
}
