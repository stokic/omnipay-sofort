<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    public function testGetData()
    {
        $request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->initialize(array(
            'amount' => '10.00',
            'currency' => 'EUR',
            'description' => 'Order Description',
            'returnUrl' => 'https://www.example.com/return',
            'cancelUrl' => 'https://www.example.com/cancel',
            'notifyUrl' => 'https://www.example.com/notify',
        ));

        $data = $request->getData();

        $this->assertInstanceOf('SimpleXMLElement', $data);
        $this->assertSame('10.00', (string) $data->amount);
        $this->assertSame('EUR', (string) $data->currency_code);
        $this->assertSame('de', (string) $data->language_code);
        $this->assertSame('https://www.example.com/return', (string) $data->success_url);
        $this->assertSame('https://www.example.com/cancel', (string) $data->abort_url);
        $this->assertSame('https://www.example.com/notify', (string) $data->notification_urls[0]->notification_url);
        $this->assertSame('Order Description', (string) $data->reasons->reason);
        $this->assertSame('1', (string) $data->su->customer_protection);
    }
}