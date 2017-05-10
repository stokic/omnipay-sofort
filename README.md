SOFORT Überweisung Omnipay gateway
==============

[![Build Status](https://travis-ci.org/aimeoscom/omnipay-sofort.png?branch=master)](https://travis-ci.org/aimeoscom/omnipay-sofort)
[![Coverage Status](https://coveralls.io/repos/github/aimeoscom/omnipay-sofort/badge.svg?branch=master)](https://coveralls.io/github/aimeoscom/omnipay-sofort?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/aimeoscom/omnipay-sofort/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/aimeoscom/omnipay-sofort/?branch=master)

[SOFORT Überweisung](https://www.sofort.com/eng-INT/) gateway for awesome [Omnipay](https://github.com/adrianmacneil/omnipay) library.

#### API Notes

This gateway only provides 2 methods to place a successful transaction. The first one is `purchase` which initializes a purchase and returns a redirect url.

The second one is `acceptNotification`. This method receives status notification from SOFORT Überweisung and validates it by getting `transaction_details` from the API.

#### Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply run:

```
composer require gentor/omnipay-sofort
```

#### Usage

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay) repository.

**1. Purchase**

```php
$gateway = Omnipay::create('Sofort');
$gateway->initialize(array(
    'username' => 'sofort_customer_id',
    'password' => 'sofort_api_key',
    'projectId' => 'sofort_project_id',
    'testMode' => true
));

$response = $gateway->purchase(array(
    'amount' => 199.00,
    'description' => 'Google Nexus 4',
))->send();

if ($response->isSuccessful() && $response->isRedirect()) {
    // redirect to offsite payment gateway
    $transactionReference = $response->getTransactionReference();
    $transactionStatus = $response->getTransactionStatus();
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

```

**2. Accept Notification**

```php
$gateway = Omnipay::create('Sofort');
$gateway->initialize(array(
    'username' => 'sofort_customer_id',
    'password' => 'sofort_api_key',
    'projectId' => 'sofort_project_id',
    'testMode' => true
));

$response = $gateway->acceptNotification()->send();

if ($response->isSuccessful()) {
    // payment was successful
    $transactionReference = $response->getTransactionReference();
    $transactionStatus = $response->getTransactionStatus();
    print_r($response);
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

```
