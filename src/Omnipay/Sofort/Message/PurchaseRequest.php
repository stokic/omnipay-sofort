<?php

namespace Omnipay\Sofort\Message;

use SimpleXMLElement;

/**
 * Class PurchaseRequest
 * @package Omnipay\Sofort\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @return SimpleXMLElement
     */
    public function getData()
    {
        $data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><multipay/>');

        $data->addChild('project_id', $this->getProjectId());
        $data->addChild('amount', $this->getAmount());
        $data->addChild('currency_code', $this->getCurrency());
        $data->addChild('success_url', str_replace('&', '&amp;', $this->getReturnUrl()));
        $data->addChild('abort_url', str_replace('&', '&amp;', $this->getCancelUrl()));
        $data->addChild('notification_urls')->addChild(
            'notification_url',
            str_replace('&', '&amp;', $this->getNotifyUrl())
        );

        //user variable
        $data->addChild('user_variables')->addChild(
            'user_variable', $this->getUserVariable()
        );

        $reasons = $data->addChild('reasons');

        if (is_string($this->getDescription())) {
            $reasons->addChild('reason', $this->getDescription());
        } elseif (is_array($this->getDescription())) {
            foreach ($this->getDescription() as $reason) {
                $reasons->addChild('reason', $reason);
            }
        }

        $su = $data->addChild('su');
        $su->addChild('customer_protection', (int)(bool)$this->getProtection());

        $sender = $data->addChild('sender');
        $sender->addChild('country_code', $this->getCountry());

        return $data;
    }

    /**
     * @param $response
     * @return PurchaseResponse
     */
    protected function createResponse($response)
    {
        return $this->response = new PurchaseResponse($this, $response);
    }
}
