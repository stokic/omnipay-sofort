<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use SimpleXMLElement;

/**
 * Class NotifyRequest
 * @package Omnipay\Sofort\Message
 */
class NotifyRequest extends AbstractRequest
{
    /**
     * @return SimpleXMLElement
     * @throws InvalidRequestException
     */
    public function getData()
    {
        if (empty($this->getTransactionReference())) {

            $xml = new SimpleXMLElement($this->httpRequest->getContent());

            if (isset($xml->transaction)) {
                $this->setTransactionReference((string)$xml->transaction);
            } else {
                throw new InvalidRequestException("The transaction parameter is required");
            }
        }

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
        return $this->response = new NotifyResponse($this, $response);
    }
}
